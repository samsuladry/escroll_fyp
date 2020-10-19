@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Bachelor'))

@section('content')
    <div class="row">
        <div class="col">

            <div class="card">
                <div class="card-header">
                    <strong>Add New Bachelor</strong>
                </div><!--card-header-->
                <div class="card-body">
                    <form action="{{url('admin/faculty/'.$faculty->id.'/department/'.$department->id.'/bachelor/store')}}" method="POST">
                        @csrf

                      <input type="text" name="department_id" style="display: none;" value="{{$department->id}}">
                      
                      <div class="form-group">
                        <label>Bachelor Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter Bachelor Name">
                      </div>

                     
                      <button style="float: right;" type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
