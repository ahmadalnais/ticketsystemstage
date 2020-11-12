<?php

namespace App\Nova;

use App\Nova\Filters\TicketStatus;
use App\Project;
use App\User;
use Beyondcode\StringLimit\StringLimit;
use ElevateDigital\CharcountedFields\TextCounted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inspheric\Fields\Indicator;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;
use Timothyasp\Badge\Badge;

class Ticket extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Ticket';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public function subtitle()
    {
        return $this->user->name;
    }
    
    public static $search = [
        'id', 'title', 'description', 'url', 'device','type', 'Status',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            TextCounted::make('title')
                ->rules('required')
                ->maxChars(60)
                ->warningAt(50),
            Trix::make('Beschrijving', 'description')
                ->rules('required', 'max:700'),
            Text::make('url')
                ->rules('required'),
            Select::make('device')->options([
                'Tv'        => 'Tv',
                'PC'        => 'PC',
                'Laptop'    => 'Laptop',
                'MacBook'   => 'MacBook',
                'Tablet'    => 'Tablet',
                'Ipad'      => 'Ipad',
                'Mobile'    => 'Mobile',
            ])
                ->rules('required')
                ->sortable(),
            Select::make('type')->options([
                'Apple'     => 'Iphone',
                'Samsung'   => 'Samsung',
                'Huawei'    => 'Huawei',
                'LG'        => 'LG',
                'Nokia'     => 'Nokia',
                'Asus'      => 'Asus',
                'Sony'      => 'Sony',
                'HTC'       => 'HTC',
            ])
                ->help('This is just for TV, Tablet and Smartphone')
                ->sortable(),
            Text::make('Smartphone,Tablet or Ipad', 'device_name')
                ->help('Example: galaxy s10, Iphone 11 or Huawei mate pro 30. etc....'),
            Badge::make('Status', 'status')
                ->options([
                    'Afkeuren'   => 'Afkeuren',
                    'Accepteren' => 'Accepteren',
                    'Opgelost'   => 'Opgelost',
                ])
                ->colors([
                    'Afkeuren'   => 'red',
                    'Accepteren' => 'orange',
                    'Opgelost'   => 'green',
                ])
                ->hideWhenCreating()
                ->canSee(function ($request) {
                    return $request->user()->can('update-users', $this);
                }),
            BelongsTo::make('project'),
            Select::make('browser')->options([
                'Google Chrome'     => 'Google Chrome',
                'FireFox'           => 'FireFox',
                'Safari'            => 'Safari',
                'Opera'             => 'Opera',
                'Internet Explorer' => 'Internet Explorer', 
            ])
                ->rules('required')
                ->sortable(),
            Text::make('version number')->help('<a href="https://help.zenplanner.com/hc/en-us/articles/204253654-How-to-Find-Your-Internet-Browser-Version-Number-Google-Chrome">Find Your Version Number</a>')
                ->sortable()
                ->nullable(),
            File::make('attachment')
                ->disk('public')
                ->storeOriginalName('attachment_name'),
            HasMany::make('reply'),
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
        return [
            (new TicketStatus)->canSee(function ($request) {
                return $request->user()->can('view-users', User::class);
            }),
        ];
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
    public static function indexQuery(NovaRequest $request, $query)
    {
        $userProjectsArray = $request->user()->projects->pluck('id')->toArray();
        return  $request->user()->hasRole('Admin') || $query->whereIn('project_id', $userProjectsArray)->get();
    }
}
