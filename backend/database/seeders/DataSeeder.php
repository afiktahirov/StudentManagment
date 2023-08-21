<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Instructor;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = ["Front end", "Back end", "Mobile app"];
        $instructors = [
            ["name" => "Nijat", "surname" => "Mammadli"],
            ["name" => "Akif", "surname" => "İsmayılov"],
            ["name" => "Aksin", "surname" => "Ceferov"],
            ["name" => "Abubekir", "surname" => "Qedimov"],
        ];
        $students = [
            ["name" => "Rafiq", "surname" => "Cəfərov", "group_id" => 1],
            ["name" => "Afiq", "surname" => "Hüseynov", "group_id" => 2],
            ["name" => "Orxan", "surname" => "Kərimli", "group_id" => 1],
        ];
        foreach ($groups as $value) {
            Group::create(["name" => $value]);
        }
        foreach ($instructors as $value) {
            Instructor::create($value);
        }
        foreach ($students as $value) {
            Student::create($value);
        }
        // DB::table("group_instructor")->insert(["group_id" => 1, "instructor_id" => 1]);
        // DB::table("group_instructor")->insert(["group_id" => 1, "instructor_id" => 2]);
        // DB::table("group_instructor")->insert(["group_id" => 2, "instructor_id" => 1]);
    }
}
