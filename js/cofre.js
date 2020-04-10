function upup() {
    var numero = document.getElementById('vsa');
    var min = 19999999990000;
    var max = 20000000000000;
    var duração = 1000;
    for (var i = min; i <= max; i++) {
        setTimeout(function (nr) {
            numero.innerHTML = nr;
        }, i * duração / max, i);
    }
}
;
function upev() {
    var numero = document.getElementById('SAEV');
    var min = 290000;
    var max = 300000;
    var duração = 1000;
    for (var i = min; i <= max; i++) {
        setTimeout(function (nr) {
            numero.innerHTML = nr;
        }, i * duração / max, i);
    }
}
;
// window.onload = upup;