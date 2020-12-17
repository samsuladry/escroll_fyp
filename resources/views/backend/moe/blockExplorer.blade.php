@extends('backend.moe.layouts.layout')

@section('content')

<h1>Block Explorer</h1>

<div class="header">
    <h1>Block Explorer</h1>
</div>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col" class="text-center">Block Number</th>
            <th scope="col" class="text-center">Block Hash</th>
            <th scope="col" class="text-center">Timestamp</th>
            {{-- <th scope="col" class="text-center">Transaction Hash</th> --}}
            
            
        </tr>
    </thead>

    <tbody  class="text-center">

    </tbody>

</table>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
{{-- <script src="https://pagination.js.org/dist/2.1.5/pagination.min.js"></script> --}}

{{-- <script type="module" src={{asset('js/web3.js')}}></script> --}}
{{-- <script type="module" src={{asset('js/blockchain/unixToDate.js')}}></script> --}}
<script type="module">
    // import web3 from '/js/web3.js';
    import unixToDate from '/js/blockchain/unixToDate.js'
    // import web3 from '/js/web3.js'
    const web3 = new Web3('https://ropsten.infura.io/v3/6abc6ef995814f84950059729182f065');

    let txnHash = document.getElementById("txn-input")

    // function sendTxnHash()
    // {
    //     // document.getElementById('target').submit();
    //     // console.log(txnHash)
    //     $("#target").submit()

    // }

    // $('#pagination-container').pagination({
    //     dataSource: [1, 2, 3, 4, 5, 6, 7, ... , 195],
    //     callback: function(data, pagination) {
    //         // template method of yourself
    //         var html = template(data);
    //         $('#data-container').html(html);
    // }
    // })

    // async function listBlock()
    // {
        
    //     let latestBlock = await web3.eth.getBlockNumber()
    //     // console.log("test: ", latestBlock)
    //     for(var i=0; i<10; i++)
    //     {
    //         var block = await web3.eth.getBlock(latestBlock - i)
    //         var blockNumber = block.number;
    //         var blockHash = block.hash;
    //         var t = block.timestamp;
    //         var time = unixToDate(t);
    //         // let x = window.location.href = "";

    //         // var transactionHash = block.transactions
    //         // console.log("Block " + time)
    //         $('tbody').append("<tr><td>" + blockNumber + "</td><td>" + blockHash + "</td><td>" + time + "</td></tr>")
    //     }

    // }
    // listBlock()

    web3.eth.getBlockNumber()
    .then(res =>
    {
        for(var i=0; i<10; i++)
        {
            web3.eth.getBlock(res - i).then(res =>
            {
                var blockNumber = res.number;
                var blockHash = res.hash;
                var t = res.timestamp;
                var time = unixToDate(t);
                // let x = window.location.href = "";

                // var transactionHash = block.transactions
                // console.log("Block " + time)
                $('tbody').append("<tr><td>" + blockNumber + "</td><td>" + blockHash + "</td><td>" + time + "</td></tr>")
            })
            
        }
    })


</script>
@endsection