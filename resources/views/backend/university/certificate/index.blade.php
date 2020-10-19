@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Certicate'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card text-center">
                <div class="card-header">
                    <strong>Digital Certificate Info</strong>

                    <a style="float: right;" href="{{url('admin/digital_certificate/add')}}">
                        <button class="btn btn-sm btn-success">Add Certificate Info</button>
                    </a>

                </div>
                <div class="card-body">
                     <div class="col-lg-12">
                            <table class="table table-striped">
                                  <thead>
                                    <tr>
                                      <th scope="col">Name</th>
                                      <th scope="col">Location</th>
                                      <th scope="col">Reason</th>
                                      <th scope="col">Contact Info</th>
                                   
                                    </tr>
                                  </thead>
                                  <tbody>

                                    @foreach($certificates as $certificate)
                                    <tr>
                                      <th>{{$certificate->name}}</th>
                                      <td>{{$certificate->location}}</td>
                                      <td>{{$certificate->reason}}</td>
                                      <td>{{$certificate->contact_info}}</td>
                                    </tr>
                                    @endforeach
                                    

                                    

                                  </tbody>
                                </table>
                            
                        </div>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection
