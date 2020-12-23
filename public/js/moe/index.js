var list = [
    {
        "university": "IIUM",
        "logoLink": "https://www.iium.edu.my/img/iium-logo-latest-v2.png",
        "redirectLink": "moe/uniPage"
    },
    {
        "university": "IIUM",
        "logoLink": "https://www.iium.edu.my/img/iium-logo-latest-v2.png",
        "redirectLink": "https://www.iium.edu.my/"
    },
    {
        "university": "IIUM",
        "logoLink": "https://www.iium.edu.my/img/iium-logo-latest-v2.png",
        "redirectLink": "https://www.iium.edu.my/"
    },
    {
        "university": "IIUM",
        "logoLink": "https://www.iium.edu.my/img/iium-logo-latest-v2.png",
        "redirectLink": "https://www.iium.edu.my/"
    },
    {
        "university": "IIUM",
        "logoLink": "https://www.iium.edu.my/img/iium-logo-latest-v2.png",
        "redirectLink": "https://www.iium.edu.my/"
    },
    {
        "university": "IIUM",
        "logoLink": "https://www.iium.edu.my/img/iium-logo-latest-v2.png",
        "redirectLink": "https://www.iium.edu.my/"
    },
    {
        "university": "IIUM",
        "logoLink": "https://www.iium.edu.my/img/iium-logo-latest-v2.png",
        "redirectLink": "https://www.iium.edu.my/"
    },
    {
        "university": "IIUM",
        "logoLink": "https://www.iium.edu.my/img/iium-logo-latest-v2.png",
        "redirectLink": "https://www.iium.edu.my/"
    },

]

var generateList = document.getElementById('uniList');
var nHTML = '';

for(var i=0; i<list.length; i++){
    nHTML += '<div class="col-4 mb-4" > <div class="card"> <div class="card-header content-center"> <a href="' + list[0].redirectLink + '"><img src="' + list[0].logoLink + '" width="100%"> </a></div> <div class="card-body row text-center"> <div class="col"> <div class="text-value-xl">UIAM</div> </div> </div> </div> </div>'
}
console.log("nHTML = ", nHTML)
generateList.innerHTML = nHTML;

////////////////////////////////////////////////////////////

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

    var data = google.visualization.arrayToDataTable([
        ['University', 'Total number of Students'],
        ['IIUM',     11],
        ['UiTM',      2],
        ['UM',  2],
        ['UKM', 2],
        ['UTM',    7],
        ['USM',     11],
        ['UniZa',     11],
        ['UniDLT',     11],
        ['UUM',     11],
    ]);

    var options = {
        title: 'Percentage of Student (IPTS)',
        is3D: true,
        legend: 'none',
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart1'));
    chart.draw(data, options);
}

google.charts.setOnLoadCallback(drawCharts);

function drawCharts() {

    var datas = google.visualization.arrayToDataTable([
        ['University', 'Total number of Studentss'],
        ['IIUM',     11],
        ['UiTM',      2],
        ['UM',  2],
        ['UKM', 21],
        ['UTM',    7],
        ['USM',     11],
        ['UniZa',     11],
        ['UniDLT',     11],
        ['UUM',     11],
    ]);

    var option = {
        title: 'Percentage of Student (IPTA)',
        is3D: true,
        legend: 'none',
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(datas, option);
}