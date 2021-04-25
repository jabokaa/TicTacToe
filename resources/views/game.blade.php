
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
<p><a href="{{URL::to('game')}}">Nuevo Juego</a></p>
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
        <p>Jogador 1: {{$gameRoom->gamer1Id}}, Jogador 2: {{$gameRoom->gamer2Id}}, sala: {{$gameRoom->id}}
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
        </script>
</body>
