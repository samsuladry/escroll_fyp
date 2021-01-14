@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Upload Csv'))

@section('content')
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-header">
        <strong>Excel Format (.xlsx, .xls)</strong>
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
        <strong>Upload Excel</strong>
      </div>
      <!--card-header-->
      <div class="card-body">
        <div class="col-lg-12" style="margin-top: 1em;margin-bottom: 4em;">

          <form action="{{route('admin.store-csv')}}" method="POST" enctype="multipart/form-data" style="margin-top: 1em;">
            @csrf
            <div class="row form-group">
                <label for="file" class="col-sm-2 control-label">Upload File</label>
                <div class="col-sm-10">
                    <input type="file" name="file" accept=".xlsx, .xls" class="form-control-file" required>
                </div>
            </div>

            <div class="row form-group">
                <label for="academic" class="col-sm-2 control-label">Academic Level</label>
                <div class="col-sm-10">
                    <select name="academic" id="academic" class="form-control" required>
                        <option value="">Please Select</option>
                        @foreach ($academic_level as $academic)
                            <option value="{{$academic->id}}">{{$academic->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <label for="batch" class="col-sm-2 control-label">Convocation Batch</label>
                <div class="col-sm-10">
                    <input type="text" name="batch" id="batch" class="form-control" autocomplete="off" required>
                </div>
            </div>
            <button class=" btn btn-success" style="margin-top: 1em;">Upload</button>
          </form>


        </div>
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
        <strong>Upload Your Academic Transacript</strong>
      </div>
      <!--card-header-->
      <div class="card-body">
        <div class="col-lg-12" style="margin-top: 1em;margin-bottom: 4em;">
          <div class="d-flex p-2 justify-content-center">
              <div class='card mt-2'>
                  <div>
                      <form id="ipfsSubmit">
                          <input id="ipfsFile" type="file" multiple />
                          <input id="ipfsSubmit2" type="submit" />
                      </form>

                      <form id="target" method="post" action="{{ route('admin.update-ipfs') }}">
                        @csrf
                        <p id="content"></p>
                      </form>
                  </div>
              </div>
          </div>

          <div class="d-flex p-2 justify-content-center">
              <table class="table">
                  <thead>
                      <tr>
                          <th scope="col">No.</th>
                          <th scope="col">Matric No.</th>
                          <th scope="col">Link</th>
                          <th scope="col">Date</th>
                      </tr>
                  </thead>
                  <tbody id="uploadTable">
                      
                  </tbody>
              </table>
          </div>
        </div>
      </div>
      <!--card-body-->

    </div>
    <!--card-->
  </div>
  <!--col-->
</div>
<!--row-->
@endsection


@push('before-scripts')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
@endpush
@push('after-scripts')

<script src="https://cdn.jsdelivr.net/npm/ipfs/dist/index.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ipfs/0.47.1-rc.19/index.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/ipfs-http-client/dist/index.min.js"></script>
<script src="https://bundle.run/buffer@5.6.0"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="module" src="{{ asset('js/ipfs.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#academic').select2({
            placeholder: 'Select Academic Level',
            autoClear: true,
        });
    });
</script>
@endpush
@push('before-styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endpush
