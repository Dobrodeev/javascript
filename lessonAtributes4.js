let arr = ['man1', 'man2', 'woman'];
// let ul = document.getElementsByClassName('list');
/*let ul = document.querySelector('.list');
for (let i = 0; i < arr.length; i ++){
    let text = document.createElement('li');
    text.innerHTML = arr[i];
    text.addEventListener('click', printLi);
    ul.appendChild(text);
}
function printLi() {
    alert(this.innerHTML);
}*/

/*let ul = document.querySelector('.list2');
let text = 'Еще текст.';
let li = document.createElement('li');
ul.insertBefore(li, ul.children[0]);
li.innerHTML = text;*/

let ul = document.querySelector('.list3');
let firstElem = ul.firstElementChild;
firstElem.style.color = 'red';

let someul = document.getElementById('element');
let someli = someul.previousElementSibling;
someli.innerHTML = someli.innerHTML + '<li>Some text for li</li>';

let div = document.getElementById('test');
let nextdiv = div.nextElementSibling.nextElementSibling;
nextdiv.innerHTML = nextdiv.innerHTML + '<p>Some text for div</p>';

let lielement = document.getElementById('elem');
let parent = lielement.parentNode;
parent.style.backgroundColor = '#f00';

let ourul = document.querySelector('.list3');
// let ourli = ourul.lastElementChild
// let ourli = ourul.children[2];
let ourli = document.querySelector('li:lastChild');
ourli.addEventListener('click', hideLi);
function hideLi() {
    alert('We hide li');
}