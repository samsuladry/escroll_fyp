@extends('backend.moe.layouts.layout')

@section('content')


<form id="ajaxform">
    @csrf

<div class="container">
  <h1>Registration</h1>
    <div class="row">
        <div class="registration col" style="width: 50%;">
            <div class="card text-white bg-dark mb-3" style="width: 100%;">
                <div class="card-body" style="width: 100%;">
                    {{-- <form method="" action="">
                        @csrf --}}
                        <div class="form-group">
                          <label for="uniName">University Name</label>
                          <input type="text" class="form-control" id="uniNameInput" Name="uniNameInput" placeholder="University Name">
                          
                        </div>
                        <div class="form-group">
                          <label for="uniBlockchainAddress">Blockchain Address</label>
                          <input type="text" class="form-control" id="uniAddressInput" Name="uniAddressInput" placeholder="University Blockchain Address">
                        </div>

                        <div class="form-group">
                          <label for="uniAcronym">University Acronym</label>
                          <input type="text" class="form-control" id="uniAcronym" Name="uniAcronym" placeholder="University Acronym">
                        </div>
                        
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Submit
                        </button>
                      {{-- </form> --}}
                </div>
            </div>
        </div>
        
        <div class="faq col" style="width: 50%;">
            <div class="card text-white bg-dark mb-3" style="width: 100%;">
                <div class="card-body" style="width: 100%;">
                  <h4 class="card-title">FAQ</h4>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p><p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
    </div>

</div>

  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="mnemonicPhrase">Mnemonic phrases</label>
            <input type="text" class="form-control" id="uniNameInput" Name="mnemonicPhrases" placeholder="Mnemonic Phrases">
            
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary save-data" id="submitButton">Submit</button>
        </div>
      </div>
    </div>
  </div>

</form>

<script type="module" src="https://cdn.jsdelivr.net/npm/web3@1.3.0/dist/web3.min.js" defer></script>
<script type="module" src="https://cdn.jsdelivr.net/gh/ethereumjs/browser-builds/dist/ethereumjs-tx/ethereumjs-tx-1.3.3.min.js"></script>
<script type="module" src="https://cdn.jsdelivr.net/npm/ethers@5.0.19/dist/ethers.umd.min.js"></script>
{{-- <script type="module" src="{{ asset('js/uniRegistration.js') }}"></script> --}}
{{-- <script type="module" src="{{ asset('js/blockchain/getPrivateKey.js') }}"></script> --}}

<script type="module">
  import unixToDate from '/js/blockchain/unixToDate.js'
  // import web3 from '/js/blockchain/web3.js'

  $(".save-data").click(function(event)
  {
      event.preventDefault();

      // alert($(this).text());

      var uniName = $("input[name=uniNameInput]").val();
      var uniAddress = $("input[name=uniAddressInput]").val();
      var uniAcronym = $("input[name=uniAcronym]").val();
      // var mnemonicPhrase = $("input[name=mnemonicPhrases]").val();
      // export mnemonicPhrase
      // alert(mnemonicPhrase)
      
      // var message = $("input[name=message]").val();
      var _token   = $('meta[name="csrf-token"]').attr('content');

      $('#exampleModal').modal('hide')
      
      // alert(uniAddress);
      $.ajax({
        url: "{{ route('admin.moe.registration.store')}}",
        type:"POST",
        data:{
          uniName:uniName,
          uniAddress:uniAddress,
          uniAcronym:uniAcronym,
          _token: _token
        },
        success:function(response){
          // console.log(response);
          if(response) {
            alert(response.success)
            $('.success').text(response.success);
            $("#ajaxform")[0].reset();
          }
          else
          {
            alert("Not successful")
            $('.success').text(response.success);
            $("#ajaxform")[0].reset();
          }
        },
        error:function(res)
        {
          if(res)
          {
            alert("Not successful")
            $('.success').text(response.success);
            $("#ajaxform")[0].reset();
          }
        }
       });
  });
</script>
    


@endsection