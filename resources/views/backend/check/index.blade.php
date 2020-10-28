@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Check Typo'))

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
                        <li class="active"><a data-toggle="tab" href="#faculty">Faculty</a></li>
                        <li><a data-toggle="tab" href="#programme">Programme</a></li>
                        <li><a data-toggle="tab" href="#citizenship">Citizenship</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="faculty" class="tab-pane fade in active show">
							<table class="table table-striped table-bordered">
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
							<table class="table table-striped table-bordered">
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
							<table class="table table-striped table-bordered">
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
@endsection
