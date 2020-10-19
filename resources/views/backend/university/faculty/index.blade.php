@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Faculty'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card text-center">
                <div class="card-header">
                    <strong>Faculty</strong>

                    <a style="float: right;" href="{{url('admin/faculty/add')}}">
                        <button class="btn btn-sm btn-success">Add Faculty</button>
                    </a>

                </div>
                <div class="card-body">
                     <div class="col-lg-12">
                            <table class="table table-striped">
                                  <thead>
                                    <tr>
                                      <th scope="col">ID</th>
                                      <th scope="col">Name</th>
                                      <th scope="col">Action</th>  
                                    </tr>
                                  </thead>
                                  <tbody>


                                    @foreach($faculties as $faculty)

                                    @if(!count($faculties))
                                    @else
                                    <tr>
                                      <th>{{$faculty->id}}</th>
                                      <th>{{$faculty->name}}</th>
                                      <td>

                                        <a href="{{url('admin/faculty/'.$faculty->id.'/edit')}}">
                                          <button class="btn btn-info">Edit</button>
                                        </a>

                                        <a href="{{url('admin/faculty/'.$faculty->id.'/department')}}">
                                          <button class="btn btn-primary">List Department</button>
                                        </a>


                                        <a href="{{url('admin/faculty/'.$faculty->id.'/dean')}}">
                                          <button class="btn btn-primary">List Dean</button>
                                        </a>


                                        <a href="{{url('admin/faculty/'.$faculty->id.'/graduate')}}">
                                          <button class="btn btn-success">Graduate Student 
                                             <span class="badge badge-warning">{{ App\Models\Student::where('faculty_id', $faculty->id)->count() }}</span>
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
