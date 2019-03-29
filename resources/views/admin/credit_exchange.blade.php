@extends('layouts.admin')

@section('content')
<!-- Horizontal Form -->
<div class="col-lg-12">
    <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <div class="box box-info">
            <div class="box-header with-border text-center">
              <h3 class="box-title">Euro-Credit-Wechselkurs</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" id="rate_form" method="post" action="{{ route('change_rate') }}">
            @csrf
              <div class="box-body">
                <div class="form-group">
                  <div class="col-sm-12">
                   <label for="credit">Credit</label>
                    <input type="text" class="form-control" id="credit" name="credit" value="{{ old('credit') ? old('credit') : ($exchange_rate != null ? $exchange_rate->credit_point : '') }}">
                    @if($errors->has('credit'))
                        <span class="invalid" role="alert">
                            <strong>{{ $errors->first('credit') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                      <label for="euro">Euro</label>
                    <input type="text" class="form-control" id="euro" name="euro" value="{{ old('euro') ? old('euro') : ($exchange_rate != null ? $exchange_rate->credit_euro : '') }}">
                    @if ($errors->has('euro'))
                        <span class="invalid" role="alert">
                            <strong>{{ $errors->first('euro') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-default">Stornieren</button>
                <button type="submit" class="btn btn-info pull-right" form="rate_form">Aktualisieren</button>
              </div>
              <!-- /.box-footer -->
            </form>
            <div class="exchange_message text-center">
            @if(session('exchange_message'))
                        {{ session('exchange_message') }}
                      @endif
</div>
          </div>
        </div>
        <div class="col-lg-3"></div>
          <!-- /.box -->
@endsection