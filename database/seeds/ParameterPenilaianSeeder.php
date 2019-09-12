<?php

use Illuminate\Database\Seeder;
use App\ParameterPenilaian;

class ParameterPenilaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ParameterPenilaian::create([
            'parameter' => 'Keutuhan dan Power Suara',
            'jenis_nilai' => 'vokal',
        ]);
        ParameterPenilaian::create([
            'parameter' => 'Kejernihan, Kehalusan Suara',
            'jenis_nilai' => 'vokal',
        ]);
        ParameterPenilaian::create([
            'parameter' => 'Variasi Suara',
            'jenis_nilai' => 'vokal',
        ]);
        ParameterPenilaian::create([
            'parameter' => 'Kesesuaian Vokal dan Backing Vokal',
            'jenis_nilai' => 'vokal',
        ]);
        ParameterPenilaian::create([
            'parameter' => 'Peralihan Lagu',
            'jenis_nilai' => 'vokal',
        ]);
        ParameterPenilaian::create([
            'parameter' => 'Keutuhan & Tempo Lagu',
            'jenis_nilai' => 'vokal',
        ]);
        ParameterPenilaian::create([
            'parameter' => 'Keindahan Lagu',
            'jenis_nilai' => 'vokal',
        ]);
        ParameterPenilaian::create([
            'parameter' => 'Kreativitas',
            'jenis_nilai' => 'vokal',
        ]);
        ParameterPenilaian::create([
            'parameter' => 'Irama Dasar Banjari',
            'jenis_nilai' => 'banjari',
        ]);
        ParameterPenilaian::create([
            'parameter' => 'Power Pukulan',
            'jenis_nilai' => 'banjari',
        ]);
        ParameterPenilaian::create([
            'parameter' => 'Akurasi Pukulan',
            'jenis_nilai' => 'banjari',
        ]);
        ParameterPenilaian::create([
            'parameter' => 'Tempo',
            'jenis_nilai' => 'banjari',
        ]);
        ParameterPenilaian::create([
            'parameter' => 'Dinamika',
            'jenis_nilai' => 'banjari',
        ]);
        ParameterPenilaian::create([
            'parameter' => 'Keserasian',
            'jenis_nilai' => 'banjari',
        ]);
        ParameterPenilaian::create([
            'parameter' => 'Variasi Banjari',
            'jenis_nilai' => 'banjari',
        ]);
        ParameterPenilaian::create([
            'parameter' => 'Harmonisasi',
            'jenis_nilai' => 'banjari',
        ]);
        ParameterPenilaian::create([
            'parameter' => 'Muro\'atul Kalimat',
            'jenis_nilai' => 'adab',
        ]);
        ParameterPenilaian::create([
            'parameter' => 'Kesiapan Peserta dan Performance',
            'jenis_nilai' => 'adab',
        ]);
        ParameterPenilaian::create([
            'parameter' => 'Ekspresi & Penghayatan',
            'jenis_nilai' => 'adab',
        ]);
    }
}
