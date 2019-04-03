<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
    * @ORM\Column(type="text", length=100)
    */
    private $title;
    /**
    * @ORM\Column(type="text")
    */
    private $body;
//Since above properties are private, and they can't be accessed ourside
//the class, getters an setters have to be created
public function returnId()
{
    return $this->id;
}
public function returnTitle()
{
    return $this->title;
}

public function returnBody()
{
    return $this->body;
} 

//Setters
//$title is passed as a parameter
public function setTitle($title)
{
    $this->title= $title;
}

public function setbody($body)
{
    $this->body= $body;
}

}
