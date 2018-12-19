'use strict'


let pass = document.querySelector('#password.input')
let repeatPass = document.querySelector('#rpassword.input')
let passBlock = document.querySelector('.password-block');
let rpassBlock = document.querySelector('.rpassword-block');
let button = document.querySelector('.registerbtn');

pass.addEventListener("keyup", passwordOnRules);
repeatPass.addEventListener("keyup", equalPass);

let obrig = RegExp('^.{5,}$');
let medium = RegExp('^.{5,7}$');
let long = RegExp('^.{8,}$')

let passNU = RegExp('([_@$%]|[a-z])+([0-9])([0-9]|[_@$%]|[a-z])*([A-Z])([0-9]|[_@$%]|[a-z]|[A-Z])*')
let passLN = RegExp('([_@$%]|[a-z])+([A-Z])([A-Z]|[_@$%]|[a-z])*([0-9])([0-9]|[_@$%]|[a-z]|[A-Z])*')



function passwordOnRules(event){
    let message = document.getElementById("message")
    if(message){
        message.parentNode.removeChild(message);
    }
    let password = event.target.value
    let test = (passNU.test(password) || passLN.test(password));
   

    if(test && obrig.test(password)){
    
        if(test && medium.test(password)){
            writeMessages("medium size", passBlock)
        }
        else if(test && long.test(password)){
            writeMessages("long size",passBlock)
        }
        else{
            writeMessages("max of 25 ",passBlock)
        }

    }
    else{
        writeMessages("Pass: at least 7 letter that  start with lowercase letter or a symbol:$, @, %, _; in the middle you need to have at least a number and an uppercase letter", passBlock)
    }
}

function equalPass(event){
    let message = document.getElementById("message")
    if(message){
        message.parentNode.removeChild(message);
    }
    if(pass.value != event.target.value){
    button.disabled = true;

        writeMessages("password does not match", rpassBlock);
    }
    else{
    button.disabled = false;
        writeMessages("matching!!!", rpassBlock);
    }

}

function writeMessages(message, elem){
    let label = document.createElement('label');
    label.innerHTML = message; 
    label.id = "message";

    let divis = document.createElement('div');
    divis.classList.add("message-warning");
    
    divis.appendChild(label);


    elem.appendChild(divis);
}

