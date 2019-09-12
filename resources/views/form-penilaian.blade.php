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
    <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 align="center">Form Penilaian {{$jenis}}</h1>
                <h2 align="center" id="nama-grup">Grup</h2>
            <p>Lagu : {{$lagu[0]}}</p>
            </div>
            <div class="col-md-12">
                <form action="" class="form-inline">
                    @csrf
                    <input type="hidden" name="klub_id" id="klub_id">
                    <table class="table table-hover">
                            <thead>
                              <tr>
                                <th scope="col" width="3%">No.</th>
                                <th scope="col" width="30%">Jenis yang dinilai</th>
                                <th scope="col" width="3%">Max</th>
                                <th scope="col" width="3%">Min</th>
                                <th scope="col" style="text-align: center;">Jali</th>
                                <th scope="col" style="text-align: center;">Khofi</th>
                              </tr>
                            </thead>
                            <tbody>
                                @php
                                    $max = 8;
                                @endphp
                                @foreach ($param as $p)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$p->parameter}}</td>
                                        <td>{{$max}}</td>
                                        <td>2</td>
                                        <td style="text-align: center;">
                                            <div class="form-group">
                                                @for ($i = 1; $i <= $max; $i++)
                                                        <input class="form-check-input" type="radio" name="jali_{{$p->parameter}}" value="{{$i}}" >
                                                        <label class="form-check-label" for="exampleRadios3">
                                                            {{$i}}
                                                        </label>
                                                @endfor
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            @for ($i = 1; $i <= $max; $i++)
                                                <div class="form-group">
                                                    <input class="form-check-input" type="radio" name="khofi_{{$p->parameter}}" value="{{$i}}" >
                                                    <label class="form-check-label" for="exampleRadios3">
                                                        {{$i}}
                                                    </label>
                                                </div>
                                            @endfor
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6" style="text-align: center;">
                                        <textarea name="comment" id="1" cols="120" rows="5" placeholder="catatan"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6">
                                        <button type="button" class="btn btn-primary">Nilai</button>
                                    </td>
                                </tr>
                            </tbody>
                    </table>
                </form>
            </div>
        </div>
        <div class="row">
                <div class="col-md-12">
                    <h1 align="center">Form Penilaian {{$jenis}}</h1>
                    <h2 align="center" id="nama-grup">Grup</h2>
                <p>Lagu : {{$lagu[1]}}</p>
                </div>
                <div class="col-md-12">
                    <form action="" class="form-inline">
                        @csrf
                        <input type="hidden" name="klub_id" id="klub_id">
                        <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th scope="col" width="3%">No.</th>
                                    <th scope="col" width="30%">Jenis yang dinilai</th>
                                    <th scope="col" width="3%">Max</th>
                                    <th scope="col" width="3%">Min</th>
                                    <th scope="col" style="text-align: center;">Jali</th>
                                    <th scope="col" style="text-align: center;">Khofi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $max = 8;
                                    @endphp
                                    @foreach ($param as $p)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{$p->parameter}}</td>
                                            <td>{{$max}}</td>
                                            <td>2</td>
                                            <td style="text-align: center;">
                                                <div class="form-group">
                                                    @for ($i = 1; $i <= $max; $i++)
                                                            <input class="form-check-input" type="radio" name="jali_{{$p->parameter}}" value="{{$i}}" >
                                                            <label class="form-check-label" for="exampleRadios3">
                                                                {{$i}}
                                                            </label>
                                                    @endfor
                                                </div>
                                            </td>
                                            <td style="text-align: center;">
                                                @for ($i = 1; $i <= $max; $i++)
                                                    <div class="form-group">
                                                        <input class="form-check-input" type="radio" name="khofi_{{$p->parameter}}" value="{{$i}}" >
                                                        <label class="form-check-label" for="exampleRadios3">
                                                            {{$i}}
                                                        </label>
                                                    </div>
                                                @endfor
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="6" style="text-align: center;">
                                            <textarea name="comment" id="1" cols="120" rows="5" placeholder="catatan"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <button type="button" class="btn btn-primary">Nilai</button>
                                        </td>
                                    </tr>
                                </tbody>
                        </table>
                    </form>
                </div>
            </div>
    </div>

<script>

    var pusher = new Pusher('394571fe7210979dd5ac', {
                cluster: 'ap1',
                forceTLS: true,
            });
    var grupReady = pusher.subscribe('grup-ready');
    grupReady.bind('App\\Events\\GrupReady', function(data) {
        console.log(data);
        $('#nama-grup').text("Grup "+data.grup.name);
        $('#klub_id').val(data.grup.id);
    });

</script>

</body>
</html>