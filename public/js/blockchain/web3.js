import { contractAbi, contractAddress} from './contract.js'
import loadWeb3 from './loadWeb3.js'
import unixToDate from './unixToDate.js'
// import web3 from './web3Provider'


// const Web3 = require('web3')
// const web3 = new Web3('https://ropsten.infura.io/v3/6abc6ef995814f84950059729182f065'); //pakai ni tak dapat address maybe sebab dia tak connect dengan metamask kot
const web3 = new Web3('HTTP://127.0.0.1:8545')
// const web3 = new Web3(Web3.givenProvider || 'https://ropsten.infura.io/v3/6abc6ef995814f84950059729182f065'); //dapat address maybe sebab dia connect dengan address yang ada kat metamask

export default web3
// const contractEscroll = new web3.eth.Contract(contractAbi, contractAddress)
// console.log("Contract Simple: ", contractSimple)

// async function getStudent(matricNumber)
// {
    
// 	const accounts = await web3.eth.getAccounts()
// 	// console.log('Account: ', accounts[0])
	
// 	let getStudent =  await contractEscroll.methods.getStudent(matricNumber).call()
// 	getStudent[10] = unixToDate(getStudent[10])
// 	return getStudent

// }

// async function getAllStudentMatricNumber()
// {
// 	const accounts = await web3.eth.getAccounts()
// 	let getAllStudentMatricNumber = await contractEscroll.methods.getAllStudentMatricNumberInTheUniversity().call({ from: accounts[0] })
// 	return getAllStudentMatricNumber
// }

// // async function getStudentIPFSScroll(matNo)
// // {
// // 	let getStudentIPFSScroll = await contractEscroll.methods.getStudentIPFSScroll(matNo).call()
// // 	return getStudentIPFSScroll
// // }

// async function insertUniversity(address, uniName)
// {
// 	loadWeb3()
// 	const accounts = await web3.eth.getAccounts()
// 	let insertUniversity = await contractEscroll.methods.insertUniversity(address, uniName).send({ from: accounts[0] })
// 		.then((res, err) =>
// 		{
// 			let receipt = res.transactionHash
// 			console.log("University registration succeed")
// 			console.log("Receipt: ", receipt)
// 		})
// }

// async function deleteUniversity(address)
// {
// 	loadWeb3()
// 	const accounts = await web3.eth.getAccounts()
// 	let insertUniversity = await contractEscroll.methods.deleteUniversity(address, uniName).send({ from: accounts[0] })
// 		.then((res, err) =>
// 		{
// 			let receipt = res.transactionHash
// 			console.log("University with ", address, " has been deleted")
// 			console.log("Receipt: ", receipt)
// 		})
// }


// async function insertStudent(name, matNo, nation, faculty, course, ic, gender)
// {
// 	loadWeb3()
// 	const accounts = await web3.eth.getAccounts()
// 	// console.log('Account: ', accounts[0])
// 	let insertStudent = await contractEscroll.methods.insertStudent(name, matNo, nation, faculty, course, ic, gender).send({ from: accounts[0] })
// 		.then( (res, err) =>
// 		{
// 			let receipt = res.transactionHash
// 			console.log("Student registration succeed")
// 			console.log(receipt)
// 		})

// }

// async function updateStudent(name, matNo, nation, faculty, course, ic, gender)
// {
// 	loadWeb3()
// 	const accounts = await web3.eth.getAccounts()
// 	// console.log('Account: ', accounts[0])
// 	updateStudent = await contractEscroll.methods.updateStudent(name, matNo, nation, faculty, course, ic, gender).send({ from: accounts[0] })
// 		.then( (res, err) =>
// 		{
// 			let receipt = res.transactionHash
// 				console.log("Student is successfully updated")
// 				console.log(receipt)
// 			console.log(err)
// 		})

// }

// async function deleteStudent(matNo)
// {
// 	loadWeb3()
// 	const accounts = await web3.eth.getAccounts()
// 	// console.log('Account: ', accounts[0])
// 	deleteStudent = await contractEscroll.methods.deleteStudent(matNo).send({ from: accounts[0] })
// 		.then( (res, err) =>
// 		{
// 			let receipt = res.transactionHash
// 				console.log("Student has been deleted")
// 				console.log(receipt)
// 			console.log(err)
// 		})

// }




// async function main()
// {
// 	// loadWeb3()

