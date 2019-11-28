function seasonsOfYear() {
    var num, season;
    num = +prompt('Число от 1 до 4. Будет выводится пора года: зима, весна, лето, осень.');
    switch (num) {
        case 1:
            season = 'Зима';
            break;
        case 2:
            season = 'Весна';
            break;
        case 3 :
            season = 'Лето';
            break;
        case 4:
            season = 'Осень';
            break;
        default:
            season = '';
    }
    alert(season)
    // alert(season);
    // alert('This is alert.')
    // document.getElementById('season').innerHTML='show season'
}

function f() {
    document.getElementById('spoil').innerHTML = 'spoil - spoilt - spoilt'
}

function f1() {
    var choise
    choise = confirm('Бросаем гранату Ф1 или нет?')
    // alert(choise)
    if (choise) {
        document.getElementById('f1').innerHTML = ' Мы бросили гранату Ф1'
    }
}

function f2() {
    var a = 1991
    // var neck = Number('1967 Woodstock')
    var neck = '1967 Woodstock'
    /*var lie = false
    var backgammon
    alert(String(backgammon) === 'null')
    alert(String(a))*/
    // String(a)
    // alert(typeof String(a))
    alert(typeof neck)
}