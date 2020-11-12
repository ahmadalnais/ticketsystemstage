<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Company;
use App\Feature;
use App\Quotation;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class GenerateQuotationAndInvoice extends Controller
{
    //Generate Quotation
    public function makeQuotation(Quotation $quotation)
    {       
        // Make collection for Phase. 
        $quotation->phases = collect($quotation->features)->map(function($feature) {
            return collect($feature->value)->toArray();
        })->groupBy('phases_id')->map(function($phase) {
            $newPhase = collect();
            $newPhase->put('features', $phase->all());
            $newPhase->put('total_price', collect($phase->all())->sum('custom_price'));
            return $newPhase;
        });
        // sum all of price
       $quotationTotalPrice = $quotation->phases->map(function($phase) {
            return $phase['total_price'];
       })->sum();

        $newNumber = $this->getIncrementedQuotationNumber($quotation);
        //Generate pdf fo quotation
        $user       = $quotation->project->user; 
        $company    = Company::first();
        $pdf        = PDF::loadView('offerte', [
            'quotation'             => $quotation,
            'user'                  => $user,
            'company'               => $company,
            'quotationTotalPrice'   => $quotationTotalPrice,
            'newNumber'             => $newNumber,
        ])->setPaper('A4'); 
        $pdfContents = $pdf->download()->getOriginalContent();

        //maak voor de huidige offerte met behulp van $number een offertenaam ($offerteName) (171219 . $number)

        //controleer ook of de huidige offerte ($offerteName) al eerder gegenereerd is.
        $extension  = '.pdf';
        $baseUrl    = 'public/customers/'.$quotation->project->user->id.'/offerte/'.$quotation->project->id.'/'.'Offerte '.$newNumber.$extension;

        if($baseUrl) {
            unset($quotation->phases);
            $quotation->quotation_number = $newNumber;
            $quotation->save();
        }

        if($exists = Storage::exists($baseUrl)){
            $baseUrl = 'public/customers/'.$quotation->project->user->id.'/offerte/'.$quotation->project->id.'/'.'Offerte '.$newNumber.$extension;
            $quotationPdfExists = Storage::put($baseUrl, $pdfContents);
            return $baseUrl;
        }else{
            $quotationPdfExists = Storage::put($baseUrl, $pdfContents);
            return $baseUrl;
        }
    }

    //Generate Inovice 
    public function makeInvoice(Quotation $quotation)
    {
        // Make collection for Phase. 
        $quotation->phases = collect($quotation->features)->map(function($feature) {
            return collect($feature->value)->toArray();
        })->groupBy('phases_id')->map(function($phase) {
            $newPhase = collect();
            $newPhase->put('features', $phase->all());
            $newPhase->put('total_price', collect($phase->all())->sum('custom_price'));
            return $newPhase;
        });
        // sum all of price
       $quotationTotalPrice = $quotation->phases->map(function($phase) {
            return $phase['total_price'];
       })->sum();

        $newNumber = $this->getIncrementedQuotationNumber($quotation);
        //Generate pdf of quotation
        $user     = $quotation->project->user; 
        $company  = Company::first();
        $pdf = PDF::loadView('invoice', [
            'quotation'             => $quotation,
            'user'                  => $user,
            'company'               => $company,
            'quotationTotalPrice'   => $quotationTotalPrice,
            'newNumber'             => $newNumber,
        ])->setPaper('A4'); 
        $pdfContents = $pdf->download()->getOriginalContent();
       

        $extension  = '.pdf';
        $baseUrl    = 'public/customers/'.$quotation->project->user->id.'/invoice/'.$quotation->project->id.'/'.'Invoice '.$newNumber.$extension;

        if($baseUrl) {
            unset($quotation->phases);
            $quotation->quotation_number = $newNumber;
            $quotation->save();
        }

        if($exists = Storage::exists($baseUrl)){
            $baseUrl = 'public/customers/'.$quotation->project->user->id.'/invoice/'.$quotation->project->id.'/'.'Invoice '.$newNumber.$extension;
            $quotationPdfExists = Storage::put($baseUrl, $pdfContents);
            return $baseUrl;
        }else{
            $quotationPdfExists = Storage::put($baseUrl, $pdfContents);
            return $baseUrl;
        }
    }

    // increment pdf file 
    public function getIncrementedQuotationNumber(Quotation $quotation)
    {
        // haal alle offertes op die dag (hint: $quotation model bevat created_at date) zijn gemaakt & where quotation_number IS NOT NULL
        $quotationsOfToday = Quotation::where([
            ['created_at', 'like', '%' . $quotation->created_at->format('Y-m-d') . '%'],
            ['quotation_number', '!=', null]
        ])->get();
        $lastQuotation  = $quotationsOfToday->last();

        if($quotation->quotation_number != null) {
            $newNumber = $quotation->quotation_number;
        }

        if($lastQuotation && $quotation->quotation_number == null) {
            $lastDigits = intval(substr($lastQuotation->quotation_number, -2)) + 1;
            $newNumber = $quotation->created_at->format('dmy') . sprintf("%'.02d", $lastDigits);
        }

        if(!$lastQuotation && $quotation->quotation_number == null) {
            $newNumber = $quotation->created_at->format('dmy') . sprintf("%'.02d", 1);
        }
        return $newNumber;
    }
}
