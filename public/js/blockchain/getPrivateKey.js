// import mnemonicPhrase from '../uniRegistration.js';
import { contractAbi, contractAddress } from '../blockchain/contract.js'
import web3 from '../blockchain/web3.js'

// const web3 = new Web3(Web3.givenProvider || 'HTTP://127.0.0.1:7545')
// const web3 = new Web3('HTTP://127.0.0.1:8545')
// change: prompt user mnemonic or PK
// let mnemonic ="someone hour art similar civil attitude ostrich convince dumb cheap diary foil";
// let mnemonic = 'lucky talent engine flavor essay update autumn worth tornado net wrong vacuum';
let mnemonic = 'lucky talent engine flavor essay update autumn worth tornado net wrong vacuum';
let PK = "";
let account;

// $(".save-data").click(
//     function(event)
//     {
// 		mnemonic = $("input[name=mnemonicPhrases]").val();

// 		panggil()
// 	});
panggil();
function panggil() {
    // alert("dalam " + mnemonics)

    // extract private key and wallet address from mnemonic or private key
    if (mnemonic != null) {
        let mnemonicWallet = ethers.Wallet.fromMnemonic(mnemonic);
        PK = mnemonicWallet.privateKey;
        account = mnemonicWallet.address;
    } else if (PK != null) {
        let privateKeyWallet = new ethers.Wallet(PK);
        account = privateKeyWallet.address;
    }
}


//TO DO: prompt user mnemonic OR private key of blockchain account
export let privateKey = PK.replace("0x", "");
export let walletAddress = account;
// export let privateKey = '25d1f5c3cf2197f186db0279ddc7f4e999a816f01e85e28bfd5e8e5f424d53ec';
// export let walletAddress = '0x7696cec5A99dFf0b2467C4B07a3d793B0EcfEa65';
