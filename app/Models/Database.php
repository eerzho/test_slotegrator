<?php

namespace App\Models;

use App\Consts\Messages\ErrorMessage;
use App\Traits\OutputTrait;
use Exception;
use PDO;

/**
 * @property PDO $connection
 */
abstract class Database
{
    use OutputTrait;

    protected $connection = null;

    protected int $perPage = 15;

    private array $fields = [
        'id',
    ];

    abstract public function getTable(): string;

    abstract public function getFields(): array;

    abstract public function filters(array $data): array;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->fields = array_merge($this->fields, $this->getFields());
        try {
            $this->connection = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_DATABASE_NAME, DB_USERNAME, DB_PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (Exception $exception) {
            $this->sendOutput([
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    /**
     * @param array $data
     *
     * @return array|false|void
     */
    public function search(array $data)
    {
        $columnString = implode(',', $this->fields);
        $sql = "SELECT {$columnString} FROM {$this->getTable()}";

        $filtersResult = $this->filters($data);

        if (!isset($filtersResult['conditions'])) {
            $this->sendOutput([
                'message' => ErrorMessage::SEARCH_CONDITIONS
            ], 500);
        }

        if (!isset($filtersResult['parameters'])) {
            $this->sendOutput([
                'message' => ErrorMessage::SEARCH_PARAMETERS
            ], 500);
        }

        if ($filtersResult['conditions']) {
            $sql .= " WHERE " . implode(" AND ", $filtersResult['conditions']);
        }

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($filtersResult['parameters']);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $exception) {
            $this->sendOutput([
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    /**
     * @param array $values
     *
     * @return mixed|void
     */
    public function create(array $values)
    {
        $keys = array_keys($values);
        if ($diffKeys = array_diff($keys, $this->getFields())) {
            $this->sendOutput([
                ErrorMessage::ERR_FIELDS . ': ' . implode(', ', $diffKeys)
            ], 400);
        }

        $columnString = implode(',', $keys);
        $valueString = implode(',', array_fill(0, count($values), '?'));
        $sql = "INSERT INTO {$this->getTable()} ({$columnString}) VALUES ({$valueString})";

        try {
            $stmt = $this->connection->prepare($sql);
            $res = $stmt->execute(array_values($values));
            if ($res === false) {
                $this->sendOutput([
                    'message' => ErrorMessage::CREATE
                ], 500);
            }
        } catch (Exception $exception) {
            $this->sendOutput([
                'message' => $exception->getMessage()
            ], 500);
        }

        return $this->findOne((int)$this->connection->lastInsertId());
    }

    /**
     * @param int $id
     *
     * @return mixed|void
     */
    public function findOne(int $id)
    {
        $columnString = implode(',', $this->fields);
        $sql = "SELECT {$columnString} FROM {$this->getTable()} WHERE id=?";

        try {
            $stmt = $this->connection->prepare($sql);
            $res = $stmt->execute([$id]);
            if ($res === false) {
                $this->sendOutput([
                    'message' => ErrorMessage::FIND
                ], 500);
            }
        } catch (Exception $exception) {
            $this->sendOutput([
                'message' => $exception->getMessage()
            ], 500);
        }

        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($res === false) {
            $this->sendOutput([
                'message' => ErrorMessage::NOT_FOUND
            ], 404);
        } else {
            return $res;
        }
    }

    /**
     * @param array $values
     * @param int   $id
     *
     * @return mixed|void
     */
    public function update(array $values, int $id)
    {
        $this->findOne($id);

        $keys = array_keys($values);
        if ($diffKeys = array_diff($keys, $this->getFields())) {
            $this->sendOutput([
                ErrorMessage::ERR_FIELDS . ': ' . implode(', ', $diffKeys)
            ], 400);
        }

        $columnString = implode('=?,', $keys) . '=?';
        $sql = "UPDATE {$this->getTable()} SET {$columnString} WHERE id=?";

        try {
            $stmt = $this->connection->prepare($sql);
            $res = $stmt->execute(array_merge(array_values($values), [$id]));
            if ($res === false) {
                $this->sendOutput([
                    'message' => ErrorMessage::UPDATE
                ], 500);
            }
        } catch (Exception $exception) {
            $this->sendOutput([
                'message' => $exception->getMessage()
            ], 500);
        }

        return $this->findOne($id);
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id)
    {
        $sql = "DELETE FROM {$this->getTable()} WHERE id=?";

        try {
            $stmt = $this->connection->prepare($sql);
            $res = $stmt->execute([$id]);
            if ($res === false) {
                $this->sendOutput([
                    'message' => ErrorMessage::DELETE
                ], 500);
            }
        } catch (Exception $exception) {
            $this->sendOutput([
                'message' => $exception->getMessage()
            ], 500);
        }

        return true;
    }
}