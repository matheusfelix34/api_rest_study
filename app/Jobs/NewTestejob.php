<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\View;


class NewTestejob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    private $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( \stdClass $user)
    {
        $this->user=$user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        $data="dida";
        $pdf = PDF::loadView('mail.teste',compact('data'));

        $caminhoArquivoPDF = storage_path('app/temp/nomeDoArquivo.pdf');

    if (!file_exists(dirname($caminhoArquivoPDF))) {
        mkdir(dirname($caminhoArquivoPDF), 0755, true);
    }

    file_put_contents($caminhoArquivoPDF, $pdf->output());
    \Illuminate\Support\Facades\Mail::send(new \App\Mail\newTeste($this->user));
    }
}
