function f() {
    var word, wordArray;
    word = document.getElementById('number').value;
    wordArray = word.split('');
    wordArrayReverse = word.split('').reverse();
    for (var i = 0; i < wordArray.length; i++) {
        if (wordArray[i] !== wordArrayReverse[i]) {
            alert('Не палиндром');
            return;
        }
    }
    alert('Palindrom');
    return;
}

