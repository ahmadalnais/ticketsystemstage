<?php

namespace App\Observers;

use App\Mail\QuotationEmail;
use App\Quotation;
use Illuminate\Support\Facades\Mail;

class QuotationObserve
{
    /**
     * Handle the quotation "created" event.
     *
     * @param  \App\Quotation  $quotation
     * @return void
     */
    public function created(Quotation $quotation)
    {
        // Mail::to($quotation->project->user->email)->send(new QuotationEmail($quotation));
        // maak quotation
        // in nova moet deze quotation gedownload kunnen worden.
        // in nova moet een actie komen om de quotation te mailen.
    }

    /**
     * Handle the quotation "updated" event.
     *
     * @param  \App\Quotation  $quotation
     * @return void
     */
    public function updated(Quotation $quotation)
    {
        // Mail::to($quotation->project->user->email)->send(new QuotationEmail($quotation));
    }

    /**
     * Handle the quotation "deleted" event.
     *
     * @param  \App\Quotation  $quotation
     * @return void
     */
    public function deleted(Quotation $quotation)
    {
        //
    }

    /**
     * Handle the quotation "restored" event.
     *
     * @param  \App\Quotation  $quotation
     * @return void
     */
    public function restored(Quotation $quotation)
    {
        //
    }

    /**
     * Handle the quotation "force deleted" event.
     *
     * @param  \App\Quotation  $quotation
     * @return void
     */
    public function forceDeleted(Quotation $quotation)
    {
        //
    }
}
