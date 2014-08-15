<?php


namespace LivrariaAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;

class CategoriasController extends AbstractActionController{
    
    public function indexAction() {
        $list= $this->getEm()
                ->getRepository('Livraria\Entity\Categoria')
                ->findAll();
           
        return new ViewModel(array('data'=>$list));
    } 
    /**
     * @return EntityManager
     */
    
    protected function  getEm(){
        if(null === $this->em)
            {
$this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
}
           return $this->em;
        
    }
    
    
}
