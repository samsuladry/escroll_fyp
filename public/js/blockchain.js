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

// current change: cant access var student_json without passing the data through function
oReq.onload = function () {
	// student data
	// console.log(this.responseText);
	var xhttp = new XMLHttpRequest();
	var student_json = '';
	
	console.log('before send');
	xhttp.open('get', 'student', true); //admin/student -> admin.php
	xhttp.send();
	xhttp.onload = () => {
        if(xhttp.status == 200 && xhttp.readyState == 4){
			console.log('after send');
			this.student_json = JSON.parse(xhttp.responseText);

			console.log(this.student_json[0]);
			init(this.student_json)
        }
    };
};

// current change: can't access this route through php artisan serve
var url = "/e-scroll-lookup/app/Http/Controllers/Backend/Blockchain.php";

oReq.open("get", url, true);

oReq.send();



// change: to new server
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


// change: get no. iteration, get data bachelor, display qrcode, not qrcode's path
async function displayStudent(input_matric, uniAddress) {
	var printresult = "";
	for (var i = 0; i < input_matric.length; i++) {
		getStudentDetail(input_matric[i], uniAddress).then(function (result) {
			// console.log(result)
			result[4] = JSON.parse(result[4])
			// console.log(result[4].matric_number)

			printresult += "<tr><th>" + i + "</th><td>" + result[2] + "</td><td>" + result[4].name + "</td><td>" + result[3] + "</td><td>" + result[4].qr_code_path + "</td><td></tr>";
			document.getElementById("tablestudent").innerHTML = printresult;
		});
	}
}


//-------------- MAIN PART----------------
const init = async (student_json) => {


	// insertUniversity("0", "0xc767f4D79FF02cD087219524524B925943DC924b", "IIUM")

	// console.log(student_json[0].matric_number)
	// send(student_json);

	console.log(getAllStudentMatricNumberInTheUniversity())

	insertAllStudent(student_json);

	let pelajar = await getStudentDetail("1515680", uni_address)

	console.log(pelajar)

}

setDefaultAccount();

function send(student_json) {

	//Insert university
	// insertUniversity(count, '0x5078887dAb3E447891dAF39eE0043632EA3e2F9A', 'Samsul Adry') 

	//Delete University
	//deleteUniversity(count, "0x5078887dAb3E447891dAF39eE0043632EA3e2F9A")

	//To update student details
	// let matricNumber = "Test_10"
	// let dataHash = "Updated data hash"
	// let details = "Name: Muhammad Samsul Adry, Kulliyah: Kulliyah Of Information Technology, Major: Honour Bachelor in Computer Science, Specialized in Software Engineering"
	// updateStudent(count, matricNumber, dataHash, details)


}

// current change: activate button on click
function insertAllStudent(student_json) {
	web3.eth.getTransactionCount(uni_address)
		.then(count => {
			let i = 0

			// insertStudent
			while (i < 1) {
				// var test = JSON.stringify(student_json[0])
				console.log(student_json[i])
				// console.log(test)
				var xhttp = new XMLHttpRequest();
				var formData = new FormData();
				var studentjson = JSON.stringify(student_json[i]);

				formData.append('student_json', studentjson);
				// xhttp.setRequestHeader('_token', xhttp.getResponseHeader('csrf-token'));
				xhttp.open('post', 'student/'+student_json[i].matric_number, true);
				xhttp.withCredentials = true;
				xhttp.setRequestHeader('X-CSRF-TOKEN', document.getElementsByTagName('meta')['csrf-token'].getAttribute('content'));
				xhttp.send(formData);

				xhttp.onreadystatechange = function()
				{
					if(xhttp.readyState == 4 && xhttp.status == 200)
					{
						// insertStudent(count, student_json[i].matric_number, "hash", JSON.stringify(student_json[i]));
						console.log('Insert Student');
					}
				}

				// insertStudent(count, student_json[i].matric_number, "hash", JSON.stringify(student_json[i]));
				// 	insertStudent(count, students[i].matricNumber, students[i].dataHash, students[i].jsonData)
				count++
				i++
			}
		})
}



//set default blockchain address
async function setDefaultAccount() {
	// const accounts = await ethereum.send('eth_requestAccounts');
	// web3.eth.defaultAccount = accounts["result"]["0"];

	web3.eth.defaultAccount = account;
};

// get one student's detail
async function getStudentDetail(matricNumber, uniAddress) {
	const result = await contractEscroll.methods.getStudent(matricNumber, uniAddress).call({
		from: web3.eth.defaultAccount
	});
	// 6 is the time in the student detail
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
			// console.log(res)
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
