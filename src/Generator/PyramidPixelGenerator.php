<?php

namespace Generator;

use Repository\PixelRepository;

class PyramidPixelGenerator
{
    private PixelRepositoryInterface $pixelRepository;

    public function __construct()
    {
        $this->pixelRepository = new PixelRepository();
    }

    /**
     * @param int $level
     * @return void
     */
    public function createPyramid(int $level): void
    {
        for ($z = 1; $z <= $level; $z++) {
            $this->createPlateau($z, $level);
        }
    }

    /**
     * @return void
     */
    public function cleanPixels(): void
    {
        $this->pixelRepository->cleanPixels();
    }

    /**
     * @param int $z
     * @param int $level
     * @return void
     */
    private function createPlateau(int $z, int $level): void
    {
        for ($x = $level + 1 - $z; $x <= $level + $z; $x++) {
            $this->createRow($x, $z, $level);
        }
    }

    /**
     * @param int $x
     * @param int $z
     * @param int $level
     * @return void
     */
    private function createRow(int $x, int $z, int $level): void
    {
        for ($y = $level + 1 - $z; $y <= $level + $z; $y++) {
            $newZ = $level * 2 + 1 - $z;
            $this->pixelRepository->createNewPixel($newZ, $y, $x, $level);
        }
    }
}