@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>List College</strong>
                </div><!--card-header-->
                <div class="card-body">
                     <div class="col-lg-12">
                            <table class="table table-striped">
                                  <thead>
                                    <tr>
                                      <th scope="col">Name</th>
                                      <th scope="col">Keyword</th>
                                      <th scope="col">Dean Name</th>
                                      <th scope="col">Signature</th>
                                      <th scope="col">Action</th>
                                   
                                    </tr>
                                  </thead>
                                  <tbody>

                                

                                    @foreach($colleges as $college)

                                    <tr>
                                      <th>{{$college->name}}</th>
                                      <td>{{$college->keyword}}</td>
                                      <td>{{$college->dean_name}}</td>
                                      <td>
                                          <img src="{{ asset("storage/$college->signature") }}" height="50" width="50">
                                      </td>

                                      <td>
                                      
                                          <a href="{{url('admin/university/'.$university->id.'/list-college/'.$college->id.'/graduate-student')}}">
                                              <button class="btn btn-primary">Graduate Student</button>
                                          </a>
                                
                                      </td>
                        
                                    </tr>
               

                                    @endforeach


                                  </tbody>
                                </table>
                            
                        </div>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection
