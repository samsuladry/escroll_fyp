@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Template'))

@section('content')
    <div class="row">
        <div class="col">

            <div class="card">
                <div class="card-header">
                    <strong>Edit Template</strong>
                </div><!--card-header-->
                <div class="card-body">
                    <form action="{{ url('/admin/template/'. $template->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('put') }}

                      <input type="text" name="user_id" style="display: none;" value="{{$logged_in_user->id}}">

                     <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" rows="3">{{$template->description}}</textarea>
                      </div>

                      <div class="form-group">
                        <label>Current Image Template</label><br>
                        <img src="{{ asset("storage/$template->image_template") }}" height="100" width="150">
                      </div>

                      <div class="form-group">
                        <label>Upload New Image Template</label><br>
                        <input type="file" name="image_template">
                      </div>

                      <div class="form-group">
                        <label>Upload New PDF Template</label><br>
                        <input type="file" name="pdf_template">
                      </div>

                     
                      <button style="float: right;" type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
