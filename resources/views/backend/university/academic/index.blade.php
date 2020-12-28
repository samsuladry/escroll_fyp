@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Academic Levels'))

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header text-center">
                <strong>Academic Levels</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col text-left">
                        Showing {{$academic_levels->firstItem()}} to {{$academic_levels->lastItem()}} of {{$academic_levels->total()}} Academic Levels
                    </div>
                    <div class="col text-center">
                        Page {{$academic_levels->currentPage()}}
                    </div>
                    <div class="col text-right">
                        <a href="{{route('admin.academic.create')}}" class="btn btn-success"><i class="fas fa-plus"></i> New</a>
                    </div>
                </div>
                <br>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col" width="5%">No.</th>
                        <th scope="col" width="85%">Name</th>
                        <th scope="col" width="10%">Action</th>  
                    </tr>
                    </thead>
                    <tbody>


                    @foreach($academic_levels as $academic)

                    @if(!count($academic_levels))
                    @else
                    <tr>
                        <th>{{$academic_levels->firstItem() + $loop->iteration -1 }}</th>
                        <td>{{$academic->name}}</td>
                        <td>
                            <div class="btn-group">
                                @include('backend.university.academic.partials.edit')

                                @include('backend.university.academic.partials.delete')
                            </div>
                            
                            {{-- <a href="{{url('admin/faculty/'.$faculty->id.'/edit')}}">
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
                            </a> --}}

                            

                        </td>
        
                    </tr>
                    @endif

                    @endforeach

                    </tbody>
                </table>
                <div class="row row-cols-3">
                    <div class="col text-left">
                        Showing {{$academic_levels->firstItem()}} to {{$academic_levels->lastItem()}} of {{$academic_levels->total()}} Academic Levels
                    </div>
                    <div class="col text-center">
                        Page {{$academic_levels->currentPage()}}
                    </div>
                    <div class="col text-right">
                        {{-- {{$academic_levels->appends(['search' => $search])->links()}} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection