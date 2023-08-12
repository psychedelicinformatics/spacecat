<?php

declare(strict_types=1);

error_reporting(E_ALL);
ini_set("display_errors", 1);

require "../vendor/autoload.php";

use Repository\PixelRepository;
use Repository\SceneRepository;
use ValueObject\Pixel;
use ValueObject\Scene;

?>
<html>
<head>
    <title>Nyan Cat in Space psychedelic 3D Animation</title>
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css" media="screen"/>
</head>
<body>

<section>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
</section>

<div class="astronaut">
    <div class="an">
        <div class="tank"></div>
        <div class="astro">
            <div class="helmet">
                <div class="glass">
                    <div class="shine"></div>
                </div>
            </div>
            <div class="dress">
                <div class="c">
                    <div class="btn1"></div>
                    <div class="btn2"></div>
                    <div class="btn3"></div>
                    <div class="btn4"></div>
                </div>
            </div>
            <div class="handl">
                <div class="handl1">
                    <div class="glovel">
                        <div class="thumbl"></div>
                        <div class="b2"></div>
                    </div>
                </div>
            </div>
            <div class="handr">
                <div class="handr1">
                    <div class="glover">
                        <div class="thumbr"></div>
                        <div class="b1"></div>
                    </div>
                </div>
            </div>
            <div class="legl">
                <div class="bootl1">
                    <div class="bootl2"></div>
                </div>
            </div>
            <div class="legr">
                <div class="bootr1">
                    <div class="bootr2"></div>
                </div>
            </div>
            <div class="pipe">
                <div class="pipe2">
                    <div class="pipe3"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div nyancat>
    <div class="rainbow_wrapper">
        <div class="rainbow"></div>
        <div class="rainbow r2"></div>
        <div class="rainbow r3"></div>
        <div class="rainbow r4"></div>
        <div class="rainbow r5"></div>
        <div class="rainbow r6"></div>
        <div class="rainbow r7"></div>
        <div class="rainbow r8"></div>
    </div>
</div>

<?php
$sceneRepository = new SceneRepository();
/** @var Scene[] $scenes */
$scenes = $sceneRepository->getScenes();

$levels = 8;
?>

<?php foreach ($scenes as $scene): ?>
    <div <?php echo $scene->getName(); ?> style="--size: 170vmin">
        <div rotation animate="true">
            <div center-z>
                <div grid style="--dimension: <?php echo $levels * 2; ?>">
                    <?php
                    $pixelRepository = new PixelRepository();
                    /** @var Pixel[] $pixels */
                    $pixels = $pixelRepository->getPixels($levels);
                    foreach ($pixels as $pixel) {
                        echo '<div pixel style="--l: ' . $pixel->getX()
                            . '; --r: ' . $pixel->getY()
                            . '; --c: ' . $pixel->getZ()
                            . '; --color: ' . $scene->getColor() . '; "><span></span></div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</body>
</html>
