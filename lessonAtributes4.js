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

