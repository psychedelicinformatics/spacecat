<?php

declare(strict_types=1);

error_reporting(E_ALL);
ini_set("display_errors", 1);

require "../vendor/autoload.php";

use Generator\PyramidPixelGenerator;

$floorGenerator = new PyramidPixelGenerator();
$floorGenerator->createPyramid(8);
$floorGenerator->cleanPixels();
