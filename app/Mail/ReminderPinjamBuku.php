<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReminderPinjamBuku extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $mail;

    public function __construct($param)
    {
        $this->mail = $param;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Email.main')
                    ->with([
                            'buku'                  => $this->mail['judul_buku'],
                            'tanggal_harus_kembali' => $this->mail['tanggal_harus_kembali'],
                            'nama_anggota'          => $this->mail['nama_anggota']
                        ])
                    ->subject('Reminder Kembalikan Buku');
    }
}
