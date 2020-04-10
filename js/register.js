var btnt = document.getElementById('hterm');
var closet = document.getElementById('btn_fechar');
btnt.addEventListener('click', function () {
    $('#termos').fadeIn();
});
closet.addEventListener('click', function () {
    $('#termos').fadeOut();
});