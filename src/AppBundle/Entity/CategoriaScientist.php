<?php

namespace AppBundle\Entity;

use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="categoria_scientist")
 * @UniqueEntity(
 *     fields={"categoria", "user"},
 *     message="Cientistas na mesma categoria",
 *     errorPath="user"
 * )
 */
class CategoriaScientist
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Categoria", inversedBy="categoriaScientists")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categoria;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="usersCategorias")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $periodoCategoria;

    public function getId()
    {
        return $this->id;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setCategoria(Categoria $categoria)
    {
        $this->categoria = $categoria;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getPeriodoCategoria()
    {
        return $this->periodoCategoria;
    }

    public function setPeriodoCategoria($periodoCategoria)
    {
        $this->periodoCategoria = $periodoCategoria;
    }
}