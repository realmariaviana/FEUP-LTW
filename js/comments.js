'use strict'

let storiesComments = document.querySelectorAll('.comment');

storiesComments.forEach((storiesComments) => (storiesComments.addEventListener('click', openComments), storiesComments.bool = true));

function openComments(event) {
    let comment = event.target
    let id = comment.getAttribute('data-id')
    let texts = null;
    let request = new XMLHttpRequest()
    request.open("post", "../actions/get_comments.php", true)
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.addEventListener("load", function () {
        let comments = JSON.parse(this.responseText);

        if (comment.bool)
            writeComments(comments, id);
        else
            deleteComments(id);

        comment.bool = !comment.bool;

    })

    request.send(encodeForAjax({
        story_id: id,
        text: texts
    }))

}

//DOM -> Injection of HTML
function writeComments(comments, id) {

    let divComments = document.createElement("div");
    divComments.id = "delete-" + id;
    divComments.className = "commentsContainer";
    comments.forEach(element => {
        let voteup = document.createElement("label");
        let votedown = document.createElement("label");
        votedown.id = "notLike-" + element.comment_id;
        voteup.id = "like-" + element.comment_id;
        votedown.innerHTML = "dont like"
        voteup.innerHTML = "like"
        voteup.addEventListener("click", voteUpComment);
        votedown.addEventListener("click", voteUpComment);

        let h5 = document.createElement("h5");
        let h5text = document.createTextNode(element.user_id);
        h5.appendChild(h5text);
        let p = document.createElement("p");
        let votezone = document.createElement("p");
        votezone.id = "votezone";
        let textNode = document.createTextNode(element.body);
        p.appendChild(textNode);
        let date = document.createElement("footer");
        date.appendChild(document.createTextNode(element.hour));
        let container = document.createElement("div");
        votezone.appendChild(votedown);
        votezone.appendChild(voteup);
        container.appendChild(h5);
        container.appendChild(p);
        container.appendChild(votezone);
        container.appendChild(date);
        divComments.appendChild(container);
    });

    let article = document.getElementById(id);
    article.appendChild(divComments);

    AddComment(article, id);
};

function deleteComments(id) {
    let comments = document.getElementById("delete-" + id);
    comments.parentNode.removeChild(comments);

    let comments1 = document.getElementById("newComment-" + id);

    comments1.parentNode.removeChild(comments1);
};

/**
 * 
 * Add the block for the new comment 
 * 
 * @param {} article 
 *  */
function AddComment(article, id) {
    let newComment = document.createElement("div");
    newComment.id = "newComment-" + id;
    newComment.className = "newCommentContainer";

    let commentArea = document.createElement("textarea");
    commentArea.id = "commentTextArea-" + id;

    let sendButton = document.createElement("button");
    sendButton.id = "sendCommentButton" + id;

    let sendButtonImg = document.createElement("img");
    sendButtonImg.id = "imgButton-" + id;
    sendButtonImg.src = "https://image.flaticon.com/icons/svg/60/60525.svg"
    sendButtonImg.width = 10;
    sendButtonImg.height = 10;
    sendButton.appendChild(sendButtonImg);

    sendButton.addEventListener("click", sendComment);
    newComment.appendChild(commentArea);
    newComment.appendChild(sendButton);
    article.appendChild(newComment);

}

function sendComment(event) {
    let button = event.target.getAttribute('id');
    let commentId = button.slice(-1);
    let text = document.getElementById("commentTextArea-" + commentId).value;
    if (!text)
        return;
    let request = new XMLHttpRequest()
    request.open("post", "../actions/add_comment.php", true)
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.addEventListener("load", function () {
        let comments = JSON.parse(this.responseText);

        deleteComments(commentId);
        writeComments(comments, commentId);
    });


    request.send(encodeForAjax({
        text: text,
        story_id: commentId
    }));

}


function voteUpComment(event) {
    let vote = event.target
    let name = vote.getAttribute("id");
    let commentId = name.slice(-1)
    let type = name.substring(0, name.length - 2);

    let request = new XMLHttpRequest();
    request.open("post", "../actions/add_comment_vote.php", true)
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.addEventListener("load", function () {
        let votes = JSON.parse(this.responseText);

        updateVotes(votes, commentId, type === "like");
    })

    request.send(encodeForAjax({
        comment_id: commentId,
        vote: type === "like"
    }))



}


function voteDownComment(event) {
    let vote = event.target
    let commentId = vote.getAttribute("id").slice(-1)

    let request = new XMLHttpRequest();
    request.open("post", "../actions/add_comment_vote.php", true)
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.addEventListener("load", function () {
        let votes = JSON.parse(this.responseText);
        updateCommentVotes(votes, commentId, false);

    })

    request.send(encodeForAjax({
        comment_id: storyId,
        vote: false
    }))


}


function updateCommentVotes(votes, commentId) {
    elem1 = document.getElementById("like-" + commentId);
    elem2 = document.getElementById("notLike-" + commentId);

    elem1.innerHTML = votes[0]['N'];
    elem2.innerHTML = votes[1]['N']
}

// Helper function
function encodeForAjax(data) {
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}