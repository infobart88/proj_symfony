<?php
// src/AppBundle/Entity/Category.php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="category")
 */
class Category
{
	
	/**
	 * @ORM\Column(type="integer", nullable=true)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id_category;
	
	/**
	 * @ORM\Column(type="string", length=100)
	 */
	protected $name_cat;
	
	public function getId_category()
	{
		return $this->id_category;
	}
	
	public function getName_cat()
	{
		return $this->name_cat;
	}
	
	public function setName_cat($name_cat)
	{
		$this->name_cat = $name_cat;
	}

    /**
     * Get idCategory
     *
     * @return integer
     */
    public function getIdCategory()
    {
        return $this->id_category;
    }

    /**
     * Set nameCat
     *
     * @param string $nameCat
     *
     * @return Category
     */
    public function setNameCat($nameCat)
    {
        $this->name_cat = $nameCat;

        return $this;
    }

    /**
     * Get nameCat
     *
     * @return string
     */
    public function getNameCat()
    {
        return $this->name_cat;
    }
}
