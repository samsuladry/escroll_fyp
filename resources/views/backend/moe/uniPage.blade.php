@extends('backend.moe.layouts.layout')

@section('content')

<div class="row d-flex justify-content-around">

    <div class="m-3 text-center bg-primary card" style="width:60%">
        <img src="https://www.iium.edu.my/img/iium-logo-latest-v2.png" width="100%">
    </div>

    <div class="m-3 text-center card" style="width:30%">
        <div class="card-header">
            <h5>University Contact Info</h5>
        </div>
        <div class="card-body d-flex flex-column justify-content-around">
            <table class="table table-sm table-borderless">
                <tr class="d-flex justify-content-start">
                    <th>Email:</th>
                    <td>iium@edu.my</td>
                </tr>

                <tr class="d-flex justify-content-start">
                    <th>Phone Number:</th>
                    <td> +601203142</td>
                </tr>
            </table>

        </div>
    </div>

</div>  

<div class="row">

    <div class="card" style="width:100%">
        <div class="card-header">
            <h4>Upload History</h4>
        </div>

        <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Date</th>
                <th scope="col">Quantity</th>
                <th scope="col">Size</th>
                <th scope="col">Description</th>
              </tr>
            </thead>
            <tbody id="myTable">
                
            </tbody>
          </table>
    </div>

</div>  


<script src="{{asset('js/moe/uniPage.js')}}"></script>

@endsection