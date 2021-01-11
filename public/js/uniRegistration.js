// import unixToDate from '/js/blockchain/unixToDate.js'
import { contractAbi, contractAddress } from "./blockchain/contract.js";
import web3 from "./blockchain/web3.js";
import { setAccount, privateKey, walletAddress } from "./blockchain/getPrivateKey.js";
import { insertUniversity } from './blockchain.js';

const contractEscroll = new web3.eth.Contract(contractAbi, contractAddress);



$(".save-data").click(function() {
    setAccount().then(function(result){
        event.preventDefault()

        let PK = result.privateKey;
        PK = PK.replace("0x", "");
        console.log(PK)
        let account = result.address;
        console.log(account)
        
        web3.eth
        .getTransactionCount(walletAddress)
        .then((count) => {
            // alert(PK)

            var uniName = $("input[name=uniNameInput]").val();
            var uniAddress = $("input[name=uniAddressInput]").val();
            // alert(uniAddress)
            insertUniversity(count, uniAddress, uniName, privateKey); //PK ni dia tak baca globally
        })
        .catch(function (e) {
            console.log(e);
        });
    });
});
