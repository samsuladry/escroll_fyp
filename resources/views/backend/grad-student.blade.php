@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card text-center">
                <div class="card-header">
                    <strong>Graduate Student</strong>
                </div><!--card-header-->
                <div class="card-body">
                     <div class="col-lg-12">
                            <table class="table table-striped">
                                  <thead>
                                    <tr>
                                      <th scope="col">Name</th>
                                      <th scope="col">Matric No.</th>
                                      <th scope="col">Field</th>
                                      <th scope="col">University</th>
                                      <th scope="col">QR Code</th>
                                      <th scope="col">Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($students as $student)
                                    <tr>
                                      <th>{{$student->name}}</th>
                                      <td>{{$student->matric_number}}</td>
                                      <td>{{$student->field}}</td>
                                      <td>{{$student->university}}</td>
                                      <td>
                                          <img height="80" width="80" src="{{ asset("storage/$student->qr_code_path") }}">
                                      </td>
                                      
                                      <td>

                                            <a href="{{url('admin/university/'.$university->id.'/list-college/'.$college->id.'/graduate-student/'.$student->id.'/view-cert-pdf')}}">
                                              <button class="btn btn-primary">View Cert</button>
                                            </a>
                                            <button class="btn btn-success">Download Cert</button>

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
