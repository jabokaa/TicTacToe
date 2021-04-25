
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css"/> 
    <meta name="csrf-token" content="{{ csrf_token() }}" />   
</head>
<style>
    .jogo{
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
<div>
<<<<<<< HEAD
<div><a href="{{URL::to('game')}}">Nuevo Juego</a><br>
    <div class="ml-4 text-lg leading-7 font-semibold"><a id="entrar" class="underline text-gray-900 dark:text-white">Entrar en Juego</a>
        <input type="number" id="codigoDeLaSala" name="codigoDeLaSala" class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg"><br>
    </div>
    Es el turno del jugador : {{$gameRoom->gamerTurn}}<br>
    Tu eres el jugador: {{ Cookie::get('idGamer') }}<br>
    La sala es: {{ $gameRoom->id }}<br>
</div>
=======
<p><a href="{{URL::to('game')}}">Nuevo Juego</a></p>
>>>>>>> b512f3681ddd173e2db94001268382ed138067fd
<h1>{{$gameRoom->gameState}}</h1>
</div>
        <div class="jogo" id='game'>
            <div class="linha">
                <div class="casa" id="Square1">{{$gameRoom->Square1}}</div>
                <div class="casa" id="Square2">{{$gameRoom->Square2}}</div>
                <div class="casa" id="Square3">{{$gameRoom->Square3}}</div>
            </div>
            <div class="linha">
                <div class="casa" id="Square4">{{$gameRoom->Square4}}</div>
                <div class="casa" id="Square5">{{$gameRoom->Square5}}</div>
                <div class="casa" id="Square6">{{$gameRoom->Square6}}</div>
            </div>
            <div class="linha">
                <div class="casa" id="Square7">{{$gameRoom->Square7}}</div>
                <div class="casa" id="Square8">{{$gameRoom->Square8}}</div>
                <div class="casa" id="Square9">{{$gameRoom->Square9}}</div>
            </div>
        </div>
        <div id="resultado"></div>
<<<<<<< HEAD
=======
        <p>Jogador 1: {{$gameRoom->gamer1Id}}, Jogador 2: {{$gameRoom->gamer2Id}}, sala: {{$gameRoom->id}}
>>>>>>> b512f3681ddd173e2db94001268382ed138067fd
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

            $( ".casa" )
            .mouseleave(function() {
                window.location.href = "{{URL::to('game/'.$gameRoom->id)}}"
             });
<<<<<<< HEAD

             $( "#entrar" ).click(function() {
                $teste =  "/"+document.getElementById("codigoDeLaSala").value;
                window.location.href = "{{URL::to('game/')}}"+ $teste;
            });
=======
>>>>>>> b512f3681ddd173e2db94001268382ed138067fd
        </script>
</body>
