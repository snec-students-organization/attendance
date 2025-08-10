<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassModel;
use App\Models\Student;
use App\Models\Teacher;

class SampleDataSeeder extends Seeder
{
    public function run()
    {
        // Create classes
        $classes = ['S1', 'S2', 'D1', 'D2', 'D3'];
        foreach ($classes as $className) {
            ClassModel::updateOrCreate(['name' => $className]);
        }

        // Fetch classes keyed by name for easy access
        $allClasses = ClassModel::all()->keyBy('name');

        // Specific students by class as given
        $studentsByClass = [
            'D3' => ['Sahad', 'Muhammed fayis', 'Seydali', 'Swalih','Ibrahim','Muhammed Hadi','Muhammed Ramees','thwayyib','Iquram Ul Haque','Irfan'],
            'D2' => ['Muhammed Muslih', 'Abdul Javad', 'Ali Javad','Shamnad','Althaf'],
            'D1' => ['Muhammed Bilal', 'MUthaqi', 'Ashik','Adhil','Abdulla','Farooq','Muzammil','Asjad'],
            'S2' => ['Fayis', 'Bilal S', 'Bilal MR', 'Shakir'],
            // S1 generic students
            'S1' => [
                'Muhammed Ramees',
                'Yaseen E',
                'Thameem',
                'Shamnad',
                'Saydali',
                'Yaseen',
                'Afrin',
                'Faris',
                'Murshid',
                'unais'

            ],
        ];

        // Insert students per class
        foreach ($studentsByClass as $className => $studentNames) {
            if (isset($allClasses[$className])) {
                $class = $allClasses[$className];
                foreach ($studentNames as $studentName) {
                    Student::updateOrCreate(
                        ['name' => $studentName, 'class_id' => $class->id]
                    );
                }
            }
        }

        // Add some teachers
        $teachers = ['Saleem Faisy', 'Hassan Faisy', 'Niyas Madani','Sufair Haithami','Navalu Rahman Darimi','Abdu Rahman sanae','Swalih Darimi','Shajahan Mannani','Rajan Sir','Shamnad Sir','Latheef Sir',];
        foreach ($teachers as $teacherName) {
            Teacher::updateOrCreate(['name' => $teacherName]);
        }

        // Assign PINs to classes
        $classPins = [
            'S1' => '6521',
            'S2' => '2346',
            'D1' => '3437',
            'D2' => '4667',
            'D3' => '5638',
        ];

        foreach ($classPins as $className => $pin) {
            $class = ClassModel::where('name', $className)->first();
            if ($class) {
                $class->pin = $pin;
                $class->save();
            }
        }
    }
}


