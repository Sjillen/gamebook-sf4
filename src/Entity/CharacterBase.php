<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Story;

/**
 * @ORM\MappedSuperclass
 */
Abstract class CharacterBase
{

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * Endurance equivalent for lone wolf
     * 
     * @ORM\Column(type="integer")
     */
    protected $life;

    /**
     * Combat skill equivalent for lone wolf
     * 
     * @ORM\Column(type="integer")
     */
    protected $ability;

    /* Setters and Getters */

    public function getName() : ?string
    {
        return $this->name;
    }

    public function setName($name) : void
    {
        $this->name = $name;
    }

    public function getLife() : ?int
    {
        return $this->life;
    }

    public function setLife($life) : void
    {
        $this->life = $life;
    }

    public function getAbility() : ?int
    {
        return $this->ability;
    }

    public function setAbility($ability) : void
    {
        $this->ability = $ability;
    }
}
