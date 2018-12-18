'use strict'


let pass = document.querySelector('#password')
let repeatPass = document.querySelector('#repeat-password')

let obrig = RegExp('.{5}');
let short = RegExp('.{8}');
let long = RegExp('.{10}')

let uppercase = RegExp('.+(?=[A-Z])+');
let notwords = RegExp('([_@$%]|[a-z])+(?=[0-9])+([a-z]|[A-Z]|[_@$%])+(?=[0-9])+.*')

if(pass == repeatPass){
    document.querySelector('')
}
