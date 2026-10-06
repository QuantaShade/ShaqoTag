<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        $companies = [
            [
                'name' => 'TechCorp Solutions',
                'email' => 'contact@techcorp.com',
                'website' => 'https://techcorp.example.com',
                'location' => 'San Francisco, CA',
                'description' => 'Leading software development firm specializing in cloud solutions and web apps.',
            ],
            [
                'name' => 'Creative Pulse Agency',
                'email' => 'info@creativepulse.com',
                'website' => 'https://creativepulse.example.com',
                'location' => 'New York, NY',
                'description' => 'Full-service digital agency delivering top-tier UI/UX design and branding.',
            ],
            [
                'name' => 'DataVentures Inc',
                'email' => 'hello@dataventures.com',
                'website' => 'https://dataventures.example.com',
                'location' => 'Austin, TX',
                'description' => 'Pioneering analytics and machine learning tools for enterprise businesses.',
            ],
        ];

        foreach ($companies as $company) {
            Company::firstOrCreate(['name' => $company['name']], $company);
        }
    }
}
