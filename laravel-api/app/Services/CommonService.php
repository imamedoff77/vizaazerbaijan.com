<?php

namespace App\Services;

use App\Models\EligibleCountry;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Mews\Purifier\Facades\Purifier;


class CommonService
{

    /**
     * @param $text
     * @return string
     */
    public static function cleanText($text = ''): string
    {
        return Purifier::clean($text);
    }

    /**
     * @param $filePath
     * @return string
     */
    public static function fileUrl($filePath = ''): string
    {
        return config('env.APP_URL') . "/" . $filePath;
    }

    /**
     * @param string $slug
     * @return Service
     */
    public static function getService(string $slug): Service
    {
        return self::getServices()->where('slug', $slug)->first();
    }


    /**
     * @return Collection
     */
    public static function getServices(): Collection
    {
        return Cache::rememberForever('services', function () {
            return Service::all();
        });
    }

    /**
     * @return Collection
     */
    public static function getEligibleCountries(): Collection
    {
        return Cache::rememberForever('eligibleCountries', function () {
            return EligibleCountry::orderBy('name', 'ASC')->get();
        });
    }

    /**
     * @param int $countryId
     * @return EligibleCountry
     */
    public static function getEligibleCountry(int $countryId): EligibleCountry
    {
        return self::getEligibleCountries()->where('id', $countryId)->first();
    }

    /**
     * @return Collection
     */
    public static function getCountries(): Collection
    {
        return Cache::rememberForever('countries', function () {
            return Country::orderBy('name', 'ASC')->get();
        });
    }
}
