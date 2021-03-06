@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Bachelor'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card text-center">
                <div class="card-header">
                    <strong>Bachelor</strong>

                    <a style="float: right;" href="{{url('admin/faculty/'.$faculty->id.'/department/'.$department->id.'/bachelor/add')}}">
                        <button class="btn btn-sm btn-success">Add Bachelor</button>
                    </a>

                </div>
                <div class="card-body">
                     <div class="col-lg-12">
                            <table class="table table-striped">
                                  <thead>
                                    <tr>
                                      <th scope="col">ID</th>
                                        <th scope="col">Bachelor Title</th>  
                                      <th scope="col">Action</th>  
                                    </tr>
                                  </thead>
                                  <tbody>


                                    @foreach($bachelors as $bachelor)

                                    @if(!count($bachelors))
                                    @else
                                    <tr>
                                      <th>{{$bachelor->id}}</th>
                                      <th>{{$bachelor->title}}</th>
                                      <td>

                                        <a href="{{url('admin/faculty/'.$faculty->id.'/department/'.$department->id.'/bachelor/'.$bachelor->id.'/edit')}}">
                                          <button class="btn btn-info">Edit</button>
                                        </a>

                                        <a href="{{url('admin/faculty/'.$faculty->id.'/department/'.$department->id.'/bachelor/'.$bachelor->id.'/graduate')}}">
                                          <button class="btn btn-success">Graduate Student</button>
                                        </a>

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
