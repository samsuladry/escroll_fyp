@extends('backend.moe.layouts.layout')

@section('content')

<div class="m-2">
    <h1>Dashboard</h1>

    <!-- <div class="m-2 card">
        
        <h5 class="card-header">DashBoard</h5>
        <div class="d-flex p-2 text-white justify-content-around" style="text-align: center;">
            <div class="d-flex p-2 bg-info align-self-start w-50 m-2 justify-content-around" style="background-color:#7395ae; border-radius: 10px;">
                
                <div class="m-1" style="background-color:#7395ae;">
                    Registered University: 
                    <h3>
                        12
                    </h3>
                </div>
                <div class="m-1" style="background-color:#7395ae;">
                    Pending University: 
                    <h3>
                        5
                    </h3>
                </div>
            </div>
            <div class="d-flex p-2 bg-info align-self-start w-50 m-2 justify-content-around" style="background-color:#7395ae; border-radius: 10px;">
                <div class="m-1" style="background-color:#7395ae;">
                    Registered University: 
                    <h3>
                        12
                    </h3>
                </div>
                <div class="m-1" style="background-color:#7395ae;">
                    Pending University: 
                    <h3>
                        5
                    </h3>
                </div>
            </div>          
        </div>
    </div> -->
    
   
    <div class="card mb-3">
        <div class="card-header">
            
                <h4 class="card-title mb-0">Information</h4>
        </div>

        <div class="card-body" style="text-align: center;"> 
            <div class="row">
                <div class="col d-flex flex-column" style="margin-top: auto; margin-bottom: auto;">
                    <div class="p-2 m-2">Registered Universities: 12</div>
                    <div class="p-2 m-2">Pending University: 12</div>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col" id="piechart" style="width: 100%;"></div>
                        <div class="col" id="piechart1" style="width: 100%;"></div>
                    </div>               
                </div>
                
            </div>
        </div>   
        <!-- <div class="card-footer">
            <div class="row text-center">
                
                    <div class="col-sm-12 col-md mb-sm-2 mb-0">
                        <div class="text-muted">UIAM</div><strong>29,703 Students (40%)</strong>
                            <div class="progress mt-2">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md mb-sm-2 mb-0">
                        <div class="text-muted">UM</div><strong>24,093 Students (20%)</strong>
                            <div class="progress mt-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md mb-sm-2 mb-0">
                        <div class="text-muted">UMP</div><strong>78,706 Students (60%)</strong>
                            <div class="progress mt-2">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md mb-sm-2 mb-0">
                        <div class="text-muted">UiTM</div><strong>22,123 Students (80%)</strong>
                            <div class="progress mt-2">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md mb-sm-2 mb-0">
                        <div class="text-muted">Total number of students</div><strong>102,231 Students</strong>
                            <div class="progress mt-2">
                            <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

            </div>
        </div> -->

    </div>    

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">University List</h4>
                </div>
                <div class="card-body">
                    <div class="row " id="uniList">
                    </div>                              
              </div>
            </div>
          </div>
    </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script src="{{asset('js/moe/index.js')}}"></script>

@endsection