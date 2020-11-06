import loadWeb3 from './blockchain/loadWeb3.js'
import unixToDate from './blockchain/unixToDate.js'
import { contractAbi, contractAddress } from './blockchain/contract.js'
import { privateKey as PK, walletAddress as account } from './blockchain/getPrivateKey.js'
// import IPFS from './ipfs';

const contract_abi = contractAbi;
const contract_address = contractAddress;

const uni_address = account;


// GET data from database phpmyadmin/mysql
function reqListener() {
	console.log(this.responseText);
}

var oReq = new XMLHttpRequest(); // New request object
oReq.onload = function () {
	// student data
	// console.log(this.responseText);
	var student_json = JSON.parse(this.responseText);
	// init(student_json);
};
var url = "/e-scroll-lookup/app/Http/Controllers/Backend/Blockchain.php";
oReq.open("get", url, true);

oReq.send();




// const web3 = new Web3(Web3.givenProvider || 'https://ropsten.infura.io/v3/6abc6ef995814f84950059729182f065');
const web3 = new Web3(Web3.givenProvider || 'HTTP://127.0.0.1:7545')

try {
	setDefaultAccount(); ``
} catch (error) {
	// User denied account access
	console.log("access denied");
}

const contractEscroll = new web3.eth.Contract(
	contract_abi,
	contract_address
);



// insert new student
$('#activateGraduateStudent').click(function (e) {
	e.preventDefault();
	if (web3.eth.defaultAccount === undefined) {
		return error("No accounts found. If you're using MetaMask, " +
			"please unlock it first and reload the page.");
	}
	console.log("Transaction On its Way...");
	send().then(function (result) {
		window.location.href = "../../../admin/blockchainstudent";
	});

});

// display all student's details in table
getAllStudentMatricNumberInTheUniversity().then(function (result) {
	displayStudent(result, uni_address);
});


// change display in table here
async function displayStudent(input_matric, uniAddress) {
	var printresult = "";
	for (var i = 0; i < input_matric.length; i++) {
		getStudentDetail(input_matric[i], uniAddress).then(function (result) {
			printresult += "<tr><th>" + result[3] + "</th><td>" + result[2] + "</td><td>" + result[5] + "</td><td>" + "" + "</td><td>" + "" + "</td><td></tr>";
			document.getElementById("tablestudent").innerHTML = printresult;
		});
	}
}


//-------------- MAIN PART----------------
const init = async () => {
	// insertStudent("1", "Test 11", "hash", "jsondata");
	let pelajar = await getStudentDetail("Test 11", uni_address)

	console.log(pelajar)

}

setDefaultAccount();
init();



//set default blockchain address
async function setDefaultAccount() {
	// const accounts = await ethereum.send('eth_requestAccounts');
	// web3.eth.defaultAccount = accounts["result"]["0"];

	web3.eth.defaultAccount = account;
};

// get one student's detail
async function getStudentDetail(input_matric, uniAddress) {
	const result = await contractEscroll.methods.getStudent(input_matric, uniAddress).call({
		from: web3.eth.defaultAccount
	});
	// 10 is the time in the student detail
	result[6] = unixToDate(result[6])
	return result;
}

async function getAllStudentMatricNumberInTheUniversity() {
	const result = await contractEscroll.methods.getAllStudentMatricNumberInTheUniversity().call({
		from: web3.eth.defaultAccount
	});
	return result;
}

// new*
async function getUniversity(uniAddress) {
	let getUniversity = await contractEscroll.methods.getStudent(uniAddress).call()
	return getUniversity
}

