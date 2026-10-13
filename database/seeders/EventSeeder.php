<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technology = Category::where(
            'name',
            'Tecnologia'
        )->firstOrFail();

        $development = Category::where(
            'name',
            'Desenvolvimento'
        )->firstOrFail();

        Event::updateOrCreate(
            ['title' => 'Workshop Laravel'],
            [
                'category_id' => $development->id,
                'description' => 'Workshop introdutório sobre desenvolvimento de aplicações web com Laravel.',
                'location' => 'Laboratório de Desenvolvimento',
                'start_at' => now()->addDays(7)->setTime(18, 0),
                'end_at' => now()->addDays(7)->setTime(21, 0),
                'capacity' => 30,
                'status' => 'sheduled',
            ]
        );

        Event::updateOrCreate(
            ['title' => 'Palestra sobre Inteligência Artificial'],
            [
                'category_id' => $technology->id,
                'description' => 'Palestra sobre aplicações da inteligência artificial no desenvolvimento de sistemas.',
                'location' => 'Auditório Principal',
                'start_at' => now()->addDays(14)->setTime(19, 0),
                'end_at' => now()->addDays(14)->setTime(21, 0),
                'capacity' => 100,
                'status' => 'sheduled',
            ]
        );
    }
}
