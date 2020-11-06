
//Boleh minta mnemonic user
let mnemonic;
// let mnemonic = "used young please bridge alley cluster legal excuse cigar below panda siege";

// ask private key from user
let PK = "0x7cc1f2fa4ed33cbd2b193bf48aaac1aaf03df8f660dd47e4e38ee4cf439e0710"

let account;

//TO DO: prompt user mnemonic OR private key of blockchain account

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

export let privateKey = PK.replace("0x", "");
export let walletAddress = account;