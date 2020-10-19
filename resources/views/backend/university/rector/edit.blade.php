@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('University Profile'))

@section('content')
    <div class="row">
        <div class="col">

            <div class="card">
                <div class="card-header">
                    <strong>Edit Rector</strong>
                </div><!--card-header-->
                <div class="card-body">
                    <form action="{{ url('/admin/rector/'. $rector->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('put') }}

                      <input type="text" name="user_id" style="display: none;" value="{{$logged_in_user->id}}">

                      <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Rector Name" value="{{$rector->name}}">
                      </div>
                      <div class="form-group">
                        <label>Current Signature</label><br>
                        <img src="{{ asset("storage/$rector->signature") }}" height="100" width="150">
                      </div>
                      

                      <div class="form-group">
                        <label>Update Rector Signature</label><br>
                        <input type="file" name="signature">
                      </div>
                     
                      <button style="float: right;" type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
