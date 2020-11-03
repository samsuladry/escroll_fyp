@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Department'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card text-center">
                <div class="card-header">
                    <strong>Bachelors</strong>

                    <a style="float: right;" href="{{url('admin/faculty/'.$faculty->id.'/department/add')}}">
                        <button class="btn btn-sm btn-success">Add Bachelor</button>
                    </a>

                </div>
                <div class="card-body">
                     <div class="col-lg-12">
                            <table class="table table-striped">
                                  <thead>
                                    <tr>
                                      <th scope="col">ID</th>
                                      <th scope="col">Department Name</th> 
                                      <th scope="col">Action</th>  
                                    </tr>
                                  </thead>
                                  <tbody>


                                    @foreach($departments as $department)

                                    @if(!count($departments))
                                    @else
                                    <tr>
                                      <th>{{$department->id}}</th>
                                      <th>{{$department->name}}</th>
                                      <td>

                                        <a href="{{url('admin/faculty/'.$faculty->id.'/department/'.$department->id.'/edit')}}">
                                          <button class="btn btn-info">Edit</button>
                                        </a>

                                         {{-- <a href="{{url('admin/faculty/'.$faculty->id.'/department/'.$department->id.'/bachelor')}}">
                                          <button class="btn btn-primary">View Bachelor</button>
                                        </a> --}}

                                        <a href="{{url('admin/faculty/'.$faculty->id.'/department/'.$department->id.'/graduate')}}">
                                          <button class="btn btn-success">Graduate Student
                                            <span class="badge badge-warning">{{ App\Models\Student::where('department_id', $department->id)->count() }}</span>
                                          </button>
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
