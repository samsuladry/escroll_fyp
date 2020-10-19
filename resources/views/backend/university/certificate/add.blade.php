@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Add Digital Certificate Information'))

@section('content')
    <div class="row">
        <div class="col">

            <div class="card">
                <div class="card-header">
                    <strong>Add Digital Certificate Information</strong>
                </div><!--card-header-->
                <div class="card-body">
                    <form action="{{url('admin/digital_certificate/store')}}" method="POST">
                        @csrf

                         <input type="text" name="user_id" style="display: none;" value="{{$logged_in_user->id}}">

                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Person Name">
                      </div>

                      <div class="form-group">
                        <label>Location</label>
                        <input type="text" name="location" class="form-control" placeholder="Enter Location">
                      </div>

                      <div class="form-group">
                        <label>Reason</label>
                        <input type="text" name="reason" class="form-control" placeholder="Enter Reason">
                      </div>

                      <div class="form-group">
                        <label>Contact Info</label>
                        <input type="text" name="contact_info" class="form-control" placeholder="Enter Contact Info">
                      </div>

                      <button style="float: right;" type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
