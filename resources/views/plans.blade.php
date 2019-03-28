@extends('layouts.template')

@section('plans')

    @if ($message = Session::get('success'))
        <div class="w3-panel w3-green w3-display-container">
            <span onclick="this.parentElement.style.display='none'"
    				class="w3-button w3-green w3-large w3-display-topright">&times;</span>
            <p>{!! $message !!}</p>
        </div>
        <?php Session::forget('success');?>
@endif  

@if ($message = Session::get('error'))
    <div class="w3-panel w3-red w3-display-container">
        <span onclick="this.parentElement.style.display='none'"
    			class="w3-button w3-red w3-large w3-display-topright">&times;</span>
        <p>{!! $message !!}</p>
    </div>
    <?php Session::forget('error');?>
@endif
<div class="container">
  <div class="top-space">
    <div class="row">
        <div class="col-lg-4">
        </div>
        <div class="col-lg-4">
            <div class="bottom-space">
                <div class="card" style="width: 18rem; background: #9d9d99">
                    <div class="card-body">
                        <center><h1>Basic Plan</h1></center>
                        <!--<p class="card-text" style="text-align: center">This Subscription provides you <b>6 Months</b> Active account.</p>-->
                        <p class="card-text" style="text-align: center; font-weight: bold">Price - 20$ for first Month</p>
                        <center>
                            <form method="get" action="{{ route('register') }}">
                                @csrf
                                <input type="hidden" name="plan" value="trial">
                                <button type="submit" class="btn btn-danger">SELECT PLAN</button>
                            </form>
                        </center>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
        </div>
    </div>
  </div>
</div>
@endsection