@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Academic Levels'))

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header text-center">
                <strong>Create New Academic Level</strong>
            </div>
            <div class="card-body">
                <form action="{{route('admin.academic.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <button style="float: right;" type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
    
@endsection