<?php

namespace App\Enums;

enum CountryCode: string
{
	case RUSSIA = 'Россия';
	case BELARUS = 'Беларусь';
	case KAZAKHSTAN = 'Казахстан';
	case UKRAINE = 'Украина';
	case ARMENIA = 'Армения';
	case AZERBAIJAN = 'Азербайджан';
	case GEORGIA = 'Грузия';
	case KYRGYZSTAN = 'Киргизия';
	case MOLDOVA = 'Молдова';
	case TAJIKISTAN = 'Таджикистан';
	case UZBEKISTAN = 'Узбекистан';
	case UNKNOWN = 'Неизвестно';
}
