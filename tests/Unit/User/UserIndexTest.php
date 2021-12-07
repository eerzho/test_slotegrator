<?php

namespace Tests\Unit;

use Tests\BaseTest\BaseTest;

class UserIndexTest extends BaseTest
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testUserIndex()
    {
        $token = $this->getAuthToken('example_0@example.com', 'password');

        $this->getJson('user', [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $this->compareResult(200);
    }
}