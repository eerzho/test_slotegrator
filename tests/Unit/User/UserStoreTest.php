<?php

namespace Tests\Unit;

use Tests\BaseTest\BaseTest;

class UserStoreTest extends BaseTest
{
    /**
     * @dataProvider getData
     *
     * @param $data
     * @param $codee
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testUserStore($data, $codee)
    {
        $token = $this->getAuthToken('example_0@example.com', 'password');

        $this->postJson('/user', $data, [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $this->compareResult($codee);
    }

    /**
     * @return array[]
     */
    public function getData()
    {
        return [
            [
                [
                    'email'    => 'eerzho@gmail.com',
                    'name'     => 'Zhanbolat',
                    'password' => 'password',
                ],
                200
            ],
            [
                [
                    'name'     => 'Test',
                    'password' => 'password',
                ],
                400
            ],
        ];
    }
}