<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Commercial Law Services',
                'type' => 'service',
                'excerpt' => 'Comprehensive commercial law services for businesses of all sizes.',
                'description' => 'Our commercial law practice provides expert legal services to businesses across various industries. We specialize in contract negotiations, corporate governance, mergers and acquisitions, and regulatory compliance.\n\nOur experienced team of commercial lawyers understands the complex legal landscape that businesses navigate daily. We work closely with our clients to provide practical, cost-effective solutions that protect their interests while enabling growth and success.\n\nServices include:\n- Contract drafting and review\n- Corporate structuring\n- Mergers and acquisitions\n- Regulatory compliance\n- Commercial litigation\n- Employment law\n- Intellectual property protection',
                'meta_title' => 'Commercial Law Services | Legal Experts',
                'meta_description' => 'Expert commercial law services including contract negotiations, corporate governance, M&A, and regulatory compliance for businesses.',
                'meta_keywords' => 'commercial law, business law, contract law, corporate governance, mergers acquisitions',
                'status' => 'active'
            ],
            [
                'title' => 'Family Law Practice',
                'type' => 'practice',
                'excerpt' => 'Compassionate family law representation for divorce, custody, and domestic relations matters.',
                'description' => 'Family law matters require sensitivity, understanding, and skilled legal representation. Our family law practice focuses on helping families navigate difficult times with dignity and respect.\n\nWe handle all aspects of family law, from divorce and separation to child custody and support arrangements. Our approach is collaborative when possible, but we are prepared to advocate vigorously in court when necessary.\n\nAreas of practice include:\n- Divorce and separation\n- Child custody and visitation\n- Child and spousal support\n- Property division\n- Prenuptial agreements\n- Adoption\n- Domestic violence protection',
                'meta_title' => 'Family Law Practice | Divorce & Custody Lawyers',
                'meta_description' => 'Experienced family law attorneys providing compassionate representation in divorce, custody, support, and domestic relations matters.',
                'meta_keywords' => 'family law, divorce lawyer, child custody, spousal support, domestic relations',
                'status' => 'active'
            ],
            [
                'title' => 'New Supreme Court Ruling Affects Business Contracts',
                'type' => 'news',
                'excerpt' => 'Recent Supreme Court decision creates new precedent for commercial contract interpretation.',
                'description' => 'The Supreme Court\'s recent decision in ABC Corp v. XYZ Industries has significant implications for how commercial contracts will be interpreted moving forward. The court\'s ruling establishes new precedent regarding the enforceability of liquidated damages clauses in business agreements.\n\nKey takeaways from the decision:\n\n1. Liquidated damages clauses must be reasonable at the time of contract formation\n2. Courts will now apply a stricter scrutiny standard when evaluating these clauses\n3. Businesses should review existing contracts to ensure compliance\n\nThis decision affects numerous industries, particularly those that rely heavily on standardized contracts with liquidated damages provisions. Construction, technology, and manufacturing sectors should pay particular attention to this development.\n\nOur legal team is currently reviewing the full implications of this decision and will be reaching out to affected clients with specific recommendations for contract modifications.',
                'meta_title' => 'Supreme Court Ruling Changes Business Contract Law',
                'meta_description' => 'New Supreme Court decision affects commercial contract interpretation and liquidated damages clauses. Legal analysis and implications.',
                'meta_keywords' => 'Supreme Court, business contracts, liquidated damages, commercial law, legal news',
                'status' => 'active'
            ],
            [
                'title' => 'Understanding Employment Law in the Digital Age',
                'type' => 'blog',
                'excerpt' => 'How remote work and digital communication are changing employment law compliance requirements.',
                'description' => 'The shift to remote work has fundamentally changed the employment landscape, creating new legal challenges and compliance requirements for employers. Understanding these changes is crucial for maintaining a legally compliant workplace in the digital age.\n\nKey areas of concern include:\n\n**Privacy and Monitoring**\nEmployers must balance their legitimate business interests in monitoring productivity with employee privacy rights. The use of surveillance software, keystroke tracking, and camera monitoring raises significant legal questions.\n\n**Wage and Hour Compliance**\nRemote work complicates traditional wage and hour law compliance. Issues such as tracking work hours, overtime compensation, and meal breaks require new approaches and policies.\n\n**Workplace Safety**\nEven in remote settings, employers maintain obligations under occupational safety and health laws. This includes ensuring ergonomic home office setups and addressing mental health concerns.\n\n**Data Security**\nWith employees accessing company systems from home networks, data security and confidentiality obligations become more complex and critical.\n\nEmployers should regularly review and update their policies to address these evolving challenges in employment law.',
                'meta_title' => 'Employment Law in the Digital Age | Remote Work Compliance',
                'meta_description' => 'Navigate employment law challenges in remote work environments including privacy, wage compliance, and data security requirements.',
                'meta_keywords' => 'employment law, remote work, digital workplace, labor compliance, privacy rights',
                'status' => 'active'
            ],
            [
                'title' => 'Personal Injury Claims Process',
                'type' => 'service',
                'excerpt' => 'Expert guidance through the personal injury claims process with maximum compensation focus.',
                'description' => 'When you\'ve been injured due to someone else\'s negligence, navigating the legal system can be overwhelming. Our personal injury practice is dedicated to helping victims recover the compensation they deserve while focusing on their recovery.\n\nWe handle all types of personal injury cases:\n- Motor vehicle accidents\n- Slip and fall injuries\n- Medical malpractice\n- Product liability\n- Workplace injuries\n- Wrongful death claims\n\nOur approach is comprehensive and client-focused. We investigate every aspect of your case, work with medical experts and accident reconstruction specialists, and negotiate aggressively with insurance companies.\n\nThe personal injury claims process typically involves:\n1. Initial case evaluation\n2. Evidence gathering and investigation\n3. Medical documentation and expert consultation\n4. Demand letter and negotiations\n5. Filing lawsuit if necessary\n6. Discovery and depositions\n7. Settlement negotiations or trial\n\nWe work on a contingency fee basis, meaning you pay nothing unless we win your case.',
                'meta_title' => 'Personal Injury Claims Process | Accident Lawyers',
                'meta_description' => 'Expert personal injury attorneys guide you through the claims process for maximum compensation. Contingency fee basis.',
                'meta_keywords' => 'personal injury, accident lawyer, claims process, compensation, contingency fee',
                'status' => 'active'
            ],
            [
                'title' => 'Intellectual Property Protection Strategies',
                'type' => 'practice',
                'excerpt' => 'Comprehensive IP protection including patents, trademarks, copyrights, and trade secrets.',
                'description' => 'In today\'s knowledge-based economy, intellectual property represents one of the most valuable assets for businesses and individuals. Our intellectual property practice provides comprehensive protection strategies to safeguard your innovations and creative works.\n\nOur IP services include:\n\n**Patents**\n- Utility and design patent applications\n- Patent prosecution and maintenance\n- Patent portfolio management\n- Freedom to operate analysis\n- Patent litigation and enforcement\n\n**Trademarks**\n- Trademark searches and registration\n- Brand protection strategies\n- Trademark enforcement and defense\n- Domain name disputes\n- International trademark filing\n\n**Copyrights**\n- Copyright registration and protection\n- DMCA compliance and enforcement\n- Licensing agreements\n- Fair use analysis\n\n**Trade Secrets**\n- Trade secret identification and protection\n- Confidentiality agreements\n- Employee training programs\n- Litigation and enforcement\n\nWe work with inventors, entrepreneurs, established businesses, and creative professionals to develop tailored IP strategies that protect their competitive advantages while maximizing commercial opportunities.',
                'meta_title' => 'Intellectual Property Protection | Patents, Trademarks, Copyrights',
                'meta_description' => 'Comprehensive intellectual property protection services including patents, trademarks, copyrights, and trade secrets.',
                'meta_keywords' => 'intellectual property, patents, trademarks, copyrights, trade secrets, IP protection',
                'status' => 'active'
            ]
        ];

        foreach ($posts as $postData) {
            $postData['slug'] = Str::slug($postData['title']);
            $postData['created_at'] = now()->subDays(rand(1, 30));
            $postData['updated_at'] = $postData['created_at'];
            
            Post::create($postData);
        }
    }
}
