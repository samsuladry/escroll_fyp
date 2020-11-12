@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Graduate Student'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card text-center">
                <div class="card-header">
                    <h3><strong>Gradute Student(s) for {{$department->name}}</strong></h3>

                    <!-- <a href="{{url('admin/generate-qrcode')}}">
                       <button style="float: right;" class="btn btn-success btn-sm">Export to PDF</button>
                    </a> -->
                   
                </div><!--card-header-->
                <div class="card-body">
                    <div class="col-lg-12">
                        <form action="{{ url('admin/faculty/'.$faculty->id.'/department/'.$department->id.'/graduate') }}" method="get">
                            <input type="text" name="search" id="search" value="{{ $search }}">
                            <a href="{{ url('admin/faculty/'.$faculty->id.'/department/'.$department->id.'/graduate') }}" class="btn btn-sm btn-info">Reset</a>
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
                                {{$students->links()}}
                            </div>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
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
                                    <th>{{$students->firstItem() + $loop->iteration -1 }}</th>
                                    <th>{{$student->matric_number}}</th>
                                    <td>{{$student->name}}</td>
                                    <td>{{$student->department->name}}</td>
                                    <td>
                                        @if($student->qr_code_path == NULL)
                                        @else
                                        <img width="100px" height="100px"src="/{{ $student->qr_code_path }}">
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
                        <div class="row row-cols-3">
                            <div class="col text-left">
                                Showing {{$students->firstItem()}} to {{$students->lastItem()}} of {{$students->total()}} Students
                            </div>
                            <div class="col">
                                Page {{$students->currentPage()}}
                            </div>
                            <div class="col justify-content-center">
                                {{$students->links()}}
                            </div>
                        </div>
                    </div>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection
