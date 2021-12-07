<?php

namespace Tests\Unit\Product;

use Tests\BaseTest\BaseTest;

class ProductShowTest extends BaseTest
{
    /**
     * @dataProvider getData
     *
     * @param $id
     * @param $code
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testProductShow($id, $code)
    {
        $token = $this->getAuthToken('example_0@example.com', 'password');

        $this->getJson('/product/' . $id, [
            'Authorization' => 'Bearer ' . $token
        ]);

        $this->compareResult($code);
    }

    /**
     * @return \int[][]
     */
    public function getData()
    {
        return [
            [1, 200],
            [2, 200],
            [3, 200],
            [50, 404],
        ];
    }
}