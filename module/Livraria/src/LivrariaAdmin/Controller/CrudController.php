<?php

namespace LivrariaAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;

abstract class CrudController extends AbstractActionController {
    /*
     * @var EntityManager
     */

    protected $em;
    protected $service;
    protected $entity;
    protected $form;
    protected $route;
    protected $controller;

    public function indexAction() {
        $list = $this->getEm()
                ->getRepository($this->entity)
                ->findAll();

        return new ViewModel(array('data' => $list));
    }

    public function newAction() {
        $form = new $this->form ();

        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {

                $service = $this->getServiceLocator()->get($this->service);
                $service->insert($request->getPost()->toArray());

                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
            }
        }
        return new ViewModel(array('form' => $form));
    }

    public function editAction() {
        $form = new $this->form();
        $request = $this->getRequest();

        $repository = $this->getEm()->getRepository($this->entity);
        $entity = $repository->find($this->params()->fromRoute('id', 0));

        if ($this->params()->fromRoute('id', 0))
            $form->setData($entity->toArray());

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                         
                $service = $this->getServiceLocator()->get($this->service);
                $service->update($request->getPost()->toArray());

                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
            }
        }
        return new ViewModel(array('form' => $form));
    }

    public function deleteAction() {
        $service = $this->getServiceLocator()->get($this->service);
        if ($service->delete($this->params()->fromRoute('id', 0)))
          return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
    
         try {
            //Faz a pessistencia no banco de dados
            $em->persist($entity);
            $em->flush();
        } catch (DBALException $e) {
            //Caso ocorra alguma exeção, pega o codigo e a menssagem do erro
            $error = true;
            $details['code'] = $e->getPrevious()->getCode();
            $details['message'] = $e->getMessage();
        }
        
        
        
    }
    
    
            
    /**
     * @return EntityManager
     */
    protected function getEm() {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

}
