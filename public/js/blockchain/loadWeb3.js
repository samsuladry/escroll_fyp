export default async function loadWeb3() 
{
  if (window.ethereum) 
  {
	window.web3 = new Web3(window.ethereum);
	await window.ethereum.enable()
  }
  else if (window.web3) 
  {
	  window.web3 = new Web3(window.web3.currentProvider);
  }
  else 
  {
	  window.alert('Non-Ethereum browser detected. You should consider trying MetaMask!');
  }
}


// let transaction =await web3.eth.getTransaction('0x42efddc800bb775782cfecfca9bea78f6adb8fa0def55de63ca4b24963718a87')
// let input = await web3.utils.toAscii(transaction.input)
// console.log('Decode: ', input)