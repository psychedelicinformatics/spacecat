<?php

namespace Database;

use Repository\DatabaseInterface;
use Project\Database\PDOException;

class Database implements DatabaseInterface
{
    private string $dbhost = 'localhost';
    private string $dbname = '3dtest';
    private string $username = 'root';
    private string $password = 'Testtest32%';
    /**
     * @param int $level
     * @return array
     */
    public function getLevelFromDatabase(int $level = 8): array
    {
        $sql = "SELECT * FROM pixels WHERE level = :level";
        $statement = $this->connect()->prepare($sql);
        $statement->execute([
            'level' => $level,
        ]);

        $array = [];
        while ($value = $statement->fetch()) {
            $array[] = $value;
        }

        return $array;
    }

    /**
     * @param int $x
     * @param int $y
     * @param int $z
     * @param int $level
     * @return void
     */
    public function insertPixelIntoDatabase(int $x, int $y, int $z, int $level): void
    {
        if ($this->pixelExists($x, $y, $z, $level)) {
            return;
        }

        $sql = "INSERT INTO pixels (x, y, z, level) VALUES (:x, :y, :z, :level)";
        $statement = $this->connect()->prepare($sql);
        $statement->execute([
            'x' => $x,
            'y' => $y,
            'z' => $z,
            'level' => $level,
        ]);
    }

    /**
     * @param int $x
     * @param int $y
     * @param int $z
     * @param int $level
     * @return bool
     */
    public function hasAllNeighbours(int $x, int $y, int $z, int $level): bool
    {
        if (!$this->pixelExists($x + 1, $y, $z, $level)) {
            return false;
        }
        if (!$this->pixelExists($x - 1, $y, $z, $level)) {
            return false;
        }
        if (!$this->pixelExists($x, $y + 1, $z, $level)) {
            return false;
        }
        if (!$this->pixelExists($x, $y - 1, $z, $level)) {
            return false;
        }
        if (!$this->pixelExists($x, $y, $z + 1, $level)) {
            return false;
        }
        if (!$this->pixelExists($x, $y, $z - 1, $level)) {
            return false;
        }

        return true;
    }

    /**
     * @param int $x
     * @param int $y
     * @param int $z
     * @param int $level
     * @return void
     */
    public function markAsToDelete(int $x, int $y, int $z, int $level): void
    {
        $sql = "UPDATE pixels SET todelete = 1 WHERE x = :x AND y = :y AND z = :z AND level = :level";
        $statement = $this->connect()->prepare($sql);
        $statement->execute([
            'x' => $x,
            'y' => $y,
            'z' => $z,
            'level' => $level,
        ]);
    }

    public function deleteMarked(): void
    {
        $sql = "DELETE FROM pixels WHERE todelete = 1";
        $statement = $this->connect()->prepare($sql);
        $statement->execute();
    }

    private function connect()
    {
        try {
            $datasource = "mysql:host=$this->dbhost;dbname=$this->dbname";
            return new \PDO($datasource, $this->username, $this->password);
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
            die();
        }
    }

    /**
     * @param int $x
     * @param int $y
     * @param int $z
     * @param int $level
     * @return bool
     */
    private function pixelExists(int $x, int $y, int $z, int $level = 8): bool
    {
        $sql = "SELECT * FROM pixels WHERE x = :x AND y = :y AND z = :z AND level = :level";
        $statement = $this->connect()->prepare($sql);
        $statement->execute([
            'x' => $x,
            'y' => $y,
            'z' => $z,
            'level' => $level,
        ]);

        while ($statement->fetch()) {
            return true;
        }

        return false;
    }
}