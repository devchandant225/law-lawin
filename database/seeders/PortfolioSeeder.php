<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $portfolios = [
            [
                'title' => 'E-Commerce Platform Development',
                'order' => 1,
                'status' => 'active',
            ],
            [
                'title' => 'Mobile App for Restaurant Management',
                'order' => 2,
                'status' => 'active',
            ],
            [
                'title' => 'Corporate Website Redesign',
                'order' => 3,
                'status' => 'active',
            ],
            [
                'title' => 'Healthcare Management System',
                'order' => 4,
                'status' => 'active',
            ],
            [
                'title' => 'Educational Learning Platform',
                'order' => 5,
                'status' => 'inactive',
            ],
            [
                'title' => 'Real Estate Property Portal',
                'order' => 6,
                'status' => 'active',
            ]
        ];

        foreach ($portfolios as $portfolio) {
            Portfolio::create($portfolio);
        }
    }
}
