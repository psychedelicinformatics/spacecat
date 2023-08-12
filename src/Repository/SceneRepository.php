<?php

namespace Repository;

use ValueObject\Scene;

class SceneRepository
{
    private array $scenes;

    public function __construct()
    {
        $scenes = [];
        $scenes[] = new Scene('scene', 'white');
        $scenes[] = new Scene('scene2', 'white');
        $scenes[] = new Scene('scene3', 'black');
        $scenes[] = new Scene('scene4', 'black');

        $this->scenes = $scenes;
    }

    /**
     * @return array
     */
    public function getScenes(): array
    {
        return $this->scenes;
    }
}