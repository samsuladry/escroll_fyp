// import mnemonicPhrase from '../uniRegistration.js';
import { contractAbi, contractAddress } from '../blockchain/contract.js'
import web3 from '../blockchain/web3.js'

// const web3 = new Web3(Web3.givenProvider || 'HTTP://127.0.0.1:7545')
// const web3 = new Web3('HTTP://127.0.0.1:8545')
// change: prompt user mnemonic or PK
let mnemonic ="someone hour art similar civil attitude ostrich convince dumb cheap diary foil";
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
