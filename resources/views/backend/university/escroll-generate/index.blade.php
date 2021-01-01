@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Template'))

@section('content')
<div class="row">
	<div class="col">
		<div class="card text-center">
			<div class="card-header">
				<strong>Generate PDF</strong>
			</div>
			<div class="card-body">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="form-group row">
								{{-- <label for="batch" class="col-sm-2 col-form-label">Batch</label> --}}
								<div class="col-sm-10">
									<select name="batch" id="batch" class="form-control">
										@foreach ($batches as $batch)
										<option value="{{$batch->batch}}">{{$batch->batch}}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="form-group row">
								{{-- <label for="academic_level" class="col-sm-2 col-form-label">Academic Level</label> --}}
								<div class="col-sm-10">
									<select name="academic_level" id="academic_level" class="form-control">
										@foreach ($academic_levels as $academic_level)
										<option value="{{$academic_level->id}}">{{$academic_level->name}}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
					</div>
					<button id="generate" class="btn btn-info"><i class="fa fa-play" aria-hidden="true"></i> Generate PDF</button>
					<div class="row">
						<div class="col-md-12">
							<div class="panel-body">
								<span id="success_message"></span>
								<div id="startup">
									<span class="spinner-border text-success"></span> <span>Preparing for PDF generation...</span>
								</div>
								<div class="form-group" id="process" style="display:none;">
									<div class="progress">
										<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
											<span id="display-percentage" style="color:black;"></span>
										</div>
									</div>
									<div>
										<span id="display-time"></span>
									</div>
									
									<div id="zip-process">
										<span class="spinner-border text-success"></span> <span>Zipping file and download...</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--card-body-->
		</div>
		<!--card-->
		<div class="card text-center">
			<div class="card-header">
				<strong>Download ZIP</strong>
			</div>
			<div class="card-body">
				<select name="zip" id="zip">
					@foreach ($file_names as $file)
					<option value="{{ $file }}"> Batch : {{explode('_', $file)[1]}} | Level : {{explode('_', $file)[2]}} </option>
					@endforeach
				</select>
				<button id="download" class="btn btn-info"><i class="fa fa-arrow-circle-down"></i> Download zip</button>
			</div>
		</div>
	</div>
	<!--col-->
