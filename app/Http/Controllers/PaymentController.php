<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
/** All Paypal Details class **/
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use URL;
use App\User;
use App\payments;
use App\Purchase;

class PaymentController extends Controller
{
    private $_api_context;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }
    public function index()
    {
        return view('paywithpaypal');
    }
    public function payWithpaypal(Request $request)
    {
        //dd($request);
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName('Kidwedo Package') /** item name **/
            ->setCurrency($request->get('currency'))
            ->setQuantity(1)
            ->setPrice($request->get('amount')); /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency($request->get('currency'))
            ->setTotal($request->get('amount'));
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::to('status')) /** Specify return URL **/
            ->setCancelUrl(URL::to('status'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error', 'Connection timeout');
                return Redirect::to('/subscribe');
            } else {
                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::to('/subscribe');
            }
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        \Session::put('error', 'Unknown error occurred');
        return Redirect::to('/subscribe');
    }
    public function getPaymentStatus()
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
           /* DB::table('payments')->insert([
                'transaction_id' => $payment_id,
                'payer_name' => $name,
                'payer_email' => $result->payer->payer_info->email,
                'payer_id' => Input::get('PayerID'),
                'gateway' => 'paypal',
                'payer_user_id' => $user->user_id,
                'token' => Input::get('token'),
                'status' => $result->getState(),
                'amount' => $result->transactions[0]->amount->total,
                'currency' => $result->transactions[0]->amount->currency,
                'response' => serialize($result),
                'created_at' => $result->create_time,
                'updated_at' => $result->update_time
        ]); */
            \Session::put('error', 'Payment failed. Please try to pay again.');
            return Redirect::to('/subscribe');
        }
        $payinfo = new payments();
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        $name=$result->payer->payer_info->first_name." ".$result->payer->payer_info->last_name;
        if ($result->getState() == 'approved') {
            $payinfo->transaction_id = $payment_id;
            $payinfo->payer_name = $name;
            $payinfo->payer_email = $result->payer->payer_info->email;
            $payinfo->payer_id = Input::get('PayerID');
            $payinfo->gateway = 'paypal';
            $payinfo->payer_user_id = Auth::user()->id;
            $payinfo->plan_id = 1;
            $payinfo->token = Input::get('token');
            $payinfo->status = $result->getState();
            $payinfo->amount = $result->transactions[0]->amount->total;
            $payinfo->credits = 10;
            $payinfo->currency = $result->transactions[0]->amount->currency;
            $payinfo->response = serialize($result);
            $payinfo->save();
            
            $user=User::where('email', Auth::user()->email)->first();
            $user->status_id = 1;
            $cost = 10;
            if($user->available_credits != null)
            {
                $cost = $user->available_credits+10;
            }
            $user->available_credits = $cost; 
            $user->update();

            // $purchase = new Purchase();
            // $purchase->user_id = Auth::user()->id;
            // $purchase->event_plan_id = $payinfo->id;
            // $purchase->purchase_type_code = 1;
            // $purchase->purchase_status = "Active";
            // $purchase->save();

            $purchase_id = DB::table('user_purchase')
                ->insertGetId([
                    'user_id' => Auth::user()->id,
                    'event_plan_id' => 1,
                    'purchase_type_code' => 1,
                    'purchase_status'=> 'Active',
                    'credits' => 10,
                    "created_at" =>  \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now()
                ]);

            $data['payment'] = $payinfo;
            //return redirect()->route('paymentinfo',['id' => $payinfo->id]);
            return view('payment',$data);
        }
            $payinfo->transaction_id = $payment_id;
            $payinfo->payer_name = $name;
            $payinfo->payer_email = $result->payer->payer_info->email;
            $payinfo->payer_id = Input::get('PayerID');
            $payinfo->gateway = 'paypal';
            $payinfo->payer_user_id = Auth::user()->id;
            $payinfo->token = Input::get('token');
            $payinfo->status = $result->getState();
            $payinfo->amount = $result->transactions[0]->amount->total;
            $payinfo->currency = $result->transactions[0]->amount->currency;
            $payinfo->response = serialize($result);
            $payinfo->save();
            \Session::put('error', 'Payment failed');
        return Redirect::to('/subscribe');
    }

    public function readResponse()
    {
        $response=DB::table('payments')->select('response')->first();
        $response=unserialize($response->response);
        dd($response);
    }
}