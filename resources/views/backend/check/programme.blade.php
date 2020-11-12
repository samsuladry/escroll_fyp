@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Programme'))

@section('content')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap.min.css">
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
    <div class="row">
        <div class="col">
            <div class="card text-center">
                <div class="card-header">
                    <h3><strong>Students for Programme {{ucwords(str_replace('-', ' ', $programme)) }}</strong></h3>
                    <form action="{{ route('admin.check.programme.import', $programme) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success">Import & generate QR</button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="col-lg-12">
                        <form action="{{ route('admin.check.programme', $programme) }}" method="get">
                            <input type="text" name="search" id="search" value="{{ $search }}">
                            <a href="{{ route('admin.check.programme', $programme) }}" class="btn btn-sm btn-info">Reset</a>
                            <button type="submit" class="btn btn-sm btn-info">Search</button>
                        </form>
                        <br>
                        <div class="row row-cols-3">
                            <div class="col text-left">
                                Showing {{(is_null($students->firstItem()))? 0 : $students->firstItem()}} to {{(is_null($students->lastItem()))? 0 : $students->lastItem()}} of {{$students->total()}} students
                            </div>
                            <div class="col">
                                Page {{$students->currentPage()}}
                            </div>
                            <div class="col justify-content-center">
                                {{$students->appends(['search' => $search])->links()}}
                            </div>
                        </div>
                        <br>
                        <div class="table-responsive-lg">
                            <table class="table table-striped table-bordered" id="students">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Matric Number</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Faculty</th>
                                        <th scope="col">Citizenship</th>
                                        <th scope="col">Serial_no</th>
                                        <th scope="col">Date_endorse</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <th>{{$students->firstItem() + $loop->iteration - 1}}</th>
                                            <td>{{$student->matric_no}}</td>
                                            <td>{{$student->name}}</td>
                                            <td>{{$student->faculty}}</td>
                                            <td>{{$student->citizenship}}</td>
                                            <td>{{$student->serial_no}}</td>
                                            <td>{{$student->date_endorse}}</td>
                                            <td>@include('backend.check.partials.action')</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row row-cols-3">
                            <div class="col text-left">
                                Showing {{(is_null($students->firstItem()))? 0 : $students->firstItem()}} to {{(is_null($students->lastItem()))? 0 : $students->lastItem()}} of {{$students->total()}} students
                            </div>
                            <div class="col">
                                Page {{$students->currentPage()}}
                            </div>
                            <div class="col justify-content-center">
                                {{$students->appends(['search' => $search])->links()}}
                            </div>
                        </div>
                    </div>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection