export const contractAddress = '0x2D3638FF4B88a33C0e9849725125a4E5c816CA69'
export const contractAbi = [
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "_matricNumber",
				"type": "string"
			}
		],
		"name": "deleteStudent",
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
				"name": "_ipfsHash",
				"type": "string"
			}
		],
		"name": "insertScroll",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "_name",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_matricNumber",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_nationality",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_faculty",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_course",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_ic",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_gender",
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
				"internalType": "string",
				"name": "matricNumber",
				"type": "string"
			},
			{
				"indexed": false,
				"internalType": "string",
				"name": "scrollIPFS",
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
		"name": "scrollInserted",
		"type": "event"
	},
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": false,
				"internalType": "string",
				"name": "matricNumber",
				"type": "string"
			},
			{
				"indexed": false,
				"internalType": "string",
				"name": "scrollIPFS",
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
		"name": "scrollUpdated",
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
				"name": "name",
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
				"name": "nationality",
				"type": "string"
			},
			{
				"indexed": false,
				"internalType": "string",
				"name": "faculty",
				"type": "string"
			},
			{
				"indexed": false,
				"internalType": "string",
				"name": "course",
				"type": "string"
			},
			{
				"indexed": false,
				"internalType": "string",
				"name": "identityCardNo",
				"type": "string"
			},
			{
				"indexed": false,
				"internalType": "string",
				"name": "gender",
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
				"name": "name",
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
				"name": "nationality",
				"type": "string"
			},
			{
				"indexed": false,
				"internalType": "string",
				"name": "faculty",
				"type": "string"
			},
			{
				"indexed": false,
				"internalType": "string",
				"name": "course",
				"type": "string"
			},
			{
				"indexed": false,
				"internalType": "string",
				"name": "identityCardNo",
				"type": "string"
			},
			{
				"indexed": false,
				"internalType": "string",
				"name": "gender",
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
				"internalType": "string[]",
				"name": "matricNo",
				"type": "string[]"
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
		"name": "universitiesInserted",
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
				"name": "_ipfsHash",
				"type": "string"
			}
		],
		"name": "updateScroll",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "_name",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_matricNumber",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_nationality",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_faculty",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_course",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_ic",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_gender",
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
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			}
		],
		"name": "allUniAdd",
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
		"name": "allUniName",
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
		"inputs": [],
		"name": "getAllStudentMatricNumberInTheUniversity",
		"outputs": [
			{
				"internalType": "string[]",
				"name": "",
				"type": "string[]"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [],
		"name": "getAllUniversity",
		"outputs": [
			{
				"internalType": "address[]",
				"name": "",
				"type": "address[]"
			},
			{
				"internalType": "string[]",
				"name": "",
				"type": "string[]"
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
				"internalType": "string",
				"name": "_matricNumber",
				"type": "string"
			}
		],
		"name": "getStudentIPFSScroll",
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
				"name": "_uniAdd",
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
				"name": "_matNo",
				"type": "string"
			}
		],
		"name": "matricNoCounter",
		"outputs": [
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
				"internalType": "string",
				"name": "",
				"type": "string"
			}
		],
		"name": "scroll",
		"outputs": [
			{
				"internalType": "string",
				"name": "matricNumber",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "scrollIPFS",
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
				"name": "name",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "matricNumber",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "nationality",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "faculty",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "course",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "identityCardNo",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "gender",
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
			}
		],
		"name": "universities",
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
	},
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "_sender",
				"type": "address"
			},
			{
				"internalType": "string",
				"name": "_matNo",
				"type": "string"
			}
		],
		"name": "verifyOwner",
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
				"internalType": "address",
				"name": "_sender",
				"type": "address"
			}
		],
		"name": "verifyUniversity",
		"outputs": [
			{
				"internalType": "bool",
				"name": "",
				"type": "bool"
			}
		],
		"stateMutability": "view",
		"type": "function"
	}
]