<?php

namespace ValueObject;

class Pixel
{
    private int $x;
    private int $y;
    private int $z;
    private int $level;

    /**
     * @param int $x
     * @param int $y
     * @param int $z
     * @param int $level
     */
    public function __construct(int $x, int $y, int $z, int $level)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
        $this->level = $level;
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }

    /**
     * @return int
     */
    public function getZ(): int
    {
        return $this->z;
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }
}