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
						{{-- <button id="searchStudent" class="btn btn-unique btn-rounded btn-sm my-0 btn-success" type="submit">Search</button> --}}
						<button id="activateGraduateStudent" class="btn btn-unique btn-rounded btn-sm my-0 btn-success" type="submit">Active</button>
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
            


						</tbody>
					</table>


				</div>
				<!--col-->
			</div>
			<!--card-body-->





			@endsection

			<!-- Scripts -->

			<!-- change: put in specific page that use blockchain only -->
			<script type="module" src="https://cdn.jsdelivr.net/npm/web3@1.3.0/dist/web3.min.js" defer></script>
			<script type="module" src="https://cdn.jsdelivr.net/gh/ethereumjs/browser-builds/dist/ethereumjs-tx/ethereumjs-tx-1.3.3.min.js"></script>
			<script type="module" src="https://cdn.jsdelivr.net/npm/ipfs-http-client@44.1.1/dist/index.min.js"></script>
			<script type="module" src="https://cdn.jsdelivr.net/npm/ethers@5.0.19/dist/ethers.umd.min.js"></script>
			<script type="module" src="https://unpkg.com/react@16/umd/react.production.min.js" crossorigin></script>
			<!-- <script type="module" src="https://unpkg.com/ipfs/dist/index.min.js"></script> -->
			<script type="module" src="{{ asset('js/blockchain.js') }}" defer></script>
			<script type="module" src="{{ asset('js/ipfs.js') }}" defer></script>