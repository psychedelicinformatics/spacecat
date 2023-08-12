<?php

declare(strict_types=1);

use Generator\PyramidPixelGenerator;

error_reporting(E_ALL);
ini_set("display_errors", 1);

require "../vendor/autoload.php";

$floorGenerator = new PyramidPixelGenerator();
$floorGenerator->createPyramid(4);
$floorGenerator->createPyramid(6);
$floorGenerator->createPyramid(7);
$floorGenerator->cleanPixels();
?>

test
