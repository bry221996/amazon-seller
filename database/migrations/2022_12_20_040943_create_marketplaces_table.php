<?php

use App\Models\Account\Marketplace;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketplaces', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name')->unique();
            $table->string('region');
            $table->string('country');
            $table->string('timezone');
            $table->string('domain_name');
            $table->string('country_code');
            $table->string('currency_code');
            $table->string('language_code');

            $table->foreign('region')
                ->references('id')
                ->on('regions');
        });

        Marketplace::insert(
            [
                [
                    "id" => "AMEN7PMS3EDWL",
                    "name" => "Amazon.com.be",
                    "country" => "Belgium",
                    "country_code" => "BE",
                    "currency_code" => "EUR",
                    "language_code" => "en-NL",
                    "domain_name" => "www.amazon.be",
                    "region" => "eu",
                    "timezone" => 'Europe/Paris'
                ],
                [
                    "id" => "A21TJRUUN4KGV",
                    "name" => "Amazon.com.in",
                    "country" => "India",
                    "country_code" => "IN",
                    "currency_code" => "INR",
                    "language_code" => "en-HI",
                    "domain_name" => "www.amazon.in",
                    "region" => "eu",
                    "timezone" => 'Europe/Paris'
                ],
                [
                    "id" => "A17E79C6D8DWNP",
                    "name" => "Amazon.com.sa",
                    "country" => "Saudi Arabia",
                    "country_code" => "SA",
                    "currency_code" => "SAR",
                    "language_code" => "en-AR",
                    "domain_name" => "www.amazon.sa",
                    "region" => "eu",
                    "timezone" => 'Europe/Paris'
                ],
                [
                    "id" => "A2EUQ1WTGCTBG2",
                    "name" => "Amazon.ca",
                    "country" => "Canada",
                    "country_code" => "CA",
                    "currency_code" => "CAD",
                    "language_code" => "en_CA",
                    "domain_name" => "www.amazon.ca",
                    "region" => "na",
                    "timezone" => "America/Los_Angeles"
                ],
                [
                    "id" => "ATVPDKIKX0DER",
                    "name" => "Amazon.com",
                    "country" => "USA",
                    "country_code" => "US",
                    "currency_code" => "USD",
                    "language_code" => "en_US",
                    "domain_name" => "www.amazon.com",
                    "region" => "na",
                    "timezone" => "America/Los_Angeles"
                ],
                [
                    "id" => "A1AM78C64UM0Y8",
                    "name" => "Amazon.com.mx",
                    "country" => "Mexico",
                    "country_code" => "MX",
                    "currency_code" => "MXN",
                    "language_code" => "en_MX",
                    "domain_name" => "www.amazon.com.mx",
                    "region" => "na",
                    "timezone" => "America/Los_Angeles"
                ],
                [
                    "id" => "A2Q3Y263D00KWC",
                    "name" => "Amazon.com.br",
                    "country" => "Brazil",
                    "country_code" => "BR",
                    "currency_code" => "BRL",
                    "language_code" => "en_BR",
                    "domain_name" => "www.amazon.com.br",
                    "region" => "na",
                    "timezone" => "America/Sao_Paulo"
                ],
                [
                    "id" => "A1F83G8C2ARO7P",
                    "name" => "Amazon.com.uk",
                    "country" => "UK",
                    "country_code" => "UK",
                    "currency_code" => "GBP",
                    "language_code" => "en-DE",
                    "domain_name" => "www.amazon.co.uk",
                    "region" => "eu",
                    "timezone" => "Europe/London"
                ],
                [
                    "id" => "ARBP9OOSHTCHU",
                    "name" => "Amazon.com.eg",
                    "country" => "Egypt",
                    "country_code" => "EG",
                    "currency_code" => "EGP",
                    "language_code" => "en_AR",
                    "domain_name" => "www.amazon.eg",
                    "region" => "eu",
                    "timezone" => "Africa/Cairo"
                ],
                [
                    "id" => "A13V1IB3VIYZZH",
                    "name" => "Amazon.com.fr",
                    "country" => "France",
                    "country_code" => "FR",
                    "currency_code" => "EUR",
                    "language_code" => "en-FR",
                    "domain_name" => "www.amazon.fr",
                    "region" => "eu",
                    "timezone" => "Europe/Paris"
                ],
                [
                    "id" => "A1PA6795UKMFR9",
                    "name" => "Amazon.com.de",
                    "country" => "Germany",
                    "country_code" => "DE",
                    "currency_code" => "EUR",
                    "language_code" => "en_DE",
                    "domain_name" => "www.amazon.de",
                    "region" => "eu",
                    "timezone" => "Europe/Paris"
                ],
                [
                    "id" => "APJ6JRA9NG5V4",
                    "name" => "Amazon.com.it",
                    "country" => "Italy",
                    "country_code" => "IT",
                    "currency_code" => "EUR",
                    "language_code" => "en-IT",
                    "domain_name" => "www.amazon.it",
                    "region" => "eu",
                    "timezone" => "Europe/Paris"
                ],
                [
                    "id" => "A1805IZSGTT6HS",
                    "name" => "Amazon.com.nl",
                    "country" => "Netherlands",
                    "country_code" => "NL",
                    "currency_code" => "EUR",
                    "language_code" => "en-NL",
                    "domain_name" => "www.amazon.nl",
                    "region" => "eu",
                    "timezone" => "Europe/Paris"
                ],
                [
                    "id" => "A1RKKUPIHCS9HS",
                    "name" => "Amazon.com.es",
                    "country" => "Spain",
                    "country_code" => "ES",
                    "currency_code" => "EUR",
                    "language_code" => "en_ES",
                    "domain_name" => "www.amazon.es",
                    "region" => "eu",
                    "timezone" => "Europe/Paris"
                ],
                [
                    "id" => "A2NODRKZP88ZB9",
                    "name" => "Amazon.com.se",
                    "country" => "Sweden",
                    "country_code" => "SE",
                    "currency_code" => "SEK",
                    "language_code" => "en-SV",
                    "domain_name" => "www.amazon.se",
                    "region" => "eu",
                    "timezone" => "Europe/Stockholm"
                ],
                [
                    "id" => "A2VIGQ35RCS4UG",
                    "name" => "Amazon.com.ae",
                    "country" => "United Arab Emirates (U.A.E.)",
                    "country_code" => "AE",
                    "currency_code" => "AED",
                    "language_code" => "en_AR",
                    "domain_name" => "www.amazon.ae",
                    "region" => "eu",
                    "timezone" => "Asia/Dubai"
                ],
                [
                    "id" => "A33AVAJ2PDY3EV",
                    "name" => "Amazon.com.tr",
                    "country" => "Turkey",
                    "country_code" => "TR",
                    "currency_code" => "TRY",
                    "language_code" => "en-TR",
                    "domain_name" => "www.amazon.com.tr",
                    "region" => "eu",
                    "timezone" => "Europe/Istanbul"
                ],
                [
                    "id" => "A1C3SOZRARQ6R3",
                    "name" => "Amazon.com.pl",
                    "country" => "Poland",
                    "country_code" => "PL",
                    "currency_code" => "PLN",
                    "language_code" => "en-PL",
                    "domain_name" => "www.amazon.pl",
                    "region" => "eu",
                    "timezone" => "Europe/Warsaw"
                ],
                [
                    "id" => "A1VC38T7YXB528",
                    "name" => "Amazon.com.jp",
                    "country" => "Japan",
                    "country_code" => "JP",
                    "currency_code" => "JPY",
                    "language_code" => "en-JA",
                    "domain_name" => "www.amazon.co.jp",
                    "region" => "fe",
                    "timezone" => "Asia/Tokyo"
                ],
                [
                    "id" => "A39IBJ37TRP1C6",
                    "name" => "Amazon.com.au",
                    "country" => "Australia",
                    "country_code" => "AU",
                    "currency_code" => "AUD",
                    "language_code" => "en-US",
                    "domain_name" => "www.amazon.com.au",
                    "region" => "fe",
                    "timezone" => "Australia/Sydney"
                ],
                [
                    "id" => "A19VAU5U5O7RUS",
                    "name" => "Amazon.com.sg",
                    "country" => "Singapore",
                    "country_code" => "SG",
                    "currency_code" => "SGD",
                    "language_code" => "en-US",
                    "domain_name" => "www.amazon.sg",
                    "region" => "fe",
                    "timezone" => "Asia/Singapore"
                ]
            ]

        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marketplaces');
    }
};
