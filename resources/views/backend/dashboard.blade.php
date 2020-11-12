@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>@lang('strings.backend.dashboard.welcome') {{ $logged_in_user->name }}!</strong>
                </div><!--card-header-->
                  <!--card-header-->
                <div class="card-body">
                    <div class="col-lg-12" style="margin-top: 1em;margin-bottom: 4em;">
                        {{-- <form action="{{url('admin/import-csv/store')}}" method="POST" enctype="multipart/form-data" style="margin-top: 1em;"> --}}
                        {{-- @csrf --}}
                        {{-- <input type="file" name="file" accept=".csv"> --}}
                        <br>
                        <a class=" btn btn-success" style="margin-top: 1em;" href="{{route('admin.import-csv') }}">Go to Upload</a>
                        {{-- </form> --}}
            
            
                    </div>
                </div>
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection
