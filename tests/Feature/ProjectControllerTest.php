<?php

namespace Tests\Feature;

use Tests\WithOnceMigrateTestCase as TestCase;

/**
 * Class ProjectControllerTest
 *
 * @package Tests\Feature
 */
class ProjectControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->getJson('/api/v1/project');
        $response->assertStatus(200);

        $responseData = json_decode($response->getContent(), true);
        $this->assertTrue(isset($responseData['data']));

        $this->assertCount(7, $responseData['data']);
        $this->assertEquals('tymondesigns', $responseData['data'][0]['owner']);
        $this->assertEquals('jwt-auth', $responseData['data'][0]['repo']);
        $this->assertEquals(7, $responseData['meta']['total']);
    }
}
