<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\TransaksiDetailModel as TransaksiDetail;
use App\Mail\ReminderPinjamBuku;
use Mail;

class SendManyEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $tanggal          = date('Y-m-d');
        $tanggal_reminder = date('Y-m-d', strtotime($tanggal. ' + 3 days'));
        // session()->put('tanggal_reminder',$tanggal_reminder);

        $get_data = TransaksiDetail::join('transaksi_buku','detail_transaksi.id_transaksi','=','transaksi_buku.id_transaksi')
                                    ->join('anggota_perpus','transaksi_buku.id_anggota_perpus','=','anggota_perpus.id_anggota_perpus')
                                    ->join('anggota','anggota_perpus.id_anggota','=','anggota.id_anggota')
                                    ->join('buku','detail_transaksi.id_buku','=','buku.id_buku')
                                    ->where('tanggal_harus_kembali',$tanggal_reminder)
                                    ->where('status_transaksi','sedang-dipinjam')
                                    ->get();

        // $when = now()->addMinutes(5);
        
        foreach ($get_data as $key => $value) {
            $reminder = [
                            'judul_buku'            => $value->judul_buku, 
                            'nama_anggota'          => $value->nama_anggota, 
                            'tanggal_harus_kembali' => $value->tanggal_harus_kembali
                        ];

    
            Mail::to($value->email)->queue(new ReminderPinjamBuku($reminder));
        }
    }
}
