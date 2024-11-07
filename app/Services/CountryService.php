<?php
declare(strict_types=1);

namespace App\Services;

use App\Enums\CountryCode;
use App\Enums\CountryCodePrefix;

class CountryService
{
	/**
	 * Определение страны по телефону.
	 */
	public static function determineCountryByPhone(string $phone): CountryCode
	{
		if (!str_starts_with($phone, '+')) {
			$phone = '+' . $phone;
		}

		foreach (CountryCodePrefix::cases() as $prefix) {
			if (str_starts_with($phone, $prefix->value)) {
				return match ($prefix) {
					CountryCodePrefix::RUSSIA => CountryCode::RUSSIA,
					CountryCodePrefix::BELARUS => CountryCode::BELARUS,
					CountryCodePrefix::UKRAINE => CountryCode::UKRAINE,
					CountryCodePrefix::ARMENIA => CountryCode::ARMENIA,
					CountryCodePrefix::AZERBAIJAN => CountryCode::AZERBAIJAN,
					CountryCodePrefix::GEORGIA => CountryCode::GEORGIA,
					CountryCodePrefix::KYRGYZSTAN => CountryCode::KYRGYZSTAN,
					CountryCodePrefix::MOLDOVA => CountryCode::MOLDOVA,
					CountryCodePrefix::TAJIKISTAN => CountryCode::TAJIKISTAN,
					CountryCodePrefix::UZBEKISTAN => CountryCode::UZBEKISTAN,
				};
			}
		}

		return CountryCode::UNKNOWN;
	}
}
