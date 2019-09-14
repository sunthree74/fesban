<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Penilaian Final {{config('app.name', 'Laravel')}}</title>
    <link href="{{ asset('assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
    <!--jQuery-->
    <script src="{{ asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
    <style>
        .table-text{
            font-size: 25px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <br><br>
                <h1 align="center">Urutan Pemenang {{config('app.name', 'Laravel')}} Tahun {{date('Y')}}</h1>
                <br>
                <table class="table table-border table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Grup</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nilai as $n)
                            <tr>
                                <td width="10%" class="table-text">{{$loop->iteration}}</td>
                                <td class="table-text">{{$n['name']}}</td>
                                <th class="table-text">{{$n['nilai']}}</th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>