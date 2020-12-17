@extends('backend.moe.layouts.layout')

@section('content')

<h1>Registration</h1>
<form method="" action="">
    @csrf

<div class="container">
    <div class="row">
        <div class="registration col" style="width: 50%;">
            <div class="card text-white bg-dark mb-3" style="width: 100%;">
                <div class="card-body" style="width: 100%;">
                    {{-- <form method="" action="">
                        @csrf --}}
                        <div class="form-group">
                          <label for="exampleInputEmail1">University Name</label>
                          <input type="text" class="form-control" id="uniNameInput" Name="uniNameInput" placeholder="University Name">
                          
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Blockchain Address</label>
                          <input type="text" class="form-control" id="uniAddressInput" Name="uniAddressInput" placeholder="University Blockchain Address">
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
            <label for="exampleInputEmail1">Mnemonic phrases</label>
            <input type="text" class="form-control" id="uniNameInput" Name="mnemonicPhrases" placeholder="Mnemonic Phrases">
            
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="submitButton">Submit</button>
        </div>
      </div>
    </div>
  </div>

</form>
<script>
    let submitbutton = document.getElementById('submitButton')

    function click()
    {
        console.log(uniNameInput)
    }
    
</script>
    


@endsection