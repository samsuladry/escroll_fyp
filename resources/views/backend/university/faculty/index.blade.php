@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Faculty'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card text-center">
                <div class="card-header">
                    <h3><strong>Faculty(s) for {{auth()->user()->university->name}}</strong></h3>
                </div>
                <div class="card-body">
                    <div class="col-lg-12">
                        <form action="{{ route('admin.view-faculty') }}" method="get">
                            <input type="text" name="search" id="search" value="{{ $search }}">
                            <a href="{{ route('admin.view-faculty') }}" class="btn btn-sm btn-info">Reset</a>
                            <button type="submit" class="btn btn-sm btn-info">Search</button>
                        </form>
                        <br>
                        <div class="row row-cols-3">
                            <div class="col text-left">
                                Showing {{$faculties->firstItem()}} to {{$faculties->lastItem()}} of {{$faculties->total()}} Faculties
                            </div>
                            <div class="col">
                                Page {{$faculties->currentPage()}}
                            </div>
                            <div class="col justify-content-center">
                                {{$faculties->appends(['search' => $search])->links()}}
                            </div>
                        </div>
                        <br>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Action</th>  
                            </tr>
                            </thead>
                            <tbody>


                            @foreach($faculties as $faculty)

                            @if(!count($faculties))
                            @else
                            <tr>
                                <th>{{$faculties->firstItem() + $loop->iteration -1 }}</th>
                                <th>{{$faculty->name}}</th>
                                <td>

                                    <a href="{{url('admin/faculty/'.$faculty->id.'/edit')}}">
                                    <button class="btn btn-info">Edit</button>
                                    </a>

                                    <a href="{{url('admin/faculty/'.$faculty->id.'/department')}}">
                                    <button class="btn btn-primary">List Bachelor</button>
                                    </a>


                                    <a href="{{url('admin/faculty/'.$faculty->id.'/dean')}}">
                                    <button class="btn btn-primary">List Dean</button>
                                    </a>


                                    <a href="{{url('admin/faculty/'.$faculty->id.'/graduate')}}">
                                    <button class="btn btn-success">Graduate Student 
                                        <span class="badge badge-warning">{{ App\Models\Student::where('faculty_id', $faculty->id)->count() }}</span>
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
                                Showing {{$faculties->firstItem()}} to {{$faculties->lastItem()}} of {{$faculties->total()}} Faculties
                            </div>
                            <div class="col">
                                Page {{$faculties->currentPage()}}
                            </div>
                            <div class="col justify-content-center">
                                {{$faculties->appends(['search' => $search])->links()}}
                            </div>
                        </div>
                    </div>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection
