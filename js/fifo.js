var btndp = document.getElementById('btndp');
var btnsq = document.getElementById('btnsq');
var divdp = document.getElementById('dp');
var divsq = document.getElementById('sq');
var cdsq = document.getElementById('cdsq');
var cddp = document.getElementById('cddp');

btndp.addEventListener('click', function () {
    $('#dp').slideToggle();
    divsq.style.display = 'none';
    document.getElementById("inpdp").focus();
});
btnsq.addEventListener('click', function () {
    $('#sq').fadeIn();
    divdp.style.display = 'none';
    document.getElementById("inpsq").focus();
});
cddp.addEventListener('click', function () {
    $('#dp').slideToggle();
});
cdsq.addEventListener('click', function () {
    $('#sq').fadeOut();
});