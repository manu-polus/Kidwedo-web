@extends('layouts.admin')
@section('dealerlist')

@php $count = 1; @endphp
<div class="box-header">
    <h3 class="box-title">{{ request()->is('admin/dealer/home') ? 'Active Dealers' : (request()->is('admin/dealer/waiting') ? 'Awaiting Dealers' : 'Blocked Dealers' ) }}</h3>
</div>
@php
    if(request()->is('admin/dealer/home'))
    {
        session(['route_type' => 1]);
    }
    if(request()->is('admin/dealer/waiting'))
    {
        session(['route_type' => 0]);
    }
    if(request()->is('admin/dealer/blocked'))
    {
        session(['route_type' => 2]);
    }
@endphp
<!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Business Name</th>
                  <th>Options</th>
                  <th></th>
                </tr>
                </thead>
                @foreach($dealer_list as $dealer)
                @php
                    $formdata=json_encode($dealer,JSON_HEX_APOS);
                @endphp
                <tr>
                  <td>{{ $count++ }}</td>
                  <td>{{ $dealer->business_name }}</td>
                  @if(($dealer->status_id)==1)
                    <td>
                        <i class="fa fa-eye modal-view" style="color: blue; cursor: pointer;" data-toggle="modal" data-target="#modal-info" title="View this Dealer" data-profile='<?php echo $formdata; ?>'></i>
                        <i class="fa fa-edit modal-edit" style="color: SaddleBrown; cursor: pointer;" data-toggle="modal" data-target="#modal-edit" title="Edit this Dealer" data-profile='<?php echo $formdata; ?>'></i>
                        <a href="{{ route('blockdealer',['id' => $dealer->user_id ]) }}"><i class="fa fa-ban" style="color: darkred" title="Block this Dealer"></i></a>
                        <a href="{{ route('deletedealer',['id' => $dealer->user_id ]) }}"><i class="fa fa-trash-o" style="color: red" title="Delete this Dealer" onclick="return delete_confirm()"></i></a>
                    </td>
                  @endif
                  @if(($dealer->status_id)==2)
                    <td>
                        <i class="fa fa-eye modal-view" style="color: blue; cursor: pointer;" data-toggle="modal" data-target="#modal-info" title="View this Dealer" data-profile='<?php echo $formdata; ?>'></i>
                        <i class="fa fa-edit modal-edit" style="color: SaddleBrown; cursor: pointer;" data-toggle="modal" data-target="#modal-edit" title="Edit this Dealer" data-profile='<?php echo $formdata; ?>'></i>
                        <a href="{{ route('acceptdealer',['id' => $dealer->user_id ]) }}"><i class="fa fa-thumbs-o-up" style="color: green" title="Accept this Dealer"></i></a>
                        <a href="{{ route('blockdealer',['id' => $dealer->user_id ]) }}"><i class="fa fa-ban" style="color: darkred" title="Block this Dealer"></i></a>
                        <a href="{{ route('deletedealer',['id' => $dealer->user_id ]) }}"><i class="fa fa-trash-o" style="color: red" title="Delete this Dealer" onclick="return delete_confirm()"></i></a>
                    </td>
                  @endif
                  @if(($dealer->status_id)==3)
                    <td>
                        <i class="fa fa-eye modal-view" style="color: blue; cursor: pointer;" data-toggle="modal" data-target="#modal-info" title="View this Dealer" data-profile='<?php echo $formdata; ?>'></i>
                        <i class="fa fa-edit modal-edit" style="color: SaddleBrown; cursor: pointer;" data-toggle="modal" data-target="#modal-edit" title="Edit this Dealer" data-profile='<?php echo $formdata; ?>'></i>
                        <a href="{{ route('acceptdealer',['id' => $dealer->user_id ]) }}"><i class="fa fa-thumbs-o-up" style="color: green" title="Accept this Dealer"></i></a>
                        <a href="{{ route('deletedealer',['id' => $dealer->user_id ]) }}"><i class="fa fa-trash-o" style="color: red" title="Delete this Dealer" onclick="return delete_confirm()"></i></a>
                    </td>
                  @endif
                </tr>
                @endforeach
              </table>
            </div>
            
            <div class="modal modal-default fade" id="modal-edit">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title"></h4>
                            </div>
                            <div class="modal-body">
                            <p>
                                <form id="edit_dealer" method="POST" action="{{ route('editdealer') }}">
                                @csrf
                                <strong>Business</strong><input type="text" class="form-control" value="{{ old('business_name') }}" name="business_name" id="business_name" style="color: black;" required>
                                    @if ($errors->has('business_name'))
                                    <span class="invalid-feedback" style="color: red" role="alert">
                                        <strong>{{ $errors->first('business_name') }}</strong>
                                    </span>
                                    @endif
                                    <br><br>
                                    <strong>Name</strong><input type="text" class="form-control" value="{{ old('name') }}" name="name" id="name" style="color: black;" required>
                                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" style="color: red" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                    <br><br>
                                    <input type="hidden" id="id" value="" name="id">
                                    <strong>E-Mail</strong><input type="email" class="form-control" value="{{ old('email') }}" name="email" id="email" style="color: black;" required disabled>
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" style="color: red" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                    <br><br>
                                    <strong>Address</strong><textarea class="form-control" name="address" id="address" style="color: black;" required>{{ old('address') }}</textarea>
                                    @if ($errors->has('address'))
                                    <span class="invalid-feedback" style="color: red" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                    <br><br>
                                    <strong>Website</strong><input type="text" class="form-control" value="{{ old('website') }}" name="website" id="website" style="color: black;">
                                    <br><br>
                                    <strong>Zipcode</strong><input type="text" class="form-control" value="{{ old('zipcode') }}" name="zipcode" id="zipcode" style="color: black;" required>
                                    @if ($errors->has('zipcode'))
                                    <span class="invalid-feedback" style="color: red" role="alert">
                                        <strong>{{ $errors->first('zipcode') }}</strong>
                                    </span>
                                    @endif
                                    <br><br>
                                    <strong>Contact Number</strong><input type="text" class="form-control" value="{{ old('contact') }}" name="contact" id="contact" style="color: black;" required>
                                    @if ($errors->has('contact'))
                                    <span class="invalid-feedback" style="color: red" role="alert">
                                        <strong>{{ $errors->first('contact') }}</strong>
                                    </span>
                                    @endif
                                    <br><br>
                                    <strong>About <span class="business"></span></strong><textarea name="about" id="about" class="form-control" style="color: black;" required>{{ old('about') }}</textarea>
                                    @if ($errors->has('about'))
                                    <span class="invalid-feedback" style="color: red" role="alert">
                                        <strong>{{ $errors->first('about') }}</strong>
                                    </span>
                                    @endif
                                </form>
                            </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal"><strong>Close</strong></button>
                                <button type="submit" form="edit_dealer" class="btn btn-outline"><strong>Save changes</strong></button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>

                <div class="modal modal-info fade" id="modal-info">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title"></h4>
                            </div>
                            <div class="modal-body">
                                <p>
                                    <strong>Name :</strong> <span class="viewname"></span><br>
                                    <strong>E-Mail :</strong> <span class="viewemail"></span><br>
                                    <strong>Address :</strong> <span class="viewaddress"></span><br>
                                    <strong>Website :</strong> <a href="" target="_blank" class="viewwebsitelink"><span class="viewwebsite"></span></a><br>
                                    <strong>Zipcode :</strong> <span class="viewzipcode"></span><br>
                                    <strong>Contact Number :</strong> <span class="viewcontact"></span><br><br>
                                    <strong>About <span class="viewbusiness"></span></strong><div class="viewabout"></div>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            <!-- /.box-body -->
            <script src="{{ asset('js/kidwedo.js') }}"></script>
            @if (count($errors) > 0)
            <script type="text/javascript">
                $('#modal-edit').modal('show');
            </script>
            @endif
            <script>
                $(".modal-view").click(function(){
                    var viewdata = $(this).data('profile');
                    $('.modal-title,.viewbusiness').html(viewdata.business_name);
                    $('.viewname').html(viewdata.name);
                    $('.viewemail').html(viewdata.email);
                    $('.viewaddress').html(viewdata.address);
                    $('.viewwebsite').html(viewdata.website);
                    $("a.viewwebsitelink").attr("href", viewdata.website);
                    $('.viewzipcode').html(viewdata.zipcode);
                    $('.viewcontact').html(viewdata.mobile_number);
                    $('.viewabout').html(viewdata.description);
                });

                $(".modal-edit").click(function(){
                    var editdata = $(this).data('profile');
                    $('.modal-title').html("Edit details for "+editdata.business_name);
                    $('span.business').html(editdata.business_name);
                    $('#id').val(editdata.user_id);
                    $('#name').val(editdata.name);
                    $('#business_name').val(editdata.business_name);
                    $('#email').val(editdata.email);
                    $('#website').val(editdata.website);
                    $('#address').val(editdata.address);
                    $('#zipcode').val(editdata.zipcode);
                    $('#contact').val(editdata.mobile_number);
                    $('#about').val(editdata.description);
                });
            </script>
@endsection