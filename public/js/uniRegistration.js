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