<?php

namespace App\Nova;

use App\User;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Project extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Project';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'choose',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
// index array ['ahmad', 'eric', 'Melvin']
// numeric array [0 => 'ahmad', 1 => 'eric', 2 => 'Melvin']
// associative array ['name' => 'ahmad', 'name_2' => 'eric', 'name_3' => 'Melvin']
// multi dimensional array [['name' => 'Ahmad'], ['name' => 'melvin'], ['name' => 'Eric']]
        //

        return [
            ID::make()->sortable(),
            Text::make('name')
                ->rules('required')
                ->sortable(),
            Select::make('Type Project', 'choose')->options([
                    'web'    => 'Website',
                    'mobile' => 'Application',
                ])
                ->rules('required')
                ->sortable(),
            BelongsTo::make('user')
                ->hideWhenUpdating(),
            // Select::make('Gebruiker', 'user_id')->options([
            //     $request->user()->id => $request->user()->name
            // ])->displayUsing(function ($user_id) use ($request){
            //     return $request->user()->name;
            // })
            //     ->rules('required')
            //     ->hideFromIndex(),
            HasMany::make('tickets'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }

    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        return  $request->user()->hasRole('Admin') || $query->where('user_id', $request->user()->id);
    }
}
