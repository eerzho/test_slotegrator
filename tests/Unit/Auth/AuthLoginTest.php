<?php

namespace Tests\Unit\Auth;

use Tests\BaseTest\BaseTest;

class AuthLoginTest extends BaseTest
{
    /**
     * @dataProvider getData
     *
     * @param $data
     * @param $code
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testAuthLogin($data, $code)
    {
        $data['password'] = 'password';

        $this->postJson('/auth/login', $data);

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
                    'email' => 'example_0@example.com'
                ],
                200
            ],
            [
                [
                    'email' => 'example_1@example.com'
                ],
                200
            ],
            [
                [
                    'email' => 'example_2@example.com'
                ],
                200
            ],
            [
                [
                    'email' => 'example_1000@example.com'
                ],
                400
            ],
        ];
    }
}