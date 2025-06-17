<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Standard Service',
                'price' => 69,
                'meta' => [
                    'title' => 'Get Standard Azerbaijan eVisa in 3-5 Working Day'
                ]
            ],
            [
                'title' => 'Fast Service',
                'price' => 69,
                'meta' => [
                    'title' => 'Get Urgent Azerbaijan eVisa in 24 Hours'
                ]
            ],
            [
                'title' => 'Emergency Service',
                'price' => 69,
                'meta' => [
                    'title' => 'Get Urgent Azerbaijan eVisa in 24 Hours'
                ]
            ],
        ];

        foreach ($services as $service) {
            $newService = new Service();
            $newService->title = $service['title'];
            $newService->slug = Str::slug($service['title']);
            $newService->price = $service['price'];
            $newService->meta = $service['meta'];
            $newService->save();
        }
    }
}
