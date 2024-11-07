<?php

namespace Database\Seeders;

use App\Models\Guest;
use Illuminate\Database\Seeder;

class GuestSeeder extends Seeder
{
    /**
     * Заполнение таблицы гостей.
     */
    public function run(): void
    {
        Guest::factory()->count(10)->create();
    }
}
