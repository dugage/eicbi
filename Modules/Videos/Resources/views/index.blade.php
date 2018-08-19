@extends('videos::layouts.master')

@section('breadcrumb') 

    <li class="breadcrumb-item active" aria-current="page">{{ trans('app.videos.videos') }}</li>

@stop

@section('main-content')

    <div class="row">

        <div class="col-12 grid-margin stretch-card">

            <div class="card">

                <div id="table-data" class="card-body">
                    
                    <h4 class="card-title">{{ trans('app.listOf') }} {{ trans('app.videos.videos') }}</h4>
                    <p class="card-description float-left"><a href="#" class="btn btn-primary btn-fw"><i class="mdi mdi-plus"></i>{{ trans('app.create') }}</a></p>

                    <div class="form-group col-md-4 float-right">
                        <input v-model="searchParam" @keyup="getDataBySearchParam" name="searchParam" class="form-control rounded-0 py-2" type="search" value="" placeholder="{{ trans('app.search') }}..." id="searchParam">
                    </div>

                    <template v-if="preloader">
                        <div id="content-preloader">
                            <p>
                                <img src="{{asset('images/Eclipse-0.4s-108px.svg')}}" alt="preloader" class=""><br/>
                                <span>{{ trans('app.loadData') }}</span> 
                            </p>
                        </div>
                    </template>

                    @include('videos::partials/tables/index_table')

                </div>

            </div>

        </div>

    </div>

@stop

