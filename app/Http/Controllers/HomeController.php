<?php

namespace App\Http\Controllers;

use App\User;
use App\Klub;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getGrup()
    {
        $grup = Klub::with(['event_packs'=> function ($query) {
            $query->whereYear('created_at', date('Y'));
        }])->get();

        return Datatables::of($grup)
            ->addColumn('action', function ($grup) {
                $retVal = (!isset($grup->event_packs)) ? 'disabled' : '' ;
                $a =    '<a title="Pembayaran" '.$retVal.' href="'.url('pembayaran-page').'/' . base64_encode($grup->id) . '" class="btn btn-icon-only blue" ><i class="fa fa-money"></i></a>'
                        .'<a title="Grup Siap" id="siap" data-value="' . base64_encode($grup->id) . '" class="btn btn-icon-only green" ><i class="fa fa-flag-checkered"></i></a>'
                        .'<a title="Mulai Penilaian" id="play" data-value="' . base64_encode($grup->id) . '" class="btn btn-icon-only green" ><i class="fa fa-play"></i></a>'
                        .'<a title="Stop Penilaian" id="stop" data-value="' . base64_encode($grup->id) . '" class="btn btn-icon-only green" ><i class="fa fa-stop"></i></a>'
                        .'<a title="Upload Rekaman MP3  " id="stop" data-value="' . base64_encode($grup->id) . '" class="btn btn-icon-only green" ><i class="fa fa-music"></i></a>'
                        .'<a title="Tentukan nomor urut tampil" data-toggle="modal" href="#basic"  id="edit" data-value="' . base64_encode($grup->id) . '" class="btn btn-icon-only green" ><i class="fa fa-pencil"></i></a>';
                
                if (Auth::user()->hasRole('unverified')) { // you can pass an id or slug
                    $a = '<span class="label label-success label-sm"> No Action </span>';
                }
                
                return $a;
            })
            ->make(true);
    }

    public function gantiPasswordPage()
    {
        return \view('ganti-password');
    }

    public function gantiPassword(Request $request)
    {
        Validator::make($request->all(), [
            'old_password' => 'required|min:8',
            'new_password' => 'required|min:8',
            'new_password_confirmation' => 'required|min:8',
        ])->validate();

        if ($request->new_password == $request->new_password_confirmation) {
            if (Hash::check($request->old_password, Auth::user()->password)) {
                $user = User::findOrFail(Auth::user()->id);
                $user->update([
                    'password' => Hash::make($request->new_password),
                ]);
                return redirect()->route('password.change')->with(['success' => 'Anda Berhasil Mengganti Password']);
            } else {
                return redirect()->route('password.change')->with(['error' => 'Password Lama Anda Salah!']);
            }
        } else {
            return redirect()->route('password.change')->with(['error' => 'Periksa Kembali Inputan Anda!']);
        }
    }
}
