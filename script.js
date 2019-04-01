function myfunc() {
    // document.getElementById('demo').innerHTML='hell';

    // document.getElementById('demo').innerHTML='Zi zi top';
    var card = prompt('Назвите кату от 2 до Туза: 2,3,4,...,J, Q, K, A', 0);
    var result;
    switch (card) {
        case 2: result = 2;
            break;
        case 3: result = 3;
            break;
        case 4: result = 2;
            break;
        case 5: result = 3;
            break;
        case 6: result = 2;
            break;
        case 7: result = 3;
            break;
        case 8: result = 2;
            break;
        case 9: result = 3;
            break;
        case 10:
        case 'J':
        case 'Q':
        case 'K': result = 10;
        break;
        case 'A': result = 11;
        break;
        default : result = 'Неясно что.'
    }
    alert(result);
}
function suitOfCard() {
    var variant = +prompt('Масть карты - число от 0 до 3', 0)
    var suit;
    switch (variant) {
        case 0 : suit = 'clubs - трефы';
        break;
        case 1: suit = 'hearts';
        break;
        case 2: suit = 'diamonds';
        break;
        case 3: suit = 'spades - пики';
        break;
        default: suit = 'Непонятно какая масть.'
    }
    alert(suit)
}
function textFunction()
{
    document.getElementById("someID").innerHTML = 'Some text for someID';
}

function f() {
    var x, y, z;
    x = 5;
    y = 6;
    z = x + y;
    document.write('x=',x);
    document.write('y=',y);
    document.write('x+y=', z);
    document.write('/n');
    for (i = 0; i < 10; i++)
    {
        document.writeln(i);
    }
}