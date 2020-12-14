@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Template'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card text-center">
                <div class="card-header">
                    <strong>Template</strong>

                    <a style="float: right;" href="{{url('admin/template/add')}}">
                        <button class="btn btn-sm btn-success">Add New Template</button>
                    </a>

                </div>
                <div class="card-body">
                     <div class="col-lg-12">
                            <table class="table table-striped">
                                  <thead>
                                    <tr>
                                      <th scope="col">ID</th>
                                      <th scope="col">Description</th>  
                                      <th scope="col">Preview</th>
                                      <th scope="col">Created At</th>
                                      <th scope="col">Action</th>  
                                    </tr>
                                  </thead>
                                  <tbody>


                                    @foreach($templates as $template)

                                    @if(!count($templates))
                                    @else
                                    <tr>
                                      <th>{{$loop->iteration}}</th>
                                      <td>{{$template->description}}</td>
                                      <td>
                                        <img src="{{ asset("storage/$template->image_template") }}" height="100" width="150">
                                      </td>
                                      <td>{{$template->created_at}}</td>
                                      <td class="btn-group">

                                        <a href="{{route('admin.edit-escroll', $template->id)}}">
                                          <button class="btn btn-info">Edit</button>
                                        </a>

                                        <a href="{{route('admin.view-escroll', $template->id)}}" target="_blank">
                                            <button class="btn btn-info">E-Scroll</button>
                                        </a>

                                        <form action="{{route('admin.activate-template', $template->id)}}" method="POST">
                                            @csrf
                                            <button class="btn  {{($template->active)? 'btn-success': 'btn-warning' }}">{{($template->active)? 'Activated': 'Deactivated' }}</button>
                                        </form>

                                      </td>
                        
                                    </tr>
                                    @endif

                                    @endforeach

                                  </tbody>
                                </table>
                            
                        </div>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection
