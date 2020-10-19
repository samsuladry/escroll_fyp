@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('University Profile'))

@section('content')
    <div class="row">
        <div class="col">

            <div class="card">
                <div class="card-header">
                    <strong>Digital Signature Details</strong>
                </div><!--card-header-->
                <div class="card-body">
                    <form action="{{url('admin/rector/store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                         <input type="text" name="user_id" style="display: none;" value="{{$logged_in_user->id}}">
                      <div class="form-group">
                        <label>Issuer Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Rector Name">
                      </div>

                      <div class="form-group">
                        <label>Rector Signature</label><br>
                        <input type="file" name="signature">
                      </div>
                     
                      <button style="float: right;" type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
