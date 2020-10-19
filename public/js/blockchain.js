// GET smart contract's ABI
// var abi_json = (function() {
// 	var json = null;
// 	$.ajax({
// 	  'async': false,
// 	  'global': false,
// 	  'url': "/e-scroll-lookup/build/contracts/Escroll.json",
// 	  'dataType': "json",
// 	  'success': function(data) {
// 		json = data;
// 	  }
// 	});
// 	return json;
//   })();
// const contract_abi = (abi_json["abi"]);

import loadWeb3 from './blockchain/loadWeb3.js'
import unixToDate from './blockchain/unixToDate.js'
import { contractAbi, contractAddress } from './blockchain/contract.js'
// import IPFS from './ipfs';

const contract_abi = contractAbi;

const contract_address = "0x2D3638FF4B88a33C0e9849725125a4E5c816CA69";



// GET data from database
function reqListener() {
	console.log(this.responseText);
}

var oReq = new XMLHttpRequest(); // New request object
oReq.onload = function () {
	// student data
	// console.log(this.responseText);
	var student_json = JSON.parse(this.responseText);
	init(student_json);
};
var url = "/e-scroll-lookup/app/Http/Controllers/Backend/Blockchain.php";
oReq.open("get", url, true);

oReq.send();





//-------------- MAIN PART----------------
// POST to blockchain
const init = async (student_json) => {
	const web3 = new Web3(Web3.givenProvider || 'https://ropsten.infura.io/v3/6abc6ef995814f84950059729182f065');

	try {
		setDefaultAccount();
	} catch (error) {
		// User denied account access
		console.log("access denied");
	}

	const contract = new web3.eth.Contract(
		contract_abi,
		contract_address
	);

	//current blockchain address
	async function setDefaultAccount() {
		const accounts = await ethereum.send('eth_requestAccounts');
		web3.eth.defaultAccount = accounts["result"]["0"];
	};

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


		// insertStudent(student_json[0]["name"], student_json[0]["matric_number"],
		// "nationality",student_json[0]["faculty_id"],student_json[0]["department_id"], "971109", "female");
	});

	// var imageHash = IPFS.imageHash;

	// alert(imageHash)


	// delete one student and get all student
	// $('#activateGraduateStudent').click(function (e) {
	// 	displayAccountInfo();
	// 	e.preventDefault();
	// 	if (web3.eth.defaultAccount === undefined) {
	// 		return error("No accounts found. If you're using MetaMask, " +
	// 		"please unlock it first and reload the page.");
	// 	}
	// 	console.log("Transaction On its Way...");

	// 	// contract.methods.deleteStudent(2).send({
	// 	// 	from: web3.eth.defaultAccount
	// 	// }).on('error', function(error,receipt) {
	// 	// 	console.log(error);
	// 	// 	// console.log(receipt);
	// 	// });

	// 	result();
	// });

	async function getAllStudentMatricNumberInTheUniversity() {
		const result = await contract.methods.getAllStudentMatricNumberInTheUniversity().call({
			from: web3.eth.defaultAccount
		});
		return result;
	}

	$('#searchStudent').click(function (e) {
		getAllStudentMatricNumberInTheUniversity().then(function (result) {
			displayStudent(result);
		});
	});

	// samsul's
	let Escroll = await getStudentIPFSScroll("T0010")
	console.log("Student IPFS Hash: ", Escroll)

	// let students = [
	// 	 "Percubaan 124", matNo: "T0051", nation: "Kemboja", faculty: "Kulliyah Of Engineering", course: "Mechanical", ic: "-", gender: "Male"},
	// {name: "Percubaan 125", matNo: "T0052", nation: "Malaysia", faculty: "Kulliyah Of Engineering", course: "Mechanical", ic: "56578", gender: "Male"},
	// {name: "Percubaan 126", matNo: "T0053", nation: "Malaysia", faculty: "Kulliyah Of Engineering", course: "Mechanical", ic: "56578", gender: "Male"},
	// {name: "Percubaan 127", matNo: "T0054", nation: "Indonesia", faculty: "Kulliyah Of Engineering", course: "Mechanical", ic: "-", gender: "Male"},
	// {name: "Percubaan 128", matNo: "T0055", nation: "Malaysia", faculty: "Kulliyah Of Engineering", course: "Mechanical", ic: "56578", gender: "Male"},
	// {name: "Percubaan 129", matNo: "T0056", nation: "Malaysia", faculty: "Kulliyah Of Engineering", course: "Mechanical", ic: "56578", gender: "Male"},
	// {name: "Percubaan 130", matNo: "T0057", nation: "Malaysia", faculty: "Kulliyah Of Engineering", course: "Mechanical", ic: "56578", gender: "Male"},
	// {name: "Percubaan 131", matNo: "T0058", nation: "Malaysia", faculty: "Kulliyah Of Engineering", course: "Mechanical", ic: "56578", gender: "Male"},
	// {name: "Percubaan 132", matNo: "T0059", nation: "Malaysia", faculty: "Kulliyah Of Engineering", course: "Mechanical", ic: "56478", gender: "Male"},
	// {name: "Percubaan 132", matNo: "T0059", nation: "Malaysia", faculty: "Kulliyah Of Engineering", course: "Mechanical", ic: "56478", gender: "Male"},
	// ];

	let scroll = ["Hash 1", "Hash 2", "Hash 3", "Hash 4", "Hash 5", "Hash 6", "Hash 7", "Hash 8", "Hash 9", "Hash 10",]

	async function send() {
		let len = student_json.length
		const sendAllStudent = await web3.eth.getTransactionCount('0x13126f93B9718f2272627A76A941B58076d6AA57')
			.then(count => {
				let i = 0


				console.log("Students length: ", len)
				while (i < len) {
					console.log("Atas ", count)
					console.log(student_json[i].name)
					insertStudentAll(count, student_json[i].name, student_json[i].matric_number, "malaysia", student_json[i].faculty_id, student_json[i].department_id, "-", "Male")
					count++
					console.log("Tengah ", count)
					insertScroll(count, student_json[i].matric_number, scroll[i])
					i++
					count++
					console.log("Bawah ", count)
				}

			})
	}

	// To search for all students matric number
	let semua = await getAllStudentMatricNumberInTheUniversity()
	console.log("Semua: ", semua)
	console.log("Total number of student: ", semua.length)





	// get student's detail from blockchain by matric number
	// $('#searchStudent').click(function (e) {
	// 	e.preventDefault();
	// 	var input_matric = document.getElementById('contentSearchStudent').value;
	// 	input_matric = input_matric.split(/, */g);

	// 	displayStudent(input_matric);
	// });

	// matric number in [array]
	function displayStudent(input_matric) {
		var printresult = "";
		for (var i = 0; i < input_matric.length; i++) {
			getStudentDetail(input_matric[i]).then(function (result) {
				printresult += "<tr><th>" + result[3] + "</th><td>" + result[2] + "</td><td>" + result[5] + "</td><td>" + "" + "</td><td>" + "" + "</td><td></tr>";
				document.getElementById("tablestudent").innerHTML = printresult;
			});
		}
	}

	// get one student's detail
	async function getStudentDetail(input_matric) {
		const result = await contract.methods.getStudent(input_matric).call({
			from: web3.eth.defaultAccount
		});
		// 10 is the time in the student detail
		result[10] = unixToDate(result[10])
		return result;
	}

	async function getStudentIPFSScroll(matNo) {
		let getStudentIPFSScroll = await contract.methods.getStudentIPFSScroll(matNo).call()
		return getStudentIPFSScroll
	}

	async function insertUniversity(address, uniName) {
		// loadWeb3()
		const accounts = await web3.eth.getAccounts()
		let insertUniversity = await contract.methods.insertUniversity(address, uniName).send({ from: accounts[0] })
			.then((res, err) => {
				let receipt = res.transactionHash
				console.log("University registration succeed")
				console.log("Receipt: ", receipt)
			})
	}

	async function deleteUniversity(address) {
		// loadWeb3()
		const accounts = await web3.eth.getAccounts()
		let insertUniversity = await contract.methods.deleteUniversity(address, uniName).send({ from: accounts[0] })
			.then((res, err) => {
				let receipt = res.transactionHash
				console.log("University with ", address, " has been deleted")
				console.log("Receipt: ", receipt)
			})
	}

	async function insertStudent(name, matNo, nation, faculty, course, ic, gender) {
		contract.methods.insertStudent(name, matNo, nation, faculty, course, ic, gender).send({
			from: web3.eth.defaultAccount
		}).on('error', function (error, receipt) {
			console.log(error);
		});
	}

	async function updateStudent(name, matNo, nation, faculty, course, ic, gender) {
		// loadWeb3()
		const accounts = await web3.eth.getAccounts()
		// console.log('Account: ', accounts[0])
		updateStudent = await contract.methods.updateStudent(name, matNo, nation, faculty, course, ic, gender).send({ from: accounts[0] })
			.then((res, err) => {
				let receipt = res.transactionHash
				console.log("Student is successfully updated")
				console.log(receipt)
				console.log(err)
			})

	}

	async function deleteStudent(matNo) {
		// loadWeb3()
		const accounts = await web3.eth.getAccounts()
		// console.log('Account: ', accounts[0])
		deleteStudent = await contract.methods.deleteStudent(matNo).send({ from: accounts[0] })
			.then((res, err) => {
				let receipt = res.transactionHash
				console.log("Student has been deleted")
				console.log(receipt)
				console.log(err)
			})

	}

	//kena buat baru untuk masukkan auto
	function insertScroll(txCount, matNo, ipfsHash) {
		// loadWeb3()
		// const accounts = await web3.eth.getAccounts()
		// console.log('Account: ', accounts[0])
		let account = '0x5078887dAb3E447891dAF39eE0043632EA3e2F9A'
		var privateKey = new ethereumjs.Buffer.Buffer('f0f91d2ad69d760dd4753d8aad3a108c8b372eab81ee7c549e5c0d494f3fcbd9', 'hex');

		let data = contract.methods.insertScroll(matNo, ipfsHash).encodeABI()

		// create transaction object
		const txObject = {
			nonce: web3.utils.toHex(txCount),
			gasLimit: web3.utils.toHex(800000),
			gasPrice: web3.utils.toHex(web3.utils.toWei('30', 'gwei')),
			to: contract_address,
			data: data
		}


		//Sign transaction
		const tx = new ethereumjs.Tx(txObject, { chain: 'ropsten', hardfork: 'petersburg' })
		tx.sign(privateKey);

		let serializedTx = tx.serialize();
		const raw = '0x' + serializedTx.toString('hex')




		// //Broadcast the transaction
		web3.eth.sendSignedTransaction(raw, (err, txHash) => {
			if (!err) {
				console.log('txHash: ', txHash)
				console.log("MatNo in IPFS: ", matNo)
			}
			else {
				console.log(err);
			}
		})


	}

	function insertStudentAll(txCount, name, matNo, nation, faculty, course, ic, gender) {
		// loadWeb3()
		// let accounts = await web3.eth.getAccounts()
		// let account = accounts[0]

		// edit: set account and private key outside 
		//account tak pakai
		// let account = '0x5078887dAb3E447891dAF39eE0043632EA3e2F9A'
		var privateKey = new ethereumjs.Buffer.Buffer('f0f91d2ad69d760dd4753d8aad3a108c8b372eab81ee7c549e5c0d494f3fcbd9', 'hex');

		// let data = contract.methods.insertStudent(name, matNo, nation, faculty, course, ic, gender).encodeABI()

		let data = contract.methods.insertStudent(name, matNo, nation, faculty, course, ic, gender).encodeABI()

		// create transaction object
		const txObject = {
			nonce: web3.utils.toHex(txCount),
			gasLimit: web3.utils.toHex(800000),
			gasPrice: web3.utils.toHex(web3.utils.toWei('30', 'gwei')),
			to: contract_address,
			data: data
		}

		

		//Sign transaction
		const tx = new ethereumjs.Tx(txObject, { chain: 'ropsten', hardfork: 'petersburg' })
		tx.sign(privateKey);

		let serializedTx = tx.serialize();
		const raw = '0x' + serializedTx.toString('hex')




		// //Broadcast the transaction
		web3.eth.sendSignedTransaction(raw, (err, txHash) => {
			if (!err) {
				console.log('txHash: ', txHash)
				console.log(name)
			}
			else {
				console.log(err);
			}
		})


	}

}





