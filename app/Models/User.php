<?php

namespace App\Models;

class User extends Database
{
    protected int $perPage = 20;

    /**
     * @return string
     */
    public function getTable(): string
    {
        return 'users';
    }

    /**
     * @return string[]
     */
    public function getFields(): array
    {
        return [
            'first_name',
            'last_name',
            'username',
            'email',
            'password',
        ];
    }

    /**
     * @param array $data
     *
     * @return array[]
     */
    public function filters(array $data): array
    {
        $conditions = [];
        $parameters = [];

        if (isset($data['id'])) {
            $conditions[] = 'id = ?';
            $parameters[] = $data['id'];
        }
        if (isset($data['first_name'])) {
            $conditions[] = 'first_name LIKE ?';
            $parameters[] = '%' . $data['first_name'] . '%';
        }
        if (isset($data['last_name'])) {
            $conditions[] = 'last_name LIKE ?';
            $parameters[] = '%' . $data['last_name'] . '%';
        }
        if (isset($data['username'])) {
            $conditions[] = 'username LIKE ?';
            $parameters[] = '%' . $data['username'] . '%';
        }
        if (isset($data['email'])) {
            $conditions[] = 'email LIKE ?';
            $parameters[] = '%' . $data['email'] . '%';
        }

        return [
            'conditions' => $conditions,
            'parameters' => $parameters
        ];
    }
}