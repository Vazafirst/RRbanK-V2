<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
        <link rel="stylesheet" href="css/style.css">
        <style>
            .loading{
                position: absolute;
                top: 0; bottom: 0;
                left: 0; right: 0;
                margin: auto;
                border: 0px;
                width: 700px;
                height: 300px;
                min-width: 400px;
                min-height: 400px;
                border-radius: 10px;
                background-color: rgba(0,0,0,0);
            }
            .lds-ring {
                display: inline-block;
                position: relative;
                width: 80px;
                height: 80px;
                z-index: 8;
            }
            .lds-ring div {
                box-sizing: border-box;
                display: block;
                position: absolute;
                width: 64px;
                top: 160px;
                left: 310px;
                height: 64px;
                margin: 8px;
                border: 8px solid #fff;
                border-radius: 50%;
                animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
                border-color: #fff transparent transparent transparent;
                z-index: 8;
            }
            .lds-ring div:nth-child(1) {
                animation-delay: -0.45s;
            }
            .lds-ring div:nth-child(2) {
                animation-delay: -0.3s;
            }
            .lds-ring div:nth-child(3) {
                animation-delay: -0.15s;
            }
            @keyframes lds-ring {
                0% {
                    transform: rotate(0deg);
                }
                100% {
                    transform: rotate(360deg);
                }
            }

        </style>  
    </head>
    <body>
        <div class="loading">
            <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
        </div>
    </body>
</html>
