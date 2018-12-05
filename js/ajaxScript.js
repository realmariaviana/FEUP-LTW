'use strict'

let storiesComments = document.querySelectorAll('.comment');

storiesComments.forEach((storiesComments) => (storiesComments.addEventListener('click', openComments), storiesComments.bool=true));

function openComments(event) {
    let comment = event.target
    let id = comment.getAttribute('data-id')

    let request = new XMLHttpRequest()
    request.open("post", "../actions/get_comments.php", true)
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.addEventListener("load", function () {
        let comments = JSON.parse(this.responseText);

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
        let h5 = document.createElement("h5");
        let h5text = document.createTextNode(element.user_id);
        h5.appendChild(h5text);
        let p = document.createElement("p");
        let textNode = document.createTextNode(element.body);
        p.appendChild(textNode);
        let date = document.createElement("footer");
        date.appendChild(document.createTextNode(element.hour));
        let container = document.createElement("div");
        container.appendChild(h5);
        container.appendChild(p);
        container.appendChild(date);
        divComments.appendChild(container);
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