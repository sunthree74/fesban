<?php

namespace App\Http\Controllers;

use DB;
use App;
use View;
use Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Pembayaran;
use App\EventPack;
use App\User;
use App\Klub;
use App\Mail\GrupQrcode;
use App\Events\GrupReady;
use App\Events\GrupPlay;
use App\Events\GrupStop;
use App\PenguranganPenilaian;

class LombaController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('pendaftaran');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lomba = EventPack::where('klub_id', $request->klub_id)->whereYear('created_at', date('Y'))->first();
        if (isset($lomba)) {
            return redirect()->route('lomba.create')->with(['error' => 'Anda Telah Mendaftarkan Grup Anda Pada '.config('app.name', 'Laravel').' Tahun '.date('Y').'']);
        }

        try {
            EventPack::create([
                'klub_id' => $request->klub_id,
                'judul_lagu' => $request->judul_lagu1."|".$request->judul_lagu2,
            ]);
            return redirect()->route('lomba.create')->with(['success' => 'Anda Berhasil Mendaftar '.config('app.name', 'Laravel').' Tahun '.date('Y').'']);
        } catch (\Exception $e) {
            return redirect()->route('lomba.create')->with(['error' => 'Ada Kesalahan Sistem. { '.$e->getMessage().' }']);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * go to pembayaran page
     */
    public function gotoPembayaranPage($id)
    {
        return \view('pembayaran',compact('id'));
    }

    public function storePembayaran(Request $request)
    {
        try {
            Pembayaran::create([
                'klub_id' => \base64_decode($request->klub_id),
                'jumlah' => $request->jumlah,
                'user_id' => Auth::user()->id,
            ]);
            return redirect()->route('pembayaran.create',$request->klub_id)->with(['success' => 'Pembayaran Berhasil Dicatat']);
        } catch (\Exception $e) {
            return redirect()->route('pembayaran.create',$request->klub_id)->with(['error' => 'Ada Kesalahan Sistem. { '.$e->getMessage().' }']);
        }
        
    }

    protected function makeSQLite()
    {
        try {
            Schema::connection('sqlite')->create('app_config', function($table)
            {
                $table->increments('id');
                $table->integer('uang_registrasi');
                $table->date('tgl_acara');
                $table->date('tgl_tm');
                $table->date('tgl_pengumuman');
                $table->timestamps();
            });
            echo 'Pembuatan SQLite Berhasil!';
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        
    }

    public function gotoPengaturanPage()
    {
        return \view('pengaturan');
    }

    public function storePengaturan(Request $request)
    {
        try {
            DB::connection('sqlite')->table('app_config')->insert([
                [   'uang_registrasi' => $request->jumlah,
                    'tgl_acara' => $request->formattedacara,
                    'tgl_tm' => $request->formattedtm,]
            ]);
            return redirect()->route('pengaturan.create')->with(['success' => 'Data Acara Berhasil Dicatat']);
        } catch (\Exception $e) {
            return redirect()->route('pengaturan.create')->with(['error' => 'Ada Kesalahan Sistem. { '.$e->getMessage().' }']);
        }
    }

    public function nomorUrut(Request $request)
    {
        try {
            $a = EventPack::where('klub_id',base64_decode($request->klub_id))->first();
            if (isset($a)) {
                $a->nomor_urut = $request->nomorurut;
                $a->save();
            } else {
                EventPack::create([
                    'klub_id' => base64_decode($request->klub_id),
                    'nomor_urut' => $request->nomorurut,
                ]);
            }
            
            

            $g = Klub::with(['event_packs' => function ($query) {
                $query->whereYear('created_at', date('Y'))->first();
            },'user'])->find(base64_decode($request->klub_id));
            $u = User::find($g->user_id);
            $grup= $g;
            $view = View::make('pdf-attachment', compact('grup'));
            $contents = $view->render();
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($contents);
            $output = $pdf->output();

            $t = Storage::disk('local')->put('qrcode/'.$g->grup_number.'.pdf', $output);
            
            Mail::to($g->user->email)->send(new GrupQrcode($g));
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function readyPlay($id)
    {
        $g = Klub::with(['event_packs'=> function ($query) {
            $query->whereYear('created_at', date('Y'));
        }])->where('id', base64_decode($id))->first();

        \event(new GrupReady($g));
    }

    public function grupPlay($id)
    {
        $g = Klub::where('id', base64_decode($id))->first();

        \event(new GrupPlay($g));
    }

    public function grupStop($id)
    {
        $g = Klub::where('id', base64_decode($id))->first();

        \event(new GrupStop($g));
    }

    public function scanner($jenis)
    {
        return \view('scanner', compact('jenis'));
    }

    public function eventPackCheck($jenis,$grupnumber)
    {
        try {
            $k = Klub::where('grup_number', $grupnumber)->first();
            $e = EventPack::where('klub_id', $k->id)->whereYear('created_at', date('Y'))->first();
            $batasRegistrasi =date("14:40:00");
            if ($jenis == 'registrasi') {
                if ($e->registrasi == 'sudah') {
                    return response()->json([
                        'msg' => "Grup ".$k->name." Sudah Melakukan Registrasi",
                        'klub_id' => $k->id,
                    ]);
                } else {
                    $e->registrasi = 'sudah';
                    $e->status = 'menunggu';
                    $e->save();
                    
                    if (date('H:i:s') > $batasRegistrasi) {
                        PenguranganPenilaian::create([
                            'klub_id' => $k->id,
                            'jenis' => 'telat daftar atau datang',
                            'jumlah' => 15,
                        ]);
                        return response()->json([
                            'msg' => "Grup ".$k->name." Telah Melewati Batas Waktu Registrasi",
                            'klub_id' => $k->id,
                        ]);
                    }
                    return response()->json([
                        'msg' => "Registrasi Grup ".$k->name." Berhasil",
                        'klub_id' => $k->id,
                    ]);
                }
                
            } else if ($jenis == 'snack') {
                if ($e->snack == 'sudah') {
                    return response()->json([
                        'msg' => "Snack Grup ".$k->name." Sudah Diambil. Tidak Bisa Melakukan Pengambilan Snack Dua Kali",
                        'klub_id' => $k->id,
                    ]);
                } else {
                    $e->snack = 'sudah';
                    $e->save();
        
                    return response()->json([
                        'msg' => "Pengambilan Snack Grup ".$k->name." Berhasil",
                        'klub_id' => $k->id,
                    ]); 
                }
                
            } else if ($jenis == 'photobooth') {
                if ($e->photo == 'sudah') {
                    return response()->json([
                        'msg' => "Photobooth Grup ".$k->name." Sudah Dilakukan. Tidak Bisa Melakukan Photobooth Dua Kali",
                        'klub_id' => $k->id,
                    ]);
                } else {
                    $e->photo = 'sudah';
                    $e->save();

                    return response()->json([
                        'msg' => "Photobooth Grup ".$k->name." Berhasil",
                        'klub_id' => $k->id,
                    ]);
                }
            }
        } catch (\Exception $e) {
            return response("Ada Kesalahan Sistem. ", 500);
        }
    }

    public function storeSholawat(Request $request)
    {
        try {
            $e = EventPack::where('klub_id',$request->klub_id)->first();
            $s = $request->sholawat1."|".$request->sholawat2;
            $e->judul_lagu = $s;
            $e->save();
            return redirect()->route('scanner', 'registrasi')->with(['success' => 'Judul Sholawat Berhasil Dicatat']);
        } catch (\Exception $e) {
            return redirect()->route('scanner', 'registrasi')->with(['error' => 'Ada Kesalahan Sistem. { '.$e->getMessage().' }']);
        }
    }
}
