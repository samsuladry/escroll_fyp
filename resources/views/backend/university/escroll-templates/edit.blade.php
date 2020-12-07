@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Template'))

@section('content')
<link href="vendor/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="vendor/select2/dist/js/select2.min.js"></script>
    <div class="row">
        <div class="col">

            <div class="card">
                <div class="card-header">
                    <strong>Edit Template</strong>
                </div><!--card-header-->
                <div class="card-body">
                    <form action="{{ route('admin.update-escroll', [$template->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('put') }}

                        <input type="text" name="university_id" style="display: none;" value="{{auth()->user()->university->id}}">

                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" rows="3">{{$template->description}}</textarea>
                        </div>

                        <div class="form-group">
                            Enable stuff
                            Name: <input type="checkbox" name="name" id="name" {{($template->escrollSetup->name)? 'checked': ''}}>
                            Bachelor: <input type="checkbox" name="bachelor" id="bachelor" {{($template->escrollSetup->bachelor)? 'checked': ''}}>
                            Left Signature: <input type="checkbox" name="left_signature" id="left_signature" {{($template->escrollSetup->left_signature)? 'checked': ''}}>
                            Right Signature: <input type="checkbox" name="right_signature" id="right_signature" {{($template->escrollSetup->right_signature)? 'checked': ''}}>
                            QR: <input type="checkbox" name="qr" id="qr" {{($template->escrollSetup->qr)? 'checked': ''}}>
                            Serial Number: <input type="checkbox" name="serial_no" id="serial_no" {{($template->escrollSetup->serial_no)? 'checked': ''}}>
                            Date Endorsed: <input type="checkbox" name="date_endorse" id="date_endorse" {{($template->escrollSetup->date_endorse)? 'checked': ''}}>
                            Landscape: <input type="checkbox" name="landscape" id="landscape" {{($template->escrollSetup->landscape)? 'checked': ''}}>
                        </div>
                        <div class="form-group">
                            <select name="student" class="student">
                                <option value="">Please Select</option>
                                @foreach ($students as $student)
                                    <option value="{{$student->id}}">{{$student->matric_number}} - {{$student->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Current Image Template</label><br>
                            <img src="{{ asset("storage/$template->image_template") }}" height="100" width="150">
                        </div>

                        <div class="form-group">
                            <label>Upload New Image Template</label><br>
                            <input type="file" name="image_template">
                        </div>

                        
                        <button style="float: right;" type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.student').select2({
                placeholder: 'Select Student',
                allowClear: true,
            });
        });
    </script>
@endsection
