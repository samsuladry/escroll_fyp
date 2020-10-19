@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card text-center">
                <div class="card-header">
                    <strong>University</strong>

                    <a style="float: right;" href="{{url('admin/auth/user/create')}}">
                        <button class="btn btn-sm btn-success">Add University</button>
                    </a>

                </div>
                <div class="card-body">
                     <div class="col-lg-12">
                            <table class="table table-striped">
                                  <thead>
                                    <tr>
                                      <th scope="col">Name</th>
                                      <th scope="col">Email</th>
                                      <th scope="col">Created At</th>
                                      <th scope="col">Action</th>
                                   
                                    </tr>
                                  </thead>
                                  <tbody>


                                    @foreach($universities as $university)

                                    @if($university->name == NULL)
                                    @else
                                    <tr>
                                      <th>{{$university->first_name}} {{$university->last_name}}</th>
                                      <td>{{$university->email}}</td>
                                      <td>{{$university->created_at}}</td>
                                      <td>

                                        <a href="{{url('admin/university/'.$university->id.'/list-college')}}">
                                          <button class="btn btn-info">View Profile</button>
                                        </a>

                                        <a href="{{url('admin/university/'.$university->id.'/list-college')}}">
                                          <button class="btn btn-primary">Graduate Student</button>
                                        </a>

                                        <a href="{{url('admin/university/'.$university->id.'/list-college')}}">
                                          <button class="btn btn-success">List College</button>
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
