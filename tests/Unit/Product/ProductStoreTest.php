<?php

namespace Tests\Unit\Product;

use Tests\BaseTest\BaseTest;

class ProductStoreTest extends BaseTest
{
    /**
     * @dataProvider getData
     *
     * @param $data
     * @param $code
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testProductStore($data, $code)
    {
        $token = $this->getAuthToken('example_0@example.com', 'password');

        $this->postJson('/product', $data, [
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
                    'name'        => 'Iphone 13',
                    'description' => 'new iphone',
                    'count'       => 199
                ],
                200
            ],
            [
                [
                    'name'  => 'Iphone 13',
                    'count' => 1000
                ],
                400
            ]
        ];
    }
}