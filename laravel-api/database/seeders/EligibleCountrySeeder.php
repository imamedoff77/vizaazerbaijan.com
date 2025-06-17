<?php

namespace Database\Seeders;

use App\Models\EligibleCountry;
use Illuminate\Database\Seeder;

class EligibleCountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $countries = [
            ['name' => 'Algeria', 'short_code' => 'DZ'],
            ['name' => 'Andorra', 'short_code' => 'AD'],
            ['name' => 'Argentina', 'short_code' => 'AR'],
            ['name' => 'Australia', 'short_code' => 'AU'],
            ['name' => 'Austria', 'short_code' => 'AT'],
            ['name' => 'Bahamas', 'short_code' => 'BS'],
            ['name' => 'Bahrain', 'short_code' => 'BH'],
            ['name' => 'Barbados', 'short_code' => 'BB'],
            ['name' => 'Belgium', 'short_code' => 'BE'],
            ['name' => 'Bolivia (Plurinational State of)', 'short_code' => 'BO'],
            ['name' => 'Bosnia and Herzegovina', 'short_code' => 'BA'],
            ['name' => 'Brazil', 'short_code' => 'BR'],
            ['name' => 'Brunei Darussalam', 'short_code' => 'BN'],
            ['name' => 'Bulgaria', 'short_code' => 'BG'],
            ['name' => 'Canada', 'short_code' => 'CA'],
            ['name' => 'Chile', 'short_code' => 'CL'],
            ['name' => 'China', 'short_code' => 'CN'],
            ['name' => 'Colombia', 'short_code' => 'CO'],
            ['name' => 'Costa Rica', 'short_code' => 'CR'],
            ['name' => 'Croatia', 'short_code' => 'HR'],
            ['name' => 'Cuba', 'short_code' => 'CU'],
            ['name' => 'Cyprus', 'short_code' => 'CY'],
            ['name' => 'Czechia', 'short_code' => 'CZ'],
            ['name' => 'Denmark', 'short_code' => 'DK'],
            ['name' => 'Djibouti', 'short_code' => 'DJ'],
            ['name' => 'Ecuador', 'short_code' => 'EC'],
            ['name' => 'Estonia', 'short_code' => 'EE'],
            ['name' => 'Finland', 'short_code' => 'FI'],
            ['name' => 'France', 'short_code' => 'FR'],
            ['name' => 'Germany', 'short_code' => 'DE'],
            ['name' => 'Greece', 'short_code' => 'GR'],
            ['name' => 'Guatemala', 'short_code' => 'GT'],
            ['name' => 'Holy See (Vatican)', 'short_code' => 'VA'],
            ['name' => 'Honduras', 'short_code' => 'HN'],
            ['name' => 'Hungary', 'short_code' => 'HU'],
            ['name' => 'Iceland', 'short_code' => 'IS'],
            ['name' => 'India', 'short_code' => 'IN'],
            ['name' => 'Indonesia', 'short_code' => 'ID'],
            ['name' => 'Iran (Islamic Republic of)', 'short_code' => 'IR'],
            ['name' => 'Ireland', 'short_code' => 'IE'],
            ['name' => 'Israel', 'short_code' => 'IL'],
            ['name' => 'Italy', 'short_code' => 'IT'],
            ['name' => 'Jamaica', 'short_code' => 'JM'],
            ['name' => 'Japan', 'short_code' => 'JP'],
            ['name' => 'Jordan', 'short_code' => 'JO'],
            ['name' => 'Kuwait', 'short_code' => 'KW'],
            ['name' => 'Latvia', 'short_code' => 'LV'],
            ['name' => 'Liechtenstein', 'short_code' => 'LI'],
            ['name' => 'Lithuania', 'short_code' => 'LT'],
            ['name' => 'Luxembourg', 'short_code' => 'LU'],
            ['name' => 'Malaysia', 'short_code' => 'MY'],
            ['name' => 'Maldives', 'short_code' => 'MV'],
            ['name' => 'Malta', 'short_code' => 'MT'],
            ['name' => 'Mauritius', 'short_code' => 'MU'],
            ['name' => 'Mexico', 'short_code' => 'MX'],
            ['name' => 'Monaco', 'short_code' => 'MC'],
            ['name' => 'Mongolia', 'short_code' => 'MN'],
            ['name' => 'Montenegro', 'short_code' => 'ME'],
            ['name' => 'Nepal', 'short_code' => 'NP'],
            ['name' => 'Netherlands', 'short_code' => 'NL'],
            ['name' => 'New Zealand', 'short_code' => 'NZ'],
            ['name' => 'North Macedonia', 'short_code' => 'MK'],
            ['name' => 'Norway', 'short_code' => 'NO'],
            ['name' => 'Oman', 'short_code' => 'OM'],
            ['name' => 'Pakistan', 'short_code' => 'PK'],
            ['name' => 'Panama', 'short_code' => 'PA'],
            ['name' => 'Paraguay', 'short_code' => 'PY'],
            ['name' => 'Peru', 'short_code' => 'PE'],
            ['name' => 'Poland', 'short_code' => 'PL'],
            ['name' => 'Portugal', 'short_code' => 'PT'],
            ['name' => 'Republic of Korea', 'short_code' => 'KR'],
            ['name' => 'Romania', 'short_code' => 'RO'],
            ['name' => 'San Marino', 'short_code' => 'SM'],
            ['name' => 'Saudi Arabia', 'short_code' => 'SA'],
            ['name' => 'Seychelles', 'short_code' => 'SC'],
            ['name' => 'Singapore', 'short_code' => 'SG'],
            ['name' => 'Slovakia', 'short_code' => 'SK'],
            ['name' => 'Slovenia', 'short_code' => 'SI'],
            ['name' => 'South Africa', 'short_code' => 'ZA'],
            ['name' => 'Spain', 'short_code' => 'ES'],
            ['name' => 'Sri Lanka', 'short_code' => 'LK'],
            ['name' => 'Sweden', 'short_code' => 'SE'],
            ['name' => 'Switzerland', 'short_code' => 'CH'],
            ['name' => 'Thailand', 'short_code' => 'TH'],
            ['name' => 'Trinidad and Tobago', 'short_code' => 'TT'],
            ['name' => 'Turkmenistan', 'short_code' => 'TM'],
            ['name' => 'United Kingdom of Great Britain and Northern Ireland', 'short_code' => 'GB'],
            ['name' => 'United States of America', 'short_code' => 'US'],
            ['name' => 'Viet Nam', 'short_code' => 'VN'],
        ];

        foreach ($countries as $country) {
            $newCountry = new EligibleCountry();
            $newCountry->name = $country['name'];
            $newCountry->short_code = strtolower($country['short_code']);
            $newCountry->save();
        }
    }
}
