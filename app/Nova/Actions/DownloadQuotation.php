<?php

namespace App\Nova\Actions;

use App\Http\Controllers\GenerateQuotationAndInvoice;
use App\Mail\QuotationEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class DownloadQuotation extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $quotations)
    {
        $PDF = new GenerateQuotationAndInvoice();

        // sometimes you've got multiple models
        // and sometimes you've got only one model. 
        // so sometimes you need to get multiple paths
        // and sometimes you only need one path.
        
        $quotationPdfLocation = $PDF->makeQuotation($quotations->first());
        $url = Storage::url($quotationPdfLocation);

        return Action::openInNewTab($url, 'offerte.pdf'); 
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }
}
