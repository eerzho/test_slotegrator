<?php

namespace Tests\Unit\Product;

use Tests\BaseTest\BaseTest;

class ProductIndexTest extends BaseTest
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testProductIndex()
    {
        $token = $this->getAuthToken('example_0@example.com', 'password');

        $this->getJson('/product', [
            'Authorization' => 'Bearer ' . $token
        ]);

        $this->compareResult(200);
    }
}