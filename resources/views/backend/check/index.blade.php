@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Check Typo'))

@section('content')
<div class="row">
	<div class="col">
		<div class="card text-center">
			<div class="card-header">
				<h1><strong>Check for Typo</strong></h1>
				<h4>This page only shows the list of programmes, faculties and citizenships. If there is any typo in the titles, edit the titles and the system will automatically fix to the respective student's data</h3>

					<h3>Once the data have been verified, click the import button, to save into the lookup table button</h3>
					<form action="{{ route('admin.check.all.import') }}" method="POST">
						@csrf
						<button type="submit" class="btn btn-sm btn-success disabled2"><i class="fas fa-qrcode"></i> Import All & generate QR</button>
					</form>
			</div>
			<div class="card-body">
				<nav>
					<div class="nav nav-tabs" id="nav-tab" role="tablist">
						<a class="nav-item nav-link active" id="nav-faculty-tab" data-toggle="tab" role="tab" href="#faculty" aria-controls="nav-faculty" aria-selected="true">Faculty</a>
						<a class="nav-item nav-link" id="nav-programme-tab" data-toggle="tab" role="tab" href="#programme" aria-controls="nav-programme" aria-selected="false">Programme</a>
						<a class="nav-item nav-link" id="nav-citizenship-tab" data-toggle="tab" role="tab" href="#citizenship" aria-controls="nav-citizenship" aria-selected="false">Citizenship</a>
					</div>
				</nav>
				<div class="tab-content" id="nav-tabContent">
					<div id="faculty" class="tab-pane fade active show" id="nav-faculty" role="tabpanel" aria-labelledby="nav-faculty-tab">
						<table class="table table-striped table-bordered" id="faculty-table">
							<thead>
								<tr>
									<th scope="col">No</th>
									<th scope="col">Faculty</th>
									<th scope="col">No of Students</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($faculties as $item)
								<tr>
									<th>{{$loop->iteration}}</th>
									<td>{{$item->faculty}}</td>
									<td>{{ App\Models\PreImport::where('faculty', $item->faculty)->count() }}</td>
									<td>
										<div class="btn-group">
											<a href="{{route('admin.check.faculty', str_replace(' ', '-', $item->faculty)) }}" class="btn btn-sm btn-primary"><i class="fas fa-wrench"></i> Fix Typo</a>
											<form action="{{ route('admin.check.faculty.import', $item->faculty) }}" method="POST">
												@csrf
												<button type="submit" class="btn btn-sm btn-success disabled2"><i class="fas fa-qrcode"></i> Import & generate QR</button>
											</form>
										</div>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div id="programme" class="tab-pane fade" id="nav-programme" role="tabpanel" aria-labelledby="nav-programme-tab">
						<table class="table table-striped table-bordered" id="programme-table">
							<thead>
								<tr>
									<th scope="col">No</th>
									<th scope="col">Programme</th>
									<th scope="col">No of Students</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($programmes as $item)
								<tr>
									<th>{{$loop->iteration}}</th>
									<td>{{$item->programme}}</td>
									<td>{{ App\Models\PreImport::where('programme', $item->programme)->count() }}</td>
									<td>
										<div class="btn-group">
											<a href="{{route('admin.check.programme', str_replace(' ', '-', $item->programme)) }}" class="btn btn-sm btn-primary"><i class="fas fa-wrench"></i> Fix Typo</a>
											<form action="{{ route('admin.check.programme.import', $item->programme) }}" method="POST">
												@csrf
												<button type="submit" class="btn btn-sm btn-success disabled2"><i class="fas fa-qrcode"></i> Import & generate QR</button>
											</form>
										</div>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div id="citizenship" class="tab-pane fade" id="nav-citizenship" role="tabpanel" aria-labelledby="nav-citizenship-tab">
						<table class="table table-striped table-bordered" id="citizenship-table">
							<thead>
								<tr>
									<th scope="col">No</th>
									<th scope="col">Citizenship</th>
									<th scope="col">No of Students</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($citizenships as $item)

								<tr>
									<th>{{$loop->iteration}}</th>
									<td>{{$item->citizenship}}</td>
									<td>{{ App\Models\PreImport::where('citizenship', $item->citizenship)->count() }}</td>
									<td>
										<div class="btn-group">
											<a href="{{route('admin.check.citizenship', str_replace(' ', '-', $item->citizenship)) }}" class="btn btn-sm btn-primary"><i class="fas fa-wrench"></i> Fix Typo</a>
											<form action="{{ route('admin.check.citizenship.import', $item->citizenship) }}" method="POST">
												@csrf
												<button type="submit" class="btn btn-sm btn-success disabled2"><i class="fas fa-qrcode"></i> Import & generate QR</button>
											</form>
										</div>
									</td>
								</tr>

								@endforeach
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
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
	$(document).ready(function() {
		$('#faculty-table').DataTable();
		$('#programme-table').DataTable();
		$('#citizenship-table').DataTable();
	});

	$('.disabled2').on('click', function() {
		$('.disabled2').attr('disabled', 'disabled')
		this.form.submit();
	});
</script>
@endsection