<?php

namespace Repository;

use Database\Database;
use Generator\PixelRepositoryInterface;
use ValueObject\Pixel;

class PixelRepository implements PixelRepositoryInterface
{
    private DatabaseInterface $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    /**
     * @param int $level
     * @return array
     */
    public function getPixels(int $level = 8): array
    {
        $pixels = [];
        foreach ($this->getRawPixelArray($level) as $rawPixel) {
            $pixels[$rawPixel['id']] = new Pixel(
                $rawPixel['x'],
                $rawPixel['y'],
                $rawPixel['z'],
                $rawPixel['level'],
            );
        }

        return $pixels;
    }

    /**
     * @param int $x
     * @param int $y
     * @param int $z
     * @param int $level
     * @return void
     */
    public function createNewPixel(int $x, int $y, int $z, int $level): void
    {
        $this->database->insertPixelIntoDatabase($x, $y, $z, $level);
    }

    public function cleanPixels(): void
    {
        /** @var Pixel[] $pixelArray */
        $pixels = $this->getPixels();
        /** @var Pixel $pixel */
        foreach ($pixels as $pixel) {
            if ($this->database->hasAllNeighbours($pixel->getX(), $pixel->getY(), $pixel->getZ(), $pixel->getLevel())) {
                $this->database->markAsToDelete($pixel->getX(), $pixel->getY(), $pixel->getZ(), $pixel->getLevel());
            }
        }
        $this->database->deleteMarked();
    }

    /**
     * @param int $level
     * @return array
     */
    private function getRawPixelArray(int $level = 8): array
    {
        return $this->database->getLevelFromDatabase($level);
    }
}