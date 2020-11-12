<?php

namespace App\Nova\Flexible\Presets;

use App\Feature;
use App\Nova\Flexible\Resolvers\FeatureResolver;
use App\Phase;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Whitecube\NovaFlexibleContent\Flexible;
use Whitecube\NovaFlexibleContent\Layouts\Preset;

class FeaturesPreset extends Preset
{
    /**
     * The available features
     *
     * @var Illuminate\Support\Collection
     */
    protected $features;
    protected $phases;

    /**
     * Create a new preset instance
     *
     * @return void
     */
    public function __construct()
    {
        $this->features = Feature::orderBy('description')->get();
        $this->phases = Phase::orderBy('title')->get();
    }


    // public function mapWithKeys($collection, $function) 
    // {
    //     $options = [];

    //     foreach($collection as $object) {
    //         array_merge($options, $function($object));
    //     }

    //     return $options;
    // }


    /**
     * Execute the preset configuration
     *
     * @return void
     */
    public function handle(Flexible $field)
    {


        // $options = [];

        // foreach($this->features as $feature) {
        //     $options[$feature->id] = $feature->description . ' - €' . $feature->price;
        // }



        //Features Field

        $options = $this->features->mapWithKeys(function($feature) {
            return [$feature->id => $feature->description . ' - €' . $feature->price];
        })->toArray();

        $optionsPhase = $this->phases->mapWithKeys(function($phase) {
            return [$phase->title => $phase->id . ' - ' . $phase->title];
        })->toArray();


        $field->addLayout('Feature', 'features', [
            Select::make('id')
                ->options($options)
                ->displayUsingLabels()
                ->rules('required'),
            Number::make('custom_price'),
            Text::make('description')->exceptOnForms(),
            Select::make('Phase', 'phases_id')
                ->options($optionsPhase)
                ->rules('required'),
        ]);
        $field->button('Add Feature');
        $field->resolver(FeatureResolver::class);
    }

}
