'use strict'

let tags = document.querySelectorAll('.story > .storyFooter > .tags');

let remove = document.querySelectorAll('.story');
remove.forEach(element => {
    let ok = element.getElementsByClassName('tags');

    ok[0].parentNode.removeChild(ok[0])
});