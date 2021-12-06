<?php

$data = [
    'name'     => 'User-',
    'email'    => 'example_',
    'password' => password_hash('password', PASSWORD_BCRYPT),
];

for ($i = 0; $i < 10; $i++) {
    \App\Models\User::query()->create([
        'name'     => $data['name'] . $i,
        'email'    => $data['email'] . $i . '@example.com',
        'password' => $data['password'],
    ]);
}