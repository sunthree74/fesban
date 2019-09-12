@extends('layouts.app')

@section('content')
    <div class="portlet box blue ">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i> Data Anggota Grup Hadroh </div>
            <div class="tools">
                <a href="" class="collapse"> </a>
            </div>
        </div>
        <div class="portlet-body form">
            <form role="form" method="POST" action="{{route('anggota.update')}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="klub_id" value="{{Auth::user()->klub->id}}">
                <input type="hidden" name="id" value="{{Auth::user()->klub->id}}">
                <div class="form-body">
                    <div class="form-group @error('name') has-error @enderror">
                        {{-- <label class="control-label">Nama Grup</label> --}}
                        <input type="text" class="form-control" name="name" value="{{$anggota->name}}"> 
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">
                        <img src="{{asset('uploaded').'/'.$anggota->foto}}" alt="foto-profil" /> </div>
                    <div class="form-group @error('foto') has-error @enderror">
                        <label class="control-label">Foto Anggota</label>
                        <input type="file" class="form-control" name="foto"> 
                        @error('foto')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group @error('nohp') has-error @enderror">
                            {{-- <label class="control-label">Nama Grup</label> --}}
                            <input type="text" class="form-control" name="nohp" required value="{{$anggota->nohp}}"> 
                            @error('nohp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="form-group @error('tempat_lahir') has-error @enderror">
                            {{-- <label class="control-label">Nama Grup</label> --}}
                            <input type="text" class="form-control" name="tempat_lahir" value="{{$anggota->tempat_lahir}}"> 
                            @error('tempat_lahir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="form-group @error('tanggal_lahir') has-error @enderror">
                        {{-- <label class="control-label">Nama Grup</label> --}}
                        <input type="text" class="form-control date-picker" id="tanggal_lahir" name="tanggal_lahir" value="{{$anggota->tanggal_lahir}}"> 
                        <input type="hidden" name="formatteddate" id="formatted">
                        <div id="calend" style="padding-top=20px;"></div>
                        @error('tanggal_lahir')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn red">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection