<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 27.01.2020
 * Time: 0:11
 */
namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

/**
 * Class WithOnceMigrateTestCase
 *
 * @package Tests
 */
abstract class WithOnceMigrateTestCase extends BaseTestCase
{
    use CreatesApplication;
    use MigrateFreshSeedOnce {
        setUp as protected migrateSetUp;
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->migrateSetUp();
    }
}
