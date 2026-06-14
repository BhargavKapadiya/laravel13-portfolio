<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::firstOrCreate([
            'id' => 1,
        ], [
            'name' => 'Afghanistan',
            'short_code' => 'af',
            'isd_code' => '+93',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 2,
        ], [
            'name' => 'Albania',
            'short_code' => 'al',
            'isd_code' => '+355',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 3,
        ], [
            'name' => 'Algeria',
            'short_code' => 'dz',
            'isd_code' => '+213',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 4,
        ], [
            'name' => 'American Samoa',
            'short_code' => 'AS',
            'isd_code' => '+1684',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 5,
        ], [
            'name' => 'Andorra',
            'short_code' => 'ad',
            'isd_code' => '+376',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 6,
        ], [
            'name' => 'Angola',
            'short_code' => 'ao',
            'isd_code' => '+244',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 7,
        ], [
            'name' => 'Anguilla',
            'short_code' => 'ai',
            'isd_code' => '+1264',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 8,
        ], [
            'name' => 'Antarctica',
            'short_code' => 'AQ',
            'isd_code' => '+672',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 9,
        ], [
            'name' => 'Antigua And Barbuda',
            'short_code' => 'ag',
            'isd_code' => '+1268',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 10,
        ], [
            'name' => 'Argentina',
            'short_code' => 'ar',
            'isd_code' => '+54',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 11,
        ], [
            'name' => 'Armenia',
            'short_code' => 'am',
            'isd_code' => '+374',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 12,
        ], [
            'name' => 'Aruba',
            'short_code' => 'aw',
            'isd_code' => '+297',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 13,
        ], [
            'name' => 'Australia',
            'short_code' => 'au',
            'isd_code' => '+61',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 14,
        ], [
            'name' => 'Austria',
            'short_code' => 'at',
            'isd_code' => '+43',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 15,
        ], [
            'name' => 'Azerbaijan',
            'short_code' => 'az',
            'isd_code' => '+994',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 16,
        ], [
            'name' => 'Bahamas The',
            'short_code' => 'bs',
            'isd_code' => '+1242',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 17,
        ], [
            'name' => 'Bahrain',
            'short_code' => 'bh',
            'isd_code' => '+973',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 18,
        ], [
            'name' => 'Bangladesh',
            'short_code' => 'bd',
            'isd_code' => '+880',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 19,
        ], [
            'name' => 'Barbados',
            'short_code' => 'bb',
            'isd_code' => '+1246',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 20,
        ], [
            'name' => 'Belarus',
            'short_code' => 'by',
            'isd_code' => '+375',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 21,
        ], [
            'name' => 'Belgium',
            'short_code' => 'be',
            'isd_code' => '+32',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 22,
        ], [
            'name' => 'Belize',
            'short_code' => 'bz',
            'isd_code' => '+501',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 23,
        ], [
            'name' => 'Benin',
            'short_code' => 'bj',
            'isd_code' => '+229',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 24,
        ], [
            'name' => 'Bermuda',
            'short_code' => 'bm',
            'isd_code' => '+1441',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 25,
        ], [
            'name' => 'Bhutan',
            'short_code' => 'bt',
            'isd_code' => '+975',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 26,
        ], [
            'name' => 'Bolivia',
            'short_code' => 'bo',
            'isd_code' => '+591',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 27,
        ], [
            'name' => 'Bosnia and Herzegovina',
            'short_code' => 'ba',
            'isd_code' => '+387',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 28,
        ], [
            'name' => 'Botswana',
            'short_code' => 'bw',
            'isd_code' => '+267',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 29,
        ], [
            'name' => 'Bouvet Island',
            'short_code' => 'BV',
            'isd_code' => '+47',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 30,
        ], [
            'name' => 'Brazil',
            'short_code' => 'br',
            'isd_code' => '+55',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 31,
        ], [
            'name' => 'British Indian Ocean Territory',
            'short_code' => 'IO',
            'isd_code' => '+246',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 32,
        ], [
            'name' => 'Brunei',
            'short_code' => 'bn',
            'isd_code' => '+673',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 33,
        ], [
            'name' => 'Bulgaria',
            'short_code' => 'bg',
            'isd_code' => '+359',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 34,
        ], [
            'name' => 'Burkina Faso',
            'short_code' => 'bf',
            'isd_code' => '+226',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 35,
        ], [
            'name' => 'Burundi',
            'short_code' => 'bi',
            'isd_code' => '+257',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 36,
        ], [
            'name' => 'Cambodia',
            'short_code' => 'kh',
            'isd_code' => '+855',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 37,
        ], [
            'name' => 'Cameroon',
            'short_code' => 'cm',
            'isd_code' => '+237',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 38,
        ], [
            'name' => 'Canada',
            'short_code' => 'ca',
            'isd_code' => '+1',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 39,
        ], [
            'name' => 'Cape Verde',
            'short_code' => 'cv',
            'isd_code' => '+238',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 40,
        ], [
            'name' => 'Cayman Islands',
            'short_code' => 'ky',
            'isd_code' => '+1345',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 41,
        ], [
            'name' => 'Central African Republic',
            'short_code' => 'cf',
            'isd_code' => '+236',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 42,
        ], [
            'name' => 'Chad',
            'short_code' => 'td',
            'isd_code' => '+235',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 43,
        ], [
            'name' => 'Chile',
            'short_code' => 'cl',
            'isd_code' => '+56',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 44,
        ], [
            'name' => 'China',
            'short_code' => 'cn',
            'isd_code' => '+86',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 45,
        ], [
            'name' => 'Christmas Island',
            'short_code' => 'cx',
            'isd_code' => '+61',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 46,
        ], [
            'name' => 'Cocos (Keeling) Islands',
            'short_code' => 'cc',
            'isd_code' => '+61',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 47,
        ], [
            'name' => 'Colombia',
            'short_code' => 'co',
            'isd_code' => '+57',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 48,
        ], [
            'name' => 'Comoros',
            'short_code' => 'km',
            'isd_code' => '+269',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 49,
        ], [
            'name' => 'Republic Of The Congo',
            'short_code' => 'CG',
            'isd_code' => '+242',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 50,
        ], [
            'name' => 'Democratic Republic Of The Congo',
            'short_code' => 'CD',
            'isd_code' => '+242',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 51,
        ], [
            'name' => 'Cook Islands',
            'short_code' => 'ck',
            'isd_code' => '+682',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 52,
        ], [
            'name' => 'Costa Rica',
            'short_code' => 'cr',
            'isd_code' => '+506',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 53,
        ], [
            'name' => "Cote D'Ivoire (Ivory Coast)",
            'short_code' => 'ci',
            'isd_code' => '+225',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 54,
        ], [
            'name' => 'Croatia (Hrvatska)',
            'short_code' => 'hr',
            'isd_code' => '+385',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 55,
        ], [
            'name' => 'Cuba',
            'short_code' => 'cu',
            'isd_code' => '+53',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 56,
        ], [
            'name' => 'Cyprus',
            'short_code' => 'cy',
            'isd_code' => '+357',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 57,
        ], [
            'name' => 'Czech Republic',
            'short_code' => 'cz',
            'isd_code' => '+420',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 58,
        ], [
            'name' => 'Denmark',
            'short_code' => 'dk',
            'isd_code' => '+45',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 59,
        ], [
            'name' => 'Djibouti',
            'short_code' => 'dj',
            'isd_code' => '+253',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 60,
        ], [
            'name' => 'Dominica',
            'short_code' => 'dm',
            'isd_code' => '+1767',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 61,
        ], [
            'name' => 'Dominican Republic',
            'short_code' => 'do',
            'isd_code' => '+1809',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 62,
        ], [
            'name' => 'East Timor',
            'short_code' => 'TP',
            'isd_code' => '+670',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 63,
        ], [
            'name' => 'Ecuador',
            'short_code' => 'ec',
            'isd_code' => '+593',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 64,
        ], [
            'name' => 'Egypt',
            'short_code' => 'eg',
            'isd_code' => '+20',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 65,
        ], [
            'name' => 'El Salvador',
            'short_code' => 'sv',
            'isd_code' => '+503',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 66,
        ], [
            'name' => 'Equatorial Guinea',
            'short_code' => 'gq',
            'isd_code' => '+240',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 67,
        ], [
            'name' => 'Eritrea',
            'short_code' => 'er',
            'isd_code' => '+291',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 68,
        ], [
            'name' => 'Estonia',
            'short_code' => 'ee',
            'isd_code' => '+372',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 69,
        ], [
            'name' => 'Ethiopia',
            'short_code' => 'et',
            'isd_code' => '+251',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 71,
        ], [
            'name' => 'Falkland Islands',
            'short_code' => 'fk',
            'isd_code' => '+500',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 72,
        ], [
            'name' => 'Faroe Islands',
            'short_code' => 'fo',
            'isd_code' => '+298',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 73,
        ], [
            'name' => 'Fiji Islands',
            'short_code' => 'fj',
            'isd_code' => '+679',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 74,
        ], [
            'name' => 'Finland',
            'short_code' => 'fi',
            'isd_code' => '+358',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 75,
        ], [
            'name' => 'France',
            'short_code' => 'fr',
            'isd_code' => '+33',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 76,
        ], [
            'name' => 'French Guiana',
            'short_code' => 'gf',
            'isd_code' => '+594',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 77,
        ], [
            'name' => 'French Polynesia',
            'short_code' => 'pf',
            'isd_code' => '+689',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 78,
        ], [
            'name' => 'French Southern Territories',
            'short_code' => 'tf',
            'isd_code' => '+1',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 79,
        ], [
            'name' => 'Gabon',
            'short_code' => 'ga',
            'isd_code' => '+241',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 80,
        ], [
            'name' => 'Gambia',
            'short_code' => 'gm',
            'isd_code' => '+220',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 81,
        ], [
            'name' => 'Georgia',
            'short_code' => 'ge',
            'isd_code' => '+995',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 82,
        ], [
            'name' => 'Germany',
            'short_code' => 'de',
            'isd_code' => '+49',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 83,
        ], [
            'name' => 'Ghana',
            'short_code' => 'gh',
            'isd_code' => '+233',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 84,
        ], [
            'name' => 'Gibraltar',
            'short_code' => 'gi',
            'isd_code' => '+350',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 85,
        ], [
            'name' => 'Greece',
            'short_code' => 'gr',
            'isd_code' => '+30',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 86,
        ], [
            'name' => 'Greenland',
            'short_code' => 'gl',
            'isd_code' => '+299',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 87,
        ], [
            'name' => 'Grenada',
            'short_code' => 'gd',
            'isd_code' => '+1473',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 88,
        ], [
            'name' => 'Guadeloupe',
            'short_code' => 'gp',
            'isd_code' => '+590',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 89,
        ], [
            'name' => 'Guam',
            'short_code' => 'GU',
            'isd_code' => '+1671',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 90,
        ], [
            'name' => 'Guatemala',
            'short_code' => 'gt',
            'isd_code' => '+502',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 91,
        ], [
            'name' => 'Guernsey and Alderney',
            'short_code' => 'GG',
            'isd_code' => '+44',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 92,
        ], [
            'name' => 'Guinea',
            'short_code' => 'gn',
            'isd_code' => '+224',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 93,
        ], [
            'name' => 'Guinea-Bissau',
            'short_code' => 'gw',
            'isd_code' => '+245',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 94,
        ], [
            'name' => 'Guyana',
            'short_code' => 'gy',
            'isd_code' => '+592',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 95,
        ], [
            'name' => 'Haiti',
            'short_code' => 'ht',
            'isd_code' => '+509',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 96,
        ], [
            'name' => 'Heard and McDonald Islands',
            'short_code' => 'HM',
            'isd_code' => '+672',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 97,
        ], [
            'name' => 'Honduras',
            'short_code' => 'hn',
            'isd_code' => '+504',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 98,
        ], [
            'name' => 'Hong Kong S.A.R.',
            'short_code' => 'hk',
            'isd_code' => '+852',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 99,
        ], [
            'name' => 'Hungary',
            'short_code' => 'hu',
            'isd_code' => '+36',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 100,
        ], [
            'name' => 'Iceland',
            'short_code' => 'is',
            'isd_code' => '+354',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 101,
        ], [
            'name' => 'India',
            'short_code' => 'in',
            'isd_code' => '+91',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 102,
        ], [
            'name' => 'Indonesia',
            'short_code' => 'id',
            'isd_code' => '+62',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 103,
        ], [
            'name' => 'Iran',
            'short_code' => 'ir',
            'isd_code' => '+98',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 104,
        ], [
            'name' => 'Iraq',
            'short_code' => 'iq',
            'isd_code' => '+964',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 105,
        ], [
            'name' => 'Ireland',
            'short_code' => 'ie',
            'isd_code' => '+353',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 106,
        ], [
            'name' => 'Israel',
            'short_code' => 'il',
            'isd_code' => '+972',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 107,
        ], [
            'name' => 'Italy',
            'short_code' => 'it',
            'isd_code' => '+39',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 108,
        ], [
            'name' => 'Jamaica',
            'short_code' => 'jm',
            'isd_code' => '+1876',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 109,
        ], [
            'name' => 'Japan',
            'short_code' => 'jp',
            'isd_code' => '+81',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 110,
        ], [
            'name' => 'Jersey',
            'short_code' => 'JE',
            'isd_code' => '+44',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 111,
        ], [
            'name' => 'Jordan',
            'short_code' => 'jo',
            'isd_code' => '+962',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 112,
        ], [
            'name' => 'Kazakhstan',
            'short_code' => 'kz',
            'isd_code' => '+7',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 113,
        ], [
            'name' => 'Kenya',
            'short_code' => 'ke',
            'isd_code' => '+254',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 114,
        ], [
            'name' => 'Kiribati',
            'short_code' => 'ki',
            'isd_code' => '+686',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 115,
        ], [
            'name' => 'Korea North',
            'short_code' => 'kp',
            'isd_code' => '+850',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 116,
        ], [
            'name' => 'Korea South',
            'short_code' => 'kr',
            'isd_code' => '+82',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 117,
        ], [
            'name' => 'Kuwait',
            'short_code' => 'kw',
            'isd_code' => '+965',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 118,
        ], [
            'name' => 'Kyrgyzstan',
            'short_code' => 'kg',
            'isd_code' => '+996',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 119,
        ], [
            'name' => 'Laos',
            'short_code' => 'la',
            'isd_code' => '+856',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 120,
        ], [
            'name' => 'Latvia',
            'short_code' => 'lv',
            'isd_code' => '+371',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 121,
        ], [
            'name' => 'Lebanon',
            'short_code' => 'lb',
            'isd_code' => '+961',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 122,
        ], [
            'name' => 'Lesotho',
            'short_code' => 'ls',
            'isd_code' => '+266',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 123,
        ], [
            'name' => 'Liberia',
            'short_code' => 'lr',
            'isd_code' => '+231',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 124,
        ], [
            'name' => 'Libya',
            'short_code' => 'ly',
            'isd_code' => '+218',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 125,
        ], [
            'name' => 'Liechtenstein',
            'short_code' => 'li',
            'isd_code' => '+423',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 126,
        ], [
            'name' => 'Lithuania',
            'short_code' => 'lt',
            'isd_code' => '+370',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 127,
        ], [
            'name' => 'Luxembourg',
            'short_code' => 'lu',
            'isd_code' => '+352',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 128,
        ], [
            'name' => 'Macau S.A.R.',
            'short_code' => 'mo',
            'isd_code' => '+853',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 129,
        ], [
            'name' => 'Macedonia',
            'short_code' => 'mk',
            'isd_code' => '+389',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 130,
        ], [
            'name' => 'Madagascar',
            'short_code' => 'mg',
            'isd_code' => '+261',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 131,
        ], [
            'name' => 'Malawi',
            'short_code' => 'mw',
            'isd_code' => '+265',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 132,
        ], [
            'name' => 'Malaysia',
            'short_code' => 'my',
            'isd_code' => '+60',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 133,
        ], [
            'name' => 'Maldives',
            'short_code' => 'mv',
            'isd_code' => '+960',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 134,
        ], [
            'name' => 'Mali',
            'short_code' => 'ml',
            'isd_code' => '+223',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 135,
        ], [
            'name' => 'Malta',
            'short_code' => 'mt',
            'isd_code' => '+356',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 136,
        ], [
            'name' => 'Isle of Man',
            'short_code' => 'IM',
            'isd_code' => '+44',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 137,
        ], [
            'name' => 'Marshall Islands',
            'short_code' => 'mh',
            'isd_code' => '+692',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 138,
        ], [
            'name' => 'Martinique',
            'short_code' => 'mq',
            'isd_code' => '+596',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 139,
        ], [
            'name' => 'Mauritania',
            'short_code' => 'mr',
            'isd_code' => '+222',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 140,
        ], [
            'name' => 'Mauritius',
            'short_code' => 'mu',
            'isd_code' => '+230',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 141,
        ], [
            'name' => 'Mayotte',
            'short_code' => 'yt',
            'isd_code' => '+269',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 142,
        ], [
            'name' => 'Mexico',
            'short_code' => 'mx',
            'isd_code' => '+52',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 143,
        ], [
            'name' => 'Micronesia',
            'short_code' => 'FM',
            'isd_code' => '+691',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 144,
        ], [
            'name' => 'Moldova',
            'short_code' => 'md',
            'isd_code' => '+373',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 145,
        ], [
            'name' => 'Monaco',
            'short_code' => 'mc',
            'isd_code' => '+377',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 146,
        ], [
            'name' => 'Mongolia',
            'short_code' => 'mn',
            'isd_code' => '+976',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 147,
        ], [
            'name' => 'Montserrat',
            'short_code' => 'ms',
            'isd_code' => '+1664',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 148,
        ], [
            'name' => 'Morocco',
            'short_code' => 'ma',
            'isd_code' => '+212',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 149,
        ], [
            'name' => 'Mozambique',
            'short_code' => 'mz',
            'isd_code' => '+258',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 150,
        ], [
            'name' => 'Myanmar',
            'short_code' => 'mm',
            'isd_code' => '+95',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 151,
        ], [
            'name' => 'Namibia',
            'short_code' => 'na',
            'isd_code' => '+264',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 152,
        ], [
            'name' => 'Nauru',
            'short_code' => 'nr',
            'isd_code' => '+674',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 153,
        ], [
            'name' => 'Nepal',
            'short_code' => 'np',
            'isd_code' => '+977',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 154,
        ], [
            'name' => 'Netherlands Antilles',
            'short_code' => 'an',
            'isd_code' => '+599',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 155,
        ], [
            'name' => 'Netherlands The',
            'short_code' => 'nl',
            'isd_code' => '+31',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 156,
        ], [
            'name' => 'New Caledonia',
            'short_code' => 'nc',
            'isd_code' => '+687',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 157,
        ], [
            'name' => 'New Zealand',
            'short_code' => 'nz',
            'isd_code' => '+64',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 158,
        ], [
            'name' => 'Nicaragua',
            'short_code' => 'ni',
            'isd_code' => '+505',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 159,
        ], [
            'name' => 'Niger',
            'short_code' => 'ne',
            'isd_code' => '+227',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 160,
        ], [
            'name' => 'Nigeria',
            'short_code' => 'ng',
            'isd_code' => '+234',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 161,
        ], [
            'name' => 'Niue',
            'short_code' => 'nu',
            'isd_code' => '+683',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 162,
        ], [
            'name' => 'Norfolk Island',
            'short_code' => 'nf',
            'isd_code' => '+672',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 163,
        ], [
            'name' => 'Northern Mariana Islands',
            'short_code' => 'mp',
            'isd_code' => '+1670',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 164,
        ], [
            'name' => 'Norway',
            'short_code' => 'no',
            'isd_code' => '+47',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 165,
        ], [
            'name' => 'Oman',
            'short_code' => 'om',
            'isd_code' => '+968',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 166,
        ], [
            'name' => 'Pakistan',
            'short_code' => 'pk',
            'isd_code' => '+92',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 167,
        ], [
            'name' => 'Palau',
            'short_code' => 'pw',
            'isd_code' => '+680',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 168,
        ], [
            'name' => 'Palestinian Territory Occupied',
            'short_code' => 'ps',
            'isd_code' => '+970',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 169,
        ], [
            'name' => 'Panama',
            'short_code' => 'pa',
            'isd_code' => '+507',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 170,
        ], [
            'name' => 'Papua new Guinea',
            'short_code' => 'pg',
            'isd_code' => '+675',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 171,
        ], [
            'name' => 'Paraguay',
            'short_code' => 'py',
            'isd_code' => '+595',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 172,
        ], [
            'name' => 'Peru',
            'short_code' => 'pe',
            'isd_code' => '+51',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 173,
        ], [
            'name' => 'Philippines',
            'short_code' => 'ph',
            'isd_code' => '+63',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 174,
        ], [
            'name' => 'Pitcairn Island',
            'short_code' => 'PN',
            'isd_code' => '+64',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 175,
        ], [
            'name' => 'Poland',
            'short_code' => 'pl',
            'isd_code' => '+48',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 176,
        ], [
            'name' => 'Portugal',
            'short_code' => 'pt',
            'isd_code' => '+351',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 177,
        ], [
            'name' => 'Puerto Rico',
            'short_code' => 'PR',
            'isd_code' => '+1787',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 178,
        ], [
            'name' => 'Qatar',
            'short_code' => 'qa',
            'isd_code' => '+974',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 179,
        ], [
            'name' => 'Reunion',
            'short_code' => 're',
            'isd_code' => '+262',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 180,
        ], [
            'name' => 'Romania',
            'short_code' => 'ro',
            'isd_code' => '+40',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 181,
        ], [
            'name' => 'Russia',
            'short_code' => 'ru',
            'isd_code' => '+70',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 182,
        ], [
            'name' => 'Rwanda',
            'short_code' => 'rw',
            'isd_code' => '+250',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 183,
        ], [
            'name' => 'Saint Helena',
            'short_code' => 'sh',
            'isd_code' => '+290',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 184,
        ], [
            'name' => 'Saint Kitts And Nevis',
            'short_code' => 'kn',
            'isd_code' => '+1869',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 185,
        ], [
            'name' => 'Saint Lucia',
            'short_code' => 'lc',
            'isd_code' => '+1758',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 186,
        ], [
            'name' => 'Saint Pierre and Miquelon',
            'short_code' => 'pm',
            'isd_code' => '+508',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 187,
        ], [
            'name' => 'Saint Vincent And The Grenadines',
            'short_code' => 'vc',
            'isd_code' => '+1784',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 188,
        ], [
            'name' => 'Samoa',
            'short_code' => 'ws',
            'isd_code' => '+684',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 189,
        ], [
            'name' => 'San Marino',
            'short_code' => 'sm',
            'isd_code' => '+378',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 190,
        ], [
            'name' => 'Sao Tome and Principe',
            'short_code' => 'st',
            'isd_code' => '+239',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 191,
        ], [
            'name' => 'Saudi Arabia',
            'short_code' => 'sa',
            'isd_code' => '+966',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 192,
        ], [
            'name' => 'Senegal',
            'short_code' => 'sn',
            'isd_code' => '+221',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 193,
        ], [
            'name' => 'Serbia',
            'short_code' => 'RS',
            'isd_code' => '+381',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 194,
        ], [
            'name' => 'Seychelles',
            'short_code' => 'sc',
            'isd_code' => '+248',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 195,
        ], [
            'name' => 'Sierra Leone',
            'short_code' => 'sl',
            'isd_code' => '+232',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 196,
        ], [
            'name' => 'Singapore',
            'short_code' => 'sg',
            'isd_code' => '+65',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 197,
        ], [
            'name' => 'Slovakia',
            'short_code' => 'sk',
            'isd_code' => '+421',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 198,
        ], [
            'name' => 'Slovenia',
            'short_code' => 'si',
            'isd_code' => '+386',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 199,
        ], [
            'name' => 'Smaller Territories of the UK',
            'short_code' => 'GB',
            'isd_code' => '+44',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 200,
        ], [
            'name' => 'Solomon Islands',
            'short_code' => 'sb',
            'isd_code' => '+677',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 201,
        ], [
            'name' => 'Somalia',
            'short_code' => 'so',
            'isd_code' => '+252',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 202,
        ], [
            'name' => 'South Africa',
            'short_code' => 'za',
            'isd_code' => '+27',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 203,
        ], [
            'name' => 'South Georgia',
            'short_code' => 'gs',
            'isd_code' => '+500',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 204,
        ], [
            'name' => 'South Sudan',
            'short_code' => 'SS',
            'isd_code' => '+211',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 205,
        ], [
            'name' => 'Spain',
            'short_code' => 'es',
            'isd_code' => '+34',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 206,
        ], [
            'name' => 'Sri Lanka',
            'short_code' => 'lk',
            'isd_code' => '+94',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 207,
        ], [
            'name' => 'Sudan',
            'short_code' => 'sd',
            'isd_code' => '+249',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 208,
        ], [
            'name' => 'Suriname',
            'short_code' => 'sr',
            'isd_code' => '+597',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 209,
        ], [
            'name' => 'Svalbard And Jan Mayen Islands',
            'short_code' => 'sj',
            'isd_code' => '+47',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 210,
        ], [
            'name' => 'Swaziland',
            'short_code' => 'sz',
            'isd_code' => '+268',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 211,
        ], [
            'name' => 'Sweden',
            'short_code' => 'se',
            'isd_code' => '+46',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 212,
        ], [
            'name' => 'Switzerland',
            'short_code' => 'ch',
            'isd_code' => '+41',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 213,
        ], [
            'name' => 'Syria',
            'short_code' => 'sy',
            'isd_code' => '+963',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 214,
        ], [
            'name' => 'Taiwan',
            'short_code' => 'tw',
            'isd_code' => '+886',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 215,
        ], [
            'name' => 'Tajikistan',
            'short_code' => 'tj',
            'isd_code' => '+992',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 216,
        ], [
            'name' => 'Tanzania',
            'short_code' => 'tz',
            'isd_code' => '+255',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 217,
        ], [
            'name' => 'Thailand',
            'short_code' => 'th',
            'isd_code' => '+66',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 218,
        ], [
            'name' => 'Togo',
            'short_code' => 'tg',
            'isd_code' => '+228',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 219,
        ], [
            'name' => 'Tokelau',
            'short_code' => 'tk',
            'isd_code' => '+690',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 220,
        ], [
            'name' => 'Tonga',
            'short_code' => 'to',
            'isd_code' => '+676',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 221,
        ], [
            'name' => 'Trinidad And Tobago',
            'short_code' => 'tt',
            'isd_code' => '+1868',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 222,
        ], [
            'name' => 'Tunisia',
            'short_code' => 'tn',
            'isd_code' => '+216',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 223,
        ], [
            'name' => 'Turkey',
            'short_code' => 'tr',
            'isd_code' => '+90',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 224,
        ], [
            'name' => 'Turkmenistan',
            'short_code' => 'tm',
            'isd_code' => '+993',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 225,
        ], [
            'name' => 'Turks And Caicos Islands',
            'short_code' => 'tc',
            'isd_code' => '+1649',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 226,
        ], [
            'name' => 'Tuvalu',
            'short_code' => 'tv',
            'isd_code' => '+688',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 227,
        ], [
            'name' => 'Uganda',
            'short_code' => 'ug',
            'isd_code' => '+256',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 228,
        ], [
            'name' => 'Ukraine',
            'short_code' => 'ua',
            'isd_code' => '+380',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 229,
        ], [
            'name' => 'United Arab Emirates',
            'short_code' => 'ae',
            'isd_code' => '+971',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 230,
        ], [
            'name' => 'United Kingdom',
            'short_code' => 'gb',
            'isd_code' => '+44',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 231,
        ], [
            'name' => 'United States',
            'short_code' => 'us',
            'isd_code' => '+1',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 232,
        ], [
            'name' => 'United States Minor Outlying Islands',
            'short_code' => 'UM',
            'isd_code' => '+246',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 233,
        ], [
            'name' => 'Uruguay',
            'short_code' => 'uy',
            'isd_code' => '+598',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 234,
        ], [
            'name' => 'Uzbekistan',
            'short_code' => 'uz',
            'isd_code' => '+998',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 235,
        ], [
            'name' => 'Vanuatu',
            'short_code' => 'vu',
            'isd_code' => '+678',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 236,
        ], [
            'name' => 'Vatican City State (Holy See)',
            'short_code' => 'VA',
            'isd_code' => '+379',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 237,
        ], [
            'name' => 'Venezuela',
            'short_code' => 've',
            'isd_code' => '+58',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 238,
        ], [
            'name' => 'Vietnam',
            'short_code' => 'vn',
            'isd_code' => '+84',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 239,
        ], [
            'name' => 'Virgin Islands (British)',
            'short_code' => 'vg',
            'isd_code' => '+1284',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 240,
        ], [
            'name' => 'Virgin Islands (US)',
            'short_code' => 'vi',
            'isd_code' => '+1340',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 241,
        ], [
            'name' => 'Wallis And Futuna Islands',
            'short_code' => 'wf',
            'isd_code' => '+681',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 242,
        ], [
            'name' => 'Western Sahara',
            'short_code' => 'eh',
            'isd_code' => '+212',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 243,
        ], [
            'name' => 'Yemen',
            'short_code' => 'ye',
            'isd_code' => '+967',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 244,
        ], [
            'name' => 'Yugoslavia',
            'short_code' => 'YU',
            'isd_code' => '+38',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 245,
        ], [
            'name' => 'Zambia',
            'short_code' => 'zm',
            'isd_code' => '+260',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Country::firstOrCreate([
            'id' => 246,
        ], [
            'name' => 'Zimbabwe',
            'short_code' => 'zm',
            'isd_code' => '+263',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