</div>
<!--row-->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
	var totalStudents = 0;
	var counter = 0;
	var minit = 0;
	var second = 0;
	$(document).ready(function() {
		$('#zip-process').css('display', 'none');
		$('#startup').css('display', 'none');
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		// $('.progress').atttr('display', 'none');
		$("#generate").click(function() {
			event.preventDefault();
			remove_folder();
		});

		$("#download").click(function() {
			event.preventDefault();
			download_zip(true, $('#zip').val());
		});
		get_total_students()
			.then(result => {
				totalStudents = result.total;
			})
			.catch(err => {
				alert('Error getting total students');
			});
	});

	function get_total_students() {
		return new Promise((resolve, reject) => {
			$.ajax({
				type: "POST",
				url: '{{route("admin.escroll.total-students")}}',
				success: resolve,
				error: reject
			});
		});
	}

	function remove_folder() {
		$('#startup').css('display', 'block');
		$.ajax({
			type: 'POST',
			url: '{{route("admin.escroll.remove-folder")}}',
			beforeSend: () => {
				console.log('remove folder before');
				$('#generate').attr('disabled', 'disabled');
				$('#download').attr('disabled', 'disabled');
			},
			success: () => {
				generate_pdf();
			},
			complete: () => {
				console.log('remove folder complete');
			},
		});
	}

	function generate_pdf() {
		$.ajax({
			type: 'POST',
			url: '{{route("admin.escroll.generate")}}',
			data: {
				batch: $('#batch').val(),
				academic_level: $('#academic_level').val()
			},
			beforeSend: function() {
				$('#generate').attr('disabled', 'disabled');
				$('#download').attr('disabled', 'disabled');
				$('#process').css('display', 'block');
				$('.progress-bar').css('width', 0 + '%');
				minit = 0;
				second = 0;
				counter = 0;
				$('#display-time').html('');
				$('#display-time').html(0 + ' second elapsed');
				$('#display-percentage').html(0 + '/' + totalStudents + ' (' + 0 + '%)');
				setTimeout(() => {
					get_percentage(totalStudents);
					$('#startup').css('display', 'none');
					clearTimer = setInterval(() => {
						get_percentage(totalStudents);
					}, 2000);

					myInterval = setInterval(function() {
						minit = parseInt(counter / 60);
						second = (counter - minit * 60);
						if (minit == 0) {
							if (second == 1 || second == 0) {
								$('#display-time').html('');
								$('#display-time').html(second + ' second elapsed');
							} else {
								$('#display-time').html('');
								$('#display-time').html(second + ' seconds elapsed');
							}
						} else if (minit == 1) {
							if (second == 1 || second == 0) {
								$('#display-time').html('');
								$('#display-time').html(minit + ' minute ' + second + ' second elapsed');
							} else {
								$('#display-time').html('');
								$('#display-time').html(minit + ' minute ' + second + ' seconds elapsed');
							}
						} else {
							if (second == 1 || second == 0) {
								$('#display-time').html('');
								$('#display-time').html(minit + ' minutes ' + second + ' second elapsed');
							} else {
								$('#display-time').html('');
								$('#display-time').html(minit + ' minutes ' + second + ' seconds elapsed');
							}
						}

						++counter;
					}, 1000);
				}, 5000);
			},
			success: (data) => {
				setTimeout(() => {
					$('#zip-process').css('display', 'block');
					download_zip(false, '{{auth()->user()->university->acronym}}' + '_' + data.batch + '_' + data.academic_level);
				}, 5000);
			},
			complete: (data) => {
				$('#generate').attr('disabled', false);
				$('#download').attr('disabled', false);
			},
			error: (error) => {
				$('#zip-process').css('display', 'block');
				clearInterval(clearTimer);
				clearInterval(myInterval);
				alert(error.responseJSON.msg);
			},
		});
	}

	function get_percentage(totalStudents) {
		$.ajax({
			type: 'POST',
			url: '{{route("admin.escroll.check-percentage")}}',
			data: {
				totalStudents: totalStudents
			},
			success: (data) => {
				$('.progress-bar').css('width', data.total + '%');
				$('#display-percentage').html(data.total_files + '/' + data.totalStudents + ' (' + data.total + '%)');
				if (data.total >= 100) {
					$('.progress-bar').css('width', '100%');
					$('#zip-process').css('display', 'block');
					clearInterval(clearTimer);
					clearInterval(myInterval);
				}
				// $('#display-percentage').html('');

			},
			complete: () => {},
			error: (error) => {
				alert('Failed to check percentage');
				$('#zip-process').css('display', 'block');
				clearInterval(clearTimer);
				clearInterval(myInterval);
			}
		});
	}

	function download_zip(download = false, filename = null) {
		console.log('download value is = ' + download);
		$.ajax({
			type: 'POST',
			url: '{{route("admin.escroll.download-zip")}}',
			data: {
				download: download,
				filename: filename
			},
			xhrFields: {
				responseType: 'blob'
			},
			beforeSend: () => {
				$('#download').attr('disabled', 'disabled');
			},
			success: function(response) {
				var blob = new Blob([response]);
				var link = document.createElement('a');
				link.href = window.URL.createObjectURL(blob);
				link.download = "{{auth()->user()->university->acronym}}.zip";
				link.click();
			},
			complete: () => {
				$('#zip-process').css('display', 'none');
				$('#generate').attr('disabled', false);
				$('#download').attr('disabled', false);
			},
			error: function(blob) {
				alert('Error occured while zipping');
			}
		})
	}
</script>
@endsection

@push('before-scripts')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
@endpush
@push('after-scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
	// $(document).ready(function () {
	$('#zip').select2({
		placeholder: 'Select Zip File',
		autoClear: true,
	});
	$('#academic_level').select2({
		placeholder: 'Select Zip File',
		autoClear: true,
	});
	$('#batch').select2({
		placeholder: 'Select Zip File',
		autoClear: true,
	});
	// });
</script>
@endpush
@push('before-styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endpush
