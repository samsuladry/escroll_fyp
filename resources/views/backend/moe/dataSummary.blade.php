@extends('backend.moe.layouts.layout')

@section('content')

 <!-- <div class="card ">
        <div class="col align-self-center">
            One of three columns
          </div>
    </div> -->

    <div class="row"></div>

    <div class="card mt-5">
        <div class="card-header">
            <h5 class="card-title">Data Visual 1</h5>
        </div>
        <div class="card-body">
            <canvas id="myChart" width="400" height="400"></canvas>
        
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-header">
            <h5 class="card-title">Data Visual 2</h5>
        </div>
        <div class="card-body">
            <canvas id="myChart2" width="400" height="400"></canvas>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script src="{{asset('js/moe/dataSummary.js')}}"></script>

@endsection