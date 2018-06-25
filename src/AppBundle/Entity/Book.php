<?php
// src/AppBundle/Entity/Book.php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="book")
 */
class Book
{
	
	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id_book;
	
	/**
	 * @ORM\Column(type="string", length=100)
	 */
	protected $title;
	
	/**
	 * @ORM\Column(type="string", length=100)
	 */
	protected $author;
	
	/**
	 * @ORM\Column(type="decimal", scale=2)
	 */
	protected $price;
	
	public function getTitle()
	{
		return $this->title;
	}
	
	public function setTitle($title)
	{
		$this->title = $title;
	}
	
	public function getAuthor()
	{
		return $this->author;
	}
	
	public function setAuthor($author)
	{
		$this->author = $author;
	}
	
	public function getPrice()
	{
		return $this->price;
	}
	
	public function setPrice($price)
	{
		$this->price = $price;
	}

    public function getId_book()
    {
        return $this->id_book;
    }

    /**
     * Get idBook
     *
     * @return integer
     */
    public function getIdBook()
    {
        return $this->id_book;
    }
}
