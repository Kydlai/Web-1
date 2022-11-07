var form= document.querySelector('.validate_form');
var xOptions = document.querySelector(".x")
var yCoordinate = document.querySelector(".y")
var rOptions = document.querySelectorAll(".r")

//функция для генерации ошибок
function generateTip(text, color) {
        var tip = document.createElement('div');
        tip.className = 'tip';
        tip.style.color = color;
        tip.innerHTML = text;
        return tip;
}

//функция для очистки подсказок при повторной валидации
function removeValidation() {
        var tips = form.querySelectorAll('.tip')
        for (var i = 0; i < tips.length; i++) {
                tips[i].remove()
        }
}

function checkRadios(radios) {
        radios = rOptions
        for(var i=0; i<radios.length; i++){
                if(radios[i].checked) return true;
        }
        var error = generateTip('↓откуда восставать-то?↓','darkred');
        radios[0].parentElement.insertBefore(error, radios[0]);
        return false;
}

function isNumber(s){
        var n = parseFloat(s.replace(',','.'));
        return !isNaN(n) && isFinite(n);
}

function validateField(coordinate,min,max){
        if(coordinate.value){
                coordinate.value = coordinate.value.replace(',','.');
                var index = coordinate.value.indexOf("\.")
                if(coordinate.value.slice(index + 1).indexOf("\.") != -1 || coordinate.value.indexOf("\.") == coordinate.value.size - 1){
                        var error = generateTip('↓Ты гений?↓','darkred')
                        coordinate.parentElement.insertBefore(error, coordinate)
                        return false;
                }
                if(coordinate.value<=min || coordinate.value>=max || !isNumber(coordinate.value) || coordinate.value.toUpperCase() != coordinate.value.toLowerCase()){
                        var error = generateTip('↓Это куда?↓','darkred')
                        coordinate.parentElement.insertBefore(error, coordinate)
                        return false;
                }
                else{
                        var correct = generateTip('Восстание возможно','green');
                        coordinate.parentElement.insertBefore(correct, coordinate)
                        return true;
                }
        }
        var error = generateTip('↓Ну и куда восставать?↓','darkred');
        coordinate.parentElement.insertBefore(error, coordinate);
        return false;
}

function validateAll(){
        console.log(typeof null)
        removeValidation()
        return checkRadios(rOptions) && validateField(yCoordinate,-5,3);
}