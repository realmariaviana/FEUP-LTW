'user strict'

let upvotes = document.querySelectorAll('.votes > .upvote');
let downVotes = document.querySelectorAll('.votes > .downvote');

upvotes.forEach((upvote) => (upvote.addEventListener("click", addVote), upvote.voted = false));
downVotes.forEach((downvote) => (downvote.addEventListener("click", addDownVote), downvote.voted = false));

function addVote(event) {
    let vote = event.target
    let storyId = vote.getAttribute("id").slice(-1)

    let request = new XMLHttpRequest();
    request.open("post", "../actions/add_vote.php", true)
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.addEventListener("load", function () {
        let votes = JSON.parse(this.responseText);
        updateVotes(votes, storyId, true);
        
    })

    request.send(encodeForAjax({
        story_id: storyId,
        vote: true
    }))

}


function addDownVote(event) {
    let vote = event.target
    let storyId = vote.getAttribute("id").slice(-1)

    let request = new XMLHttpRequest();
    request.open("post", "../actions/add_vote.php", true)
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.addEventListener("load", function () {
        let votes = JSON.parse(this.responseText);
        updateVotes(votes, storyId, false);
    
    })

    request.send(encodeForAjax({
        story_id: storyId,
        vote: false
    }))


}


function updateVotes(votes, storyId) {
    elem1 = document.getElementById("number-up-votes-" + storyId);
    elem2 = document.getElementById("number-down-votes-" + storyId);
   
    elem1.innerHTML = votes[0]['N'];
    elem2.innerHTML = votes[1]['N']
}