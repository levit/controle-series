<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class SeriesCreated extends Mailable
{

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public int $idSerie, public string $nomeSerie, public int $qtdTemporadas, public int $episodiosPorTemporada)
    {
        $this->subject = "Série $nomeSerie Criada";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.series-created');
        //return $this->view('mail.series-created');
    }
}
