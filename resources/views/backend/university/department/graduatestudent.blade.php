@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Graduate Student'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card text-center">
                <div class="card-header">
                    <strong>Gradute Student</strong>

                    <!-- <a href="{{url('admin/generate-qrcode')}}">
                       <button style="float: right;" class="btn btn-success btn-sm">Export to PDF</button>
                    </a> -->
                   
                </div><!--card-header-->
                <div class="card-body">
                      <div class="col-lg-12">
                            <table class="table table-striped">
                                  <thead>
                                    <tr>
                                      <th scope="col">Matric Number</th>
                                      <th scope="col">Name</th>
                                      <th scope="col">Field</th>
                                      <th scope="col">QR Code</th>
                                      <th scope="col">Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($students as $student)
                                    <tr>
                                      <th>{{$student->matric_number}}</th>
                                      <td>{{$student->name}}</td>
                                      <td>{{$student->department->name}}</td>
                                      <td>
                                          @if($student->qr_code_path == NULL)
                                          @else
                                          <img height="80" width="80" src="/{{ $student->qr_code_path }}">
                                          @endif
                                      </td>
                                      
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
