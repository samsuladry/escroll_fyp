@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Graduate Student'))

@section('content')
<div class="row">
  <div class="col">
    <div class="card text-center">
      <div class="card-header">
        <strong>Gradute Student</strong>

        <button style="float: right;" class="btn btn-success btn-sm" data-toggle="modal" data-target="#generateQR">Activate</button>



        <!-- Modal -->
        <div class="modal fade" id="generateQR" tabindex="-1" role="dialog" aria-labelledby="generateQRlable" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="generateQRlable">Activate Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <!-- <form action="{{url('admin/faculty/'.$faculty->id.'/graduate/activate')}}" method="POST" enctype="multipart/form-data"> -->

              <form action="{{ url('admin/blockchainstudent') }}"></form>
              @csrf
              <div class="modal-body">
                This process can be done once, make sure you check all the record before activate all the record, this process involve <b>QR code generation, PDF generation and Store Record in Blockchain</b><br><br>Please upload digital certificate (.crt) before submit.

                <hr>

                <input type="text" name="user_id" value="{{ Auth::user()->id }}" style="display: none;">
                <input type="text" name="faculty_id" value="{{ $faculty->id }}" style="display: none;">

                <input type="file" name="certificate" accept=".crt">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <a href="{{url('admin/faculty/'.$faculty->id.'/graduate/activate')}}"> -->
                <!-- <a href="{{ url('admin/blockchainstudent') }}"> -->
                <button id="activateGraduateStudent" type="submit" class="btn btn-success">Activate Graduate Student</button>
                <!-- </a> -->
              </div>

              </form>
            </div>
          </div>
        </div>

      </div>
      <!--card-header-->
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
                <td>{{$student->graduate_field->title}}</td>
                <td>
                  @if($student->qr_code_path == NULL)
                  @else
                  <img height="80" width="80" src="{{ asset("storage/$student->qr_code_path") }}">
                  @endif
                </td>

                <td>
                  <a href="{{url('admin/gradute-student/'.$student->id.'/view-cert')}}">
                    <button class="btn btn-primary">View</button>
                  </a>
                </td>
              </tr>

              @endforeach
            </tbody>
          </table>

        </div>


      </div>
      <!--card-body-->
    </div>
    <!--card-->
  </div>
  <!--col-->
</div>
<!--row-->
@endsection