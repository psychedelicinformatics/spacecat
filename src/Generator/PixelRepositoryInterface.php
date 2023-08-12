<?php

namespace Generator;
interface PixelRepositoryInterface
{
    public function getPixels(int $level = 8): array;

    public function createNewPixel(int $x, int $y, int $z, int $level): void;

    public function cleanPixels(): void;
}