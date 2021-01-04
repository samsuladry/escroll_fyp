<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-SCROLL</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <style>
      /* body
      {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 70%; */
        /* background-color: red;
      } */

      .container
      {
        /* display: block;
        margin-left: auto;
        margin-right: auto;
        width: 70%; */
        /* background-color: blue; */

        margin: auto;
        width: 70%;
        /* border: 3px solid green; */
        padding: 10px;
      }
      .jumbotron.main
      {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 75%;
        /* background-color: yellow; */
      }

      .jumbotron.detail
      {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 100%;
        /* background-color: green; */
      }

      #logoHead
      {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 80%;
      }
    
      #cert
      {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 100%;
        height: 90%;
      }
      /* #info
      {
        //background-color: rgb(0, 255, 234);
      } */
    </style>
</head>
<body>
    <div class="container">
        <div class="jumbotron main">
            <img id="logoHead" src="{{ asset('/img/IIUM.png') }}">
            <div class="card" id="info">
              <h5 class="card-header">e-SCROLL</h5>
              <div class="jumbotron detail">
                  <img id="cert" src="{{ asset('/img/IIUM_cert_template.jfif') }}">
              </div>
              <div  class="card-body">
                  <h5 class="card-title">Student Data</h5>
                  <table class="table table-hover table-bordered">
                      <tbody>
                      <!-- //////////////////////////////////////////////////////////////// -->
                        <thead class="thead-dark">
                          <tr>
                            <th>Address</th>
                            <td id="address"></td> 
                          </tr>
                        </thead>

                        <thead class="thead-light">
                          <tr>
                            <th>University Name</th>
                            <td id="uniName"></td> 
                          </tr>
                        </thead>

                        <thead class="thead-dark">
                          <tr>
                            <th>Matric Number</th>
                            <td id="matNo"></td>
                          </tr>
                        </thead>

                      <!-- ////////////////////////////////////////////////////////////// -->
                        {{-- <thead class="thead-dark">
                          <tr>
                            <th>Transaction Hash</th> 
                            <td>
                              <a href="#">
                                  34c4b712be1875bc1e0d7124fe684fc5e8fb707f
                              </a>
                            </td>
                          </tr>
                        </thead> --}}

                        <thead class="thead-light">
                          <tr>
                            <th>Json Data</th> 
                            <td id="jsonData"></td>
                          </tr>
                        </thead>

                        <thead class="thead-dark">
                          <tr>
                            <th>Status</th> 
                            <td id="status"></td>
                          </tr>
                        </thead>

                        <thead class="thead-light">
                          <tr>
                            <th>TimeStamp</th> 
                            <td id="timestamp"></td>
                          </tr>
                        </thead>

                        <thead class="thead-dark">
                          <tr>
                            <th>Block Number</th> 
                            <td id="blockNo"></td>
                          </tr>
                        </thead>
  
                      </tbody>
                    </table>
              </div>
            </div>
        </div>
    </div>
</body>
<script type="module" src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
<script type="module" src="https://cdn.jsdelivr.net/gh/ethereumjs/browser-builds/dist/ethereumjs-tx/ethereumjs-tx-1.3.3.min.js"></script>
<script src="https://cdn.ethers.io/lib/ethers-5.0.umd.min.js" type="application/javascript"></script>
<!-- {{-- <script type="module" src="/js/unixToDate.js"></script> --}}
{{-- <script type="module" src="{{asset('/js/web3.js')}}"></script> --}} -->
<script type="module" src="{{ asset('js/blockchain.js') }}"></script>
<!-- {{-- <script type="module" src="/js/display.js"></script> --}} -->

<script type="module">
  import { getStudentDetail } from "{{ asset('js/blockchain.js') }}";
  
  let uniAddress = '{{$address}}';
  let matricNumber = '{{$matricNumber}}';

  // console.log(address)
  // console.log( matricNumber)

  async function displayData()
  {
    // let json = document.getElementById('jsonData')
    let pelajar = await getStudentDetail(uniAddress, matricNumber)
    document.getElementById("address").innerHTML = pelajar[0]
    document.getElementById("uniName").innerHTML = pelajar[1]
    document.getElementById("matNo").innerHTML = pelajar[2]
    document.getElementById("jsonData").innerHTML = pelajar[4]
    document.getElementById("status").innerHTML = pelajar[5]
    document.getElementById("timestamp").innerHTML = pelajar[6]
    document.getElementById("blockNo").innerHTML = pelajar[7]

    // console.log(pelajar)
  }
  displayData()
  
  // getUniversity(uniAddress).then(e=> console.log(e))
  // readFromTransactionhash();
  
  
  
</script>

<!-- <script>

  const web3 = new Web3('HTTP://127.0.0.1:8545') 
  let address = {{$address}}
  let matricNumber = {{$matricNumber}}
  displayData(matricNumber, address)
  

  const contractEscroll = new web3.eth.Contract(contractAbi, contractAddress)
  async function getStudent(matricNumber, uniAddress)
  {
    let getStudent =  await contractEscroll.methods.getStudent(matricNumber, uniAddress).call()
    getStudent[6] = unixToDate(getStudent[6])
    return getStudent

  }

  function displayData(matNo, address)
  {
      let result = getStudent(matNo, address)

      console.log(result)
  }
</script> -->
</html>