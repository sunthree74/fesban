<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ParameterPenilaian;
use App\EventPack;
use App\Klub;
use Yajra\Datatables\Datatables;

class PenilaianController extends Controller
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

        return \view('list-penilaian');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($jenis,$id)
    {
        $param = ParameterPenilaian::where('jenis_nilai',$jenis)->orderBy('id', 'ASC')->get();

        $grup = Klub::select(['klubs.id','klubs.name','event_packs.judul_lagu'])
                    ->join('event_packs', 'event_packs.klub_id', '=', 'klubs.id')
                    ->whereYear('event_packs.created_at', date('Y'))
                    ->first();
        $lagu = explode("|",$grup->judul_lagu);
        return \view('form-penilaian', compact('jenis','param','grup','lagu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function getGrup()
    {
        $grup = EventPack::select(['event_packs.id', 'klubs.id as klub_id', 'klubs.name', 'klubs.alamat', 'event_packs.status'])
                            ->join('klubs', 'event_packs.klub_id', '=', 'klubs.id')
                            ->whereYear('event_packs.created_at', date('Y'))
                            ->get();

        return Datatables::of($grup)
            ->addColumn('action', function ($grup) {
                $a =    '<a title="Nilai Vokal" href="'.url('penilaian/vokal').'/'.$grup->klub_id.'" class="btn btn-icon-only green" ><i class="fa fa-microphone"></i></a>'
                        .'<a title="Nilai Nilai Adab" href="'.url('penilaian/adab').'/'.$grup->klub_id.'" class="btn btn-icon-only green" ><i class="fa fa-smile-o"></i></a>'
                        .'<a title="Nilai Nilai Banjari" href="'.url('penilaian/banjari').'/'.$grup->klub_id.'" class="btn btn-icon-only green" ><i class="fa fa-star-half-empty"></i></a>'
                        .'<a title="Timer" href="'.url('timer').'/'.$grup->klub_id.'" class="btn btn-icon-only green" ><i class="fa fa-hourglass-start"></i></a>';
                return $a;
            })
            ->make(true);
    }

    public function timer($id)
    {
        return \view('timer', compact('id'));
    }

    public function timerCalculation($id,$pengurangan)
    {
        if ($pengurangan == 'ada') {
            PenguranganPenilaian::create([
                'klub_id' => $id,
                'jenis' => 'melebihi batas waktu',
                'jumlah' => 3,
            ]);

            return redirect()->route('penilaian.listgrup');
        } else {
            return redirect()->route('penilaian.listgrup');
        }
    }
}
