<?php

namespace Livraria\Service;

use Doctrine\ORM\EntityManager;
use Livraria\Entity\Configurator;

abstract class AbstractService {

    /**
     * @var EntityManager
     */
    protected $em;
    protected $entity;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function insert(array $data) {
        $entity = new $this->entity($data);
        
        $this->em->persist($entity); //fila de acoes do banco de dados
        $this->em->flush(); // excutando a acao do  persist
        return $entity;
    }

    public function update(array $data) {
        $entity = $this->em->getReference($this->entity, $data['id']);
        $entity = Configurator::configure($entity, $data);

        $this->em->persist($entity); //fila de acoes do banco de dados
        $this->em->flush(); // excutando a acao do  persist
        return $entity;
    }

    public function delete($id) {
        $entity = $this->em->getReference($this->entity, $id);
        if ($entity) {
            $this->em->remove($entity);
            $this->em->flush();
            return $id;
        }
    }

}
