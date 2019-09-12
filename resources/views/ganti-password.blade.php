@extends('layouts.app')

@section('content')
    <div class="portlet box blue ">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i> Ganti Password </div>
            <div class="tools">
                <a href="" class="collapse"> </a>
            </div>
        </div>
        <div class="portlet-body form">
            <form role="form" method="POST" action="{{route('password.ganti')}}">
                @csrf
                @method('PUT')
                <div class="form-body">
                    <div class="form-group @error('old_password') has-error @enderror">
                        {{-- <label class="control-label">Nama Grup</label> --}}
                        <input type="password" class="form-control" placeholder="Password Lama" name="old_password" required> 
                        @error('old_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group @error('new_password') has-error @enderror">
                            {{-- <label class="control-label">Nama Grup</label> --}}
                            <input type="password" class="form-control" placeholder="Password Baru" name="new_password" required > 
                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="form-group @error('new_password_confirmation') has-error @enderror">
                            {{-- <label class="control-label">Nama Grup</label> --}}
                            <input type="password" class="form-control" placeholder="Konfirmasi Password Baru" name="new_password_confirmation" required> 
                            @error('new_password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn red">Ganti</button>
                </div>
            </form>
        </div>
    </div>
@endsection