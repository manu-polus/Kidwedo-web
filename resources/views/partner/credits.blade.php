@extends('layouts.partner')
@section('title')
My Credits
@endsection
@section('content')
<!--credits-view-contents-->
<section class="container-fluid register-bg">
				<div class="container">
				<div class="activity-view my-messages mb-20 w-100">
					<h5>CREDITS</h5>
					<div class="row p-15 msg-list">
						<div class="col-lg-6 available-credit">
                        @if(count($credits) > 0)
							<p>
							Gesamt Umsatz: {{ $total }} €<span>
                               </span>
							</p>
                        @endif
						</div>
						<div class="col-lg-12">
							<div class="credit-table-outer">
                            
							<table class="table">
                            @if(count($credits) > 0)
							  <thead>
							    <tr>
							      <th scope="col">Transaktionen</th>
							      <th scope="col">Datum</th>
										<th scope="col" class="text-right">Credits</th>
										<th scope="col" class="text-center">|</th>
										<th scope="col">Euro</th>
							      
							    </tr>
							  </thead>
                              @endif
							  <tbody>
                              @forelse($credits as $credit)
							    <tr>
									<td>Aktivität: <a href="{{ route('partner_activity.view',['id' => $credit->event_date_id]) }}"><u>{{ $credit->event_name }}</u></a> | Kunde: {{ $credit->name }}</td>
							      <td>{{ date('d-m-Y', strtotime($credit->created_at)) }}</td>
							      <td class="text-right"><span class="{{ $credit->purchase_type == 1 ? 'av-credit' : 'minus-credit' }}"><img src="{{ asset('images/credit-icon.png') }}">{{ $credit->purchase_type == 1 ? '+' : '-' }}{{ $credit->credits }}</span> </td><td class="text-center">|</td>
										<td><span class="{{ $credit->purchase_type == 1 ? 'av-credit' : 'minus-credit' }}"> {{ $credit->credits_in_euro }}<span>&euro;</td>
							    </tr>
                                @empty
                                <div class="col-lg-12 a-not-found text-center v-h-center">
			                        <div>
				                        <h3>Keine Daten gefunden</h3>
				                    </div>
		                        </div>
                            @endforelse
							  </tbody>
							</table>
            </div>
						</div>
					</div>
				</div>
				</div>
			</section>
			<!--credits-view-contents end-->
@endsection