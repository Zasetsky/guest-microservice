<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Guest;
use App\DTO\GuestDTO;
use App\Services\CountryService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Exception;

class GuestService
{
	/**
	 * Создание нового гостя.
	 */
	public function createGuest(GuestDTO $guestDTO): Guest
	{
		try {
			return DB::transaction(function () use ($guestDTO) {
				return Guest::create([
					'first_name' => $guestDTO->firstName,
					'last_name' => $guestDTO->lastName,
					'email' => $guestDTO->email,
					'phone' => $guestDTO->phone,
					'country' => $guestDTO->country ?? CountryService::determineCountryByPhone($guestDTO->phone)->value,
				]);
			});
		} catch (Exception $e) {
			throw new Exception("Ошибка при создании гостя: " . $e->getMessage());
		}
	}

	/**
	 * Получение гостя по идентификатору.
	 */
	public function getGuestById(string $id): Guest
	{
		try {
			return Guest::findOrFail($id);
		} catch (ModelNotFoundException $e) {
			throw new Exception("Гость с ID {$id} не найден.");
		} catch (Exception $e) {
			throw new Exception("Произошла ошибка при получении гостя: " . $e->getMessage());
		}
	}

	/**
	 * Получение всех гостей.
	 */
	public function getAllGuests(): Collection
	{
		try {
			return Guest::all();
		} catch (Exception $e) {
			throw new Exception("Произошла ошибка при получении списка гостей: " . $e->getMessage());
		}
	}

	/**
	 * Обновление информации о госте.
	 */
	public function updateGuest(string $id, GuestDTO $guestDTO): Guest
	{
		try {
			return DB::transaction(function () use ($id, $guestDTO) {
				$guest = Guest::findOrFail($id);

				$updateData = array_filter([
					'first_name' => $guestDTO->firstName,
					'last_name' => $guestDTO->lastName,
					'email' => $guestDTO->email,
					'phone' => $guestDTO->phone,
					'country' => $guestDTO->country,
				], function ($value) {
					return !is_null($value);
				});

				$guest->update($updateData);

				return $guest;
			});
		} catch (ModelNotFoundException $e) {
			throw new Exception("Гость с ID {$id} не найден, обновление не удалось.");
		} catch (Exception $e) {
			throw new Exception("Ошибка при обновлении гостя: " . $e->getMessage());
		}
	}


	/**
	 * Удаление гостя.
	 */
	public function deleteGuest(string $id): void
	{
		try {
			DB::transaction(function () use ($id) {
				$guest = Guest::findOrFail($id);
				$guest->delete();
			});
		} catch (ModelNotFoundException $e) {
			throw new Exception("Гость с ID {$id} не найден, удаление невозможно.");
		} catch (Exception $e) {
			throw new Exception("Ошибка при удалении гостя: " . $e->getMessage());
		}
	}
}
