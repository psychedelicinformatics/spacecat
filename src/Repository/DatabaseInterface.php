<?php

namespace Repository;

interface DatabaseInterface
{
    public function getLevelFromDatabase(int $level = 8): array;

    public function insertPixelIntoDatabase(int $x, int $y, int $z, int $level): void;

    public function hasAllNeighbours(int $x, int $y, int $z, int $level): bool;

    public function markAsToDelete(int $x, int $y, int $z, int $level): void;

    public function deleteMarked(): void;
}