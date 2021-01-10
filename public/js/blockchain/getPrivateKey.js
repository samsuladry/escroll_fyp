// import mnemonicPhrase from '../uniRegistration.js';
import { contractAbi, contractAddress } from '../blockchain/contract.js'
import web3 from '../blockchain/web3.js'

let mnemonic = "";
let PK = "";
let account;

export async function setAccount () {
    mnemonic = "";
    PK = "";

    let MnemonicOrPK = $("#MnemonicOrPK").val();
    if (MnemonicOrPK == "mnemonicPhrases") {
        mnemonic = $("input[name=mnemonicPhrases]").val();
        let mnemonicWallet = ethers.Wallet.fromMnemonic(mnemonic);
        PK = mnemonicWallet.privateKey;
        // account = mnemonicWallet.address;
		
    } else if (MnemonicOrPK == "privateKeyPhrases") {
        PK = $("input[name=mnemonicPhrases]").val();
        PK = "0x" + PK;
    }
    let privateKeyWallet = new ethers.Wallet(PK);
    account = privateKeyWallet.address;
    return privateKeyWallet;
};


//TO DO: prompt user mnemonic OR private key of blockchain account
export let privateKey = PK.replace("0x", "");
export let walletAddress = account;
