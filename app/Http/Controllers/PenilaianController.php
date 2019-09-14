<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ParameterPenilaian;
use App\EventPack;
use App\Klub;
use App\Penilaian;
use App\Events\RefreshTable;
use App\PenguranganPenilaian;
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
        $grup = Klub::all();

        return \view('list-penilaian', compact('grup'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($jenis,$id)
    {
        $param = ParameterPenilaian::where('jenis_nilai',$jenis)->orderBy('id', 'ASC')->get();

        $grup = Klub::findOrFail($id);

        return \view('form-penilaian', compact('jenis','param','grup'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $p = Penilaian::where('klub_id', $request->klub_id)->whereYear('created_at', date('Y'))->first();
        if ($request->jenis == 'vokal') {
            $jali = ($request->jali_1+$request->jali_2+$request->jali_3+$request->jali_4+$request->jali_5+$request->jali_6+$request->jali_7+$request->jali_8)*1;
            $khofi = ($request->khofi_1+$request->khofi_2+$request->khofi_3+$request->khofi_4+$request->khofi_5+$request->khofi_6+$request->khofi_7+$request->khofi_8)*0.5;
            
            try {
                if (isset($p)) {
                    $p->jali_vokal = $jali;
                    $p->khofi_vokal = $khofi;
                    $p->catatan_vokal = $request->comment;
                    $p->save();
                } else {
                    Penilaian::create([
                        'klub_id' => $request->klub_id,
                        'jali_vokal' => $jali,
                        'khofi_vokal' => $khofi,
                        'catatan_vokal' => $request->comment,
                    ]);
                }

                return redirect()->route('penilaian.listgrup')->with(['success' => 'Penilaian Vokal Telah Dicatat']);
            } catch (\Exception $e) {
                return redirect()->route('penilaian.listgrup')->with(['error' => 'Ada Kesalahan Sistem. { '.$e->getMessage().' }']);
            }
            
        } else if($request->jenis == 'banjari') {
            $jali = ($request->jali_9+$request->jali_10+$request->jali_11+$request->jali_12+$request->jali_13+$request->jali_14+$request->jali_15+$request->jali_16)*1;
            $khofi = ($request->khofi_9+$request->khofi_10+$request->khofi_11+$request->khofi_12+$request->khofi_13+$request->khofi_14+$request->khofi_15+$request->khofi_16)*0.5;
            
            try {
                if (isset($p)) {
                    $p->jali_banjari = $jali;
                    $p->khofi_banjari = $khofi;
                    $p->catatan_banjari = $request->comment;
                    $p->save();
                } else {
                    Penilaian::create([
                        'klub_id' => $request->klub_id,
                        'jali_banjari' => $jali,
                        'khofi_banjari' => $khofi,
                        'catatan_banjari' => $request->comment,
                    ]);
                }

                return redirect()->route('penilaian.listgrup')->with(['success' => 'Penilaian Banjari Telah Dicatat']);
            } catch (\Exception $e) {
                return redirect()->route('penilaian.listgrup')->with(['error' => 'Ada Kesalahan Sistem. { '.$e->getMessage().' }']);
            }
            
        } else if($request->jenis == 'adab') {
            $jali = ($request->jali_17+$request->jali_18+$request->jali_19)*1;
            $khofi = ($request->khofi_17+$request->khofi_18+$request->khofi_19)*0.5;
            
            try {
                if (isset($p)) {
                    $p->jali_adab = $jali;
                    $p->khofi_adab = $khofi;
                    $p->catatan_adab = $request->comment;
                    $p->save();
                } else {
                    Penilaian::create([
                        'klub_id' => $request->klub_id,
                        'jali_adab' => $jali,
                        'khofi_adab' => $khofi,
                        'catatan_adab' => $request->comment,
                    ]);
                }

                return redirect()->route('penilaian.listgrup')->with(['success' => 'Penilaian Adab Telah Dicatat']);
            } catch (\Exception $e) {
                return redirect()->route('penilaian.listgrup')->with(['error' => 'Ada Kesalahan Sistem. { '.$e->getMessage().' }']);
            }
            
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

    public function getGrup()
    {
        $grup = EventPack::select(['event_packs.id', 'klubs.id as klub_id', 'klubs.name', 'klubs.alamat', 'event_packs.status'])
                            ->join('klubs', 'event_packs.klub_id', '=', 'klubs.id')
                            ->whereYear('event_packs.created_at', date('Y'))
                            ->orderBy('event_packs.status', 'ASC')
                            ->get();

        return Datatables::of($grup)
            ->addColumn('action', function ($grup) {
                $a =    '<a title="Nilai Vokal" href="'.url('penilaian/vokal').'/'.$grup->klub_id.'" class="btn btn-icon-only green" ><i class="fa fa-microphone"></i></a>'
                        .'<a title="Nilai Nilai Adab" href="'.url('penilaian/adab').'/'.$grup->klub_id.'" class="btn btn-icon-only green" ><i class="fa fa-smile-o"></i></a>'
                        .'<a title="Nilai Nilai Banjari" href="'.url('penilaian/banjari').'/'.$grup->klub_id.'" class="btn btn-icon-only green" ><i class="fa fa-star-half-empty"></i></a>'
                        .'<a title="Timer" href="'.url('timer').'/'.$grup->klub_id.'" class="btn btn-icon-only green" ><i class="fa fa-hourglass-start"></i></a>';
                return $a;
            })
            ->editColumn('status', function ($grup){
                if ($grup->status == 'menunggu') {
                    $a = '<span class="label label-warning"> '.$grup->status.' </span>';
                } else if ($grup->status == 'belum datang') {
                    $a = '<span class="label label-danger"> '.$grup->status.' </span>';
                } else if ($grup->status == 'tampil') {
                    $a = '<span class="label label-info"> '.$grup->status.' </span>';
                } else if ($grup->status == 'sudah tampil') {
                    $a = '<span class="label label-success"> '.$grup->status.' </span>';
                }
                return $a;
            })
            ->rawColumns(['action','status'])
            ->make(true);
    }

    public function timer($id)
    {
        try {
            $e = EventPack::where('klub_id',$id)->first();

            $e->status = 'tampil';
            $e->save();

            \event(new RefreshTable());

            return \view('timer', compact('id'));
        } catch (\Exception $e) {
            return redirect()->route('penilaian.listgrup')->with(['error' => 'Ada Kesalahan Sistem. { '.$e->getMessage().' }']);
        }
        
    }

    public function timerCalculation($id,$pengurangan)
    {
        try {
            $e = EventPack::where('klub_id',$id)->first();

            $e->status = 'sudah tampil';
            $e->save();

            \event(new RefreshTable());

            if ($pengurangan == 'ada') {
                PenguranganPenilaian::create([
                    'klub_id' => $id,
                    'jenis' => 'melebihi batas waktu',
                    'jumlah' => 3,
                ]);

                return redirect()->route('penilaian.listgrup')->with(['success' => 'Penampilan Melebihi Batas Waktu. Pengurangan Nilai Telah Dicatat']);
            } else {
                return redirect()->route('penilaian.listgrup')->with(['success' => 'Penampilan Tidak Melebihi Batas Waktu']);
            }
        } catch (\Exception $e) {
            return redirect()->route('penilaian.listgrup')->with(['error' => 'Ada Kesalahan Sistem. { '.$e->getMessage().' }']);
        }
        
    }

    public function penguranganNilai(Request $request)
    {
        try {
            if ($request->jenis == 'tidak membawa teks') {
                PenguranganPenilaian::create([
                    'klub_id' => $request->id,
                    'jenis' => $request->jenis,
                    'jumlah' => 2,
                ]);
            }
            return response("Pengurangan Nilai Berhasil Ditambahkan", 200);
        } catch (\Exception $e) {
            return response("Pengurangan Nilai Gagal Ditambahkan", 500);
        }
        
    }

    public function penguranganNilaiManual(Request $request)
    {
        try {
            if ($request->jenis == 'tidak membawa teks') {
                PenguranganPenilaian::create([
                    'klub_id' => $request->klub_id,
                    'jenis' => $request->jenis,
                    'jumlah' => 2,
                ]);
            } else if ($request->jenis == 'melebihi batas waktu') {
                PenguranganPenilaian::create([
                    'klub_id' => $request->klub_id,
                    'jenis' => $request->jenis,
                    'jumlah' => 3,
                ]);
            } else if ($request->jenis == 'telat daftar atau datang') {
                PenguranganPenilaian::create([
                    'klub_id' => $request->klub_id,
                    'jenis' => $request->jenis,
                    'jumlah' => 15,
                ]);
            } else if ($request->jenis == 'latihan di area lomba') {
                PenguranganPenilaian::create([
                    'klub_id' => $request->klub_id,
                    'jenis' => $request->jenis,
                    'jumlah' => 5,
                ]);
            }
            return redirect()->route('penilaian.listgrup')->with(['success' => 'Pengurangan Nilai Berhasil Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->route('penilaian.listgrup')->with(['error' => 'Ada Kesalahan Sistem. { '.$e->getMessage().' }']);
        }
    }

    public function finalResult()
    {
        $grup = Klub::all();
        // dd($grup);
        $nilai = array();
        $i = 0;
        foreach ($grup as $g) {
            $nilai[$i]['name'] = $g->name;
            $penilaian = Penilaian::where('klub_id', $g->id)->whereYear('created_at', date('Y'))->first();
            // dd($penilaian);
            $vokal = 40 - ($penilaian['jali_vokal'] + $penilaian['khofi_vokal']);
            $adab = 30 - ($penilaian['jali_adab'] + $penilaian['khofi_adab']);
            $banjari = 30 - ($penilaian['jali_banjari'] + $penilaian['khofi_banjari']);
            $pengurangan = PenguranganPenilaian::where('klub_id', $g->id)->whereYear('created_at', date('Y'))->sum('jumlah');
            $nilai[$i]['nilai'] = ($vokal+$adab+$banjari)-$pengurangan;
            $i++;
        }
        // arsort($nilai);
        $sorterNilai = array_column($nilai, 'nilai');
        array_multisort($sorterNilai, SORT_DESC, $nilai);
        // dd($nilai);
        return \view('penilaian-final', compact('nilai'));
    }
}
