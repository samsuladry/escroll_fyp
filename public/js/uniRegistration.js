// import unixToDate from '/js/blockchain/unixToDate.js'
import { contractAbi, contractAddress } from "./blockchain/contract.js";
import web3 from "./blockchain/web3.js";

const contractEscroll = new web3.eth.Contract(contractAbi, contractAddress);

let mnemonic = "";
let PK = "";
let account;

async function setAccount () {
    mnemonic = "";
    PK = "";

    let MnemonicOrPK = $("#MnemonicOrPK").val();
    if (MnemonicOrPK == "mnemonicPhrases") {
        mnemonic = $("input[name=mnemonicPhrases]").val();
        let mnemonicWallet = ethers.Wallet.fromMnemonic(mnemonic);
        PK = mnemonicWallet.privateKey;
		account = mnemonicWallet.address;
		
    } else if (MnemonicOrPK == "privateKeyPhrases") {
        PK = $("input[name=mnemonicPhrases]").val();
        let privateKeyWallet = new ethers.Wallet(PK);
        account = privateKeyWallet.address;
	}
	console.log(account)
};

// TODO: SAMSUL: panggil dengan insertUniversity ni tak boleh sekalikan jeke?
function panggil(PK) {
    // extract private key and wallet address from mnemonic or private key
    // alert(PK)
    web3.eth
        .getTransactionCount(account)
        .then((count) => {
            // alert(PK)

            var uniName = $("input[name=uniNameInput]").val();
            var uniAddress = $("input[name=uniAddressInput]").val();
            // alert(uniAddress)
            insertUniversity(count, uniAddress, uniName, PK); //PK ni dia tak baca globally
        })
        .catch(function (e) {
            console.log(e);
        });
    // alert("dalam " + account)
}

async function insertUniversity(txCount, address, uniName, pk) {
    // alert(txCount)
    // alert(uniName)
    let _privateKey = pk.replace("0x", "");
    // alert(_privateKey)
    // let walletAddress = account;
    var privateKey = new ethereumjs.Buffer.Buffer(_privateKey, "hex");
    let data = contractEscroll.methods
        .insertUniversity(address, uniName)
        .encodeABI();

    // create transaction object
    const txObject = {
        nonce: web3.utils.toHex(txCount),
        gasLimit: web3.utils.toHex(1000000),
        gasPrice: web3.utils.toHex(web3.utils.toWei("0", "gwei")), //Letak 0 untuk private network
        to: contractAddress,
        data: data,
    };

    //Sign transaction
    const tx = new ethereumjs.Tx(txObject, {
        chain: "ropsten",
        hardfork: "petersburg",
    }); // ethereum-common?? untuk private network
    tx.sign(privateKey);

    let serializedTx = tx.serialize();
    const raw = "0x" + serializedTx.toString("hex");

    // //Broadcast the transaction
    web3.eth.sendSignedTransaction(raw).then((res) => {
        console.log("Test");
        console.log(res);
        console.log("The university with ", address, " address has been Added");
    });
}
