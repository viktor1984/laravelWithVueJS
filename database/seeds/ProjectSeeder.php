<?php

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class ProjectSeeder
 */
class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Project::count()) {
            return null;
        }

        DB::insert(file_get_contents(base_path('database/seeds/project_dump.sql')));
    }
}
