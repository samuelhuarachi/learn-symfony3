<?php
/**
 * Created by PhpStorm.
 * User: gomes
 * Date: 12/12/17
 * Time: 10:01
 */

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoriaRepository")
 * @ORM\Table(name="categoria")
 */
class Categoria
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string",unique=true)
     * @Gedmo\Slug(fields={"name"})
     */
    private $slug;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active = true;


    /**
     * @ORM\OneToMany(
     *     targetEntity="CategoriaScientist",
     *     mappedBy="categoria",
     *     fetch="EXTRA_LAZY",
     *     orphanRemoval=true,
     *     cascade={"persist"}
     * )
     * @Assert\Valid()
     */
    private $categoriaScientists;



    public function __construct()
    {
        $this->categoriaScientists = new ArrayCollection();
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function getSlug()
    {
        return $this->slug;
    }


    public function setSlug($slug)
    {
        $this->slug = $slug;
    }


    public function getId()
    {
        return $this->id;
    }


    public function getName()
    {
        return $this->name;
    }


    public function setName($name)
    {
        $this->name = $name;
    }


    public function addCategoriaScientist(CategoriaScientist $categoriaScientist)
    {
        if($this->categoriaScientists->contains($categoriaScientist)) {
            return;
        }
        $this->categoriaScientists[] = $categoriaScientist;
        $categoriaScientist->setCategoria($this);
    }

    /**
     * @return ArrayCollection|CategoriaScientist[]
     */
    public function getCategoriaScientists()
    {
        return $this->categoriaScientists;
    }

    public function removeCategoriaScientist(CategoriaScientist $categoriaScientist) {
        if(!$this->categoriaScientists->contains($categoriaScientist)) {
            return;
        }

        $this->categoriaScientists->removeElement($categoriaScientist);
        $categoriaScientist->setCategoria(null);
    }
}