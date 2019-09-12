@extends('layouts.app')

@section('content')
    <div class="portlet box blue ">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i> Pembayaran Registrasi Lomba </div>
            <div class="tools">
                <a href="" class="collapse"> </a>
            </div>
        </div>
        <div class="portlet-body form">
            <form action="{{url('pembayaran/store')}}" method="post">
                @csrf
                <div class="form-body">
                    <input type="hidden" name="klub_id" value="{{$id}}" required>
                    <div class="form-group form-md-line-input form-md-floating-label">
                        <input type="text" class="form-control input-sm only-num format-number-field" name="jumlah" required>
                        <label for="jumlahPengurban">Nominal</label>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-10">
                                <button type="submit" class="btn blue">PROSES</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection