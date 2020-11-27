@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Graduate Student'))

@section('content')
<div class="row">
  <div class="col">
    <div class="card text-center">
      <div class="card-header">
        <h3><strong>Gradute Student(s) for {{$faculty->name}}</strong></h3>

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

                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="faculty_id" value="{{ $faculty->id }}">

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
          <form action="{{ route('admin.view-faculty-graduate', $faculty) }}" method="get">
            <input type="text" name="search" id="search" value="{{ $search }}">
            <a href="{{ route('admin.view-faculty-graduate', $faculty) }}" class="btn btn-sm btn-info">Reset</a>
            <button type="submit" class="btn btn-sm btn-info">Search</button>
          </form>
          <br>
          <div class="row row-cols-3">
            <div class="col text-left">
              Showing {{$students->firstItem()}} to {{$students->lastItem()}} of {{$students->total()}} Students
            </div>
            <div class="col">

                Page {{$students->currentPage()}}
            </div>
            <div class="col justify-content-center">
                {{$students->appends(['search' => $search])->links()}}
            </div>
          </div>
          
        </div>
        <br>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">No.</th>
              <th scope="col">Matric Number</th>
              <th scope="col">Name</th>
              <th scope="col">Bachelor</th>
              <th scope="col">QR Code</th>
              <th scope="col">Verified</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($students as $student)
            <tr>
              <th>{{$students->firstItem()+$loop->iteration -1}}</th>
              <th>{{$student->matric_number}}</th>
              <td>{{$student->name}}</td>
              <td>{{$student->department->name}}</td>
              <td>
                @if($student->qr_code_path == NULL)
                @else
                <img src="{{ asset($student->qr_code_path) }}">
                @endif
              </td>

              <td>
                @if($student->is_import == 1)
                  <img src="{{ asset("img/backend/correct.png") }}" alt="" height="24px" width="24px">
                @else
                  <img src="{{ asset("img/backend/close.png") }}" alt="" height="24px" width="24px">
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
        <div class="row row-cols-3">
          <div class="col text-left">
            Showing {{$students->firstItem()}} to {{$students->lastItem()}} of {{$students->total()}} Students
          </div>
          <div class="col">
            Page {{$students->currentPage()}}
          </div>
          <div class="col justify-content-center">
            {{$students->appends(['search' => $search])->links()}}
          </div>
        </div>
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