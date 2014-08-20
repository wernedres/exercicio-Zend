<?php 

namespace Livraria\Service;

use Doctrine\ORM\EntityManager;
use Livraria\Entity\Configurator;

class User extends AbstractService {

    public function __construct(EntityManager $em) {
        parent::__construct($em);
        $this->entity = 'Livraria\Entity\User';
    }

    public function update(array $data) {
        $entity = $this->em->getReference($this->entity, $data['id']);
        if (empty($data['password']))
            unset($data['password']);
        
        $entity = Configurator::configure($entity, $data);//se o dado da senha for em branco o configurator nao vai rolar, pq to dando unsset
        
        $this->em->persist($entity);
        $this->em->flush();
        
        return $entity;
        
        
        }

}
