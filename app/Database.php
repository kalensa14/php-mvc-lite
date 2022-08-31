<?php

declare(strict_types=1);

namespace App;

use PDO;
use PDOException;

class Database
{
    private PDO $db;

    public function __construct()
    {
        $this->db = new PDO('sqlite:' . APP_ROOT . '/database/db.sqlite', '', '', [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    /**
     * @param string $table
     * @param array $data
     * @return void
     * @throws PDOException
     */
    public function insert(string $table, array $data): void
    {
        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES(%s)',
            $table,
            implode(',', array_keys($data)),
            implode(',', array_fill(0, count($data), '?'))
        );

        $query = $this->db->prepare($sql);
        $query->execute(array_values($data));
    }

    /**
     * @throws PDOException
     * @return int
     */
    public function lastInsertId(): int
    {
        return $this->db->lastInsertId();
    }

    /**
     * @param string $table
     * @param array $condition
     * @param array $data
     * @throws PDOException
     * @return int
     */
    public function update(string $table, array $condition, array $data): int
    {
        $sets = array_map(fn($key) => $key . ' = ?', array_keys($data));
        $wheres = array_map(fn($key) => $key . ' = ?', array_keys($condition));

        $sql = sprintf(
            'UPDATE %s SET %s WHERE %s',
            $table,
            implode(',', $sets),
            implode(' AND ', $wheres)
        );

        $query = $this->db->prepare($sql);
        $query->execute([...array_values($data), ...array_values($condition)]);

        return $query->rowCount();
    }

    /**
     * @param string $table
     * @param array $condition
     * @throws PDOException
     * @return int
     */
    public function delete(string $table, array $condition): int
    {
        $wheres = array_map(fn($key) => $key . ' = ?', array_keys($condition));
        $sql = sprintf(
            'DELETE FROM %s WHERE %s',
            $table,
            implode(' AND ', $wheres)
        );

        $query = $this->db->prepare($sql);
        $query->execute(array_values($condition));

        return $query->rowCount();
    }

    /**
     * @param string $sql
     * @param array $params
     * @throws PDOException
     * @return array
     */
    public function query(string $sql, array $params = []): array
    {
        $query = $this->db->prepare($sql);
        $query->execute($params);

        return $query->fetchAll();
    }
}