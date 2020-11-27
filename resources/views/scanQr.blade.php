<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/scanQr.css') }}">
    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container">
        <nav class="navbar navbar-dark bg-dark">
            <span class="navbar-brand mb-0 h1">Authenticate your Scroll</span>
        </nav>


        <div class="scanner mx-auto" >
            <div class="popup" id="popup-1">
				<form id="target" method="get" action="{{ route('display') }}"><p id="content"></p></form>
                <div class="overlay"></div>
                <div class="content">
					<div class="close-btn" id="popUp1">&times;</div>
					@csrf
                    <h1>Please Scan Your QR Code</h1>
                    <video class="text-center" id="preview" ></video>
                </div>
            </div>
            <button id="popUp">Scan Qr Code</button>
        </div>


    </div>
  </body>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script type="module" src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
	<script type="module" src="https://cdn.jsdelivr.net/gh/ethereumjs/browser-builds/dist/ethereumjs-tx/ethereumjs-tx-1.3.3.min.js"></script>
	<script src="https://cdn.ethers.io/lib/ethers-5.0.umd.min.js" type="application/javascript"></script>
	<script type="module" src="{{ asset('js/blockchain/unixTodate.js') }}"></script>
	<script type="module" src="{{ asset('js/blockchain.js') }}"></script>
    
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js" ></script>
	

	
	
	
	
	<script>
		// let popUp = document.getElementById("popUp")
		// let popUp2 = document.getElementById("popUp1")

		popUp.addEventListener("click", togglePopup, true)
		popUp1.addEventListener("click", toggleClose)
		let scanner = new Instascan.Scanner(
			{
				video: document.getElementById('preview')
			}
		);


		async function result(content)
		{
			
			let realContent = content.split(",")
			let address = realContent[0]
			let matricNumber = realContent[1]
			// var _token = $("input[name='_token']").val();
			
			$("#content").append('<input type="hidden" name="matricNumber" value="'+matricNumber+'">')
			$("#content").append('<input type="hidden" name="address" value="'+address+'">')
			$("#target").submit()

			
			toggleClose()

		}

		scanner.addListener('scan', result);
		function togglePopup(){
			document.getElementById("popup-1").classList.toggle("active", true)
			Instascan.Camera.getCameras().then(cameras => 
				{
					if(cameras.length > 0){
						scanner.start(cameras[0]);
					} else {
						console.error("There is no camera");
					}
				});	
		}

		function toggleClose()
		{
			document.getElementById("popup-1").classList.toggle("active", false)
			scanner.stop()
		}
	</script>

</html>