// import mnemonicPhrase from '../uniRegistration.js';
import { contractAbi, contractAddress } from '../blockchain/contract.js'
import web3 from '/js/blockchain/web3.js'

// const web3 = new Web3(Web3.givenProvider || 'HTTP://127.0.0.1:7545')
// const web3 = new Web3('HTTP://127.0.0.1:8545')
// change: prompt user mnemonic or PK
let mnemonic = 'lucky talent engine flavor essay update autumn worth tornado net wrong vacuum';
let PK = "";
let account;


if (mnemonic != null) 
	{
		let mnemonicWallet = ethers.Wallet.fromMnemonic(mnemonic);
		PK = mnemonicWallet.privateKey
		account = mnemonicWallet.address
	}
else if (PK != null) 
	{
		let privateKeyWallet = new ethers.Wallet(PK);
		account = privateKeyWallet.address
	}

// const contractEscroll = new web3.eth.Contract(
// 	contractAbi,
// 	contractAddress
// );

// $(".save-data").click(
//     async function(event)
//     {
// 		// event.preventDefault()
// 		// mnemonic = $("input[name=mnemonicPhrases]").val();
// 		mnemonic = 'skin slush pond flight inner illegal visa worry alone dry flag describe'
// 		// mnemonic = ''
// 		// let pk = '306b8aa737c2a36cf0d312b4315926e2abb3a79c1b5cd4ea04e4593df62812a2'
// 		let pk
// 		// alert("sini")
		
// 		// web3.eth.getTransactionCount("0x1d94536baFFcc6DCCcAb71dE0545D5AaE57F572a")
// 		// 	.then(res =>
// 		// 		{
// 		// 			alert(res)
// 		// 		})
// 		panggil(mnemonic, pk)
// 		// alert(mnemonic)
// 	});
	
// function panggil(mnemonic, PK)
// {
// 	// extract private key and wallet address from mnemonic or private key
// 	if (mnemonic != null) 
// 	{
// 		let mnemonicWallet = ethers.Wallet.fromMnemonic(mnemonic);
// 		PK = mnemonicWallet.privateKey
// 		account = mnemonicWallet.address

// 		// alert(PK)
// 		web3.eth.getTransactionCount(account)
// 			.then(count => {
// 				// alert(PK)

// 				var uniName = $("input[name=uniNameInput]").val();
// 				var uniAddress = $("input[name=uniAddressInput]").val();
// 				// alert(uniAddress)
// 				insertUniversity(count, uniAddress, uniName, PK) //PK ni dia tak baca globally


// 			}).catch(function (e) 
// 			{
// 				console.log(e)
// 			});
// 		// alert("dalam " + account)
// 	}
// 	else if (PK != null) {
// 		let privateKeyWallet = new ethers.Wallet(PK);
// 		account = privateKeyWallet.address
// 	}

// }

// async function insertUniversity(txCount, address, uniName, pk) {

// 	// alert(txCount)
// 	let _privateKey = pk.replace("0x", "");
// 	alert(_privateKey)
// 	// let walletAddress = account;
// 	var privateKey = new ethereumjs.Buffer.Buffer(_privateKey, 'hex');
// 	let data = contractEscroll.methods.insertUniversity(address, uniName).encodeABI()

// 	// create transaction object
// 	const txObject = {
// 		nonce: web3.utils.toHex(txCount),
// 		gasLimit: web3.utils.toHex(1000000),
// 		gasPrice: web3.utils.toHex(web3.utils.toWei('0', 'gwei')), //Letak 0 untuk private network
// 		to: contractAddress,
// 		data: data
// 	}

// 	//Sign transaction
// 	const tx = new ethereumjs.Tx(txObject, { chain: 'ropsten', hardfork: 'petersburg' }) // ethereum-common?? untuk private network
// 	tx.sign(privateKey);

// 	let serializedTx = tx.serialize();
// 	const raw = '0x' + serializedTx.toString('hex')

// 	// //Broadcast the transaction
// 	web3.eth.sendSignedTransaction(raw)
// 		.then(res => {
// 			console.log(res)
// 			console.log("The university with ", address, " address has been Added")
// 		})
// }

// // let mnemonic = "used young please bridge alley cluster legal excuse cigar below panda siege";

// // ask private key from user

// // let PK = "0x7cc1f2fa4ed33cbd2b193bf48aaac1aaf03df8f660dd47e4e38ee4cf439e0710"

// // change: function on click push data to blockchain.
// // let key;
// // while (key == null) {
// // 	key = prompt("Enter your Blockchain Account's Mnemonics (12 words) or Private Key (start with 0x) here:");
// // }



// // if (key.startsWith("0x")) {// user input Privatekey
// // 	let privateKeyWallet = new ethers.Wallet(PK);
// // 	account = privateKeyWallet.address
// // 	console.log("private key was entered")
// // }
// // else if (key != null) { // user input mnemonic
// // 	let privateKeyWallet = new ethers.Wallet(PK);
// // 	account = privateKeyWallet.address
// // }


// //TO DO: prompt user mnemonic OR private key of blockchain account



export let privateKey = PK.replace("0x", "");
export let walletAddress = account;