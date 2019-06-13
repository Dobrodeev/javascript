// function checkAnswer() {
    // let question = document.getElementsByClassName('question');
    let question = document.querySelectorAll('.question');
    let check = document.getElementById('check');
    let nextElement = document.getElementById('next');

    // alert(question);
    /*for (var key in question){
        alert(key + ' ' + question[key]);
    }*/

    let result = [];
    let now = 0;
    showAnswer();
    now ++;// 1
    // alert(now);
    nextElement.addEventListener('click', next);
    check.addEventListener('click', checkAnswer);
    function next() {
        showAnswer();
        now ++; // второй вопрос
        if (!question[now]){
            nextElement.style.display = 'none';
            check.style.display = 'block';
        }
    }
    function showAnswer() {
        for (let i = 0; i < question.length; i ++){
            question[i].style.display = 'none'; // скрываем
        }
        question[now].style.display = 'block'; // показываем
    }
    
    function checkAnswer() {
        for (let i = 0; i < question.length; i ++){
            let answer = question[i].querySelectorAll('input[type = radio]');
            result.push(trueAnswer(answer))
        }
        printResult();
        result = [];
    }
    /*for (let i = 0; i < question.length; i ++){
        let answer = question[i].querySelectorAll('input[type = radio]');
        result.push(trueAnswer(answer))
    }*/

    /*answer.forEach(function (elem) {
        alert(elem);
    });*/
    function trueAnswer(answer) {
        let result = null;
        let noAnswer = true;
        for (let i = 0; i < answer.length; i ++){
            let isTrue = (answer[i].getAttribute('data-true') !== null);
            if (answer[i].checked){
                noAnswer = false;
                if (isTrue){
                    result = true;
                }
                else {
                    result = false;
                }
            } 
            else {
                if (isTrue){
                    result = false;
                }
            }
        } 
        if (noAnswer){
            result = null;
        }
        return result;
    }
    
    function printResult() {
        let trueAnswer = falseAnswer = noAnswer = 0;
        for (let i = 0; i < result.length; i ++){
            if (result[i] === true){
                trueAnswer ++;
            } else if (result[i] === false){
                falseAnswer ++;
            }else if (result[i] === null){
                noAnswer ++;
            }
        }
        let all = trueAnswer + falseAnswer + noAnswer;
        let procent = Math.round(trueAnswer/all * 100);
        let msg = 'True answers: ' + trueAnswer + '(' + procent + '%)\n' + 'Error answers: ' + falseAnswer + '\n' + 'No answers: ' + noAnswer + '\n';
        alert(msg);
    }
// }