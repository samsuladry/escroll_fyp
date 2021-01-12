// fix contract address once contract is deployed
// change: samsul will deploy contract to server, then we will use the contract address
// 0x83c184bB27fed6001980E72F19F4f70bEe7a19cB //contract ada 3000 student
// contract server nazhan (development): 0xC65Bd5C9A7EC77ade023e1fcdC5417857713401b
export const contractAddress = '0x02260eE742F0f56522A2788f0BB0dE2c278D32b4'
export const contractAbi = [
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "_uniAddress",
				"type": "address"
			}
		],
		"name": "deleteUniversity",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "_matricNumber",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_dataHash",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_jsonData",
				"type": "string"
			}
		],
		"name": "insertStudent",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "_uniAddress",
				"type": "address"
			},
			{
				"internalType": "string",
				"name": "_uniName",
				"type": "string"
			}
		],
		"name": "insertUniversity",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [],
		"stateMutability": "nonpayable",
		"type": "constructor"
	},
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": false,
				"internalType": "address",
				"name": "uniAddress",
				"type": "address"
			},
			{
				"indexed": false,
				"internalType": "string",
				"name": "uniName",
				"type": "string"
			},
			{
				"indexed": false,
				"internalType": "string",
				"name": "matricNumber",
				"type": "string"
			},
			{
				"indexed": false,
				"internalType": "string",
				"name": "dataHash",
				"type": "string"
			},
			{
				"indexed": false,
				"internalType": "string",
				"name": "jsonData",
				"type": "string"
			},
			{
				"indexed": false,
				"internalType": "string",
				"name": "status",
				"type": "string"
			},
			{
				"indexed": false,
				"internalType": "uint256",
				"name": "deployTime",
				"type": "uint256"
			},
			{
				"indexed": false,
				"internalType": "uint256",
				"name": "blockNumber",
				"type": "uint256"
			}
		],
		"name": "studentInserted",
		"type": "event"
	},
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": false,
				"internalType": "address",
				"name": "uniAddress",
				"type": "address"
			},
			{
				"indexed": false,
				"internalType": "string",
				"name": "uniName",
				"type": "string"
			},
			{
				"indexed": false,
				"internalType": "string",
				"name": "matricNumber",
				"type": "string"
			},
			{
				"indexed": false,
				"internalType": "string",
				"name": "dataHash",
				"type": "string"
			},
			{
				"indexed": false,
				"internalType": "string",
				"name": "jsonData",
				"type": "string"
			},
			{
				"indexed": false,
				"internalType": "string",
				"name": "status",
				"type": "string"
			},
			{
				"indexed": false,
				"internalType": "uint256",
				"name": "deployTime",
				"type": "uint256"
			},
			{
				"indexed": false,
				"internalType": "uint256",
				"name": "blockNumber",
				"type": "uint256"
			}
		],
		"name": "studentUpdated",
		"type": "event"
	},
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "_matricNumber",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_dataHash",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_jsonData",
				"type": "string"
			}
		],
		"name": "updateStudent",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "_matricNumber",
				"type": "string"
			}
		],
		"name": "checkStudentExistance",
		"outputs": [
			{
				"internalType": "bool",
				"name": "",
				"type": "bool"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "_matricNumber",
				"type": "string"
			}
		],
		"name": "getStudent",
		"outputs": [
			{
				"internalType": "address",
				"name": "",
				"type": "address"
			},
			{
				"internalType": "string",
				"name": "",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "",
				"type": "string"
			},
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			},
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "_uniAddress",
				"type": "address"
			}
		],
		"name": "getUniversity",
		"outputs": [
			{
				"internalType": "address",
				"name": "",
				"type": "address"
			},
			{
				"internalType": "string",
				"name": "",
				"type": "string"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "",
				"type": "string"
			}
		],
		"name": "students",
		"outputs": [
			{
				"internalType": "address",
				"name": "uniAddress",
				"type": "address"
			},
			{
				"internalType": "string",
				"name": "uniName",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "matricNumber",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "dataHash",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "jsonData",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "status",
				"type": "string"
			},
			{
				"internalType": "uint256",
				"name": "deployTime",
				"type": "uint256"
			},
			{
				"internalType": "uint256",
				"name": "blockNumber",
				"type": "uint256"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "",
				"type": "address"
			},
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			}
		],
		"name": "uniAdd",
		"outputs": [
			{
				"internalType": "address",
				"name": "",
				"type": "address"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			}
		],
		"name": "uniAddress",
		"outputs": [
			{
				"internalType": "address",
				"name": "",
				"type": "address"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			}
		],
		"name": "uniName",
		"outputs": [
			{
				"internalType": "string",
				"name": "",
				"type": "string"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "_uniAddress",
				"type": "address"
			}
		],
		"name": "universityCounter",
		"outputs": [
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			}
		],
		"stateMutability": "view",
		"type": "function"
	}
]