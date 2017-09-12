<?php

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Cat extends \Kdyby\Doctrine\Entities\BaseEntity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    public $id;

    /**
     * @ORM\Column(type="string")
     */
    public $name;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    public $description;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $health;
    
    /**
     * @ORM\Column(type="integer")
     */
    public $age;
    
    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    public $color;
    
    /**
     * @ORM\Column(type="float")
     */
    public $lat;
    
    /**
     * @ORM\Column(type="float")
     */
    public $lng;
    
    
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getDescription() {
        return $this->description;
    }

    function getHealth() {
        return $this->health;
    }

    function getAge() {
        return $this->age;
    }

    function getColor() {
        return $this->color;
    }

    function getLat() {
        return $this->lat;
    }

    function getLng() {
        return $this->lng;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setHealth($health) {
        $this->health = $health;
    }

    function setAge($age) {
        $this->age = $age;
    }

    function setColor($color) {
        $this->color = $color;
    }

    function setLat($lat) {
        $this->lat = $lat;
    }

    function setLng($lng) {
        $this->lng = $lng;
    }


    
}