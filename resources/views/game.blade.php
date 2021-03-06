
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css"/> 
    <meta name="csrf-token" content="{{ csrf_token() }}" />   
</head>
<style>
    .jogo{
        width:603px;
        height:600px;
        border:solid 3px;
        background-image: url({{asset("juego.jpg")}});
        border-color: rgba(0,0,0,0);
    }
    
    .linha{
        height:200px;
        border-bottom:solid 1px;
        border-color: rgba(0,0,0,0);
    }
    .divLinia{
        display: flex;
        flex-flow: row wrap;
    }
    .letra{
        font-size: 20px;
        color: rgba(255, 255, 255, 0.9);
        font-family: "Comic Sans MS", cursive, sans-serif;
    }
    
    .casa{
        width:200px;
        height:100%;
        border-right:solid 1px;
        float:left;
        border-color: rgba(0,0,0,0);
    }

    .coluna-33 {
        width: 33%;
    }
    .coluna-67 {
        width: 66%;
    }
</style>
<body style="background-image: url({{asset('fondo.png')}});">
<div class='divLinia'>
    <div  class="coluna-33">
        <div> <a href="{{URL::to('game')}}"><button>Nuevo Juego</button></a><br><br>
            <button id="entrar">Entrar en Juego</button>
                <input type="number" id="codigoDeLaSala" name="codigoDeLaSala" class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg"><br>
            </div>
            <br>
            @if($gameRoom->gameState != '')<button id="reiniciar" type="button">Reiniciar</button>@endif<br><br>
            <p class='letra'>
            Es el turno del jugador : {{$gameRoom->gamerTurn}}<br>
            Tu eres el jugador: {{ Cookie::get('idGamer') }}<br>
            La sala es: {{ $gameRoom->id }}<br><br></p>
            <button id="actualizar" type="button">Actualizar</button><br>
        </div>
        <h1>{{$gameRoom->gameState}}</h1>
    </div>
    <div class="jogo" id='game'  class="coluna-67">
        <div class="linha">
            <div class="casa" id="Square1">@if($gameRoom->Square1 != '')<img src='{{asset($gameRoom->Square1)}}'style="width: 100%;">@endif</div>
            <div class="casa" id="Square2">@if($gameRoom->Square2 != '')<img src='{{asset($gameRoom->Square2)}}'style="width: 100%;">@endif</div>
            <div class="casa" id="Square3">@if($gameRoom->Square3 != '')<img src='{{asset($gameRoom->Square3)}}'style="width: 100%;">@endif</div>
        </div>
        <div class="linha">
            <div class="casa" id="Square4">@if($gameRoom->Square4 != '')<img src='{{asset($gameRoom->Square4)}}'style="width: 100%;">@endif</div>
            <div class="casa" id="Square5">@if($gameRoom->Square5 != '')<img src='{{asset($gameRoom->Square5)}}'style="width: 100%;">@endif</div>
            <div class="casa" id="Square6">@if($gameRoom->Square6 != '')<img src='{{asset($gameRoom->Square6)}}'style="width: 100%;">@endif</div>
        </div>
        <div class="linha">
            <div class="casa" id="Square7">@if($gameRoom->Square7 != '')<img src='{{asset($gameRoom->Square7)}}'style="width: 100%;">@endif</div>
            <div class="casa" id="Square8">@if($gameRoom->Square8 != '')<img src='{{asset($gameRoom->Square8)}}'style="width: 100%;">@endif</div>
            <div class="casa" id="Square9">@if($gameRoom->Square9 != '')<img src='{{asset($gameRoom->Square9)}}'style="width: 100%;">@endif</div>
        </div>
    </div>
</div>
        <div id="resultado"></div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
        <script>
            $('.casa').on('click',function(){ 

                var squareId = $(this).attr('id');
                $.ajax({ 
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{url("jugar")}}', 
                    type: 'PUT', 
                    data: {square:squareId , idGameRoom:{{$gameRoom->id}}},
                    success: function(data) { 
                        window.location.href = "{{URL::to('game/'.$gameRoom->id)}}"
                    } 
                }); 
            });

            $('#reiniciar').on('click',function(){ 
            var squareId = $(this).attr('id');
                $.ajax({ 
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{url("restartGame")}}', 
                    type: 'PUT', 
                    data: {idGameRoom:{{$gameRoom->id}}},
                    success: function(data) { 
                        window.location.href = "{{URL::to('game/'.$gameRoom->id)}}"
                    } 
                }); 
            });

            $('#actualizar').on('click',function(){ 
                window.location.href = "{{URL::to('game/'.$gameRoom->id)}}";
            });

             $( "#entrar" ).click(function() {
                $teste =  "/"+document.getElementById("codigoDeLaSala").value;
                window.location.href = "{{URL::to('game/')}}"+ $teste;
            });

            var time = 4000; // 1s

            setTimeout(function(){ 
                window.location.href = "{{URL::to('game/'.$gameRoom->id)}}";
            }, time);
        </script>
</body>
