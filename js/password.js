'use strict'


let pass = document.querySelector('#password')
let repeatPass = document.querySelector('#repeat-password')

let obrig = RegExp('.{2,}');
let medium = RegExp('.{5,}');
let long = RegExp('.{7,30}')

let uppercase = RegExp('.+(?=[A-Z])+');
let notwords = RegExp('([_@$%]|[a-z])+(?=[0-9])+([a-z]|[A-Z]|[_@$%])+(?=[0-9])+.*')

let passNU = RegExp('([_@$%]|[a-z])+([0-9])([0-9]|[_@$%]|[a-z])*([A-Z])([0-9]|[_@$%]|[a-z]|[A-Z])*')
let passLN = RegExp('([_@$%]|[a-z])+([A-Z])([A-Z]|[_@$%]|[a-z])*([0-9])([0-9]|[_@$%]|[a-z]|[A-Z])*')

let test = (passNU.test(password) || passLN.test(password)) && obrig.test(password);

if(test){
    //get button and enable and print short, long, or medium

}
else{
    ///disable button and print message with wrong matches
}


if(pass == repeatPass){
    document.querySelector('')
}
