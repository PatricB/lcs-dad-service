<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ServiceTest extends TestCase
{
    /**
     * @return void
     */
    public function testValidDate()
    {
        $this->post('/', [
            'datum' => strtotime("+1 days", time())
        ]);

        $this->assertEquals(
            json_encode(['nachricht' => '']), $this->response->getContent()
        );
    }

    /**
     * @return void
     */
    public function testValidDateWithDays()
    {
        $this->post('/?tage=1', [
            'datum' => strtotime("+2 days", time())
        ]);

        $this->assertEquals(
            json_encode(['nachricht' => '']), $this->response->getContent()
        );
    }

    /**
     * @return void
     */
    public function testInValidDate()
    {
        $this->post('/', [
            'datum' => strtotime("-1 days", time())
        ]);

        $this->assertNotEquals(
            json_encode(['nachricht' => '']), $this->response->getContent()
        );
    }

    /**
     * @return void
     */
    public function testInValidDateWithDays()
    {
        $this->post('/?tage=1', [
            'datum' => strtotime("-1 days", time())
        ]);

        $this->assertNotEquals(
            json_encode(['nachricht' => '']), $this->response->getContent()
        );
    }
}
