import unixToDate from './blockchain/unixToDate.js'
import { contractAbi, contractAddress } from './blockchain/contract.js'
import web3 from '/js/blockchain/web3.js'
import { privateKey as PK, walletAddress as account } from './blockchain/getPrivateKey.js'
// import IPFS from './ipfs';


const contract_abi = contractAbi;
const contract_address = contractAddress;

const uni_address = account;


// GET data from database phpmyadmin/mysql
function reqListener() {
	console.log(this.responseText);
}

function startBlockchain() {
	// var oReq = new XMLHttpRequest(); // New request object

	// current change: cant access var student_json without passing the data through function
	// oReq.onload = function () {
	// student data
	// console.log(this.responseText);
	var xhttp = new XMLHttpRequest();
	var student_json = '';

	xhttp.open('get', 'student', true); //admin/student -> admin.php
	xhttp.send();
	xhttp.onload = (student_json) => {
		if (xhttp.status == 200 && xhttp.readyState == 4) {
			// console.log(JSON.parse(xhttp.responseText))
			student_json = JSON.parse(xhttp.responseText);
			init(student_json)
			
		}
	};
	// };

	// // current change: can't access this route through php artisan serve
	// var url = "/e-scroll-lookup/app/Http/Controllers/Backend/Blockchain.php";

	// oReq.open("get", url, true);

	// oReq.send();
}




// change: to new server
// const web3 = new Web3(Web3.givenProvider || 'https://ropsten.infura.io/v3/6abc6ef995814f84950059729182f065');
// const web3 = new Web3(Web3.givenProvider || 'HTTP://127.0.0.1:7545')


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

	
	startBlockchain();
});

// display all student's details in table
// getAllStudentMatricNumberInTheUniversity()
// 	.then(function (result) 
// 	{
// 		// alert(result)
// 		displayStudent(result, uni_address);
// 	});


// change: get no. iteration, get data bachelor, display qrcode, not qrcode's path
async function displayStudent(input_matric, uniAddress) {
	var printresult = "";
	// alert(uniAddress)
	let count = 1
	
	for (var i = 0; i < input_matric.length; i++) 
	{
		// console.log(input_matric[i]);
		getStudentDetail(uniAddress, input_matric[i])
			.then(function (result) 
			{
				// console.log(result)
				result[4] = JSON.parse(result[4])
				// console.log(result[4].matric_number)

				printresult += "<tr><th>" + count + "</th><td>" + result[2] + "</td><td>" + result[4].name + "</td><td>" + result[3] + "</td><td>" + result[4].faculty + "</td><td></tr>";
				document.getElementById("tablestudent").innerHTML = printresult;
				count++
			});

		// result[4] = JSON.parse(result[4])
		// printresult += "<tr><th>" + i + "</th><td>" + result[2] + "</td><td>" + result[4].name + "</td><td>" + result[3] + "</td><td>" + result[4].faculty + "</td><td></tr>";
		// document.getElementById("tablestudent").innerHTML = printresult;
	}
}
// getStudentDetail("1420242", uni_address).then( res =>
// 	{
// 		console.log('Test: ', res)
// 	})


