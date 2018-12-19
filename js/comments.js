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
        entity_id: id,
        text: texts
    }))

}

function writeComments(comments, id) {

    let divComments = document.createElement("div");
    divComments.id = "delete-" + id;
    divComments.className = "commentsContainer";
  
    comments.forEach(element => {
        
        let h5 = document.createElement("h5");
        h5.innerHTML=element.username;
       
        let p = document.createElement("p");
        p.innerHTML = element.body;

        let div = document.createElement("image");
        div.innerHTML = element.image;

        let date = document.createElement("footer");
        date.innerHTML = element.hour;

        let container = document.createElement("div");
       container.classList.add("comments-container");
       

       let container2 = document.createElement("div");
       container2.classList.add("comments-user");
        container2.appendChild(h5);
        container2.appendChild(date);

        let container3 = document.createElement("div");
        container3.classList.add("comment-vote");
         
        container3.appendChild(p);
        container3.appendChild(votes(element));
        

        container.appendChild(container2);
        container.appendChild(container3);

    
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


function votes(element){

    let voteupcount = document.createElement("label");
    let votedowncount = document.createElement("label");

    voteupcount.id = "number-up-votes-" + element.entity_id;
    votedowncount.id = "number-down-votes-" + element.entity_id;
   
    voteupcount.innerHTML = element.upvotes;
    votedowncount.innerHTML = element.downvotes;
    let voteup = document.createElement("img");
    let votedown = document.createElement("img");


    if(element.voteup)
    voteup.src = "https://image.flaticon.com/icons/svg/25/25423.svg"
    else
    voteup.src = "https://image.flaticon.com/icons/svg/25/25297.svg" 

    voteup.width="15" 
    voteup.height="15"
    voteup.alt="upVote"


    if(element.votedown)
    votedown.src = "https://image.flaticon.com/icons/svg/25/25395.svg"
    else
    votedown.src = "https://image.flaticon.com/icons/svg/25/25237.svg"

    votedown.width="15" 
    votedown.height="15"
    votedown.alt="downVote"



    voteup.id = "up-vote-" + element.entity_id;
    votedown.id = "down-vote-" + element.entity_id;
    
    voteup.addEventListener("click", addVote);
    votedown.addEventListener("click", addDownVote);



    let votezone = document.createElement("p");
    votezone.id = "votezone";
    votezone.appendChild(votedowncount);
    votezone.appendChild(votedown);
    votezone.appendChild(voteupcount);
    votezone.appendChild(voteup);

    return votezone;

}

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


// Helper function
function encodeForAjax(data) {
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}