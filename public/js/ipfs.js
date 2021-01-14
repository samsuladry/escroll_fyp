const Buffer = window.Ipfs.Buffer
var table1 = document.getElementById( 'uploadTable' );

// const file = urlSource('https://ipfs.io/images/ipfs-logo.svg')
  
var buffer_;
var bufferList = [];
var hash = [];
var myURL = [];
var file = [];
var matricNumber = [];
var count = 0;

var upload = document.getElementById('ipfsFile');

/// Function to fetch and change file into buffer
async function captureFile(file, count)
{
    console.log("File captured... (in function)", file)
    matricNumber[count] = file.name.replace(".jpeg", "")
    console.log("File name: ", matricNumber)
    const reader = new window.FileReader()
    reader.readAsArrayBuffer(file)
    reader.onloadend = async function () {
        buffer_ = await Buffer(reader.result)
        console.log("IPFS File: ", buffer_)
        bufferList[count] = buffer_;
    }

}

/// Linking the function with html (button)
upload.onchange = async function(event) {
    console.log("File captured...")
    //Process file for IPFS
    file = event.target.files
    console.log("File:", file)
    

    for(i=0; i<file.length; i++)
    {   
        bufferList[i] = await captureFile(file[i], i)
        count++
        // console.log("Buffer No:", [i+1], bufferList[i])
        // console.log("Buffer out...", bufferList)
    }

    

    for(var i=0; i<file.length; i++){
        var row = table1.insertRow(i);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);


        cell1.innerHTML = i+1;
        cell2.innerHTML = file[i].name;
        cell3.innerHTML = "-";
        cell4.innerHTML = "-";
    }
    
}

/// Get the element by ID
var submit = document.getElementById('ipfsSubmit2');


/// Creating IPFS and sending file to IPFS
async function onSubmit(bufferList){
    console.log("Buffer out...", bufferList)
    var node = await Ipfs.create();

    for(let i=0; i<bufferList.length; i++){
        let image = node.add(bufferList[i])
        console.log("Apa dalam image", image)
        console.log("Apa dalam node", node)
        for await (const { cid } of image) {
        // console.log(cid.toString())
        hash[i] = cid.toString()
        console.log("Inside Image: ", hash[i])
        myURL[i] = "https://ipfs.io/ipfs/" + hash[i] //sini dapat balik IPFS hash
        } 
    }
    console.log("Links: ", myURL)
}

/// Linking the function with html (button)
submit.onclick = async function(event) {
    event.preventDefault()
    console.log("Click Sumbit!!")
    await onSubmit(bufferList);
    // console.log("Outside Function: ", myURL)
    // myURL = 'https://ipfs.io/ipfs/' + hash;
    // console.log("After send: ", myURL[1])
    
    console.log("bawah ni: ", matricNumber)
    $("#content").append('<input type="hidden" name="myURL" value="' + myURL + '">')
    $("#content").append('<input type="hidden" name="matricNumber" value="' + matricNumber + '">')
	$("#target").submit()

    for(var i=0; i<file.length; i++){
        // var row = table1.insertRow(i);
        // var cell3 = row.insertCell(2);
        // var cell4 = row.insertCell(3);
        var cell3 = table1.rows[i].cells[2];
        var cell4 = table1.rows[i].cells[3];

        cell3.innerHTML = '<a href=' + myURL[i] + '>' + myURL[i] + '/<a>';
        cell4.innerHTML = new Date();;
    }

   

}

// /// Get the element by ID
// var link = document.getElementById('ipfsLink');

// /// Link IPFS
// link.onclick = function (){
//   document.getElementById("ipfsLink").setAttribute("href", myURL);
// }


// document.getElementById("myLink").onclick = function() {
//   var link = document.getElementById("abc");
//   link.setAttribute("href", "xyz.php");
//   return false;
// }

////////////////

// var table1 = document.getElementById( 'uploadTable' );

// for(var i=0; i<file.length; i++){
//     var row = table1.insertRow(i);
//     var cell1 = row.insertCell(0);
//     var cell2 = row.insertCell(1);
//     var cell3 = row.insertCell(2);
//     var cell4 = row.insertCell(3);


//     cell1.innerHTML = i+1;
//     cell2.innerHTML = file[i].name;
//     cell3.innerHTML = [i].quantity;
//     cell4.innerHTML = historyList[i].size + ' MB';
// }