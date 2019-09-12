<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Timer {{config('app.name', 'Laravel')}}</title>
    <link href="{{ asset('assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
    <!--jQuery-->
    <script src="{{ asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
    {{-- <script src="https://js.pusher.com/4.4/pusher.min.js"></script> --}}
    <style>
        body{
            background-color: #1B5E20;
        }
        h1{
            font-size: 400px;
            font-weight: bold;
            color: white;
        }
        html, body, .container-table {
            height: 100%;
            
        }
        .container-table {
            display: table;
        }
        .vertical-center-row {
            display: table-cell;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="container container-table">
        <div class="row vertical-center-row">
            <div class="text-center col-md-2 col-md-offset-1">
                <h1 id="timer">00:00</h1>
            </div>
            <div class="col-md-12">
                <button class="btn btn-sm btn-primary" id="start">MULAI</button>
                <button class="btn btn-sm btn-danger" id="stop">STOP</button>
            </div>
        </div>
    </div>
    
    <script>
        var totalSeconds = 0;
        var isPaused = false;
        var minutes, seconds, jml;

        function setTime() {
            ++totalSeconds;
            minutes = pad(parseInt(totalSeconds / 60));
            seconds = pad(totalSeconds % 60);
            if (isPaused == false) {
                $('body').css("background-color", '#1B5E20');
                $("#timer").html(minutes+":"+seconds);
                if (minutes == 11) {
                    $('body').css("background-color", '#B71C1C');
                    isPaused = true;
                } else if (minutes == 10) {
                    $('body').css("background-color", '#F57F17');
                }
            }
        }

        function pad(val) {
            var valString = val + "";
            if (valString.length < 2) {
                return "0" + valString;
            } else {
                return valString;
            }
        }

        $("#start").click(function () {
            setInterval(setTime, 1000);
        });
        $("#stop").click(function () {
            isPaused = true;
            var pengurangan;
            if (minutes == 11 ) {
                pengurangan = 'ada';
            } else {
                pengurangan = 'tidak';
            }
            window.location.replace("{{url('penilaian/timer-calculation').'/'.$id.'/'}}"+pengurangan);
        });

    </script>
</body>
</html>