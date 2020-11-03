@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Dean'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card text-center">
                <div class="card-header">
                    <strong>Dean</strong>

                    <a style="float: right;" href="{{url('admin/faculty/'.$faculty->id.'/dean/add')}}">
                        <button class="btn btn-sm btn-success">Add Dean</button>
                    </a>

                </div>
                <div class="card-body">
                     <div class="col-lg-12">
                            <table class="table table-striped">
                                  <thead>
                                    <tr>
                                      <th scope="col">ID</th>
                                      <th scope="col">Dean Name</th> 
                                       <th scope="col">Signature</th> 
                                      <th scope="col">Action</th>  
                                    </tr>
                                  </thead>
                                  <tbody>


                                    @foreach($deans as $dean)

                                    @if(!count($deans))
                                    @else
                                    <tr>
                                      <th>{{$loop->iteration}}</th>
                                      <th>{{$dean->name}}</th>
                                      <td>
                                        <img src="{{ asset("storage/$dean->signature") }}" height="50" width="100">
                                      </td>
                                      <td>
                                        <div class="row">
                                          <a href="{{url('admin/faculty/'.$faculty->id.'/dean/'.$dean->id.'/edit')}}">
                                            <button class="btn btn-info">Edit</button>
                                          </a>
  
                                          <form action="{{ route('admin.activate-dean', [$faculty->id, $dean->id]) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn {{ ($dean->active)? 'btn-success' : 'btn-warning' }}">{{ ($dean->active)? 'Activated' : 'Deactivated' }}</button>
                                          </form>
                                        </div>
                                        
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
