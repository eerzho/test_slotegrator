<?php

namespace Tests\Unit;

use Tests\BaseTest\BaseTest;

class UserUpdateTest extends BaseTest
{
    /**
     * @dataProvider getData
     *
     * @param $data
     * @param $code
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testUserUpdate($data, $code)
    {
        $token = $this->getAuthToken('example_0@example.com', 'password');

        $this->putJson('/user/1', $data, [
            'Authorization' => 'Bearer ' . $token
        ]);

        $this->compareResult($code);
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