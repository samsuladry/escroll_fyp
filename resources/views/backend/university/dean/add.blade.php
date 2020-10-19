@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Dean'))

@section('content')
    <div class="row">
        <div class="col">

            <div class="card">
                <div class="card-header">
                    <strong>Add New Dean</strong>
                </div><!--card-header-->
                <div class="card-body">
                    <form action="{{url('admin/faculty/'.$faculty->id.'/dean/store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                      <input type="text" name="faculty_id" style="display: none;" value="{{$faculty->id}}">
                      
                      <div class="form-group">
                        <label>Dean Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Dean Name">
                      </div>

                       <div class="form-group">
                        <label>Dean Signature</label><br>
                        <input type="file" name="signature">
                      </div>
                     
                      <button style="float: right;" type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
