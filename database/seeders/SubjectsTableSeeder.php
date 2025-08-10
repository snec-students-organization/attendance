<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectsTableSeeder extends Seeder
{
    public function run()
    {
        $subjects = [
            'No Subject',
            'Nahvul valih
',
            'Avamil',
            'muqadhimathul             
                halramiya
',
            'History',
            'voyage',
            
            'al ilm noor',
            'fataul mueen',
            'alfiyya',
            'mishkathul masabe',
            'balagah',
            'musthagdama',
            'urdu',
            'awathif',
            'thareeq',
            'tafseer',
            'mandiq',
            'arbaoona navaviyya',
            'abeer',
            'thaeleemul muthallim',
            'fiqh',
            'English',
            'usoolul fiqh',
            'ihsaas',
            'degree',
            'higher secondary'


        ];

        foreach ($subjects as $subjectName) {
            Subject::updateOrCreate(['name' => $subjectName]);
        }
    }
}

