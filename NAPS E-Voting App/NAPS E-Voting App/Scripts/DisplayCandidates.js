var data = [
    ['../../Resources/NAPS logo.jpg', 'Oranagwa Osmosis', '300'],
    ['../../Resources/NAPS logo 64 x 64.bmp', 'Tolu Foyeh', '400']
];

function CreateTable(data, post) {
    var html = '';
    html = '<table class="data">';

    //step through the rows
    for (var row in data) {
        var RowData = data[row];
        //if (row == 0) {
        html += '<img alt="" src="' + row + '" width="300" height="300" />';
        //}

        html += '<tr>';

        //step through the columns in this row
        for (var col in RowData) {
            var ColData = RowData[col];

            html += '<td>';
            if (col != 0) {
                html += ColData;
            }
            html += '</td>';
        }

        html += '</tr>';
    }

    html += '</table>';
    return html;
}

function InsertHTML(id, html) {
    var element = document.getElementById(id);
    element.innerHTML = html;
}

function run() {
    var html = CreateTable(data);
    InsertHTML('President', html);
}

window.onload = run;