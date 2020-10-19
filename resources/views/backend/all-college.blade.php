@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('All College'))

@section('content')
      <div class="row">
        <div class="col">

            <div class="card text-center">
                <div class="card-header">
                    <strong>College List</strong>
                </div><!--card-header-->
                <div class="card-body">
                  <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Keyword</th>
                            <th scope="col">Dean Name</th>
                            <th scope="col">Signature</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($colleges as $college)
                          <tr>
                            <th>{{$college->name}}</th>
                            <td>{{$college->keyword}}</td>
                            <td>{{$college->dean_name}}</td>
                            <td>
                              <img src="{{ asset("storage/$college->signature") }}" height="50" width="50">
                            </td>
                            <td>
                              <button class="btn btn-primary">Edit</button>
                            </td>
                          </tr>
                          @endforeach
                    
                
                        </tbody>
                      </table>

                 
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <strong>Add New College</strong>
                </div><!--card-header-->
                <div class="card-body">
                    <form action="{{url('admin/all-college/store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="text" name="university_id" value={{$logged_in_user->university->id }} style="display: none;">
                      <div class="form-group">
                        <label>College Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter College Name">
                      </div>

                      <div class="form-group">
                        <label>Keyword</label>
                        <input type="text" name="keyword" class="form-control" placeholder="Enter Keyword">
                      </div>

                      <div class="form-group">
                        <label>Dean Name</label>
                        <input type="text" name="dean_name" class="form-control" placeholder="Enter Current Dean Name">
                      </div>

                      <div class="form-group">
                        <label>Dean Signature</label><br>
                        <input type="file" name="signature">
                      </div>

                     
                     
                      <button style="float: right;" type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
