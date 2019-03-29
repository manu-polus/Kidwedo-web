@extends('layouts.admin')

@section('user_lists')
            <div class="box-header">
              <h3 class="box-title">Registered Users</h3>
                <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                        <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>User</th>
                  <th>E-Mail</th>
                  <th>Options</th>
                  <th></th>
                </tr>
                @foreach($users_list as $user)
                @php 
                  $formdata = json_encode($user);
                @endphp
                <tr>
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td><span class="fa fa-edit modal-display" style="color: darkblue; cursor: pointer" data-toggle="modal" data-target="#modal-edit" title="Edit this User" data-profile='<?php echo $formdata; ?>'></span>&nbsp;
                  <a href="{{ route('delete_user',['id' => $user->id]) }}" style="color: red" class="fa fa-trash-o" title="Delete this User" onclick="return delete_confirm()"></a></td>
                </tr>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->

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
                                <form id="edit_dealer" method="POST" action="{{ route('edit_user') }}">
                                @csrf
                                    <input type="hidden" id="id" value="" name="id">
                                    <strong>Vorrname</strong><input type="text" class="form-control" name="name" id="name" style="color: black;" value="" required>
                                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" style="color: red" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                    <br><br>
                                    <strong>Nachname</strong><input type="text" class="form-control" name="surname" id="surname" style="color: black;" value="">
                                    @if ($errors->has('surname'))
                                    <span class="invalid-feedback" style="color: red" role="alert">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                    @endif
                                    <br><br>
                                    <strong>E-Mail</strong><input type="email" class="form-control" value="" name="email" id="email" style="color: black;" disabled>
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" style="color: red" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                    <br><br>
                                    <strong>Adresse</strong><textarea class="form-control" name="address" id="address" style="color: black;">{{ old('address') }}</textarea>
                                    @if ($errors->has('address'))
                                    <span class="invalid-feedback" style="color: red" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                    <br><br>
                                    <strong>Telefonnumber</strong><input type="text" class="form-control" value="{{ old('contact') }}" name="contact" id="contact" style="color: black;" required>
                                    @if ($errors->has('contact'))
                                    <span class="invalid-feedback" style="color: red" role="alert">
                                        <strong>{{ $errors->first('contact') }}</strong>
                                    </span>
                                    @endif
                                </form>
                            </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal"><strong>Schließen</strong></button>
                                <button type="submit" form="edit_dealer" class="btn btn-outline"><strong>Änderungen speichern</strong></button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <script src="{{ asset('js/kidwedo.js') }}"></script>
                <script>
                  $(".modal-display").click(function(){
                    var editdata = $(this).data('profile');
                    $('.modal-title').html("Edit details for "+editdata.name);
                    $('#id').val(editdata.id);
                    $('#name').val(editdata.name);
                    $('#surname').val(editdata.last_name);
                    $('#email').val(editdata.email);
                    $('#address').val(editdata.address);
                    $('#contact').val(editdata.mobile_number);
                });
                </script>
@endsection