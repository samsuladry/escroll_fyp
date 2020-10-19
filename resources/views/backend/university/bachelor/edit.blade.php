@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Bachelor'))

@section('content')
    <div class="row">
        <div class="col">

            <div class="card">
                <div class="card-header">
                    <strong>Edit Bachelor</strong>
                </div><!--card-header-->
                <div class="card-body">
                    <form action="{{ url('/admin/faculty/'.$faculty->id.'/department/'. $department->id.'/bachelor/'.$bachelor->id) }}" method="POST">
                        @csrf
                        {{ method_field('put') }}

                      <input type="text" name="department_id" style="display: none;" value="{{$department->id}}">

                      <div class="form-group">
                        <label>Bachelor Name</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter Bachelor Name" value="{{$bachelor->title}}">
                      </div>

                     
                      <button style="float: right;" type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
