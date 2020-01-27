<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 27.01.2020
 * Time: 0:12
 */

namespace Tests;

use Illuminate\Support\Facades\Artisan;

/**
 * Trait MigrateFreshSeedOnce
 *
 * @package Tests
 */
trait MigrateFreshSeedOnce
{
    /**
     * If true, setup has run at least once.
     * @var boolean
     */
    protected static $setUpHasRunOnce = false;

    /**
     * After the first run of setUp "migrate:fresh --seed"
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        if (!static::$setUpHasRunOnce) {
            Artisan::call('migrate:fresh');
            Artisan::call('config:clear');
            Artisan::call('cache:clear');
            Artisan::call(
                'db:seed', ['--class' => 'DatabaseSeeder']
            );

            static::$setUpHasRunOnce = true;
        }
    }
}