async function insertUniversity(txCount, address, uniName) {
	var privateKey = new ethereumjs.Buffer.Buffer(PK, 'hex');
	let data = contractEscroll.methods.insertUniversity(address, uniName).encodeABI()

	// create transaction object
	const txObject = {
		nonce: web3.utils.toHex(txCount),
		gasLimit: web3.utils.toHex(1000000),
		gasPrice: web3.utils.toHex(web3.utils.toWei('0', 'gwei')), //Letak 0 untuk private network
		to: contractAddress,
		data: data
	}

	//Sign transaction
	const tx = new ethereumjs.Tx(txObject, { chain: 'ropsten', hardfork: 'petersburg' }) // ethereum-common?? untuk private network
	tx.sign(privateKey);

	let serializedTx = tx.serialize();
	const raw = '0x' + serializedTx.toString('hex')

	// //Broadcast the transaction
	web3.eth.sendSignedTransaction(raw)
		.then(res => {
			console.log(res)
			console.log("The university with ", address, " address has been Added")
		})
}

async function deleteUniversity(txCount, address) {
	var privateKey = new ethereumjs.Buffer.Buffer(PK, 'hex');
	let data = contractEscroll.methods.deleteUniversity(address).encodeABI()

	// create transaction object
	const txObject = {
		nonce: web3.utils.toHex(txCount),
		gasLimit: web3.utils.toHex(1000000),
		gasPrice: web3.utils.toHex(web3.utils.toWei('0', 'gwei')), //Letak 0 untuk private network
		to: contractAddress,
		data: data
	}


	//Sign transaction
	const tx = new ethereumjs.Tx(txObject, { chain: 'ropsten', hardfork: 'petersburg' }) // ethereum-common?? untuk private network
	tx.sign(privateKey);

	let serializedTx = tx.serialize();
	const raw = '0x' + serializedTx.toString('hex')




	// //Broadcast the transaction
	web3.eth.sendSignedTransaction(raw)
		.then(res => {
			console.log(res)
			console.log("The university with ", address, " address has been deleted")
		})
}

async function insertStudent(txCount, matNo, dataHash, jsonData) {
	var privateKey = new ethereumjs.Buffer.Buffer(PK, 'hex');
	let data = contractEscroll.methods.insertStudent(matNo, dataHash, jsonData).encodeABI()

	// create transaction object
	const txObject = {
		nonce: web3.utils.toHex(txCount),
		gasLimit: web3.utils.toHex(1000000),
		gasPrice: web3.utils.toHex(web3.utils.toWei('0', 'gwei')), //Letak 0 untuk private network
		to: contractAddress,
		data: data
	}


	//Sign transaction
	const tx = new ethereumjs.Tx(txObject, { chain: 'ropsten', hardfork: 'petersburg' }) // ethereum-common?? untuk private network
	tx.sign(privateKey);

	let serializedTx = tx.serialize();
	const raw = '0x' + serializedTx.toString('hex')




	// //Broadcast the transaction
	web3.eth.sendSignedTransaction(raw)
		.then(res => {
			console.log(res)
			console.log("Student with matric number ", matNo, " has been added")
		})

}

async function updateStudent(txCount, matNo, dataHash, jsonData) {
	var privateKey = new ethereumjs.Buffer.Buffer(PK, 'hex');
	let data = contractEscroll.methods.updateStudent(matNo, dataHash, jsonData).encodeABI()

	// create transaction object
	const txObject = {
		nonce: web3.utils.toHex(txCount),
		gasLimit: web3.utils.toHex(1000000),
		gasPrice: web3.utils.toHex(web3.utils.toWei('0', 'gwei')), //Letak 0 untuk private network
		to: contractAddress,
		data: data
	}


	//Sign transaction
	const tx = new ethereumjs.Tx(txObject, { chain: 'ropsten', hardfork: 'petersburg' }) // ethereum-common?? untuk private network
	tx.sign(privateKey);

	let serializedTx = tx.serialize();
	const raw = '0x' + serializedTx.toString('hex')


	//Broadcast the transaction
	web3.eth.sendSignedTransaction(raw)
		.then(res => {
			console.log(res)
			console.log("Student with matric number", matNo, " data has been updated")
		})

}
