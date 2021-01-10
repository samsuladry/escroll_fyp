@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Graduate Student'))

@section('content')
<div class="row">
	<div class="col">
		<div class="card text-center">
			<div class="card-header">
				<h3><strong>Gradute Student(s) for {{$faculty->name}}</strong></h3>

				<button style="float: right;" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal">Activate</button>



				<!-- Modal -->
				<?php /* 
				<div class="modal fade" id="generateQR" tabindex="-1" role="dialog" aria-labelledby="generateQRlable" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="generateQRlable">Activate Confirmation</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<!-- <form action="{{url('admin/faculty/'.$faculty->id.'/graduate/activate')}}" method="POST" enctype="multipart/form-data"> -->

							<!-- <form action="{{ url('admin/blockchainstudent') }}"></form>
							@csrf -->
							<div class="modal-body">
								This process can be done once, make sure you check all the record before activate all the record, this process involve <b>QR code generation, PDF generation and Store Record in Blockchain</b><br><br>Please upload digital certificate (.crt) before submit.

								<hr>

								<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
								<input type="hidden" name="faculty_id" value="{{ $faculty->id }}">

								<input type="file" name="certificate" accept=".crt">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<!-- <a href="{{url('admin/faculty/'.$faculty->id.'/graduate/activate')}}"> -->
								<button class="save-data" type="submit" class="btn btn-success">Activate Graduate Student</button>
							</div>

							<!-- </form> -->
						</div>
					</div>
				</div>
				*/ ?>

				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Activate Confirmation</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<p> Make sure you check all the record are correct before it is activated to blockchain. <br></p>

								<hr>
								<div class="form-group float-left">
									<select class="form-control" id="MnemonicOrPK">
										<option value="mnemonicPhrases">Mnemonic Phrases</option>
										<option value="privateKeyPhrases">Private Key</option>
									</select>
								</div>
								<input type="text" class="form-control" id="uniNameInput" Name="mnemonicPhrases">

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary save-data" id="submitButton">Activate</button>
							</div>
						</div>
					</div>
				</div>

			</div>
			<!--card-header-->
			<div class="card-body">
				<div class="col-lg-12">
					<form action="{{ route('admin.view-faculty-graduate', $faculty) }}" method="get">
						<input type="text" name="search" id="search" value="{{ $search }}">
						<a href="{{ route('admin.view-faculty-graduate', $faculty) }}" class="btn btn-sm btn-info">Reset</a>
						<button type="submit" class="btn btn-sm btn-info">Search</button>
					</form>
					<br>
					<div class="row row-cols-3">
						<div class="col text-left">
							Showing {{$students->firstItem()}} to {{$students->lastItem()}} of {{$students->total()}} Students
						</div>
						<div class="col">

							Page {{$students->currentPage()}}
						</div>
						<div class="col justify-content-center">
							{{$students->appends(['search' => $search])->links()}}
						</div>
					</div>

				</div>
				<br>
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col">No.</th>
							<th scope="col">Matric Number</th>
							<th scope="col">Name</th>
							<th scope="col">Bachelor</th>
							<th scope="col">QR Code</th>
							<th scope="col">Verified</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($students as $student)
						<tr>
							<th>{{$students->firstItem()+$loop->iteration -1}}</th>
							<th>{{$student->matric_number}}</th>
							<td>{{$student->name}}</td>
							<td>{{$student->department->name}}</td>
							<td>
								@if($student->qr_code_path == NULL)
								@else
								<img src="{{ asset($student->qr_code_path) }}">
								@endif
							</td>

							<td>
								@if($student->is_import == 1)
								<img src="{{ asset("img/backend/correct.png") }}" alt="" height="24px" width="24px">
								@else
								<img src="{{ asset("img/backend/close.png") }}" alt="" height="24px" width="24px">
								@endif

								<!-- <div id="verifyStudent"></div>
								<img id="verifyStudentImg" src="{{ asset("img/backend/close.png") }}" alt=""> -->

							</td>

							<td>
								<a href="{{url('admin/gradute-student/'.$student->id.'/view-cert')}}">
									<button class="btn btn-primary">View</button>
								</a>
							</td>
						</tr>

						@endforeach
					</tbody>
				</table>
				<div class="row row-cols-3">
					<div class="col text-left">
						Showing {{$students->firstItem()}} to {{$students->lastItem()}} of {{$students->total()}} Students
					</div>
					<div class="col">
						Page {{$students->currentPage()}}
					</div>
					<div class="col justify-content-center">
						{{$students->appends(['search' => $search])->links()}}
					</div>
				</div>
			</div>
		</div>
		<!--card-body-->
	</div>
	<!--card-->
</div>
<!--col-->
</div>
<script type="module" src="https://cdn.jsdelivr.net/npm/web3@1.3.0/dist/web3.min.js" defer></script>
<script type="module" src="https://cdn.jsdelivr.net/gh/ethereumjs/browser-builds/dist/ethereumjs-tx/ethereumjs-tx-1.3.3.min.js"></script>
<script type="module" src="https://cdn.jsdelivr.net/npm/ipfs-http-client@44.1.1/dist/index.min.js"></script>
<script type="module" src="https://cdn.jsdelivr.net/npm/ethers@5.0.19/dist/ethers.umd.min.js"></script>
<script type="module" src="https://unpkg.com/react@16/umd/react.production.min.js" crossorigin></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- <script type="module" src="{{ asset('js/ipfs.js') }}" defer></script> -->
<!-- <script type="module" src="{{ asset('js/uniRegistration.js') }}"></script> -->

<script type="module">
	// import 'js/blockchain.js';
	// MnemonicOrPK
	import { setAccount } from "{{ asset('js/blockchain/getPrivateKey.js') }}";
	import { startBlockchain } from "{{ asset('js/blockchain.js') }}";
	
	$(".save-data").click(function() {
		setAccount().then(function(result){

			let PK = result.privateKey;
			PK = PK.replace("0x", "");
			console.log(PK)
			let account = result.address;
			console.log(account)
			startBlockchain(PK, account);
		});
	});



	// loading bar
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
</script>
@endsection