@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <i class="far fa-paper-plane"></i> System Flow
                </div>
                <div class="card-body">
                    
<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          #1 - University Account Registration
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
        <div class="row" style="margin-bottom: 2em;">
           Super Administrator will register one account for each university.
        </div>
       

        <img src="{{asset('img/system_flow/1.png')}}" height="500" width="800">
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          #2 - University Base Information Setup
        </button>
      </h2>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
        <div class="row" style="margin-bottom: 2em;">
           University need to setup base information such as rector, faculty, dean, department, bachelor and E-scroll template
        </div>
        

        <img src="{{asset('img/system_flow/2.0.png')}}" height="300" width="500">
        <img src="{{asset('img/system_flow/2.1.png')}}" height="300" width="500">
        <img src="{{asset('img/system_flow/2.2.png')}}" height="300" width="500">

      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h2 class="mb-0">
        <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          #3 - Upload Graduate Student List in CSV Format
        </button>
      </h2>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">

         <div class="row" style="margin-bottom: 2em;">
           University need prepare list of graduate student in CSV format.
      </div>

        <img src="{{asset('img/system_flow/3.0.png')}}" height="500" width="800">
    </div>
  </div>
    <div class="card">
    <div class="card-header" id="headingFour">
      <h2 class="mb-0">
        <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          #4 - Record Checking filtered by Faculty, Department, Bachelor 
        </button>
      </h2>
    </div>
    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
      <div class="card-body">

        <div class="row" style="margin-bottom: 2em;">
           Every record will match data with base information entered at process #2.
      </div>

      <img src="{{asset('img/system_flow/2.1.png')}}" height="500" width="800">
        

      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header" id="headingFive">
      <h2 class="mb-0">
        <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
          #5 - Generate QR Code 
        </button>
      </h2>
    </div>
    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
      <div class="card-body">

        <div class="row" style="margin-bottom: 2em;">
           Generate Qr Code by bulk after checking process is done
      </div>

      <img src="{{asset('img/system_flow/5.png')}}" height="500" width="800">
        
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header" id="headingSix">
      <h2 class="mb-0">
        <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
          #6 - Activate Blockchain 
        </button>
      </h2>
    </div>
    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
      <div class="card-body">
        Save information in Blockchain
      </div>
    </div>
  </div>

    <div class="card">
    <div class="card-header" id="headingSeven">
      <h2 class="mb-0">
        <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
          #7 - Generate to Document with Digital Signature 
        </button>
      </h2>
    </div>
    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
      <div class="card-body">
        University require to upload digital certificate as digital sign along generating process
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header" id="headingEight">
      <h2 class="mb-0">
        <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
          #8 - Bulk Download Document for Printing
        </button>
      </h2>
    </div>
    <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionExample">
      <div class="card-body">
        Document in PDF will be downloaded for paper printing.
      </div>
    </div>
  </div>

    <div class="card">
    <div class="card-header" id="headingNine">
      <h2 class="mb-0">
        <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
          #9 - Qr Code Validation
        </button>
      </h2>
    </div>
    <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
      <div class="card-body">

        <div class="row" style="margin-bottom: 2em;">
           User allow to scan QR code to validate the recognition and able to view information through portal
      </div>

      <img src="{{asset('img/system_flow/9.png')}}" height="500" width="1000">
        
      </div>
    </div>
  </div>



</div>

                </div>
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->

   


  

@endsection
