<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = [
            [
                'name' => 'John Smith',
                'slug' => 'john-smith',
                'email' => 'john.smith@law.com',
                'phone' => '+1234567890',
                'designation' => 'Senior Partner',
                'orderlist' => 1,
                'tagline' => 'Expert in Corporate Law and Litigation',
                'description' => 'John Smith is a senior partner with over 20 years of experience in corporate law and complex litigation. He has successfully represented numerous Fortune 500 companies and has been recognized as one of the top lawyers in the region.',
                'experience' => 'Over 20 years of experience in corporate law, mergers and acquisitions, and complex commercial litigation. Former Assistant District Attorney with extensive trial experience.',
                'qualification' => 'JD from Harvard Law School, BA in Political Science from Yale University. Admitted to practice in New York and California. Member of American Bar Association.',
                'additional_details' => 'Frequent speaker at legal conferences and contributor to leading legal publications. Pro bono work includes representing non-profit organizations and low-income clients.',
                'metatitle' => 'John Smith - Senior Partner | Corporate Law Expert',
                'metadescription' => 'Meet John Smith, Senior Partner with 20+ years expertise in corporate law and litigation. Contact our experienced legal team today.',
                'metakeywords' => 'corporate lawyer, litigation attorney, senior partner, legal expert',
                'status' => 'active'
            ],
            [
                'name' => 'Sarah Johnson',
                'slug' => 'sarah-johnson', 
                'email' => 'sarah.johnson@law.com',
                'phone' => '+1234567891',
                'designation' => 'Partner',
                'orderlist' => 2,
                'tagline' => 'Intellectual Property and Technology Law Specialist',
                'description' => 'Sarah Johnson specializes in intellectual property law, technology transactions, and privacy compliance. She helps clients protect their innovations and navigate complex regulatory landscapes.',
                'experience' => '15 years of experience in IP law, technology transactions, data privacy, and regulatory compliance. Previously worked at top Silicon Valley law firm.',
                'qualification' => 'JD from Stanford Law School, MS in Computer Science from MIT. Registered Patent Attorney. Member of International Association of Privacy Professionals.',
                'additional_details' => 'Published author on technology law topics. Regular advisor to startups and established tech companies on IP strategy and compliance matters.',
                'metatitle' => 'Sarah Johnson - IP & Technology Law Partner',
                'metadescription' => 'Sarah Johnson, Partner specializing in intellectual property and technology law. 15+ years experience in IP protection and tech transactions.',
                'metakeywords' => 'intellectual property lawyer, technology attorney, patent lawyer, privacy compliance',
                'status' => 'active'
            ],
            [
                'name' => 'Michael Davis',
                'slug' => 'michael-davis',
                'email' => 'michael.davis@law.com', 
                'phone' => '+1234567892',
                'designation' => 'Associate',
                'orderlist' => 3,
                'tagline' => 'Employment Law and Labor Relations Expert',
                'description' => 'Michael Davis focuses on employment law, labor relations, and workplace compliance. He provides practical solutions for complex employment issues and litigation.',
                'experience' => '8 years of experience in employment law, wage and hour disputes, discrimination cases, and labor negotiations.',
                'qualification' => 'JD from UCLA School of Law, BA in Labor Studies from UC Berkeley. Certified in Employment Law by the State Bar.',
                'additional_details' => 'Former labor organizer with deep understanding of both employer and employee perspectives. Fluent in Spanish and English.',
                'metatitle' => 'Michael Davis - Employment Law Associate',
                'metadescription' => 'Michael Davis, Associate specializing in employment law and labor relations. Experienced in workplace disputes and compliance.',
                'metakeywords' => 'employment lawyer, labor attorney, workplace disputes, discrimination cases',
                'status' => 'active'
            ]
        ];

        foreach ($teams as $teamData) {
            Team::create($teamData);
        }
    }
}
