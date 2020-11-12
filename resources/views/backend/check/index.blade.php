@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Check Typo'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card text-center">
                <div class="card-header">
                    <h1><strong>Check for Typo</strong></h1>
                    <h3>This page only shows the list of programmes, faculties and citizenships. If there is any typo in the titles, edit the titles and the system will automatically fix to the respective student's data</h3>

					<h3>Once the data have been verified, click the import button, to save into the lookup table button</h3>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs">
                        <li class="active nav-item"><a data-toggle="tab" href="#faculty" class="btn btn-outline-info active">Faculty</a></li>
                        <li class="nav-item"><a data-toggle="tab" href="#programme" class="btn btn-outline-info">Programme</a></li>
                        <li class="nav-item"><a data-toggle="tab" href="#citizenship" class="btn btn-outline-info">Citizenship</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="faculty" class="tab-pane fade in active show">
							<table class="table table-striped table-bordered" id="faculty-table">
								<thead>
									<tr>
										<th scope="col">No</th>
										<th scope="col">Faculty</th>
										<th scope="col">Action</th>  
									</tr>
								</thead>
								<tbody>
								@foreach($faculties as $item)
									<tr>
										<th>{{$loop->iteration}}</th>
										<td>{{$item->faculty}}</td>
										<td>
											<a href="{{route('admin.check.faculty', str_replace(' ', '-', $item->faculty)) }}" class="btn btn-md btn-success">Fix Typo</a>
										</td>
									</tr>
								@endforeach
								</tbody>
                            </table>
                        </div>
                        <div id="programme" class="tab-pane fade in">
							<table class="table table-striped table-bordered" id="programme-table">
								<thead>
									<tr>
										<th scope="col">No</th>
										<th scope="col">Programme</th>
										<th scope="col">Action</th>  
									</tr>
								</thead>
								<tbody>
									@foreach($programmes as $item)
									<tr>
										<th>{{$loop->iteration}}</th>
										<td>{{$item->programme}}</td>
										<td>
											<a href="{{route('admin.check.programme', str_replace(' ', '-', $item->programme)) }}" class="btn btn-md btn-success">Fix Typo</a>
										</td>
									</tr>
								@endforeach
								</tbody>
                            </table>
                        </div>
                        <div id="citizenship" class="tab-pane fade in">
							<table class="table table-striped table-bordered" id="citizenship-table">
								<thead>
									<tr>
										<th scope="col">No</th>
										<th scope="col">Citizenship</th>
										<th scope="col">Action</th>  
									</tr>
								</thead>
								<tbody>
								@foreach($citizenships as $item)

									<tr>
										<th>{{$loop->iteration}}</th>
										<td>{{$item->citizenship}}</td>
										<td>
											<a href="{{route('admin.check.citizenship', str_replace(' ', '-', $item->citizenship)) }}" class="btn btn-md btn-success">Fix Typo</a>
										</td>
									</tr>

								@endforeach
								</tbody>
                            </table>
                        </div>
                    </div>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script>
        $(document).ready(function () {
            $('#faculty-table').DataTable();
            $('#programme-table').DataTable();
            $('#citizenship-table').DataTable();
        });
    </script>
@endsection
