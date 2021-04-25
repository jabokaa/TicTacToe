
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css"/> 
    <meta name="csrf-token" content="{{ csrf_token() }}" />   
</head>
<style>
    .jogo{
        width:603px;
        height:600px;
        border:solid 3px;
        background-image: url("/juego.jpg");
        border-color: rgba(0,0,0,0);
    }
    
    .linha{
        height:200px;
        border-bottom:solid 1px;
        border-color: rgba(0,0,0,0);
    }
    
    .casa{
        width:200px;
        height:100%;
        border-right:solid 1px;
        float:left;
        border-color: rgba(0,0,0,0);
    }
</style>
<body>
<div>

<div> <a href="{{URL::to('game')}}"><button>Nuevo Juego</button></a><br><br>
    <button id="entrar">Entrar en Juego</button>
        <input type="number" id="codigoDeLaSala" name="codigoDeLaSala" class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg"><br>
    </div>
    <br>
    <button href="{{URL::to('game')}}">Nuevo Juego</button>
    @if($gameRoom->gameState != '')<button id="reiniciar" type="button">Reiniciar</button>@endif<br><br>
    Es el turno del jugador : {{$gameRoom->gamerTurn}}<br>
    Tu eres el jugador: {{ Cookie::get('idGamer') }}<br>
    La sala es: {{ $gameRoom->id }}<br><br>
    <button id="actualizar" type="button">Actualizar</button><br>
</div>
<h1>{{$gameRoom->gameState}}</h1>
</div>
        <div class="jogo" id='game'>
            <div class="linha">
                <div class="casa" id="Square1">@if($gameRoom->Square1 != '')<img src='/{{$gameRoom->Square1}}'style="width: 100%;">@endif</div>
                <div class="casa" id="Square2">@if($gameRoom->Square2 != '')<img src='/{{$gameRoom->Square2}}'style="width: 100%;">@endif</div>
                <div class="casa" id="Square3">@if($gameRoom->Square3 != '')<img src='/{{$gameRoom->Square3}}'style="width: 100%;">@endif</div>
            </div>
            <div class="linha">
                <div class="casa" id="Square4">@if($gameRoom->Square4 != '')<img src='/{{$gameRoom->Square4}}'style="width: 100%;">@endif</div>
                <div class="casa" id="Square5">@if($gameRoom->Square5 != '')<img src='/{{$gameRoom->Square5}}'style="width: 100%;">@endif</div>
                <div class="casa" id="Square6">@if($gameRoom->Square6 != '')<img src='/{{$gameRoom->Square6}}'style="width: 100%;">@endif</div>
            </div>
            <div class="linha" style="border-bottom-color: #ffffff;">
                <div class="casa" id="Square7">@if($gameRoom->Square7 != '')<img src='/{{$gameRoom->Square7}}'style="width: 100%;">@endif</div>
                <div class="casa" id="Square8">@if($gameRoom->Square8 != '')<img src='/{{$gameRoom->Square8}}'style="width: 100%;">@endif</div>
                <div class="casa" id="Square9">@if($gameRoom->Square9 != '')<img src='/{{$gameRoom->Square9}}'style="width: 100%;">@endif</div>
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
        </script>
</body>
