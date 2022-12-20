<?php

use App\Enums\MarketplaceID;
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
            $table->string('region_id');
            $table->string('country');
            $table->string('timezone');
            $table->string('domain_name');
            $table->string('country_code');
            $table->string('currency_code');
            $table->string('language_code');

            $table->foreign('region_id')
                ->references('id')
                ->on('regions');
        });

        Marketplace::insert(
            [
                [
                    "id" => MarketplaceID::BE,
                    "name" => "Amazon.com.be",
                    "country" => "Belgium",
                    "country_code" => "BE",
                    "currency_code" => "EUR",
                    "language_code" => "en-NL",
                    "domain_name" => "www.amazon.be",
                    "region_id" => "eu",
                    "timezone" => 'Europe/Paris'
                ],
                [
                    "id" => MarketplaceID::IN,
                    "name" => "Amazon.com.in",
                    "country" => "India",
                    "country_code" => "IN",
                    "currency_code" => "INR",
                    "language_code" => "en-HI",
                    "domain_name" => "www.amazon.in",
                    "region_id" => "eu",
                    "timezone" => 'Europe/Paris'
                ],
                [
                    "id" => MarketplaceID::SA,
                    "name" => "Amazon.com.sa",
                    "country" => "Saudi Arabia",
                    "country_code" => "SA",
                    "currency_code" => "SAR",
                    "language_code" => "en-AR",
                    "domain_name" => "www.amazon.sa",
                    "region_id" => "eu",
                    "timezone" => 'Europe/Paris'
                ],
                [
                    "id" => MarketplaceID::CA,
                    "name" => "Amazon.ca",
                    "country" => "Canada",
                    "country_code" => "CA",
                    "currency_code" => "CAD",
                    "language_code" => "en_CA",
                    "domain_name" => "www.amazon.ca",
                    "region_id" => "na",
                    "timezone" => "America/Los_Angeles"
                ],
                [
                    "id" => MarketplaceID::US,
                    "name" => "Amazon.com",
                    "country" => "USA",
                    "country_code" => "US",
                    "currency_code" => "USD",
                    "language_code" => "en_US",
                    "domain_name" => "www.amazon.com",
                    "region_id" => "na",
                    "timezone" => "America/Los_Angeles"
                ],
                [
                    "id" => MarketplaceID::MX,
                    "name" => "Amazon.com.mx",
                    "country" => "Mexico",
                    "country_code" => "MX",
                    "currency_code" => "MXN",
                    "language_code" => "en_MX",
                    "domain_name" => "www.amazon.com.mx",
                    "region_id" => "na",
                    "timezone" => "America/Los_Angeles"
                ],
                [
                    "id" => MarketplaceID::BR,
                    "name" => "Amazon.com.br",
                    "country" => "Brazil",
                    "country_code" => "BR",
                    "currency_code" => "BRL",
                    "language_code" => "en_BR",
                    "domain_name" => "www.amazon.com.br",
                    "region_id" => "na",
                    "timezone" => "America/Sao_Paulo"
                ],
                [
                    "id" => MarketplaceID::UK,
                    "name" => "Amazon.com.uk",
                    "country" => "UK",
                    "country_code" => "UK",
                    "currency_code" => "GBP",
                    "language_code" => "en-DE",
                    "domain_name" => "www.amazon.co.uk",
                    "region_id" => "eu",
                    "timezone" => "Europe/London"
                ],
                [
                    "id" => MarketplaceID::EG,
                    "name" => "Amazon.com.eg",
                    "country" => "Egypt",
                    "country_code" => "EG",
                    "currency_code" => "EGP",
                    "language_code" => "en_AR",
                    "domain_name" => "www.amazon.eg",
                    "region_id" => "eu",
                    "timezone" => "Africa/Cairo"
                ],
                [
                    "id" => MarketplaceID::FR,
                    "name" => "Amazon.com.fr",
                    "country" => "France",
                    "country_code" => "FR",
                    "currency_code" => "EUR",
                    "language_code" => "en-FR",
                    "domain_name" => "www.amazon.fr",
                    "region_id" => "eu",
                    "timezone" => "Europe/Paris"
                ],
                [
                    "id" => MarketplaceID::DE,
                    "name" => "Amazon.com.de",
                    "country" => "Germany",
                    "country_code" => "DE",
                    "currency_code" => "EUR",
                    "language_code" => "en_DE",
                    "domain_name" => "www.amazon.de",
                    "region_id" => "eu",
                    "timezone" => "Europe/Paris"
                ],
                [
                    "id" => MarketplaceID::IT,
                    "name" => "Amazon.com.it",
                    "country" => "Italy",
                    "country_code" => "IT",
                    "currency_code" => "EUR",
                    "language_code" => "en-IT",
                    "domain_name" => "www.amazon.it",
                    "region_id" => "eu",
                    "timezone" => "Europe/Paris"
                ],
                [
                    "id" => MarketplaceID::NL,
                    "name" => "Amazon.com.nl",
                    "country" => "Netherlands",
                    "country_code" => "NL",
                    "currency_code" => "EUR",
                    "language_code" => "en-NL",
                    "domain_name" => "www.amazon.nl",
                    "region_id" => "eu",
                    "timezone" => "Europe/Paris"
                ],
                [
                    "id" => MarketplaceID::ES,
                    "name" => "Amazon.com.es",
                    "country" => "Spain",
                    "country_code" => "ES",
                    "currency_code" => "EUR",
                    "language_code" => "en_ES",
                    "domain_name" => "www.amazon.es",
                    "region_id" => "eu",
                    "timezone" => "Europe/Paris"
                ],
                [
                    "id" => MarketplaceID::SE,
                    "name" => "Amazon.com.se",
                    "country" => "Sweden",
                    "country_code" => "SE",
                    "currency_code" => "SEK",
                    "language_code" => "en-SV",
                    "domain_name" => "www.amazon.se",
                    "region_id" => "eu",
                    "timezone" => "Europe/Stockholm"
                ],
                [
                    "id" => MarketplaceID::AE,
                    "name" => "Amazon.com.ae",
                    "country" => "United Arab Emirates (U.A.E.)",
                    "country_code" => "AE",
                    "currency_code" => "AED",
                    "language_code" => "en_AR",
                    "domain_name" => "www.amazon.ae",
                    "region_id" => "eu",
                    "timezone" => "Asia/Dubai"
                ],
                [
                    "id" => MarketplaceID::TR,
                    "name" => "Amazon.com.tr",
                    "country" => "Turkey",
                    "country_code" => "TR",
                    "currency_code" => "TRY",
                    "language_code" => "en-TR",
                    "domain_name" => "www.amazon.com.tr",
                    "region_id" => "eu",
                    "timezone" => "Europe/Istanbul"
                ],
                [
                    "id" => MarketplaceID::PL,
                    "name" => "Amazon.com.pl",
                    "country" => "Poland",
                    "country_code" => "PL",
                    "currency_code" => "PLN",
                    "language_code" => "en-PL",
                    "domain_name" => "www.amazon.pl",
                    "region_id" => "eu",
                    "timezone" => "Europe/Warsaw"
                ],
                [
                    "id" => MarketplaceID::JP,
                    "name" => "Amazon.com.jp",
                    "country" => "Japan",
                    "country_code" => "JP",
                    "currency_code" => "JPY",
                    "language_code" => "en-JA",
                    "domain_name" => "www.amazon.co.jp",
                    "region_id" => "fe",
                    "timezone" => "Asia/Tokyo"
                ],
                [
                    "id" =>  MarketplaceID::AU,
                    "name" => "Amazon.com.au",
                    "country" => "Australia",
                    "country_code" => "AU",
                    "currency_code" => "AUD",
                    "language_code" => "en-US",
                    "domain_name" => "www.amazon.com.au",
                    "region_id" => "fe",
                    "timezone" => "Australia/Sydney"
                ],
                [
                    "id" => MarketplaceID::SG,
                    "name" => "Amazon.com.sg",
                    "country" => "Singapore",
                    "country_code" => "SG",
                    "currency_code" => "SGD",
                    "language_code" => "en-US",
                    "domain_name" => "www.amazon.sg",
                    "region_id" => "fe",
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
