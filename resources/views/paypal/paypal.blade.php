<html>
<head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
    <div class="w3-container">
        @if ($message = Session::get('error'))
        <div class="w3-panel w3-red w3-display-container">
            <span onclick="this.parentElement.style.display='none'"
    				class="w3-button w3-red w3-large w3-display-topright">&times;</span>
            <p>{!! $message !!}</p>
        </div>
        <?php Session::forget('error'); ?>
        @endif

        @if(app('request')->input('plan')!=null)
            @php
                session(['user_role_id' => app('request')->input('plan')]);
            @endphp
            @if(app('request')->input('plan')==1)
               @php session(['cost' => 10]); @endphp
            @endif
            @if(app('request')->input('plan')==2)
                @php session(['cost' => 20]); @endphp
            @endif
            @if(app('request')->input('plan')==3)
                @php session(['cost' => 30]); @endphp
            @endif
        @endif
        @if(app('request')->input('username')!=null)
            @php session(['username' => app('request')->input('username')]) @endphp
        @endif
    	<form class="w3-container w3-display-middle w3-card-4 w3-padding-16" method="POST" id="payment-form"
          action="{!! URL::to('paypal') !!}">
    	  <div class="w3-container w3-teal w3-padding-16">Paywith Paypal</div>
    	  @csrf
    	  <h2 class="w3-text-blue">Payment Form</h2>
    	  <p>Amount confirmation for your choosen Plan</p>
    	  <label class="w3-text-blue"><b>Amount to be Paid in US Dollar</b></label>
    	  <input class="w3-input w3-border" id="amount" type="text" value="{{ session('plan') ? session('plan') : session('cost') }}" disabled></p>
          <input class="w3-input w3-border" id="amount" type="hidden" name="amount" value="{{ session('plan') ? session('plan') : session('cost') }}">
    	  <button class="w3-btn w3-blue">Pay with PayPal</button>
    	</form>
    </div>
</body>
</html>