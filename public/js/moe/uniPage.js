var historyList = [
    {
        "date": "20/3/2017",
        "quantity": 54512,
        "size": 1231,
        "description": "Success without error",
    },
    {
        "date": "20/3/2018",
        "quantity": 123156,
        "size": 6547,
        "description": "Success without error",
    },{
        "date": "20/3/2019",
        "quantity": 54234,
        "size": 3215,
        "description": "Success without error",
    },{
        "date": "20/3/2020",
        "quantity": 98532,
        "size": 2123,
        "description": "Success without error",
    },
]

// var history = document.getElementById('historyRow');
// var historyRow = '';

// for(var i=1; i<historyList.length; i++){
//     historyRow += '<tr><th scope="row">' + i + '</th><td>' + historyList[i].date + '</td><td>' + historyList[i].quantity + '</td><td>' + historyList[i].size + 'MB </td><td>' + historyList[i].description + '</td></tr>'
// }

// console.log("nHTML = ", historyRow)
// history.innerHTML = historyRow;

var table = document.getElementById( 'myTable' );

for(var i=0; i<historyList.length; i++){
    var row = table.insertRow(i);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);


    cell1.innerHTML = i+1;
    cell2.innerHTML = historyList[i].date;
    cell3.innerHTML = historyList[i].quantity;
    cell4.innerHTML = historyList[i].size + ' MB';
    cell5.innerHTML = historyList[i].description;
}
