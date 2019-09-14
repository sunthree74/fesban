@extends('layouts.app')

@section('content')
<div id="scanner-player" style="padding-bottom: 30px">
</div>
<div class="portlet box blue ">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i> Manual Input Id </div>
    </div>
    <div class="portlet-body form">
        <form role="form" method="POST" action="">
            <div class="form-body">
                <div class="form-group">
                    <input type="text" class="form-control" id="id-grup" placeholder="Id Grup" name="grup_number">
                </div>
            </div>
            <div class="form-actions">
                <button type="button" id="submit-manual" class="btn blue">Submit</button>
            </div>
        </form>
    </div>
</div>
@if ($jenis == 'registrasi')
<div class="portlet box blue ">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i> Judul Sholawat </div>
        <div class="tools">
            <a href="" class="collapse"> </a>
        </div>
    </div>
    <div class="portlet-body form">
        <form role="form" method="POST" action="{{route('sholawat.store')}}">
            @csrf
            <input type="hidden" name="klub_id" class="klub_id" required>
            <div class="form-body">
                <div class="form-group @error('sholawat1') has-error @enderror">
                        {{-- <label class="control-label">Nama Grup</label> --}}
                        <input type="text" class="form-control" placeholder="Sholawat 1" name="sholawat1" required > 
                        @error('sholawat1')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group @error('sholawat2') has-error @enderror">
                        {{-- <label class="control-label">Nama Grup</label> --}}
                        <input type="text" class="form-control" placeholder="Sholawat 2" name="sholawat2" required> 
                        @error('sholawat2')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" id="submit-form" disabled class="btn blue">Submit</button>
                <button type="button" class="btn btn-danger" id="pengurangan">Tidak Bawa Teks Sholawat</button>
            </div>
        </form>
        <form action="" method="POST" id="pengurangan-form">
            <input type="hidden" name="jenis" value="tidak membawa teks">
            <input type="hidden" name="id" class="klub_id" required>
        </form>
    </div>
</div>
@endif
    
    <script>
        var id;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if( /Android|Mozilla|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        var a = '<div class="row"><div class="col-xs-12"><div class="embed-responsive embed-responsive-16by9"><video id="preview" class="embed-responsive-item"></video></div></div></div>';
        $("#scanner-player").html(a)
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview'), mirror: false });
        var url = "{{url('event-pack/check').'/'.$jenis.'/'}}";
        scanner.addListener('scan', function (content) {
            $.ajax({
                url: url+content,
                type: "PUT",
                success : function(a){
                    alert(a.msg);
                    $(".klub_id").val(a.klub_id);
                    $('#submit-form').attr("disabled", false);
                },
                error : function (a) {
                    alert(a)
                }
            });
        });
        $("#submit-manual").click(function () {
            var id = $("#id-grup").val();
            $.ajax({
                url: url+id,
                type: "PUT",
                success : function(a){
                    alert(a.msg);
                    $(".klub_id").val(a.klub_id);
                    $('#submit-form').attr("disabled", false);
                },
                error : function (a) {
                    alert(a)
                }
            });
        })
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
            var selectedCam = cameras[0];
            $.each(cameras, (i, c) => {
                if (c.name.indexOf('back') != -1) {
                    selectedCam = c;
                    return false;
                }
            });

            scanner.start(selectedCam);
            // scanner.start(cameras[1]);
            } else {
            alert('Tidak Dapat Mendeteksi Kamera');
            console.error('No cameras found.');
            }
        }).catch(function (e) {
            console.error(e);
        });
        }
        $("#pengurangan").click(function () {
            $.ajax({
                url: "{{route('nilai.pengurangan')}}",
                type: "POST",
                data: $("#pengurangan-form").serialize(),
                success : function(a){
                    alert(a);
                },
                error : function (a) {
                    alert("Ada Kesalahan Sistem. "+a);
                }
            });
        })
    </script>
@endsection