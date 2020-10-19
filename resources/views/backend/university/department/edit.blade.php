@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Department'))

@section('content')
    <div class="row">
        <div class="col">

            <div class="card">
                <div class="card-header">
                    <strong>Edit Department</strong>
                </div><!--card-header-->
                <div class="card-body">
                    <form action="{{ url('/admin/faculty/'.$faculty->id.'/department/'. $department->id) }}" method="POST">
                        @csrf
                        {{ method_field('put') }}

                      <input type="text" name="faculty_id" style="display: none;" value="{{$faculty->id}}">

                      <div class="form-group">
                        <label>Department Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Department Name" value="{{$department->name}}">
                      </div>

                     
                      <button style="float: right;" type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
