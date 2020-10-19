// import React, { Component } from 'react';
// import './App.css';

//  const ipfsClient = require('ipfs-http-client')
// const ipfs = ipfsClient('http://localhost:5001')
const Component = window.React.Component;
const ipfs = window.IpfsHttpClient({ host: 'infura.ipfs.io', port: '5001', protocol: 'https' })
// const ipfs = window.IpfsHttpClient({ host: 'localhost', port: '5001', protocol: 'https' })
const Buffer = window.IpfsHttpClient.Buffer


class App extends Component {

	constructor(props) {
		super(props);
		this.state = {
			buffer: null,
			imageHash: 'QmNaziHqZ8zBS2vrYwd3bdXJHmeoHDsBm9cf4b6YUWZBcX'
		};
	}

	captureFile = (file) => {

		const reader = new window.FileReader()
		reader.readAsArrayBuffer(file)

		reader.onloadend = () => {
			this.setState({ buffer: Buffer(reader.result) })
			console.log("Buffer: ", Buffer(reader.result))
			console.log("IPFS File: ", ipfs)
		}

	}

	// Example hash : QmYLBVXEFacCreH2ftxr58uK8ouZxtC9G8RZEwzVE4UPKN
	// Example hash : QmPRFmKYXuuiybC54NyhvfHXHVWBAxw7TEaZoM8z4ZMP8R
	// Example url: https://ipfs.infura.io/ipfs/QmPRFmKYXuuiybC54NyhvfHXHVWBAxw7TEaZoM8z4ZMP8R
	onSubmit = async () => {
		// await ipfs.ping(function (time){
		// 	console.log(time + 'ms')
		// 	ipfs.stop()
		// })
		console.log("Submitting...")
		
		await ipfs.add(this.state.buffer, (error, result) => {
			console.log("Loading...")
			console.log("IPFS Result:", result)
			const imageHash = result[0].Hash
			this.setState({ imageHash: imageHash })
			console.log("Hash value:", result[0].Hash)
			if (error) {
				console.error("Error: ", error)
				return
			}
			console.log("End")
		})
		return this.state.imageHash;
	}

}

var app1 = new App();

$('#ipfsFile').change(function (event) {
	event.preventDefault()
	console.log("File captured...")
	//Process file for IPFS
	const file = event.target.files[0]
	// console.log(file)
	app1.captureFile(file);
});

var imageHash;
$('#ipfsSubmit').submit(function (event) {
	event.preventDefault()
	console.log("test")
	// imageHash = "Hello i am imagehash"
	imageHash = app1.onSubmit()
});

// exports.imageHash = imageHash;


export default App;
