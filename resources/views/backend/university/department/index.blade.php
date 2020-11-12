@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Bachelor'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card text-center">
                <div class="card-header">
                    <h3><strong>Bachelor(s) for {{$faculty->name}}</strong></h3>

                    {{-- <a style="float: right;" href="{{url('admin/faculty/'.$faculty->id.'/department/add')}}" class="btn btn-sm btn-success">
                        Add Bachelor
                    </a> --}}

                </div>
                <div class="card-body">
                     <div class="col-lg-12">
                        <form action="{{ route('admin.view-department', $faculty) }}" method="get">
                            <input type="text" name="search" id="search" value="{{ $search }}">
                            <a href="{{ route('admin.view-department', $faculty) }}" class="btn btn-sm btn-info">Reset</a>
                            <button type="submit" class="btn btn-sm btn-info">Search</button>
                        </form>
                        <div class="row row-cols-3">
                            <div class="col text-left">
                                Showing {{$departments->firstItem()}} to {{$departments->lastItem()}} of {{$departments->total()}} Departments
                            </div>
                            <div class="col">
                                Page {{$departments->currentPage()}}
                            </div>
                            <div class="col justify-content-center">
                                {{$departments->appends(['search' => $search])->links()}}
                            </div>
                        </div>
                        <br>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Bachelor Name</th> 
                                <th scope="col">Action</th>  
                            </tr>
                            </thead>
                            <tbody>


                            @foreach($departments as $department)

                            @if(!count($departments))
                            @else
                            <tr>
                                <th>{{$departments->firstItem() + $loop->iteration-1}}</th>
                                <th>{{$department->name}}</th>
                                <td>

                                <a href="{{url('admin/faculty/'.$faculty->id.'/department/'.$department->id.'/edit')}}">
                                    <button class="btn btn-info">Edit</button>
                                </a>

                                    {{-- <a href="{{url('admin/faculty/'.$faculty->id.'/department/'.$department->id.'/bachelor')}}">
                                    <button class="btn btn-primary">View Bachelor</button>
                                </a> --}}

                                <a href="{{url('admin/faculty/'.$faculty->id.'/department/'.$department->id.'/graduate')}}">
                                    <button class="btn btn-success">Graduate Student
                                    <span class="badge badge-warning">{{ App\Models\Student::where('department_id', $department->id)->count() }}</span>
                                    </button>
                                </a>

                                </td>
                
                            </tr>
                            @endif

                            @endforeach

                            </tbody>
                        </table>
                        <div class="row row-cols-3">
                            <div class="col text-left">
                                Showing {{$departments->firstItem()}} to {{$departments->lastItem()}} of {{$departments->total()}} Departments
                            </div>
                            <div class="col">
                                Page {{$departments->currentPage()}}
                            </div>
                            <div class="col justify-content-center">
                                {{$departments->appends(['search' => $search])->links()}}
                            </div>
                        </div>
                    </div>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection
