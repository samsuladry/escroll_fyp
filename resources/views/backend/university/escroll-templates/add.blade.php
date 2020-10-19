@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Template'))

@section('content')
    <div class="row">
        <div class="col">

            <div class="card">
                <div class="card-header">
                    <strong>Add New Template</strong>
                </div><!--card-header-->
                <div class="card-body">
                    <form action="{{url('admin/template/store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                         <input type="text" name="user_id" style="display: none;" value="{{$logged_in_user->id}}">
                      <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
                      </div>

                      <div class="form-group">
                        <label>Image Template</label><br>
                        <input type="file" name="image_template">
                      </div>

                      <div class="form-group">
                        <label>PDF Template</label><br>
                        <input type="file" name="pdf_template">
                      </div>
                     
                      <button style="float: right;" type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
