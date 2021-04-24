
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>    
</head>
<style>
    #jogo{
        width:603px;
        height:600px;
        border:solid 3px
    }
    
    .linha{
        height:200px;
        border-bottom:solid 1px;
    }
    
    .casa{
        width:200px;
        height:100%;
        border-right:solid 1px;
        float:left;
    }
</style>
<body>
        <div id="jogo">
            <div class="linha">
                <div class="casa" id="casa1"></div>
                <div class="casa" id="casa2"></div>
                <div class="casa" id="casa3"></div>
            </div>
            <div class="linha">
                <div class="casa" id="casa4"></div>
                <div class="casa" id="casa5"></div>
                <div class="casa" id="casa6"></div>
            </div>
            <div class="linha">
                <div class="casa" id="casa7"></div>
                <div class="casa" id="casa8"></div>
                <div class="casa" id="casa9"></div>
            </div>
        </div>
        <div id="resultado"></div>
        <p>{{$gameRoom->gamer1Id}}</p>
        <p>{{$gameRoom->id}}</p>
</body>
