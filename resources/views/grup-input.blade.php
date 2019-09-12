@extends('layouts.app')

@section('content')
    <div class="portlet box blue ">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i> Data Grup Hadroh </div>
            <div class="tools">
                <a href="" class="collapse"> </a>
            </div>
        </div>
        <div class="portlet-body form">
            <form role="form" method="POST" action="{{route('grup.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="form-group @error('name') has-error @enderror">
                        {{-- <label class="control-label">Nama Grup</label> --}}
                        <input type="text" class="form-control" placeholder="Nama Grup Hadroh" name="name" value="{{old('name')}}"> 
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group @error('foto') has-error @enderror">
                        <label class="control-label">Logo Grup Hadroh</label>
                        <input type="file" class="form-control" name="foto"> 
                        @error('foto')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group @error('alamat') has-error @enderror">
                        {{-- <label class="control-label">Input with error</label> --}}
                        <textarea name="alamat" cols="90" rows="10" placeholder="Alamat Lengkap Grup Hadroh"></textarea>
                        {{-- <input type="text" class="form-control" id="inputError"> --}}
                        @error('alamat')
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
                    <div class="form-group @error('email') has-error @enderror">
                            {{-- <label class="control-label">Nama Grup</label> --}}
                            <input type="email" class="form-control" placeholder="Email Grup" name="email" value="{{old('email')}}"> 
                            @error('email')
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