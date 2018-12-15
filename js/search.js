'use strict'

let bar = document.getElementById('search');
let check = document.getElementById('searchBox')
bar.addEventListener("keyup", search);

function search(event) {

    let elem = event.target;
    let text = elem.value;

    let request = new XMLHttpRequest();
    request.open("get", "../actions/search.php?text=" + text + "&about=" + check.value, true)
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.addEventListener("load", function () {
        let answer = JSON.parse(this.responseText);
        writeAnswer(answer, check.value, text == "");
    });

    request.send();
}


function writeAnswer(answer, theme, bool) {
    let datalist = document.getElementById("suggestions");

    while (datalist.firstChild)
        datalist.removeChild(datalist.firstChild)

    if (!bool) {
        answer.forEach(element => {
            let hint = element['N'];
            let a = document.createElement("a");
            a.href = "../pages/stories.php?search=" + theme + "&sub=" + hint;
            a.innerHTML = hint;
            datalist.appendChild(a);
        });
    }
}




// Helper function
function encodeForAjax(data) {
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}