<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CountriesTableSeeder extends Seeder
{
    public function run()
    {
        
        Schema::disableForeignKeyConstraints();
        \DB::table('countries')->truncate();
        Schema::enableForeignKeyConstraints();

        $countries = [
            [
                'id'            => 1,
                'name'          => 'Afghanistan',
                'short_code'    => 'af',
                'mobile_code'   => '93',
                'is_active'     => 0
            ],
            [
                'id'            => 2,
                'name'          => 'Albania',
                'short_code'    => 'al',
                'mobile_code'   => '355',
                'is_active'     => 0
            ],
            [
                'id'            => 3,
                'name'          => 'Algeria',
                'short_code'    => 'dz',
                'mobile_code'   => '213',
                'is_active'     => 0
            ],
            [
                'id'            => 4,
                'name'          => 'American Samoa',
                'short_code'    => 'as',
                'mobile_code'   => '1',
                'is_active'     => 0
            ],
            [
                'id'            => 5,
                'name'          => 'Andorra',
                'short_code'    => 'ad',
                'mobile_code'   => '376',
                'is_active'     => 0
            ],
            [
                'id'            => 6,
                'name'          => 'Angola',
                'short_code'    => 'ao',
                'mobile_code'   => '244',
                'is_active'     => 0
            ],
            [
                'id'            => 7,
                'name'          => 'Anguilla',
                'short_code'    => 'ai',
                'mobile_code'   => '1',
                'is_active'     => 0
            ],
            [
                'id'            => 8,
                'name'          => 'Antarctica',
                'short_code'    => 'aq',
                'mobile_code'   => '672',
                'is_active'     => 0
            ],
            [
                'id'            => 9,
                'name'          => 'Antigua and Barbuda',
                'short_code'    => 'ag',
                'mobile_code'   => '1',
                'is_active'     => 0
            ],
            [
                'id'            => 10,
                'name'          => 'Argentina',
                'short_code'    => 'ar',
                'mobile_code'   => '54',
                'is_active'     => 0
            ],
            [
                'id'            => 11,
                'name'          => 'Armenia',
                'short_code'    => 'am',
                'mobile_code'   => '374',
                'is_active'     => 0
            ],
            [
                'id'            => 12,
                'name'          => 'Aruba',
                'short_code'    => 'aw',
                'mobile_code'   => '297',
                'is_active'     => 0
            ],
            [
                'id'            => 13,
                'name'          => 'Australia',
                'short_code'    => 'au',
                'mobile_code'   => '61',
                'is_active'     => 0
            ],
            [
                'id'            => 14,
                'name'          => 'Austria',
                'short_code'    => 'at',
                'mobile_code'   => '43',
                'is_active'     => 0
            ],
            [
                'id'            => 15,
                'name'          => 'Azerbaijan',
                'short_code'    => 'az',
                'mobile_code'   => '994',
                'is_active'     => 0
            ],
            [
                'id'            => 16,
                'name'          => 'Bahamas',
                'short_code'    => 'bs',
                'mobile_code'   => '1',
                'is_active'     => 0
            ],
            [
                'id'            => 17,
                'name'          => 'Bahrain',
                'short_code'    => 'bh',
                'mobile_code'   => '973',
                'is_active'     => 0
            ],
            [
                'id'            => 18,
                'name'          => 'Bangladesh',
                'short_code'    => 'bd',
                'mobile_code'   => '880',
                'is_active'     => 0
            ],
            [
                'id'            => 19,
                'name'          => 'Barbados',
                'short_code'    => 'bb',
                'mobile_code'   => '1',
                'is_active'     => 0
            ],
            [
                'id'            => 20,
                'name'          => 'Belarus',
                'short_code'    => 'by',
                'mobile_code'   => '375',
                'is_active'     => 0
            ],
            [
                'id'            => 21,
                'name'          => 'Belgium',
                'short_code'    => 'be',
                'mobile_code'   => '32',
                'is_active'     => 0
            ],
            [
                'id'            => 22,
                'name'          => 'Belize',
                'short_code'    => 'bz',
                'mobile_code'   => '501',
                'is_active'     => 0
            ],
            [
                'id'            => 23,
                'name'          => 'Benin',
                'short_code'    => 'bj',
                'mobile_code'   => '229',
                'is_active'     => 0
            ],
            [
                'id'            => 24,
                'name'          => 'Bermuda',
                'short_code'    => 'bm',
                'mobile_code'   => '1',
                'is_active'     => 0
            ],
            [
                'id'            => 25,
                'name'          => 'Bhutan',
                'short_code'    => 'bt',
                'mobile_code'   => '975',
                'is_active'     => 0
            ],
            [
                'id'            => 26,
                'name'          => 'Bolivia',
                'short_code'    => 'bo',
                'mobile_code'   => '591',
                'is_active'     => 0
            ],
            [
                'id'            => 27,
                'name'          => 'Bosnia and Herzegovina',
                'short_code'    => 'ba',
                'mobile_code'   => '387',
                'is_active'     => 0
            ],
            [
                'id'            => 28,
                'name'          => 'Botswana',
                'short_code'    => 'bw',
                'mobile_code'   => '267',
                'is_active'     => 0
            ],
            [
                'id'            => 29,
                'name'          => 'Brazil',
                'short_code'    => 'br',
                'mobile_code'   => '55',
                'is_active'     => 0
            ],
            [
                'id'            => 30,
                'name'          => 'British Indian Ocean Territory',
                'short_code'    => 'io',
                'mobile_code'   => '246',
                'is_active'     => 0
            ],
            [
                'id'            => 31,
                'name'          => 'British Virgin Islands',
                'short_code'    => 'vg',
                'mobile_code'   => '1',
                'is_active'     => 0
            ],
            [
                'id'            => 32,
                'name'          => 'Brunei',
                'short_code'    => 'bn',
                'mobile_code'   => '673',
                'is_active'     => 0
            ],
            [
                'id'            => 33,
                'name'          => 'Bulgaria',
                'short_code'    => 'bg',
                'mobile_code'   => '359',
                'is_active'     => 0
            ],
            [
                'id'            => 34,
                'name'          => 'Burkina Faso',
                'short_code'    => 'bf',
                'mobile_code'   => '226',
                'is_active'     => 0
            ],
            [
                'id'            => 35,
                'name'          => 'Burundi',
                'short_code'    => 'bi',
                'mobile_code'   => '257',
                'is_active'     => 0
            ],
            [
                'id'            => 36,
                'name'          => 'Cambodia',
                'short_code'    => 'kh',
                'mobile_code'   => '855',
                'is_active'     => 0
            ],
            [
                'id'            => 37,
                'name'          => 'Cameroon',
                'short_code'    => 'cm',
                'mobile_code'   => '237',
                'is_active'     => 0
            ],
            [
                'id'            => 38,
                'name'          => 'Canada',
                'short_code'    => 'ca',
                'mobile_code'   => '1',
                'is_active'     => 0
            ],
            [
                'id'            => 39,
                'name'          => 'Cape Verde',
                'short_code'    => 'cv',
                'mobile_code'   => '238',
                'is_active'     => 0
            ],
            [
                'id'            => 40,
                'name'          => 'Cayman Islands',
                'short_code'    => 'ky',
                'mobile_code'   => '1',
                'is_active'     => 0
            ],
            [
                'id'            => 41,
                'name'          => 'Central African Republic',
                'short_code'    => 'cf',
                'mobile_code'   => '236',
                'is_active'     => 0
            ],
            [
                'id'            => 42,
                'name'          => 'Chad',
                'short_code'    => 'td',
                'mobile_code'   => '235',
                'is_active'     => 0
            ],
            [
                'id'            => 43,
                'name'          => 'Chile',
                'short_code'    => 'cl',
                'mobile_code'   => '56',
                'is_active'     => 0
            ],
            [
                'id'            => 44,
                'name'          => 'China',
                'short_code'    => 'cn',
                'mobile_code'   => '86',
                'is_active'     => 0
            ],
            [
                'id'            => 45,
                'name'          => 'Christmas Island',
                'short_code'    => 'cx',
                'mobile_code'   => '61',
                'is_active'     => 0
            ],
            [
                'id'            => 46,
                'name'          => 'Cocos Islands',
                'short_code'    => 'cc',
                'mobile_code'   => '61',
                'is_active'     => 0
            ],
            [
                'id'            => 47,
                'name'          => 'Colombia',
                'short_code'    => 'co',
                'mobile_code'   => '57',
                'is_active'     => 0
            ],
            [
                'id'            => 48,
                'name'          => 'Comoros',
                'short_code'    => 'km',
                'mobile_code'   => '269',
                'is_active'     => 0
            ],
            [
                'id'            => 49,
                'name'          => 'Cook Islands',
                'short_code'    => 'ck',
                'mobile_code'   => '682',
                'is_active'     => 0
            ],
            [
                'id'            => 50,
                'name'          => 'Costa Rica',
                'short_code'    => 'cr',
                'mobile_code'   => '506',
                'is_active'     => 0
            ],
            [
                'id'            => 51,
                'name'          => 'Croatia',
                'short_code'    => 'hr',
                'mobile_code'   => '385',
                'is_active'     => 0
            ],
            [
                'id'            => 52,
                'name'          => 'Cuba',
                'short_code'    => 'cu',
                'mobile_code'   => '53',
                'is_active'     => 0
            ],
            [
                'id'            => 53,
                'name'          => 'Curacao',
                'short_code'    => 'cw',
                'mobile_code'   => '599',
                'is_active'     => 0
            ],
            [
                'id'            => 54,
                'name'          => 'Cyprus',
                'short_code'    => 'cy',
                'mobile_code'   => '357',
                'is_active'     => 0
            ],
            [
                'id'            => 55,
                'name'          => 'Czech Republic',
                'short_code'    => 'cz',
                'mobile_code'   => '420',
                'is_active'     => 0
            ],
            [
                'id'            => 56,
                'name'          => 'Democratic Republic of the Congo',
                'short_code'    => 'cd',
                'mobile_code'   => '243',
                'is_active'     => 0
            ],
            [
                'id'            => 57,
                'name'          => 'Denmark',
                'short_code'    => 'dk',
                'mobile_code'   => '45',
                'is_active'     => 0
            ],
            [
                'id'            => 58,
                'name'          => 'Djibouti',
                'short_code'    => 'dj',
                'mobile_code'   => '253',
                'is_active'     => 0
            ],
            [
                'id'            => 59,
                'name'          => 'Dominica',
                'short_code'    => 'dm',
                'mobile_code'   => '1',
                'is_active'     => 0
            ],
            [
                'id'            => 60,
                'name'          => 'Dominican Republic',
                'short_code'    => 'do',
                'mobile_code'   => '1',
                'is_active'     => 0
            ],
            [
                'id'            => 61,
                'name'          => 'East Timor',
                'short_code'    => 'tl',
                'mobile_code'   => '670',
                'is_active'     => 0
            ],
            [
                'id'            => 62,
                'name'          => 'Ecuador',
                'short_code'    => 'ec',
                'mobile_code'   => '593',
                'is_active'     => 0
            ],
            [
                'id'            => 63,
                'name'          => 'Egypt',
                'short_code'    => 'eg',
                'mobile_code'   => '20',
                'is_active'     => 0
            ],
            [
                'id'            => 64,
                'name'          => 'El Salvador',
                'short_code'    => 'sv',
                'mobile_code'   => '503',
                'is_active'     => 0
            ],
            [
                'id'            => 65,
                'name'          => 'Equatorial Guinea',
                'short_code'    => 'gq',
                'mobile_code'   => '240',
                'is_active'     => 0
            ],
            [
                'id'            => 66,
                'name'          => 'Eritrea',
                'short_code'    => 'er',
                'mobile_code'   => '291',
                'is_active'     => 0
            ],
            [
                'id'            => 67,
                'name'          => 'Estonia',
                'short_code'    => 'ee',
                'mobile_code'   => '372',
                'is_active'     => 0
            ],
            [
                'id'            => 68,
                'name'          => 'Ethiopia',
                'short_code'    => 'et',
                'mobile_code'   => '251',
                'is_active'     => 0
            ],
            [
                'id'            => 69,
                'name'          => 'Falkland Islands',
                'short_code'    => 'fk',
                'mobile_code'   => '500',
                'is_active'     => 0
            ],
            [
                'id'            => 70,
                'name'          => 'Faroe Islands',
                'short_code'    => 'fo',
                'mobile_code'   => '298',
                'is_active'     => 0
            ],
            [
                'id'            => 71,
                'name'          => 'Fiji',
                'short_code'    => 'fj',
                'mobile_code'   => '679',
                'is_active'     => 0
            ],
            [
                'id'            => 72,
                'name'          => 'Finland',
                'short_code'    => 'fi',
                'mobile_code'   => '358',
                'is_active'     => 0
            ],
            [
                'id'            => 73,
                'name'          => 'France',
                'short_code'    => 'fr',
                'mobile_code'   => '33',
                'is_active'     => 0
            ],
            [
                'id'            => 74,
                'name'          => 'French Polynesia',
                'short_code'    => 'pf',
                'mobile_code'   => '689',
                'is_active'     => 0
            ],
            [
                'id'            => 75,
                'name'          => 'Gabon',
                'short_code'    => 'ga',
                'mobile_code'   => '241',
                'is_active'     => 0
            ],
            [
                'id'            => 76,
                'name'          => 'Gambia',
                'short_code'    => 'gm',
                'mobile_code'   => '220',
                'is_active'     => 0
            ],
            [
                'id'            => 77,
                'name'          => 'Georgia',
                'short_code'    => 'ge',
                'mobile_code'   => '995',
                'is_active'     => 0
            ],
            [
                'id'            => 78,
                'name'          => 'Germany',
                'short_code'    => 'de',
                'mobile_code'   => '49',
                'is_active'     => 0
            ],
            [
                'id'            => 79,
                'name'          => 'Ghana',
                'short_code'    => 'gh',
                'mobile_code'   => '233',
                'is_active'     => 0
            ],
            [
                'id'            => 80,
                'name'          => 'Gibraltar',
                'short_code'    => 'gi',
                'mobile_code'   => '350',
                'is_active'     => 0
            ],
            [
                'id'            => 81,
                'name'          => 'Greece',
                'short_code'    => 'gr',
                'mobile_code'   => '30',
                'is_active'     => 0
            ],
            [
                'id'            => 82,
                'name'          => 'Greenland',
                'short_code'    => 'gl',
                'mobile_code'   => '299',
                'is_active'     => 0
            ],
            [
                'id'            => 83,
                'name'          => 'Grenada',
                'short_code'    => 'gd',
                'mobile_code'   => '1',
                'is_active'     => 0
            ],
            [
                'id'            => 84,
                'name'          => 'Guam',
                'short_code'    => 'gu',
                'mobile_code'   => '1',
                'is_active'     => 0
            ],
            [
                'id'            => 85,
                'name'          => 'Guatemala',
                'short_code'    => 'gt',
                'mobile_code'   => '502',
                'is_active'     => 0
            ],
            [
                'id'            => 86,
                'name'          => 'Guernsey',
                'short_code'    => 'gg',
                'mobile_code'   => '44',
                'is_active'     => 0
            ],
            [
                'id'            => 87,
                'name'          => 'Guinea',
                'short_code'    => 'gn',
                'mobile_code'   => '224',
                'is_active'     => 0
            ],
            [
                'id'            => 88,
                'name'          => 'Guinea-Bissau',
                'short_code'    => 'gw',
                'mobile_code'   => '245',
                'is_active'     => 0
            ],
            [
                'id'            => 89,
                'name'          => 'Guyana',
                'short_code'    => 'gy',
                'mobile_code'   => '592',
                'is_active'     => 0
            ],
            [
                'id'            => 90,
                'name'          => 'Haiti',
                'short_code'    => 'ht',
                'mobile_code'   => '509',
                'is_active'     => 0
            ],
            [
                'id'            => 91,
                'name'          => 'Honduras',
                'short_code'    => 'hn',
                'mobile_code'   => '504',
                'is_active'     => 0
            ],
            [
                'id'            => 92,
                'name'          => 'Hong Kong',
                'short_code'    => 'hk',
                'mobile_code'   => '852',
                'is_active'     => 0
            ],
            [
                'id'            => 93,
                'name'          => 'Hungary',
                'short_code'    => 'hu',
                'mobile_code'   => '36',
                'is_active'     => 0
            ],
            [
                'id'            => 94,
                'name'          => 'Iceland',
                'short_code'    => 'is',
                'mobile_code'   => '354',
                'is_active'     => 0
            ],
            [
                'id'            => 95,
                'name'          => 'India',
                'short_code'    => 'in',
                'mobile_code'   => '91',
                'is_active'     => 0
            ],
            [
                'id'            => 96,
                'name'          => 'Indonesia',
                'short_code'    => 'id',
                'mobile_code'   => '62',
                'is_active'     => 0
            ],
            [
                'id'            => 97,
                'name'          => 'Iran',
                'short_code'    => 'ir',
                'mobile_code'   => '98',
                'is_active'     => 0
            ],
            [
                'id'            => 98,
                'name'          => 'Iraq',
                'short_code'    => 'iq',
                'mobile_code'   => '964',
                'is_active'     => 0
            ],
            [
                'id'            => 99,
                'name'          => 'Ireland',
                'short_code'    => 'ie',
                'mobile_code'   => '353',
                'is_active'     => 0
            ],
            [
                'id'            => 100,
                'name'          => 'Isle of Man',
                'short_code'    => 'im',
                'mobile_code'   => '44',
                'is_active'     => 0
            ],
            [
                'id'            => 101,
                'name'          => 'Israel',
                'short_code'    => 'il',
                'mobile_code'   => '972',
                'is_active'     => 0
            ],
            [
                'id'            => 102,
                'name'          => 'Italy',
                'short_code'    => 'it',
                'mobile_code'   => '39',
                'is_active'     => 0
            ],
            [
                'id'            => 103,
                'name'          => 'Ivory Coast',
                'short_code'    => 'ci',
                'mobile_code'   => '225',
                'is_active'     => 0
            ],
            [
                'id'            => 104,
                'name'          => 'Jamaica',
                'short_code'    => 'jm',
                'mobile_code'   => '1',
                'is_active'     => 0
            ],
            [
                'id'            => 105,
                'name'          => 'Japan',
                'short_code'    => 'jp',
                'mobile_code'   => '81',
                'is_active'     => 0
            ],
            [
                'id'            => 106,
                'name'          => 'Jersey',
                'short_code'    => 'je',
                'mobile_code'   => '44',
                'is_active'     => 0
            ],
            [
                'id'            => 107,
                'name'          => 'Jordan',
                'short_code'    => 'jo',
                'mobile_code'   => '962',
                'is_active'     => 0
            ],
            [
                'id'            => 108,
                'name'          => 'Kazakhstan',
                'short_code'    => 'kz',
                'mobile_code'   => '7',
                'is_active'     => 0
            ],
            [
                'id'            => 109,
                'name'          => 'Kenya',
                'short_code'    => 'ke',
                'mobile_code'   => '254',
                'is_active'     => 0
            ],
            [
                'id'            => 110,
                'name'          => 'Kiribati',
                'short_code'    => 'ki',
                'mobile_code'   => '686',
                'is_active'     => 0
            ],
            [
                'id'            => 111,
                'name'          => 'Kosovo',
                'short_code'    => 'xk',
                'mobile_code'   => '383',
                'is_active'     => 0
            ],
            [
                'id'            => 112,
                'name'          => 'Kuwait',
                'short_code'    => 'kw',
                'mobile_code'   => '965',
                'is_active'     => 0
            ],
            [
                'id'            => 113,
                'name'          => 'Kyrgyzstan',
                'short_code'    => 'kg',
                'mobile_code'   => '996',
                'is_active'     => 0
            ],
            [
                'id'            => 114,
                'name'          => 'Laos',
                'short_code'    => 'la',
                'mobile_code'   => '856',
                'is_active'     => 0
            ],
            [
                'id'            => 115,
                'name'          => 'Latvia',
                'short_code'    => 'lv',
                'mobile_code'   => '371',
                'is_active'     => 0
            ],
            [
                'id'            => 116,
                'name'          => 'Lebanon',
                'short_code'    => 'lb',
                'mobile_code'   => '961',
                'is_active'     => 0
            ],
            [
                'id'            => 117,
                'name'          => 'Lesotho',
                'short_code'    => 'ls',
                'mobile_code'   => '266',
                'is_active'     => 0
            ],
            [
                'id'            => 118,
                'name'          => 'Liberia',
                'short_code'    => 'lr',
                'mobile_code'   => '231',
                'is_active'     => 0
            ],
            [
                'id'            => 119,
                'name'          => 'Libya',
                'short_code'    => 'ly',
                'mobile_code'   => '218',
                'is_active'     => 0
            ],
            [
                'id'            => 120,
                'name'          => 'Liechtenstein',
                'short_code'    => 'li',
                'mobile_code'   => '423',
                'is_active'     => 0
            ],
            [
                'id'            => 121,
                'name'          => 'Lithuania',
                'short_code'    => 'lt',
                'mobile_code'   => '370',
                'is_active'     => 0
            ],
            [
                'id'            => 122,
                'name'          => 'Luxembourg',
                'short_code'    => 'lu',
                'mobile_code'   => '352',
                'is_active'     => 0
            ],
            [
                'id'            => 123,
                'name'          => 'Macau',
                'short_code'    => 'mo',
                'mobile_code'   => '853',
                'is_active'     => 0
            ],
            [
                'id'            => 124,
                'name'          => 'Macedonia',
                'short_code'    => 'mk',
                'mobile_code'   => '389',
                'is_active'     => 0
            ],
            [
                'id'            => 125,
                'name'          => 'Madagascar',
                'short_code'    => 'mg',
                'mobile_code'   => '261',
                'is_active'     => 0
            ],
            [
                'id'            => 126,
                'name'          => 'Malawi',
                'short_code'    => 'mw',
                'mobile_code'   => '265',
                'is_active'     => 0
            ],
            [
                'id'            => 127,
                'name'          => 'Malaysia',
                'short_code'    => 'my',
                'mobile_code'   => '60',
                'is_active'     => 1
            ],
            [
                'id'            => 128,
                'name'          => 'Maldives',
                'short_code'    => 'mv',
                'mobile_code'   => '960',
                'is_active'     => 0
            ],
            [
                'id'            => 129,
                'name'          => 'Mali',
                'short_code'    => 'ml',
                'mobile_code'   => '223',
                'is_active'     => 0
            ],
            [
                'id'            => 130,
                'name'          => 'Malta',
                'short_code'    => 'mt',
                'mobile_code'   => '356',
                'is_active'     => 0
            ],
            [
                'id'            => 131,
                'name'          => 'Marshall Islands',
                'short_code'    => 'mh',
                'mobile_code'   => '692',
                'is_active'     => 0
            ],
            [
                'id'            => 132,
                'name'          => 'Mauritania',
                'short_code'    => 'mr',
                'mobile_code'   => '222',
                'is_active'     => 0
            ],
            [
                'id'            => 133,
                'name'          => 'Mauritius',
                'short_code'    => 'mu',
                'mobile_code'   => '230',
                'is_active'     => 0
            ],
            [
                'id'            => 134,
                'name'          => 'Mayotte',
                'short_code'    => 'yt',
                'mobile_code'   => '262',
                'is_active'     => 0
            ],
            [
                'id'            => 135,
                'name'          => 'Mexico',
                'short_code'    => 'mx',
                'mobile_code'   => '52',
                'is_active'     => 0
            ],
            [
                'id'            => 136,
                'name'          => 'Micronesia',
                'short_code'    => 'fm',
                'mobile_code'   => '691',
                'is_active'     => 0
            ],
            [
                'id'            => 137,
                'name'          => 'Moldova',
                'short_code'    => 'md',
                'mobile_code'   => '373',
                'is_active'     => 0
            ],
            [
                'id'            => 138,
                'name'          => 'Monaco',
                'short_code'    => 'mc',
                'mobile_code'   => '377',
                'is_active'     => 0
            ],
            [
                'id'            => 139,
                'name'          => 'Mongolia',
                'short_code'    => 'mn',
                'mobile_code'   => '976',
                'is_active'     => 0
            ],
            [
                'id'            => 140,
                'name'          => 'Montenegro',
                'short_code'    => 'me',
                'mobile_code'   => '382',
                'is_active'     => 0
            ],
            [
                'id'            => 141,
                'name'          => 'Montserrat',
                'short_code'    => 'ms',
                'mobile_code'   => '1',
                'is_active'     => 0
            ],
            [
                'id'            => 142,
                'name'          => 'Morocco',
                'short_code'    => 'ma',
                'mobile_code'   => '212',
                'is_active'     => 0
            ],
            [
                'id'            => 143,
                'name'          => 'Mozambique',
                'short_code'    => 'mz',
                'mobile_code'   => '258',
                'is_active'     => 0
            ],
            [
                'id'            => 144,
                'name'          => 'Myanmar',
                'short_code'    => 'mm',
                'mobile_code'   => '95',
                'is_active'     => 0
            ],
            [
                'id'            => 145,
                'name'          => 'Namibia',
                'short_code'    => 'na',
                'mobile_code'   => '264',
                'is_active'     => 0
            ],
            [
                'id'            => 146,
                'name'          => 'Nauru',
                'short_code'    => 'nr',
                'mobile_code'   => '674',
                'is_active'     => 0
            ],
            [
                'id'            => 147,
                'name'          => 'Nepal',
                'short_code'    => 'np',
                'mobile_code'   => '977',
                'is_active'     => 0
            ],
            [
                'id'            => 148,
                'name'          => 'Netherlands',
                'short_code'    => 'nl',
                'mobile_code'   => '31',
                'is_active'     => 0
            ],
            [
                'id'            => 149,
                'name'          => 'Netherlands Antilles',
                'short_code'    => 'an',
                'mobile_code'   => '599',
                'is_active'     => 0
            ],
            [
                'id'            => 150,
                'name'          => 'New Caledonia',
                'short_code'    => 'nc',
                'mobile_code'   => '687',
                'is_active'     => 0
            ],
            [
                'id'            => 151,
                'name'          => 'New Zealand',
                'short_code'    => 'nz',
                'mobile_code'   => '64',
                'is_active'     => 0
            ],
            [
                'id'            => 152,
                'name'          => 'Nicaragua',
                'short_code'    => 'ni',
                'mobile_code'   => '505',
                'is_active'     => 0
            ],
            [
                'id'            => 153,
                'name'          => 'Niger',
                'short_code'    => 'ne',
                'mobile_code'   => '227',
                'is_active'     => 0
            ],
            [
                'id'            => 154,
                'name'          => 'Nigeria',
                'short_code'    => 'ng',
                'mobile_code'   => '234',
                'is_active'     => 0
            ],
            [
                'id'            => 155,
                'name'          => 'Niue',
                'short_code'    => 'nu',
                'mobile_code'   => '683',
                'is_active'     => 0
            ],
            [
                'id'            => 156,
                'name'          => 'North Korea',
                'short_code'    => 'kp',
                'mobile_code'   => '850',
                'is_active'     => 0
            ],
            [
                'id'            => 157,
                'name'          => 'Northern Mariana Islands',
                'short_code'    => 'mp',
                'mobile_code'   => '1',
                'is_active'     => 0
            ],
            [
                'id'            => 158,
                'name'          => 'Norway',
                'short_code'    => 'no',
                'mobile_code'   => '47',
                'is_active'     => 0
            ],
            [
                'id'            => 159,
                'name'          => 'Oman',
                'short_code'    => 'om',
                'mobile_code'   => '968',
                'is_active'     => 0
            ],
            [
                'id'            => 160,
                'name'          => 'Pakistan',
                'short_code'    => 'pk',
                'mobile_code'   => '92',
                'is_active'     => 0
            ],
            [
                'id'            => 161,
                'name'          => 'Palau',
                'short_code'    => 'pw',
                'mobile_code'   => '680',
                'is_active'     => 0
            ],
            [
                'id'            => 162,
                'name'          => 'Palestine',
                'short_code'    => 'ps',
                'mobile_code'   => '970',
                'is_active'     => 0
            ],
            [
                'id'            => 163,
                'name'          => 'Panama',
                'short_code'    => 'pa',
                'mobile_code'   => '507',
                'is_active'     => 0
            ],
            [
                'id'            => 164,
                'name'          => 'Papua New Guinea',
                'short_code'    => 'pg',
                'mobile_code'   => '675',
                'is_active'     => 0
            ],
            [
                'id'            => 165,
                'name'          => 'Paraguay',
                'short_code'    => 'py',
                'mobile_code'   => '595',
                'is_active'     => 0
            ],
            [
                'id'            => 166,
                'name'          => 'Peru',
                'short_code'    => 'pe',
                'mobile_code'   => '51',
                'is_active'     => 0
            ],
            [
                'id'            => 167,
                'name'          => 'Philippines',
                'short_code'    => 'ph',
                'mobile_code'   => '63',
                'is_active'     => 0
            ],
            [
                'id'            => 168,
                'name'          => 'Pitcairn',
                'short_code'    => 'pn',
                'mobile_code'   => '64',
                'is_active'     => 0
            ],
            [
                'id'            => 169,
                'name'          => 'Poland',
                'short_code'    => 'pl',
                'mobile_code'   => '48',
                'is_active'     => 0
            ],
            [
                'id'            => 170,
                'name'          => 'Portugal',
                'short_code'    => 'pt',
                'mobile_code'   => '351',
                'is_active'     => 0
            ],
            [
                'id'            => 171,
                'name'          => 'Puerto Rico',
                'short_code'    => 'pr',
                'mobile_code'   => '1',
                'is_active'     => 0
            ],
            [
                'id'            => 172,
                'name'          => 'Qatar',
                'short_code'    => 'qa',
                'mobile_code'   => '974',
                'is_active'     => 0
            ],
            [
                'id'            => 173,
                'name'          => 'Republic of the Congo',
                'short_code'    => 'cg',
                'mobile_code'   => '242',
                'is_active'     => 0
            ],
            [
                'id'            => 174,
                'name'          => 'Reunion',
                'short_code'    => 're',
                'mobile_code'   => '262',
                'is_active'     => 0
            ],
            [
                'id'            => 175,
                'name'          => 'Romania',
                'short_code'    => 'ro',
                'mobile_code'   => '40',
                'is_active'     => 0
            ],
            [
                'id'            => 176,
                'name'          => 'Russia',
                'short_code'    => 'ru',
                'mobile_code'   => '7',
                'is_active'     => 0
            ],
            [
                'id'            => 177,
                'name'          => 'Rwanda',
                'short_code'    => 'rw',
                'mobile_code'   => '250',
                'is_active'     => 0
            ],
            [
                'id'            => 178,
                'name'          => 'Saint Barthelemy',
                'short_code'    => 'bl',
                'mobile_code'   => '590',
                'is_active'     => 0
            ],
            [
                'id'            => 179,
                'name'          => 'Saint Helena',
                'short_code'    => 'sh',
                'mobile_code'   => '290',
                'is_active'     => 0
            ],
            [
                'id'            => 180,
                'name'          => 'Saint Kitts and Nevis',
                'short_code'    => 'kn',
                'mobile_code'   => '1',
                'is_active'     => 0
            ],
            [
                'id'            => 181,
                'name'          => 'Saint Lucia',
                'short_code'    => 'lc',
                'mobile_code'   => '1',
                'is_active'     => 0
            ],
            [
                'id'            => 182,
                'name'          => 'Saint Martin',
                'short_code'    => 'mf',
                'mobile_code'   => '599',
                'is_active'     => 0
            ],
            [
                'id'            => 183,
                'name'          => 'Saint Pierre and Miquelon',
                'short_code'    => 'pm',
                'mobile_code'   => '508',
                'is_active'     => 0
            ],
            [
                'id'            => 184,
                'name'          => 'Saint Vincent and the Grenadines',
                'short_code'    => 'vc',
                'mobile_code'   => '1',
                'is_active'     => 0
            ],
            [
                'id'            => 185,
                'name'          => 'Samoa',
                'short_code'    => 'ws',
                'mobile_code'   => '685',
                'is_active'     => 0
            ],
            [
                'id'            => 186,
                'name'          => 'San Marino',
                'short_code'    => 'sm',
                'mobile_code'   => '378',
                'is_active'     => 0
            ],
            [
                'id'            => 187,
                'name'          => 'Sao Tome and Principe',
                'short_code'    => 'st',
                'mobile_code'   => '239',
                'is_active'     => 0
            ],
            [
                'id'            => 188,
                'name'          => 'Saudi Arabia',
                'short_code'    => 'sa',
                'mobile_code'   => '966',
                'is_active'     => 0
            ],
            [
                'id'            => 189,
                'name'          => 'Senegal',
                'short_code'    => 'sn',
                'mobile_code'   => '221',
                'is_active'     => 0
            ],
            [
                'id'            => 190,
                'name'          => 'Serbia',
                'short_code'    => 'rs',
                'mobile_code'   => '381',
                'is_active'     => 0
            ],
            [
                'id'            => 191,
                'name'          => 'Seychelles',
                'short_code'    => 'sc',
                'mobile_code'   => '248',
                'is_active'     => 0
            ],
            [
                'id'            => 192,
                'name'          => 'Sierra Leone',
                'short_code'    => 'sl',
                'mobile_code'   => '232',
                'is_active'     => 0
            ],
            [
                'id'            => 193,
                'name'          => 'Singapore',
                'short_code'    => 'sg',
                'mobile_code'   => '65',
                'is_active'     => 1
            ],
            [
                'id'            => 194,
                'name'          => 'Sint Maarten',
                'short_code'    => 'sx',
                'mobile_code'   => '599',
                'is_active'     => 0
            ],
            [
                'id'            => 195,
                'name'          => 'Slovakia',
                'short_code'    => 'sk',
                'mobile_code'   => '421',
                'is_active'     => 0
            ],
            [
                'id'            => 196,
                'name'          => 'Slovenia',
                'short_code'    => 'si',
                'mobile_code'   => '386',
                'is_active'     => 0
            ],
            [
                'id'            => 197,
                'name'          => 'Solomon Islands',
                'short_code'    => 'sb',
                'mobile_code'   => '677',
                'is_active'     => 0
            ],
            [
                'id'            => 198,
                'name'          => 'Somalia',
                'short_code'    => 'so',
                'mobile_code'   => '252',
                'is_active'     => 0
            ],
            [
                'id'            => 199,
                'name'          => 'South Africa',
                'short_code'    => 'za',
                'mobile_code'   => '27',
                'is_active'     => 0
            ],
            [
                'id'            => 200,
                'name'          => 'South Korea',
                'short_code'    => 'kr',
                'mobile_code'   => '82',
                'is_active'     => 0
            ],
            [
                'id'            => 201,
                'name'          => 'South Sudan',
                'short_code'    => 'ss',
                'mobile_code'   => '211',
                'is_active'     => 0
            ],
            [
                'id'            => 202,
                'name'          => 'Spain',
                'short_code'    => 'es',
                'mobile_code'   => '34',
                'is_active'     => 0
            ],
            [
                'id'            => 203,
                'name'          => 'Sri Lanka',
                'short_code'    => 'lk',
                'mobile_code'   => '94',
                'is_active'     => 0
            ],
            [
                'id'            => 204,
                'name'          => 'Sudan',
                'short_code'    => 'sd',
                'mobile_code'   => '249',
                'is_active'     => 0
            ],
            [
                'id'            => 205,
                'name'          => 'Suriname',
                'short_code'    => 'sr',
                'mobile_code'   => '597',
                'is_active'     => 0
            ],
            [
                'id'            => 206,
                'name'          => 'Svalbard and Jan Mayen',
                'short_code'    => 'sj',
                'mobile_code'   => '47',
                'is_active'     => 0
            ],
            [
                'id'            => 207,
                'name'          => 'Swaziland',
                'short_code'    => 'sz',
                'mobile_code'   => '268',
                'is_active'     => 0
            ],
            [
                'id'            => 208,
                'name'          => 'Sweden',
                'short_code'    => 'se',
                'mobile_code'   => '46',
                'is_active'     => 0
            ],
            [
                'id'            => 209,
                'name'          => 'Switzerland',
                'short_code'    => 'ch',
                'mobile_code'   => '41',
                'is_active'     => 0
            ],
            [
                'id'            => 210,
                'name'          => 'Syria',
                'short_code'    => 'sy',
                'mobile_code'   => '963',
                'is_active'     => 0
            ],
            [
                'id'            => 211,
                'name'          => 'Taiwan',
                'short_code'    => 'tw',
                'mobile_code'   => '886',
                'is_active'     => 0
            ],
            [
                'id'            => 212,
                'name'          => 'Tajikistan',
                'short_code'    => 'tj',
                'mobile_code'   => '992',
                'is_active'     => 0
            ],
            [
                'id'            => 213,
                'name'          => 'Tanzania',
                'short_code'    => 'tz',
                'mobile_code'   => '255',
                'is_active'     => 0
            ],
            [
                'id'            => 214,
                'name'          => 'Thailand',
                'short_code'    => 'th',
                'mobile_code'   => '66',
                'is_active'     => 0
            ],
            [
                'id'            => 215,
                'name'          => 'Togo',
                'short_code'    => 'tg',
                'mobile_code'   => '228',
                'is_active'     => 0
            ],
            [
                'id'            => 216,
                'name'          => 'Tokelau',
                'short_code'    => 'tk',
                'mobile_code'   => '690',
                'is_active'     => 0
            ],
            [
                'id'            => 217,
                'name'          => 'Tonga',
                'short_code'    => 'to',
                'mobile_code'   => '676',
                'is_active'     => 0
            ],
            [
                'id'            => 218,
                'name'          => 'Trinidad and Tobago',
                'short_code'    => 'tt',
                'mobile_code'   => '868',
                'is_active'     => 0
            ],
            [
                'id'            => 219,
                'name'          => 'Tunisia',
                'short_code'    => 'tn',
                'mobile_code'   => '216',
                'is_active'     => 0
            ],
            [
                'id'            => 220,
                'name'          => 'Turkey',
                'short_code'    => 'tr',
                'mobile_code'   => '90',
                'is_active'     => 0
            ],
            [
                'id'            => 221,
                'name'          => 'Turkmenistan',
                'short_code'    => 'tm',
                'mobile_code'   => '993',
                'is_active'     => 0
            ],
            [
                'id'            => 222,
                'name'          => 'Turks and Caicos Islands',
                'short_code'    => 'tc',
                'mobile_code'   => '1',
                'is_active'     => 0
            ],
            [
                'id'            => 223,
                'name'          => 'Tuvalu',
                'short_code'    => 'tv',
                'mobile_code'   => '688',
                'is_active'     => 0
            ],
            [
                'id'            => 224,
                'name'          => 'U.S. Virgin Islands',
                'short_code'    => 'vi',
                'mobile_code'   => '1',
                'is_active'     => 0
            ],
            [
                'id'            => 225,
                'name'          => 'Uganda',
                'short_code'    => 'ug',
                'mobile_code'   => '256',
                'is_active'     => 0
            ],
            [
                'id'            => 226,
                'name'          => 'Ukraine',
                'short_code'    => 'ua',
                'mobile_code'   => '380',
                'is_active'     => 0
            ],
            [
                'id'            => 227,
                'name'          => 'United Arab Emirates',
                'short_code'    => 'ae',
                'mobile_code'   => '971',
                'is_active'     => 0
            ],
            [
                'id'            => 228,
                'name'          => 'United Kingdom',
                'short_code'    => 'gb',
                'mobile_code'   => '44',
                'is_active'     => 0
            ],
            [
                'id'            => 229,
                'name'          => 'United States',
                'short_code'    => 'us',
                'mobile_code'   => '1',
                'is_active'     => 0
            ],
            [
                'id'            => 230,
                'name'          => 'Uruguay',
                'short_code'    => 'uy',
                'mobile_code'   => '598',
                'is_active'     => 0
            ],
            [
                'id'            => 231,
                'name'          => 'Uzbekistan',
                'short_code'    => 'uz',
                'mobile_code'   => '998',
                'is_active'     => 0
            ],
            [
                'id'            => 232,
                'name'          => 'Vanuatu',
                'short_code'    => 'vu',
                'mobile_code'   => '678',
                'is_active'     => 0
            ],
            [
                'id'            => 233,
                'name'          => 'Vatican',
                'short_code'    => 'va',
                'mobile_code'   => '379',
                'is_active'     => 0
            ],
            [
                'id'            => 234,
                'name'          => 'Venezuela',
                'short_code'    => 've',
                'mobile_code'   => '58',
                'is_active'     => 0
            ],
            [
                'id'            => 235,
                'name'          => 'Vietnam',
                'short_code'    => 'vn',
                'mobile_code'   => '84',
                'is_active'     => 0
            ],
            [
                'id'            => 236,
                'name'          => 'Wallis and Futuna',
                'short_code'    => 'wf',
                'mobile_code'   => '681',
                'is_active'     => 0
            ],
            [
                'id'            => 237,
                'name'          => 'Western Sahara',
                'short_code'    => 'eh',
                'mobile_code'   => '212',
                'is_active'     => 0
            ],
            [
                'id'            => 238,
                'name'          => 'Yemen',
                'short_code'    => 'ye',
                'mobile_code'   => '967',
                'is_active'     => 0
            ],
            [
                'id'            => 239,
                'name'          => 'Zambia',
                'short_code'    => 'zm',
                'mobile_code'   => '260',
                'is_active'     => 0
            ],
            [
                'id'            => 240,
                'name'          => 'Zimbabwe',
                'short_code'    => 'zw',
                'mobile_code'   => '263',
                'is_active'     => 0
            ],
        ];

        Country::insert($countries);
    }
}
