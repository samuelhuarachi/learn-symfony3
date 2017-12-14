<?php
/**
 * Created by PhpStorm.
 * User: gomes
 * Date: 12/12/17
 * Time: 10:02
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class CategoriaRepository extends  EntityRepository
{

    /**
     * @return Categorias[]
     */
    public function findAllCategorias()
    {
        return $this->createQueryBuilder('categoria')
            ->andWhere('categoria.active = :isActive')
            ->setParameter('isActive', true)
            ->leftJoin('categoria.categoriaScientists', 'categoriaScientist')
            ->addSelect('categoriaScientist')
            ->getQuery()
            ->execute();
    }

}