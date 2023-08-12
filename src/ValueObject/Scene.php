<?php

namespace ValueObject;

class Scene
{
    private string $name;

    private string $color;

    /**
     * @param $name
     * @param $color
     */
    public function __construct($name, $color)
    {
        $this->name = $name;
        $this->color = $color;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }
}