// 	//Insert university
// 	// insertUniversity('0x13126f93B9718f2272627A76A941B58076d6AA57', 'Maisarah') // Maisarah

// 	//Insert student
// 	// insertStudent("Percubaan 1", "G123456", "Malaysia", "Kulliyah of Engineering", "Mechanical Engineering", "789456" , "Male")

// 	//Delete student
// 	//Kalau dah delete, tak boleh add matric number yang sama
// 	// deleteStudent("123456")

// 	//Update student
// 	// updateStudent("Percubaan 1", "123456", "Malaysia", "Kulliyah of Engineering", "Mechanical Engineering", "789456" , "Male")

// 	//To find a student using matric number
// 	// let pelajar = await getStudent("G123456")
// 	// let pelajar = await getStudent("456123")
// 	// let student = new Student(pelajar[0], pelajar[1], pelajar[2], pelajar[3], pelajar[4], pelajar[5], pelajar[6], pelajar[7], pelajar[8], pelajar[9], pelajar[10], pelajar[11])
// 	// document.getElementById("demo").innerHTML = student.name
// 	// console.log(student)

// 	// To search for all students matric number
// 	let semua = await getAllStudentMatricNumber()
// 	console.log("Semua: ", semua)
// 	console.log("Total number of student: ", semua.length)

// 	//Get scroll IPFS Hash
// 	// let scroll = await getStudentIPFSScroll("T0010")
// 	// console.log("Student IPFS Hash: ", scroll)

	
	
// }

// main()

// let students = [
// 	{name: "Percubaan 74", matNo: "T0001", nation: "Kemboja", faculty: "Kulliyah Of Engineering", course: "Mechanical", ic: "-", gender: "Male"},
// 	{name: "Percubaan 75", matNo: "T0002", nation: "Malaysia", faculty: "Kulliyah Of Engineering", course: "Mechanical", ic: "56478", gender: "Male"},
// 	{name: "Percubaan 76", matNo: "T0003", nation: "Malaysia", faculty: "Kulliyah Of Engineering", course: "Mechanical", ic: "56478", gender: "Male"},
// 	{name: "Percubaan 77", matNo: "T0004", nation: "Indonesia", faculty: "Kulliyah Of Engineering", course: "Mechanical", ic: "-", gender: "Male"},
// 	{name: "Percubaan 78", matNo: "T0005", nation: "Malaysia", faculty: "Kulliyah Of Engineering", course: "Mechanical", ic: "56478", gender: "Male"},
// 	{name: "Percubaan 79", matNo: "T0006", nation: "Malaysia", faculty: "Kulliyah Of Engineering", course: "Mechanical", ic: "56478", gender: "Male"},
// 	{name: "Percubaan 80", matNo: "T0007", nation: "Malaysia", faculty: "Kulliyah Of Engineering", course: "Mechanical", ic: "56478", gender: "Male"},
// 	{name: "Percubaan 81", matNo: "T0008", nation: "Malaysia", faculty: "Kulliyah Of Engineering", course: "Mechanical", ic: "56478", gender: "Male"},
// 	{name: "Percubaan 82", matNo: "T0009", nation: "Malaysia", faculty: "Kulliyah Of Engineering", course: "Mechanical", ic: "56478", gender: "Male"},
// 	{name: "Percubaan 83", matNo: "T0010", nation: "Malaysia", faculty: "Kulliyah Of Engineering", course: "Mechanical", ic: "56478", gender: "Male"},

// ];

// let scroll = ["Hash 1", "Hash 2", "Hash 3","Hash 4","Hash 5","Hash 6","Hash 7","Hash 8","Hash 9","Hash 10",]

// function send()
// {
// 	web3.eth.getTransactionCount('0x5078887dAb3E447891dAF39eE0043632EA3e2F9A')
// 	.then(count =>
// 		{	
// 			let i = 0
			
// 			while( i < students.length)
// 			{
// 				console.log("Atas ", count)
// 				insertStudentAll(count, students[i].name, students[i].matNo, students[i].nation, students[i].faculty, students[i].course, students[i].ic, students[i].gender)
// 				count++
// 				console.log("Tengah ", count)
// 				insertScroll(count, students[i].matNo, scroll[i])	
// 				i++
// 				count++
// 				console.log("Bawah ", count)
// 			}
			
// 		})
// }
// // send()


