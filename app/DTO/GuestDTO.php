<?php

namespace App\DTO;

class GuestDTO
{
	public ?string $firstName;
	public ?string $lastName;
	public ?string $email;
	public ?string $phone;
	public ?string $country;

	public function __construct(?string $firstName, ?string $lastName, ?string $email, ?string $phone, ?string $country)
	{
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->email = $email;
		$this->phone = $phone;
		$this->country = $country;
	}

	public function toArray(): array
	{
		return [
			'first_name' => $this->firstName,
			'last_name' => $this->lastName,
			'email' => $this->email,
			'phone' => $this->phone,
			'country' => $this->country,
		];
	}
}
