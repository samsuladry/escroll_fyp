@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Add Rector'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card text-center">
                <div class="card-header">
                    <strong>Rector</strong>

                    <a style="float: right;" href="{{url('admin/rector/add')}}">
                        <button class="btn btn-sm btn-success">Add Rector</button>
                    </a>

                </div>
                <div class="card-body">
                     <div class="col-lg-12">
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
                                      <th>{{$rector->id}}</th>
                                      <th>{{$rector->name}}</th>
                                      <td>
                                        <img src="{{ asset("storage/$rector->signature") }}" height="50" width="100">
                                      </td>
                                      <td>{{$rector->created_at}}</td>
                                      <td>

                                        <a href="{{url('admin/rector/'.$rector->id.'/edit')}}">
                                          <button class="btn btn-info">Edit</button>
                                        </a>

                                      </td>
                        
                                    </tr>
                                    @endif

                                    @endforeach

                                  </tbody>
                                </table>
                            
                        </div>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection
