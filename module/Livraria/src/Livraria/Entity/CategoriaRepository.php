<?php

namespace Livraria\Entity;

use Doctrine\ORM\EntityRepository;

class CategoriaRepository extends EntityRepository {

    public function fetchPairs() {  // aqui sao carregadas todas entidades categorias e entities
        $entities = $this->findAll();

        $array = array();
        
        foreach ($entities as $entity) {
            $array[$entity->getId()] = $entity->getNome(); // <-aqui sera o valor da categoria
        }

        return $array;
    }

}
