<?php

namespace Tests\Unit\Product;

use Tests\BaseTest\BaseTest;

class ProductUpdateTest extends BaseTest
{
    /**
     * @dataProvider getData
     *
     * @param $data
     * @param $code
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testProductUpdate($data, $code)
    {
        $token = $this->getAuthToken('example_0@example.com', 'password');

        $this->putJson('/product/1', $data, [
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
                    'name'        => 'Iphone 12',
                    'description' => 'old Iphone',
                    'count'       => 199
                ],
                200
            ],
            [
                [
                    'name'  => 'Iphone 12',
                    'count' => 199
                ],
                400
            ]
        ];
    }
}