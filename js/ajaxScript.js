'use strict'

let storiesComments = document.querySelectorAll('.comment');
storiesComments.forEach((s) => s.bool = true);
storiesComments.forEach((storiesComments) => storiesComments.addEventListener('click', openComments));
function openComments(event) {
    let comment = event.target
    let id = comment.getAttribute('data-id')

    let request = new XMLHttpRequest()
    request.open("post", "../actions/get_comments.php", true)
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.addEventListener("load", function () {
        let comments = JSON.parse(this.responseText);
        console.log(comments);
       
        if (comment.bool)
            writeComments(comments, id);
        else
            deleteComments();

            comment.bool = !comment.bool;
 
    })

    request.send(encodeForAjax({ story_id: id }))

}

//DOM -> Injection of HTML
function writeComments(comments, id) {

    let divComments = document.createElement("div");
    divComments.id = "delete";
    comments.forEach(element => {
        let p = document.createElement("p");
        let textNode = document.createTextNode(element.body);
        p.appendChild(textNode);
        divComments.appendChild(p);
    });

    let article = document.getElementById(id);
    article.appendChild(divComments);
};

function deleteComments() {
    let comments = document.getElementById("delete");
    comments.parentNode.removeChild(comments);
};


// Helper function
function encodeForAjax(data) {
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}