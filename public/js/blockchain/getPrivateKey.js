// import mnemonicPhrase from '../uniRegistration.js';
// import { contractAbi, contractAddress } from '../blockchain/contract.js'
// import web3 from '../blockchain/web3.js'

// change: prompt user mnemonic or PK
// let mnemonic ="someone hour art similar civil attitude ostrich convince dumb cheap diary foil";
// let mnemonic = 'lucky talent engine flavor essay update autumn worth tornado net wrong vacuum';
// var mnemonic = 'lucky talent engine flavor essay update autumn worth tornado net wrong vacuum';
var mnemonic = "";
var PK = "";
var account;
// let mnemonicWallet = ethers.Wallet.fromMnemonic(mnemonic);
// PK = mnemonicWallet.privateKey;
// account = mnemonicWallet.address;

export async function setAccount () {
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
// export let privateKey = PK.replace("0x", "");
// export let walletAddress = account;
