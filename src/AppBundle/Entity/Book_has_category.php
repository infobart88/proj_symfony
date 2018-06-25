<?php
// src/AppBundle/Entity/Book_has_category.php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="book_has_category")
 */
class Book_has_category
{
	
	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id_bhc;
	
	/**
	 *	@ORM\OneToOne(targetEntity="Book")
	 *	@ORM\JoinColumn(name="book_id", referencedColumnName="id_book")
	 */
	protected $book;
	
	/**
	 *	@ORM\ManyToOne(targetEntity="Category")
	 *	@ORM\JoinColumn(name="category_id", referencedColumnName="id_category")
	 */
	protected $category;



    /**
     * Get idBhc
     *
     * @return integer
     */
    public function getIdBhc()
    {
        return $this->id_bhc;
    }

    /**
     * Set book
     *
     * @param \AppBundle\Entity\Book $book
     *
     * @return Book_has_category
     */
    public function setBook(\AppBundle\Entity\Book $book = null)
    {
        $this->book = $book;

        return $this;
    }

    /**
     * Get book
     *
     * @return \AppBundle\Entity\Book
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Book_has_category
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
