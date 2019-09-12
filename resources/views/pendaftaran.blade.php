@extends('layouts.app')

@section('content')
    <div class="portlet box blue ">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i> Pendaftaran Lomba </div>
            <div class="tools">
                <a href="" class="collapse"> </a>
            </div>
        </div>
        <div class="portlet-body form">
            <form role="form" method="POST" action="{{route('lomba.store')}}" >
                @csrf
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label">Nama Grup</label>
                        <input type="text" class="form-control" name="namegrup" readonly value="{{Auth::user()->klub->name}}">
                        <input type="hidden" name="klub_id" value="{{Auth::user()->klub->id}}">
                    </div>
                    <div class="form-group @error('judul_lagu1') has-error @enderror">
                        {{-- <label class="control-label">Judul Lagu 1</label> --}}
                        <input type="text" class="form-control" placeholder="Judul Lagu 1" name="judul_lagu1"> 
                        @error('judul_lagu1')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group @error('judul_lagu2') has-error @enderror">
                        {{-- <label class="control-label">Judul Lagu 2</label> --}}
                        <input type="text" class="form-control" placeholder="Judul Lagu 2" name="judul_lagu2"> 
                        @error('judul_lagu2')
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