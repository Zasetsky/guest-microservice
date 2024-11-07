<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DebugHeadersMiddleware
{
	public function handle(Request $request, Closure $next): Response
	{
		// Засекаем начальное время и начальное потребление памяти
		$startTime = microtime(true);
		$startMemory = memory_get_usage();

		// Выполняем запрос
		$response = $next($request);

		// Вычисляем время выполнения и объем памяти
		$executionTime = (microtime(true) - $startTime) * 1000; // перевод в миллисекунды
		$memoryUsage = (memory_get_usage() - $startMemory) / 1024; // перевод в КБ

		// Добавляем заголовки к ответу
		$response->headers->set('X-Debug-Time', number_format($executionTime, 2) . ' ms');
		$response->headers->set('X-Debug-Memory', number_format($memoryUsage, 2) . ' KB');

		return $response;
	}
}
