<?php

namespace App\View\Components\Schema;

use Closure;
use App\Models\SiteSetting;
use App\Models\SocialMedia;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Organization extends Component
{
    public $organization;
    public $place;
    /**
     * Create a new component instance.
     */
    public function __construct($organization = null, $place = null)
    {
        $site_settings = SiteSetting::first();
        $social_medias = SocialMedia::get();
        
        $this->organization = $organization ?? [
            'name' => $site_settings->title,
            'url' => url('/'),
            'email' => $site_settings->email,
            'telephone' => $site_settings->phone,
            'priceRange' => '$$$',
            'type' => ['HealthAndBeautyBusiness', 'Organization'],
            'logo' => [
                'url' => asset('/storage/' . $site_settings->logo),
                'width' => '512',
                'height' => '512'
            ],
            'socialLinks' => array_map(fn($media) => $media->url, $social_medias->all()),
            'openingHours' => [
                'Monday 12:00-20:00',
                'Tuesday,Wednesday,Thursday,Friday 09:00-20:00',
                'Saturday 09:00-17:00'
            ]
        ];

        $this->place = $place ?? [
            'streetAddress' => $site_settings->street,
            'addressLocality' => $site_settings->city,
            'addressRegion' => $site_settings->region,
            'postalCode' => $site_settings->postalCode,
            'addressCountry' => $site_settings->country,
            'latitude' => $site_settings->latitude,
            'longitude' => $site_settings->longitude
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.schema.organization');
    }
}
