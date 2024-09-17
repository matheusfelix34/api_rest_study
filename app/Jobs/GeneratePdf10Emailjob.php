<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Report;


use Illuminate\Support\Facades\View;

class GeneratePdf10Emailjob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $title;
    private $description;
   
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($title,$description)
    {
        $this->title=$title;
        $this->description=$description;
      
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
       
        $title= $this->title;
        $description= $this->description;
        $pdf = PDF::loadView('mail.pdf_mail',compact('title','description'));
       
        $caminhoArquivoPDF = storage_path('app/temp/'.$title.'.pdf');

    if (!file_exists(dirname($caminhoArquivoPDF))) {
        mkdir(dirname($caminhoArquivoPDF), 0755, true);
    }

    file_put_contents($caminhoArquivoPDF, $pdf->output());

    \Illuminate\Support\Facades\Mail::send(new \App\Mail\PdfMail($title));
    }
}

