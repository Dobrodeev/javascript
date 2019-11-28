function myfunc() {
    var elements = document.getElementsByTagName('p');
    for (var i = 0; i < elements.length; i++) {
        elements[i].innerHTML = i
    }
    // alert(elements);
}

/*var element = document.getElementById('content');
element.style.background = 'red';
var elements = document.getElementsByTagName('b');
elements.style.background = 'green';
var input = document.getElementsByName('first');
var classic = document.getElementsByClassName('demo');
classic.style.background = 'blue';*/

function chooseAge() {
    var tableElem = document.getElementById('age-table');
    var elements = tableElem.getElementsByTagName('input');

    for (var i = 0; i < elements.length; i++) {
        var input = elements[i];
        alert(input.value + ': ' + input.checked);
    }
}

/*elements2 = document.querySelectorAll('ul > li:last-child');
for (var i = 0; i < elements2.length; i++) {
    alert( elements2[i].innerHTML ); // "тест", "пройден"
}*/

// var numberSpan = document.querySelector('.num');

// ближайший элемент сверху подходящий под селектор li
// alert(numberSpan.closest('li').className) // subchapter

// ближайший элемент сверху подходящий под селектор .chapter
// alert(numberSpan.closest('.chapter').tagName) // LI

// ближайший элемент сверху, подходящий под селектор span
// это сам numberSpan, так как поиск включает в себя сам элемент
// alert(numberSpan.closest('span') === numberSpan) // true