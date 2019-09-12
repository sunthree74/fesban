<?php

namespace App\Http\Controllers;

use App\Klub;
use App\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GrupHadrohController extends Controller
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
        return \view('grup-input');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'nohp' => 'required | numeric',
        ])->validate();

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('logo_grup', 'local');
        } else {
            $foto = 'no-photo.jpg';
        }
        
            
        try {
            Klub::create([
                'grup_number' => $this->makeGrupnumber(),
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'alamat' => $request->alamat,
                'nohp' => $request->nohp,
                'email' => $request->email,
                'foto' => $foto,
            ]);
    
            return redirect()->route('grup.create')->with(['success' => 'Anda Berhasil Mengisi Data Grup']);
        } catch (\Exception $e) {
            return redirect()->route('grup.create')->with(['error' => 'Ada Kesalahan Sistem. {'.$e->getMessage().'}']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $grup = Auth::user()->klub;

        return \view('grup-page', compact('grup'));
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
    public function update(Request $request)
    {
        try {
            $g = Klub::find($request->id);

            $g->name = $request->name;
            $g->alamat = $request->alamat;
            $g->email = $request->email;
            $g->nohp = $request->nohp;
            $g->save();
            return redirect()->route('grup.show')->with(['success' => 'Data Grup Berhasil Disimpan']);
        } catch (\Exception $e) {
            return redirect()->route('grup.show')->with(['error' => 'Ada Kesalahan Sistem. {'.$e->getMessage().'}']);
        }
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
     * 
     * function to make grup number for identification
     */
    public function makeGrupnumber()
    {
        return $this->randomNumber(4).date('dmy');
    }

    /**
     * 
     * function to make random number
     */
    public function randomNumber($length) {
        $result = '';
    
        for($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9);
        }
    
        return $result;
    }

    /**
     * 
     * create new anggota data
     */
    public function createAnggota()
    {
        return \view('anggota-input');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAnggota(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
        ])->validate();

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('foto_anggota', 'local');
        } else {
            $foto = 'no-photo.jpg';
        }
            
        try {
            // dd($request);
            Anggota::create([
                'klub_id' => $request->klub_id,
                'name' => $request->name,
                'nohp' => $request->nohp,
                'foto' => $foto,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->formatteddate,
            ]);
    
            return redirect()->route('anggota.create')->with(['success' => 'Anda Berhasil Mengisi Data Anggota Grup']);
        } catch (\Exception $e) {
            return redirect()->route('anggota.create')->with(['error' => 'Ada Kesalahan Sistem. {'.$e->getMessage().'}']);
        }
    }

    /**
     * edit anggota data
     */
    public function editAnggota($id)
    {
        $anggota = Anggota::find(base64_decode($id));

        return \view('anggota-edit', compact('anggota'));
    }

    /**
     * update new anggota data
     */
    public function updateAnggota(Request $request)
    {
        try {
            $a = Anggota::find($request->id);

            if ($request->hasFile('foto')) {
                $foto = $request->file('foto')->store('foto_anggota', 'local');
            } else {
                $foto = 'no-photo.jpg';
            }

            $a->name = $request->name;
            $a->foto = $foto;
            $a->nohp = $request->nohp;
            $a->tempat_lahir = $request->tempat_lahir;
            $a->tanggal_lahir = (isset($request->formatteddate)) ? $request->formatteddate : $a->tanggal_lahir;
            $a->save();
            return redirect()->route('anggota.edit', base64_encode($request->id))->with(['success' => 'Anda Berhasil Mengedit Data Anggota Grup']);
        } catch (\Exception $e) {
            return redirect()->route('anggota.edit', base64_encode($request->id))->with(['error' => 'Ada Kesalahan Sistem. {'.$e->getMessage().'}']);
        }
    }
}
