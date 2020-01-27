<?php

use App\Models\Commit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class CommitsSeeder
 */
class CommitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Commit::count()) {
            return null;
        }

        DB::insert(file_get_contents(base_path('database/seeds/commits_dump.sql')));
    }
}
