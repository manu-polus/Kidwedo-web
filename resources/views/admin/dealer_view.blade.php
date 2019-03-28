@extends('layouts.admin')
@section('dealerview')
            <div class="box-header">
                <h3 class="box-title">Dealer Name</h3>
            </div>
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
                <tr>
                  <td>{{ $count++ }}</td>
                  <td>{{ $dealer->business_name }}</td>
                  @if($dealer->status_id==1)
                    <td>
                        <a href="{{ route('viewdealer',['id' => $dealer->id ]) }}"><i class="fa fa-eye" style="color: blue" title="View this Dealer"></i>&nbsp;
                        <a href="{{ route('editdealer',['id' => $dealer->id ]) }}"><i class="fa fa-edit" style="color: SaddleBrown" title="Edit this Dealer"></i>&nbsp;
                        <a href="{{ route('blockdealer',['id' => $dealer->id ]) }}"><i class="fa fa-ban" style="color: darkred" title="Block this Dealer"></i>&nbsp;
                        <a href="{{ route('deletedealer',['id' => $dealer->id ]) }}"><i class="fa fa-trash-o" style="color: red" title="Delete this Dealer"></i>
                    </td>
                  @endif
                  @if($dealer->status_id==0)
                    <td>
                        <a href="{{ route('viewdealer',['id' => $dealer->id ]) }}"><i class="fa fa-eye" style="color: blue" title="View this Dealer"></i>&nbsp;
                        <a href="{{ route('editdealer',['id' => $dealer->id ]) }}"><i class="fa fa-edit" style="color: SaddleBrown" title="Edit this Dealer"></i>&nbsp;
                        <a href="{{ route('acceptdealer',['id' => $dealer->id ]) }}"><i class="fa fa-thumbs-o-up" style="color: green" title="Accept this Dealer"></i>&nbsp;
                        <a href="{{ route('blockdealer',['id' => $dealer->id ]) }}"><i class="fa fa-ban" style="color: darkred" title="Block this Dealer"></i>&nbsp;
                        <a href="{{ route('deletedealer',['id' => $dealer->id ]) }}"><i class="fa fa-trash-o" style="color: red" title="Delete this Dealer"></i>
                    </td>
                  @endif
                  @if($dealer->status_id==2)
                    <td>
                        <a href="{{ route('viewdealer',['id' => $dealer->id ]) }}"><i class="fa fa-eye" style="color: blue" title="View this Dealer"></i>&nbsp;
                        <a href="{{ route('editdealer',['id' => $dealer->id ]) }}"><i class="fa fa-edit" style="color: SaddleBrown" title="Edit this Dealer"></i>&nbsp;
                        <a href="{{ route('acceptdealer',['id' => $dealer->id ]) }}"><i class="fa fa-thumbs-o-up" style="color: green" title="Accept this Dealer"></i>&nbsp;
                        <a href="{{ route('deletedealer',['id' => $dealer->id ]) }}"><i class="fa fa-trash-o" style="color: red" title="Delete this Dealer"></i>
                    </td>
                  @endif
                </tr>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
@endsection