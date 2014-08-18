<?php

namespace LivrariaAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;
use LivrariaAdmin\Form\Categoria as FrmCategoria;

class CategoriasController extends AbstractActionController {
    /*
     * @var EntityManager
     */

    protected $em;

    public function indexAction() {
        $list = $this->getEm()
                ->getRepository('Livraria\Entity\Categoria')
                ->findAll();

        return new ViewModel(array('data' => $list));
    }

    public function newAction() {
        $form = new FrmCategoria();

        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {

                $service = $this->getServiceLocator()->get('Livraria\Service\Categoria');
                $service->insert($request->getPost()->toArray());

                return $this->redirect()->toRoute('livraria-admin', array('controller' => 'categorias'));
            }
        }
        return new ViewModel(array('form' => $form));
    }

    public function editAction() {
        $form = new FrmCategoria();
        $request = $this->getRequest();

        $repository = $this->getEm()->getRepository('Livraria\Entity\Categoria');
        $entity = $repository->find($this->params()->fromRoute('id', 0));

        if ($this->params()->fromRoute('id', 0))
            $form->setData($entity->toArray());

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {


                $service = $this->getServiceLocator()->get('Livraria\Service\Categoria');
                $service->update($request->getPost()->toArray());

                return $this->redirect()->toRoute('livraria-admin', array('controller' => 'categorias'));
            }
        }
        return new ViewModel(array('form' => $form));
    }

    public function deleteAction() {
        $service = $this->getServiceLocator()->get('Livraria\Service\Categoria');
        if ($service->delete($this->params()->fromRoute('id', 0)))
            return $this->redirect()->toRoute('livraria-admin', array('controller' => 'categorias'));
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