//-------------- MAIN PART----------------
const init = async (student_json) => {


	// insertUniversity("0", "0xc767f4D79FF02cD087219524524B925943DC924b", "IIUM")

	// console.log(student_json[0].matric_number)
	// send(student_json);

	// console.log(getAllStudentMatricNumberInTheUniversity())

	insertRecursive(student_json,0)
	// insertAllStudent(student_json);
	let nostud = await getAllStudentMatricNumberInTheUniversity();
	// console.log(nostud)
	console.log(nostud.length)

	// //Nak check student ada dalam blockchain ke tak
	// let i = 0
	// while(i < student_json.length)
	// {
	// 	var matricNumber = uni_address + "/" + student_json[i].matric_number
	// 	var check = await checkStudentExistance(uni_address, matricNumber)
	// 	// if(check == true)
	// 	// {
	// 	// 	console.log("Check: ", check)

	// 	// }
	// 	console.log("Check: ", check)
	// 	i++

	// }


	// var check = await checkStudentExistance(uni_address, '1527010')
	// console.log("Check: ", check)
	// let pelajar = await getStudentDetail("1420242", uni_address)

	// console.log(pelajar)

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

// async function storeCheck(uniAddress, matricNumber)
// {
// 	let check = new Array()
// 	let getCheck = await checkStudentExistance(uniAddress , matricNumber)
// 	check.push(getCheck)
// }

// current change: activate button on click
async function insertAllStudent(student_json) {

	var batch = 100;
	var a = _.chunk(student_json, batch);

	// console.log(a)

	// console.log(a[0][0])
	console.log(student_json.length)

	var imported_students = new Array();

	for (let i = 0; i < student_json.length; i++) {
		await web3.eth.getTransactionCount(uni_address)
			.then(count => {
				console.log(count)
				var matricNumber =  uni_address + "/" + student_json[i].matric_number;
				insertStudent(count, matricNumber, "hash", JSON.stringify(student_json[i]));
				imported_students.push(student_json[i].matric_number);
				updateStudentDatabase(imported_students)
			});
	}
	

};

function updateStudentDatabase(imported_students) {
	var xhttp = new XMLHttpRequest();
	var formData = new FormData();

	formData.append('imported_students', JSON.stringify(imported_students));
	// console.log(imported_students);
	// console.log(JSON.stringify(imported_students))
	xhttp.open('post', 'student', true);
	xhttp.withCredentials = true;
	xhttp.setRequestHeader('X-CSRF-TOKEN', document.getElementsByTagName('meta')['csrf-token'].getAttribute('content'));
	xhttp.send(formData)
	xhttp.onreadystatechange = function () {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			// insertStudent(count, student_json[i].matric_number, "hash", JSON.stringify(student_json[i]));
			console.log('imported students to db');
		}
	}

}

// verifyStudent(uni_address, "1710714");
function verifyStudent(uniAddress, matricNumber) {
	checkStudentExistance(uniAddress, matricNumber).then(result => {
		console.log(result)
		// $('#verifyStudentImg').src="asset("img/backend/correct.png")";
	});

}

async function checkStudentExistance(uniAddress, matricNumber) {
	const result = await contractEscroll.methods.checkStudentExistance(uniAddress, matricNumber).call({
		from: web3.eth.defaultAccount
	});
	return result;
}

//set default blockchain address
async function setDefaultAccount() {
	// const accounts = await ethereum.send('eth_requestAccounts');
	// web3.eth.defaultAccount = accounts["result"]["0"];

	web3.eth.defaultAccount = account;
};

// get one student's detail
export async function getStudentDetail(uniAddress, matricNumber) 
{
	const result = await contractEscroll.methods.getStudent( uniAddress, matricNumber).call();
	// 6 is the time in the student detail
	// alert('result')
	result[6] = unixToDate(result[6])
	return result;
}

async function checkStudentExistance(uniAddress, matricNumber)
{
	let result = await contractEscroll.methods.checkStudentExistance(uniAddress, matricNumber).call()
	return result
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


async function deleteUniversity(txCount, address) 
{
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

async function insertStudent(txCount, matNo, dataHash, jsonData) 
{
	// console.log("Dalam insert Student: ", txCount)
	var privateKey = new ethereumjs.Buffer.Buffer(PK, 'hex');
	let data = await contractEscroll.methods.insertStudent(matNo, dataHash, jsonData).encodeABI()

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
		.on('error', (e) => {
			// console.log(JSON.parse(e))
			// console.log('error');
			// console.log(e['message']);
			// console.log(e);
			console.log("failed at matric no: " + matNo)

			// sendTx();
		})
		.then(res => {
			// console.log(res.transactionHash)
			console.log("Student with matric number ", matNo, " has been added")
			return res;
		})

}

async function updateStudent(txCount, matNo, dataHash, jsonData) 
{
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
