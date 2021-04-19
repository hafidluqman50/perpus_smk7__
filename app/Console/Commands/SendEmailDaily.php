<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TransaksiDetailModel as TransaksiDetail;
use App\Mail\ReminderPinjamBuku;
use Illuminate\Support\Facades\Mail;

class SendEmailDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dailymail:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily Mail Send';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tanggal          = date('Y-m-d');
        $tanggal_reminder = date('Y-m-d', strtotime($tanggal. ' + 1 days'));

        $get_data = TransaksiDetail::join('transaksi_buku','detail_transaksi.id_transaksi','=','transaksi_buku.id_transaksi')
                                    ->join('anggota_perpus','transaksi_buku.id_anggota_perpus','=','anggota_perpus.id_anggota_perpus')
                                    ->join('anggota','anggota_perpus.id_anggota','=','anggota.id_anggota')
                                    ->join('buku','detail_transaksi.id_buku','=','buku.id_buku')
                                    ->where('tanggal_harus_kembali',$tanggal_reminder)
                                    ->where('status_transaksi','sedang-dipinjam')
                                    ->get();

        foreach ($get_data as $key => $value) {
            $reminder = [
                        'judul_buku'            => $value->judul_buku, 
                        'nama_anggota'          => $value->nama_anggota, 
                        'tanggal_harus_kembali' => $value->tanggal_harus_kembali
                        ];
    
            Mail::to($value->email)->send(new ReminderPinjamBuku($reminder));
        }
        
        $this->info('Daily Update has been send successfully');
    }
}
