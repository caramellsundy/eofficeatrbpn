<?php

namespace App\Http\Controllers\Pegawai;


use App\Http\Controllers\Controller;
use App\Models\Surat;
use App\Models\DisposisiTujuan;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Auth;



class DashboardController extends Controller
{

    public function index()
    {

        $user = Auth::user();



        /*
        |--------------------------------------------------------------------------
        | Ambil data pegawai login
        |--------------------------------------------------------------------------
        */


        $pegawai = Pegawai::where(
            'user_id',
            $user->id
        )->first();



        if(!$pegawai){

            abort(
                403,
                'Data pegawai belum terhubung dengan akun login.'
            );

        }



        /*
        |--------------------------------------------------------------------------
        | Statistik
        |--------------------------------------------------------------------------
        */


        // surat masuk dari disposisi (total tugas disposisi)
        $suratMasuk = Surat::whereHas(
            'disposisiTujuans',
            function($q) use($pegawai){

                $q->where(
                    'pegawai_id',
                    $pegawai->id
                );

            }
        )
        ->count();



        // disposisi yang belum selesai (tugas aktif pegawai)
        $disposisiAktif = DisposisiTujuan::where(
            'pegawai_id',
            $pegawai->id
        )
        ->whereIn('status', ['Belum Dibaca', 'Sudah Dibaca'])
        ->count();



        // surat keluar pegawai
        $suratKeluar = Surat::where(
            'user_id',
            $user->id
        )
        ->where(
            'jenis_surat',
            'keluar'
        )
        ->count();



        // jumlah disposisi
        $disposisi = DisposisiTujuan::where(
            'pegawai_id',
            $pegawai->id
        )
        ->count();



        // surat menunggu
        $menunggu = Surat::where(
            'user_id',
            $user->id
        )
        ->where(
            'status',
            'menunggu'
        )
        ->count();




        /*
        |--------------------------------------------------------------------------
        | Tugas hari ini
        |--------------------------------------------------------------------------
        */


        $disposisiBelum = DisposisiTujuan::where(
            'pegawai_id',
            $pegawai->id
        )
        ->where(
            'status',
            'Belum Dibaca'
        )
        ->count();




        $prioritasTinggi = DisposisiTujuan::where('pegawai_id', $pegawai->id)
            ->whereHas('disposisi', function ($query) {
                $query->where('prioritas', 'Tinggi');
            })
            ->count();




        /*
        |--------------------------------------------------------------------------
        | Surat terbaru
        |--------------------------------------------------------------------------
        */


        $suratTerbaru = Surat::where(
            'user_id',
            $user->id
        )
        ->latest()
        ->take(5)
        ->get();




        /*
        |--------------------------------------------------------------------------
        | Disposisi terbaru
        |--------------------------------------------------------------------------
        */


        $disposisiTerbaru = DisposisiTujuan::with([
        'disposisi.surat'
    ])
    ->where('pegawai_id', $pegawai->id)
    ->latest()
    ->take(5)
    ->get();




        /*
        |--------------------------------------------------------------------------
        | Aktivitas
        |--------------------------------------------------------------------------
        */


        $aktivitasTerbaru = collect();



        foreach($suratTerbaru as $item){


            $aktivitasTerbaru->push([

                'jam'=>$item->created_at,

                'icon'=>'bi-send-fill',

                'warna'=>'success',

                'judul'=>'Mengirim Surat',

                'keterangan'=>$item->nomor_surat

            ]);


        }



        foreach($disposisiTerbaru as $item){


            $aktivitasTerbaru->push([

                'jam'=>$item->created_at,

                'icon'=>'bi-envelope-check',

                'warna'=>'warning',

                'judul'=>'Menerima Disposisi',

                'keterangan'=>$item->disposisi->catatan ?? '-'

            ]);


        }



        $aktivitasTerbaru =
            $aktivitasTerbaru
            ->sortByDesc('jam')
            ->take(8);



        return view(
            'pegawai.dashboard',
            compact(

                'suratMasuk',

                'suratKeluar',

                'disposisi',

                'disposisiAktif',

                'menunggu',

                'disposisiBelum',

                'prioritasTinggi',

                'suratTerbaru',

                'disposisiTerbaru',

                'aktivitasTerbaru'

            )
        );

    }

}
