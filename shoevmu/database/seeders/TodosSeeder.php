<?php

namespace Database\Seeders;

use App\Models\Todo;
use Database\Factories\TodoFactory;
use Illuminate\Database\Seeder;
use Psy\VersionUpdater\Downloader\Factory;

class TodosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Todo::factory()->count(5)->create();
    }
}
