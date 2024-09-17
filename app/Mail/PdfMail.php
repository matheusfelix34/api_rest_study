<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class PdfMail extends Mailable
{
    use Queueable, SerializesModels;

    private $title;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title)
    {
        $this->title = $title;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email="matheus@gmail.com.br";
        $name= "Matheus Felix";
        $pdfPath=storage_path('app/temp/'. $this->title.'.pdf');
        $pdfName= $this->title.'.pdf';
        $this->subject('new report');
        $this->to($email,$name);
        $this->attach($pdfPath,['as' => $pdfName,
        'mime' => 'application/pdf',]);
        return $this->view('mail.notification');
    }
}
