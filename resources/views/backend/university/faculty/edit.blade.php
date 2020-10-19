@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Faculty'))

@section('content')
    <div class="row">
        <div class="col">

            <div class="card">
                <div class="card-header">
                    <strong>Edit Faculty</strong>
                </div><!--card-header-->
                <div class="card-body">
                    <form action="{{ url('/admin/faculty/'. $faculty->id) }}" method="POST">
                        @csrf
                        {{ method_field('put') }}

                      <input type="text" name="user_id" style="display: none;" value="{{$logged_in_user->id}}">

                      <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Faculty Name" value="{{$faculty->name}}">
                      </div>
                     
                      <button style="float: right;" type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
