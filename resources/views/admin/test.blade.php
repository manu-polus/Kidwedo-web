@extends('layouts.admin')

@section('component_test')

<div class="col-lg-10">
    <div class="box">
        <div class="box-body">
            Test Box
        </div>
    </div>
</div>
@component('components.tester',['users' => [$users_list]])
@endcomponent
<div id="app">
<example-component></example-component></div>
@endsection