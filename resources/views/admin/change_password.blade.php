@extends('layouts.admin')

@section('content')
<!-- Horizontal Form -->
<div class="col-lg-12">
    <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <div class="box box-info">
            <div class="box-header with-border text-center">
              <h3 class="box-title">Ändere das Passwort</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" id="pass_form" method="post" action="{{ route('change_password') }}">
            @csrf
              <div class="box-body">
                <div class="form-group">
                  <div class="col-sm-12">
                    <input type="password" class="form-control" id="password" placeholder="Derzeitiges Passwort" name="password">
                    @if(session('message'))
                        <span class="invalid" role="alert">
                            <strong>{{ session('message') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                    <input type="password" class="form-control" id="new_password" placeholder="Neues Kennwort" name="new_password">
                    @if ($errors->has('new_password'))
                        <span class="invalid" role="alert">
                            <strong>{{ $errors->first('new_password') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                    <input type="password" class="form-control" id="new_password_confirmation" placeholder="Confirm Password" name="new_password_confirmation">
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-default">Stornieren</button>
                <button type="submit" class="btn btn-info pull-right" form="pass_form">Passwort bestätigen</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
        </div>
        <div class="col-lg-3"></div>
          <!-- /.box -->
@endsection