// //kena buat baru untuk masukkan auto
// function insertScroll(txCount, matNo, ipfsHash)
// {
// 	loadWeb3()
// 	// const accounts = await web3.eth.getAccounts()
// 	// console.log('Account: ', accounts[0])
// 	let account = '0x5078887dAb3E447891dAF39eE0043632EA3e2F9A'
// 	var privateKey = new ethereumjs.Buffer.Buffer('22dc297e2b72d1f91d9fa3b1c60e5f676f7534726d2c4e48658487564c7f2b63', 'hex');
	
// 	let data =  contractEscroll.methods.insertScroll(matNo, ipfsHash).encodeABI()

// 	// create transaction object
// 	const txObject = {
// 		nonce: web3.utils.toHex(txCount),
// 		gasLimit: web3.utils.toHex(800000),
// 		gasPrice: web3.utils.toHex(web3.utils.toWei('30', 'gwei')),
// 		to: contractAddress,
// 		data: data
// 	}
	
	
// 	//Sign transaction
// 	const tx = new ethereumjs.Tx(txObject, {chain:'ropsten', hardfork: 'petersburg'})
// 	tx.sign(privateKey);
	
// 	let serializedTx = tx.serialize();
// 	const raw = '0x' + serializedTx.toString('hex')
	



// 	// //Broadcast the transaction
// 	web3.eth.sendSignedTransaction(raw, (err, txHash) =>
// 	{
// 		if (!err)
// 		{
// 			console.log('txHash: ', txHash)
// 			console.log("MatNo in IPFS: ", matNo)
// 		}
// 		else
// 		{
// 			console.log(err);
// 		}	
// 	})

	
// }



// function insertStudentAll(txCount, name, matNo, nation, faculty, course, ic, gender)
// {
// 	// loadWeb3()
// 	// let accounts = await web3.eth.getAccounts()
// 	// let account = accounts[0]
// 	let account = '0x5078887dAb3E447891dAF39eE0043632EA3e2F9A'
// 	var privateKey = new ethereumjs.Buffer.Buffer('22dc297e2b72d1f91d9fa3b1c60e5f676f7534726d2c4e48658487564c7f2b63', 'hex');
	
// 	// let data = contractEscroll.methods.insertStudent(name, matNo, nation, faculty, course, ic, gender).encodeABI()
	
// 	let data = contractEscroll.methods.insertStudent(name, matNo, nation, faculty, course, ic, gender).encodeABI()
		
// 	// create transaction object
// 	const txObject = {
// 		nonce: web3.utils.toHex(txCount),
// 		gasLimit: web3.utils.toHex(800000),
// 		gasPrice: web3.utils.toHex(web3.utils.toWei('30', 'gwei')),
// 		to: contractAddress,
// 		data: data
// 	}
	
	
// 	//Sign transaction
// 	const tx = new ethereumjs.Tx(txObject, {chain:'ropsten', hardfork: 'petersburg'})
// 	tx.sign(privateKey);
	
// 	let serializedTx = tx.serialize();
// 	const raw = '0x' + serializedTx.toString('hex')
	



// 	// //Broadcast the transaction
// 	web3.eth.sendSignedTransaction(raw, (err, txHash) =>
// 	{
// 		if (!err)
// 		{
// 			console.log('txHash: ', txHash)
// 			console.log(name)
// 		}
// 		else
// 		{
// 			console.log(err);
// 		}	
// 	})
	
	
// }


// // insertStudentAll("Percubaan 12", "123462", "Indonesia", "KICT", "BCS", "-", "Female")

// // students.forEach((student, index) =>
// // {
// // 	// setTimeout(insertStudentAll(student.name, student.matNo, student.nation, student.faculty, student.course, student.ic, student.gender), 1000)
// // 	// setInterval(function send()
// // 	// {
// // 	// 	// console.log(student.name, student.matNo, student.nation, student.faculty, student.course, student.ic, student.gender)
// // 	// 	insertStudentAll(student.name, student.matNo, student.nation, student.faculty, student.course, student.ic, student.gender)
// // 	// }, 1000);
// // 	// send()
// // })

// // students.forEach((student, index))
// // 	.then((student, index) =>
// // 	{
// // 		console.log("test")
// // 		// insertStudentAll(student.name, student.matNo, student.nation, student.faculty, student.course, student.ic, student.gender)
// // 	})
