@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Blockchain Student'))

@section('content')
<div class="row">
  <div class="col">
    <div class="card text-center">
      <div class="card-header">
        <strong>Blockchain Student</strong>

      </div>
      <!--card-header-->
      <div class="card-body">
        <div class="col-lg-12">
          <!-- <div class="float-left">
                        <button id="ipfsImage" class="btn btn-unique btn-rounded btn-sm my-0 btn-success" type="submit">Upload Cert</button>
                      </div> -->
          <div class="float-right mb-3 form-inline mr-auto">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button id="searchStudent" class="btn btn-unique btn-rounded btn-sm my-0 btn-success" type="submit">Search</button>
          </div>
          <table class="table table-striped">

            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Matric Number</th>
                <th scope="col">Name</th>
                <th scope="col">Bachelor</th>
                <th scope="col">QR Code</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <thead id="tablestudent"></thead>
              <!-- <a href="{{}}">
                <button class="btn btn-primary">View</button>
              </a> -->

            </tbody>
          </table>


        </div>
        <!--col-->
      </div>
      <!--card-body-->





      @endsection