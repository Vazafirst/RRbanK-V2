    <style>
.intfloat{
        position:fixed;
        bottom:5px;
        left: 90%;
        width: 40px;
        max-width: 40px;
        height: 40px;
        max-height: 40px;
        display: block;
        border-radius: 100px;
        background-color: #DCDCDC;
        text-align: center;
        font-size: 30px;
        border: 2px black solid;
    }

    @keyframes sm{
        0% { display: block;}
        0% { opacity: 0;}
        50% { opacity: 0.5;}
        75% { opacity: 0.8;}
        100% { opacity: 1;}
    }

    .intfloatM{
        position: fixed;
        bottom:47px;
        left: 90%;
        width: 40px;
        height: 40px;
        display: none;
        border-radius: 100px;
        background-color: #DCDCDC;
        text-align: center;
        font-size: 30px;
        border: 2px black solid;
    }
    .intfloatN{
        position: fixed;
        bottom:10px;
        left: 87%;
        width: 40px;
        height: 40px;
        display: none;
        border-radius: 100px;
        background-color: #DCDCDC;
        text-align: center;
        font-size: 30px;
        border: 2px black solid;
    }
    .ifimg{
        margin-top: 5px;
        width: 20px;
        height: 20px;
    }
</style>
<div id="intfloat" onclick="Showmenu()" class="intfloat">
<div id="intfloatM" class="intfloatM"></div>
<div id="intfloatN" class="intfloatN"></div>
<img id="ifimg" class="ifimg" src="static/img/others/intfloat.png"/>
</div>
<script>

        function Showmenu() {
            document.getElementById('intfloat').style.backgroundColor = 'red';
            $("#intfloatM").on('click', function(e){
                e.stopPropagation();
                var ifm = document.getElementById('intfloatM').style.backgroundColor;
                if(ifm == DCDCDC){
                    ifm = "red";
                }
            });
            $("#intfloatN").on('click', function(e){
                e.stopPropagation();
                document.getElementById('intfloatN').style.backgroundColor = 'red';
            });
              $('#intfloatM').slideToggle();
              $('#intfloatN').slideToggle();
        }
    </script>
    <script>
        function Hiddenmenu(){
            document.getElementById('intfloat').style.backgroundColor = 'white';
            document.getElementById('intfloatM').style.display = 'none';
            document.getElementById('intfloatN').style.display = 'none';
        }
    </script>