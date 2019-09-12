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
            <form role="form" method="POST" action="{{route('anggota.store')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="klub_id" value="{{Auth::user()->klub->id}}">
                <div class="form-body">
                    <div class="form-group @error('name') has-error @enderror">
                        {{-- <label class="control-label">Nama Grup</label> --}}
                        <input type="text" class="form-control" placeholder="Nama Anggota Grup Hadroh" name="name" value="{{old('name')}}"> 
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
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
                            <input type="text" class="form-control" placeholder="Nomor HP Grup" name="nohp" required value="{{old('nohp')}}"> 
                            @error('nohp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="form-group @error('tempat_lahir') has-error @enderror">
                            {{-- <label class="control-label">Nama Grup</label> --}}
                            <input type="text" class="form-control" placeholder="Tempat Lahir Anggota" name="tempat_lahir" value="{{old('tempat_lahir')}}"> 
                            @error('tempat_lahir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="form-group @error('tanggal_lahir') has-error @enderror">
                        {{-- <label class="control-label">Nama Grup</label> --}}
                        <input type="text" class="form-control date-picker" placeholder="Tanggal Lahir Anggota" id="tanggal_lahir" name="tanggal_lahir" value="{{old('tanggal_lahir')}}"> 
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