<?php

namespace Livraria\Service;

use Doctrine\ORM\EntityManager;
use Livraria\Entity\Categoria as CategoriaService;
use Livraria\Entity\Configurator;


class Categoria {
/**
 * @var EntityManager
 */
    
protected $em;

public function __construct(EntityManager $em) {
    $this->em = $em;   
}

public function  insert(array $data){
    $entity = new CategoriaService($data);
    $this->em->persist($entity); //fila de acoes do banco de dados
    $this->em->flush(); // excutando a acao do  persist
    return $entity;
    
}

    
}
