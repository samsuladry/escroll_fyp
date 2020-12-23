// import mnemonicPhrase from '../uniRegistration.js';

// change: prompt user mnemonic or PK
let mnemonic
let PK = "";
let account;

$(".save-data").click(
    function(event)
    {
		mnemonic = $("input[name=mnemonicPhrases]").val();
		
		panggil()
	});
	
function panggil()
{
	// alert("dalam " + mnemonics)

	// extract private key and wallet address from mnemonic or private key
	if (mnemonic != null) {
		let mnemonicWallet = ethers.Wallet.fromMnemonic(mnemonic);
		PK = mnemonicWallet.privateKey
		account = mnemonicWallet.address
	}
	else if (PK != null) {
		let privateKeyWallet = new ethers.Wallet(PK);
		account = privateKeyWallet.address
}
}


// let mnemonic = "used young please bridge alley cluster legal excuse cigar below panda siege";

// ask private key from user

// let PK = "0x7cc1f2fa4ed33cbd2b193bf48aaac1aaf03df8f660dd47e4e38ee4cf439e0710"

// change: function on click push data to blockchain.
// let key;
// while (key == null) {
// 	key = prompt("Enter your Blockchain Account's Mnemonics (12 words) or Private Key (start with 0x) here:");
// }



// if (key.startsWith("0x")) {// user input Privatekey
// 	let privateKeyWallet = new ethers.Wallet(PK);
// 	account = privateKeyWallet.address
// 	console.log("private key was entered")
// }
// else if (key != null) { // user input mnemonic
// 	let privateKeyWallet = new ethers.Wallet(PK);
// 	account = privateKeyWallet.address
// }


//TO DO: prompt user mnemonic OR private key of blockchain account



export let privateKey = PK.replace("0x", "");
export let walletAddress = account;