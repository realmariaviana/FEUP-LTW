'use strict'


let addButton = document.getElementById("addTheme");
addButton.addEventListener("click", handler);


function handler(event) {
    let inputText = document.getElementById("inputThemes").value

    if (checkAlreadyAdded(inputText) || inputText == "")
        return
    let divTheme = document.getElementsByClassName("themesDivision")
    let checkbox = document.createElement('input')
    checkbox.type="checkbox"
    checkbox.name = "themes[]"
    checkbox.classList.add("themes")
    checkbox.id = checkbox.value = inputText;
    checkbox.setAttributeNode( document.createAttribute("checked"))
    checkbox.style="opacity: 0"
    let label = document.createTextNode(inputText);

    divTheme[0].parentNode.insertBefore(checkbox, divTheme[0]);
    divTheme[0].parentNode.insertBefore(label, divTheme[0]);
    divTheme[0].parentNode.insertBefore(document.createElement('br'), divTheme[0]);
    document.getElementById("inputThemes").value = ""

}


function checkAlreadyAdded(input) {
    let themes = document.querySelectorAll('.themes')
    
    for (let element of themes) {
        if (input === element.id)
        return true;
    }
    return false;
}