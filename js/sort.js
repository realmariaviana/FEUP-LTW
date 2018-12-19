'use strict'

function initializeSort() {

    let lista = document.querySelectorAll('.sorting');

    let bool = true;

    for (let element of lista) {
        element.addEventListener("click", ola);
    }
}

initializeSort();

function ola(event) {
    let spec = event.target.id
    let request = new XMLHttpRequest();
    request.open("post", "../actions/orderStories.php", true)
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.addEventListener("load", function () {
        let stories = JSON.parse(this.responseText);

        drawStories(stories);

    })

    request.send(encodeForAjax({
        spec: spec
    }))

}

function drawStories(stories) {
    let container = document.getElementById("storyConteiner");
    activateScripts();
    while (container.firstElementChild) {
        container.removeChild(container.firstElementChild);
    }



    stories.forEach(element => {
       
        let article = document.createElement('article')
        article.id = element.entity_id
        article.classList.add("story");

        let div = document.createElement("div")
        let img = create('img')
        img.classList.add("avatar")
        img.src = element.img
        img.alt = "imgPerfil"
        div.appendChild(img)
        let span = create('span')
        let aspan = create('a')
        aspan.href = "../pages/profilePage.php?username=" + element.username;
        aspan.innerHTML = " " + element.username + " "
        span.appendChild(aspan)
        div.appendChild(span);

        ///////////////////////////////////////7
        let storyDescript = create('div');
        storyDescript.classList.add("story-descript")

        let na = create('a');
        na.href = "../pages/stories.php?search=Stories&sub=" + element.title
        na.innerHTML = " " + element.title + " "
        storyDescript.appendChild(na)
        let body = create('p');
        body.innerHTML = " " + element.body + " ";
        storyDescript.appendChild(body)

        let tagss = create('div')
        tagss.classList.add("tags")

        element.tags.forEach(element => {

            let p1 = create('p')
            let atag = create('a')
            p1.classList.add("tag")
            p1.id = element.theme
            atag.href = "../pages/stories.php?search=Themes&sub=" + element.theme
            atag.innerHTML = "#" + element.theme

            p1.appendChild(atag);
            tagss.appendChild(p1);

        })

        storyDescript.appendChild(tagss)


        ///////////////////////////////////////////////////////////
        let postfooter = create('div');
        postfooter.classList.add("post-footer")
        let ul = create('ul')
        ul.classList.add("like-com")
        let li1 = create('li')
        let li2 = create('li')
        let li3 = create('li')
        let p2 = create('p')
        p2.classList.add("votes")
        p2.innerHTML = constructVotes(element);
        li1.appendChild(p2);
        li2.innerHTML = "<label for=date >" + element.hour + "</label>"
        li3.innerHTML = "<label class=comment data-id=" + element.entity_id + "> Comments </label>"
        ul.appendChild(li1);
        ul.appendChild(li2);
        ul.appendChild(li3);
        postfooter.appendChild(ul)

        //adds
        article.appendChild(div);
        article.appendChild(storyDescript);
        article.appendChild(postfooter);
        container.appendChild(article);
    });

}


function create(string) {
    return document.createElement(string)
}

function constructVotes(elem) {

    let string

    string = "<label id=number-down-votes-" + elem.entity_id + " for=numberOfDownVotes >" + elem.votesDownStory + "</label>"

    if (elem.hivotedDown) {
        string += "<img class=downvote id=down-vote-" + elem.entity_id + " src=https://image.flaticon.com/icons/svg/25/25395.svg width=20 height=20 alt=downVote>"
    } else
        string += "<img class=downvote id=down-vote-" + elem.entity_id + " src=https://image.flaticon.com/icons/svg/25/25237.svg width=20 height=20 alt=downVote>"

    string += "<label id=number-up-votes-" + elem.entity_id + " for=numberOfupVotes >" + elem.votesUpStory + "</label>"

    if (elem.hivotedUp) {
        string += "<img class=upvote id=up-vote-" + elem.entity_id + " src=https://image.flaticon.com/icons/svg/25/25423.svg width=20 height=20 alt=upVote >"
    } else
        string += "<img class=upvote id=up-vote-" + elem.entity_id + " src=https://image.flaticon.com/icons/svg/25/25297.svg width=20 height=20 alt=upVote >"

    return string
}

function activateScripts(){
    let scriptVotes = document.getElementById("voteScript");
    scriptVotes.parentNode.removeChild(scriptVotes);
    let s = create("script")
    s.defer = true;
    s.src = "../js/votes.js"
    s.id="voteScript"

    let scriptComment = document.getElementById("commentScript");
    scriptComment.parentNode.removeChild(scriptComment);
    let s1 = create("script")
    s1.defer = true;
    s1.src = "../js/comments.js"
    s1.id="commentScript"
   
    let header = document.querySelector("header") ;
    header.appendChild(s); 

    header.appendChild(s1); 

}