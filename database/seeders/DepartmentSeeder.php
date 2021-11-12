<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::factory(5)->create();

        foreach (Department::all() as $department) {
            $employees = Employee::inRandomOrder()->take(rand(1, 30))->pluck('id');
            $department->employees()->attach($employees);
        }
    }
}
