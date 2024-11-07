<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\GuestService;
use App\DTO\GuestDTO;
use App\Http\Requests\CreateGuestRequest;
use App\Http\Requests\UpdateGuestRequest;
use Illuminate\Http\JsonResponse;
use Exception;

class GuestController extends Controller
{
	protected GuestService $guestService;

	public function __construct(GuestService $guestService)
	{
		$this->guestService = $guestService;
	}

	/**
	 * Создание нового гостя.
	 */
	public function create(CreateGuestRequest $request): JsonResponse
	{
		try {
			$guestDTO = new GuestDTO(
				$request->input('first_name'),
				$request->input('last_name'),
				$request->input('email'),
				$request->input('phone'),
				$request->input('country') ?? null
			);

			$guest = $this->guestService->createGuest($guestDTO);

			return response()->json($guest, 201);
		} catch (Exception $e) {
			return response()->json(['error' => $e->getMessage()], 400);
		}
	}

	/**
	 * Получение гостя по ID.
	 */
	public function show(string $id): JsonResponse
	{
		try {
			$guest = $this->guestService->getGuestById($id);
			return response()->json($guest, 200);
		} catch (Exception $e) {
			return response()->json(['error' => $e->getMessage()], 404);
		}
	}

	/**
	 * Получение списка всех гостей.
	 */
	public function index(): JsonResponse
	{
		try {
			$guests = $this->guestService->getAllGuests();
			return response()->json($guests, 200);
		} catch (Exception $e) {
			return response()->json(['error' => $e->getMessage()], 500);
		}
	}

	/**
	 * Обновление информации о госте.
	 */
	public function update(UpdateGuestRequest $request, string $id): JsonResponse
	{
		try {
			$guestDTO = new GuestDTO(
				$request->input('first_name'),
				$request->input('last_name'),
				$request->input('email'),
				$request->input('phone'),
				$request->input('country') ?? null
			);

			$guest = $this->guestService->updateGuest($id, $guestDTO);

			return response()->json($guest, 200);
		} catch (Exception $e) {
			return response()->json(['error' => $e->getMessage()], 404);
		}
	}

	/**
	 * Удаление гостя.
	 */
	public function destroy(string $id): JsonResponse
	{
		try {
			$this->guestService->deleteGuest($id);
			return response()->json(['message' => "Гость с ID {$id} успешно удалён"], 200);
		} catch (Exception $e) {
			return response()->json(['error' => $e->getMessage()], 404);
		}
	}
}
