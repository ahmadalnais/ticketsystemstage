<?php

namespace App\Nova\Flexible\Resolvers;

use App\Feature;
use App\Phase;
use Whitecube\NovaFlexibleContent\Value\ResolverInterface;

class FeatureResolver implements ResolverInterface
{
    /**
     * get the field's value
     *
     * @param  mixed  $resource
     * @param  string $attribute
     * @param  Whitecube\NovaFlexibleContent\Layouts\Collection $layouts
     * @return Illuminate\Support\Collection
     */
    public function get($resource, $attribute, $layouts)
    {   
        $features = collect($resource->features)->map(function($feature) {
            return [
                'name' => $feature->name,
                'value' => $feature->value,
            ];
        });

        return $features->map(function($feature) use ($layouts) {
            $layout = $layouts->find($feature['name']);
           

            if(!$layout) return;
            // dd($feature);
            $dbFeature = Feature::find($feature['value']->id);
            return $layout->duplicateAndHydrate($feature['value']->id, [
                'custom_price'  => $feature['value']->custom_price,
                'id'            => $feature['value']->id,
                'description'   => $feature['value']->description,
                'phases_id'     => $feature['value']->phases_id,
            ]);
        })->filter();
    }

    /**
     * Set the field's value
     *
     * @param  mixed  $model
     * @param  string $attribute
     * @param  Illuminate\Support\Collection $groups
     * @return string
     */
    public function set($model, $attribute, $groups)
    {

        $features = $groups->map(function($feature, $index) {

            $customPrice = $feature->getAttributes()['custom_price'];
   
            if($customPrice === null || $customPrice === "") {
                $customPrice = Feature::find($feature->getAttributes()['id'])->price;
            }

            $customDescription = $feature->getAttributes()['description'];
            if($customDescription === null || $customDescription === "") {
                $customDescription = Feature::find($feature->getAttributes()['id'])->description;
            }


            return [
                'name' => $feature->name(),
                'value' => array_merge($feature->getAttributes(), [
                    'description'  => $customDescription, //Feature::find($feature->getAttributes()['id'])->description,
                    'custom_price' => $customPrice,
                ]),
            ]; 
        });

        $model->features = $features;
        $model->save();
        
    }
}
