'user strict'

let upvotes = document.querySelectorAll('.votes > .upvote');
let downVotes = document.querySelectorAll('.votes > .downvote');

upvotes.forEach((upvote) => upvote.addEventListener("click", addVote));
downVotes.forEach((downvote) => downvote.addEventListener("click", addDownVote));

function addVote(event) {
    let vote = event.target
    let id = vote.getAttribute("id").slice(-1)

    let request = new XMLHttpRequest();
    request.open("post", "../actions/add_vote.php", true)
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.addEventListener("load", function () {
        let votes = JSON.parse(this.responseText);
        updateVotes(votes, id);

    })

    request.send(encodeForAjax({
        entity_id: id,
        vote: true
    }))

}


function addDownVote(event) {
    let vote = event.target
    let id = vote.getAttribute("id").slice(-1)

    let request = new XMLHttpRequest();
    request.open("post", "../actions/add_vote.php", true)
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.addEventListener("load", function () {
        let votes = JSON.parse(this.responseText);
        updateVotes(votes, id);

    })

    request.send(encodeForAjax({
        entity_id: id,
        vote: false
    }))


}


function updateVotes(votes, storyId) {
    elem1 = document.getElementById("number-up-votes-" + storyId);
    elem2 = document.getElementById("number-down-votes-" + storyId);
    img1 = document.getElementById("up-vote-" + storyId);
    img2 = document.getElementById("down-vote-" + storyId);

    if (votes[3])
        img2.src = "https://image.flaticon.com/icons/svg/25/25395.svg"
    else
        img2.src = "https://image.flaticon.com/icons/svg/25/25237.svg"
    if (votes[2])
        img1.src = "https://image.flaticon.com/icons/svg/25/25423.svg"
    else
        img1.src = "https://image.flaticon.com/icons/svg/25/25297.svg"
        
    elem1.innerHTML = votes[0]['N'];
    elem2.innerHTML = votes[1]['N']
}