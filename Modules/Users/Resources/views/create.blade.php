@extends('users::layouts.master')

@section('breadcrumb') 

    <li class="breadcrumb-item" aria-current="page">{{ trans('app.users.users') }}</li>
    <li class="breadcrumb-item active" aria-current="page">{{ trans('app.create') }}</li>
    
@stop

@section('main-content')

    <div class="row">

        <div class="col-12 grid-margin stretch-card">

            <div class="card">

                <div id="form-data" class="card-body">

                    <h4 class="card-title">{{ trans('app.create') }} {{ trans('app.users.user') }}</h4>

                    @include('users::partials/forms/main_form')

                </div>

            </div>
        
        </div>

    </div>

@stop
