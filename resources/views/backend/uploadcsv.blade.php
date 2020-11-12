@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Upload Csv'))

@section('content')

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-header">
        <strong>CSV Format</strong>
      </div>
      <!--card-header-->
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Matric Number</th>
              <th scope="col">Name</th>
              <th scope="col">Faculty</th>
              <th scope="col">Programme</th>
              <th scope="col">Citizenship</th>
              <th scope="col">Setial Number</th>
              <th scope="col">Endorsed Date (mm/dd/YYYY)</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">113213</th>
              <td>Mark Otto</td>
              <td>Engineering</td>
              <td>Bachelor of Engineering</td>
              <td>Malaysia</td>
              <td>123456</td>
              <td>3/13/2020</td>
            </tr>
            <tr>
              <th scope="row">113214</th>
              <td>Adam Lamberg</td>
              <td>Health Science</td>
              <td>Bachelor of Health Science</td>
              <td>Indonesia</td>
              <td>123457</td>
              <td>12/14/2020</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!--card-body-->
    </div>
    <!--card-->
  </div>
  <!--col-->
</div>
<!--row-->

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-header">
        <strong>Upload CSV</strong>
      </div>
      <!--card-header-->
      <div class="card-body">
        <div class="col-lg-12" style="margin-top: 1em;margin-bottom: 4em;">

          <form action="{{url('admin/import-csv/store')}}" method="POST" enctype="multipart/form-data" style="margin-top: 1em;">
            @csrf
            <input type="file" name="file" accept=".xlsx, .xls">
            <br>
            <button class=" btn btn-success" style="margin-top: 1em;">Upload</button>
          </form>


        </div>
      </div>
      <!--card-body-->

      {{-- <div class="card-body">
        <div className="container-fluid mt-5">
          <div className="row">
            <main role="main" className="col-lg-12 d-flex text-center">
              <div className="content mr-auto ml-auto">
                <a href=https://ipfs.infura.io/ipfs/QmNaziHqZ8zBS2vrYwd3bdXJHmeoHDsBm9cf4b6YUWZBcX target="_blank" rel="noopener noreferrer">
                  <img src=https://ipfs.infura.io/ipfs/QmNaziHqZ8zBS2vrYwd3bdXJHmeoHDsBm9cf4b6YUWZBcX />
                </a>
                <h2>Images (Change)</h2>

                <form id="ipfsSubmit">
                  <input id="ipfsFile" type="file"/>
                  <input id="ipfsSubmit2" type="submit" />
                </form>

              </div>
            </main>
          </div>
        </div>
      </div> --}}




    </div>
    <!--card-->
  </div>
  <!--col-->
</div>
<!--row-->
@endsection