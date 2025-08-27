<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Profile;

try {
    $profile = Profile::first();
    
    if (!$profile) {
        echo "No profile found. Creating a test profile...\n";
        
        $profile = Profile::create([
            'email' => 'info@lawinpartners.com',
            'phone1' => '+971 2 123 4567',
            'phone2' => '+971 50 123 4567',
            'address' => 'Legal District, Business Bay, Dubai, UAE',
            'description' => 'Expert legal services in Dubai and UAE'
        ]);
        
        echo "Test profile created successfully!\n";
    } else {
        echo "Profile exists:\n";
        echo "Email: " . ($profile->email ?: 'Not set') . "\n";
        echo "Phone1: " . ($profile->phone1 ?: 'Not set') . "\n";
        echo "Phone2: " . ($profile->phone2 ?: 'Not set') . "\n";
        echo "Address: " . ($profile->address ?: 'Not set') . "\n";
    }
    
    echo "\nGlobal profile is now available to all views through ProfileViewComposerServiceProvider!\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
