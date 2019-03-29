@extends('layouts.template')
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
							verfügbare Credits: {{$credits[0]->available_credits}}<span>
                               </span>
							</p>
              @endif
							@if(count($credits) == 0)
							<p>
							verfügbare Credits: 0<span>
                               </span>
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
							      <th scope="col">Anzahl Credits</th>
							@endif    
							    </tr>
							  </thead>
							  <tbody>
                              @forelse($credits as $credit)
							    <tr>
							      <td>{{ $credit->purchase_type == 1 ? 'Gutschrift' : 'Abgezogen : Aktivität' }} <a href="{{ route('activity.view',['id' => $credit->event_dates_id]) }}"><u>{{ $credit->event_name }}</u></a></td>
							      <td>{{ date('d-m-Y', strtotime($credit->created_at)) }}</td>
							      <td><span class="{{ $credit->purchase_type == 1 ? 'av-credit' : 'minus-credit' }}"><img src="{{ asset('images/credit-icon.png') }}">{{ $credit->purchase_type == 1 ? '+' : '-' }}{{ $credit->amount }}</span></td>
							    </tr>
                                @empty
                                <div class="col-lg-12 a-not-found text-center v-h-center">
			                        <div>
				                        <h3>Currently no Credits</h3>
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