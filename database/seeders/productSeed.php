<?php

$data = [
    'name'        => 'Product-',
    'description' => 'Description-',
];

for ($i = 0; $i < 10; $i++) {
    \App\Models\Product::query()->create([
        'name'        => $data['name'] . $i,
        'description' => $data['description'] . $i,
        'count'       => rand(0, 10),
    ]);
}