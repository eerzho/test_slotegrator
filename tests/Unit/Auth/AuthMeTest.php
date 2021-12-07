<?php

namespace Tests\Unit\Auth;

use App\Models\User;
use Tests\BaseTest\BaseTest;

class AuthMeTest extends BaseTest
{
    /**
     * @dataProvider getData
     *
     * @param $email
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testAuthMe($email)
    {
        $token = $this->getAuthToken($email, 'password');

        $this->getJson('/auth/me', [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $this->compareResult(200, [
            'data' => User::query()->where('email', $email)->first()->toArray()
        ]);
    }

    /**
     * @return array[]
     */
    public function getData()
    {
        return [
            ['example_0@example.com'],
            ['example_1@example.com'],
            ['example_2@example.com'],
        ];
    }
}