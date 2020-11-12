@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Add Rector'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card text-center">
                <div class="card-header">
                    <h3><strong>Rector for {{auth()->user()->university->name}}</strong></h3>
                    <a style="float: right;" href="{{url('admin/rector/add')}}" class="btn btn-md btn-success">
                        Add Rector
                    </a>
                </div>
                <div class="card-body">
                     <div class="col-lg-12">
                        <div class="row row-cols-3">
                            <div class="col text-left">
                                Showing {{(is_null($rectors->firstItem()))? 0 : $rectors->firstItem()}} to {{(is_null($rectors->lastItem()))? 0 : $rectors->lastItem()}} of {{$rectors->total()}} Rectors
                            </div>
                            <div class="col">
                                Page {{$rectors->currentPage()}}
                            </div>
                            <div class="col justify-content-center">
                                {{$rectors->links()}}
                            </div>
                        </div>
                        <br>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Signature</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            
                            </tr>
                            </thead>
                            <tbody>


                            @foreach($rectors as $rector)

                            @if(!count($rectors))
                            @else
                            <tr>
                                <th>{{$rectors->firstItem() + $loop->iteration - 1}}</th>
                                <th>{{$rector->name}}</th>
                                <td>
                                <img src="{{ asset("storage/$rector->signature") }}" height="50" width="100">
                                </td>
                                <td>{{$rector->created_at}}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{url('admin/rector/'.$rector->id.'/edit')}}" class="btn btn-info">
                                            Edit
                                        </a>
    
                                        <form action="{{ route('admin.activate-rector', [$rector->id]) }}" method="post">
                                        @csrf
                                            <button type="submit" class="btn {{ ($rector->active)? 'btn-success' : 'btn-warning' }}">{{ ($rector->active)? 'Activated' : 'Deactivated' }}</button>
                                        </form>
                                    </div>
                                </td>
                
                            </tr>
                            @endif

                            @endforeach

                            </tbody>
                        </table>
                        <div class="row row-cols-3">
                            <div class="col text-left">
                                Showing {{(is_null($rectors->firstItem()))? 0 : $rectors->firstItem()}} to {{(is_null($rectors->lastItem()))? 0 : $rectors->lastItem()}} of {{$rectors->total()}} Rectors
                            </div>
                            <div class="col">
                                Page {{$rectors->currentPage()}}
                            </div>
                            <div class="col justify-content-center">
                                {{$rectors->links()}}
                            </div>
                        </div>
                    </div>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection
