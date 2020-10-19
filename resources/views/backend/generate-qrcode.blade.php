@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Generate Qr Code'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>Gradute Student</strong>

                    <a href="{{url('admin/generate-qrcode')}}">
                       <button style="float: right;" class="btn btn-success btn-sm">Generate QR Code</button>
                    </a>
                   
                </div><!--card-header-->
                <div class="card-body">
                      <div class="col-lg-12">
                            <table class="table table-striped">
                                  <thead>
                                    <tr>
                                      <th scope="col">Matric Number</th>
                                      <th scope="col">Name</th>
                                      <th scope="col">Graduate Field ID</th>
                                      <th scope="col">University ID</th>
                                      <th scope="col">Rector ID</th>
                                      <th scope="col">Faculty ID</th>
                                      <th scope="col">Dean ID</th>
                                      <th scope="col">Template ID</th>
                                      <th scope="col">Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($students as $student)
                                    <tr>
                                      <th>{{$student->matric_number}}</th>
                                      <td>{{$student->name}}</td>
                                      <td>{{$student->field}}</td>
                                      <td>{{$student->university_id}}</td>
                                      <td>{{$student->rector_id}}</td>
                                      <td>{{$student->faculty_id}}</td>
                                      <td>{{$student->dean_id}}</td>
                                      <td>{{$student->template_id}}</td>
                                      <td>
                                        <!--  <a href="{{url('admin/gradute-student/'.$student->id.'/view-cert')}}">
                                            <button class="btn btn-primary">View</button>
                                         </a> -->
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
