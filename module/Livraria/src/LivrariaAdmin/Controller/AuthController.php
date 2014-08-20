<?php

namespace LivrariaAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
use LivrariaAdmin\Form\Login as LoginForm;
use Zend\Authentication\Storage\Session as SessionStorage;

class AuthController extends AbstractActionController {

    public function indexAction() {

        $form = new LoginForm;
        $error = false;

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {// vericando se o formulario é valido
                $data = $request->getPost()->toArray();

                $auth = new AuthenticationService;

                $sessionStorage = new SessionStorage("LivrariaAdmin"); //setando namespace da sessionStorage
                $auth->setStorage($sessionStorage); //aplicando sessionStorage na aplicação

                $authAdapter = $this->getServiceLocator()->get('Livraria\Auth\Adapter');
                $authAdapter->setUsername($data['email'])
                        ->setPassword($data['password']);

                $result = $auth->authenticate($authAdapter);

                if ($result->isValid()) {
                    $sessionStorage->write($auth->getIdentity()['user'], null); //gravando essa entidade user no sessionStorage
                    return $this->redirect()->toRoute("livraria-admin", array('controller' => 'categorias')); //se o usuario se autenticar sera redirecionado para paginas de categorias
                } else {
                    $error = true;
                }
            }
        }
        return new ViewModel(array('form' => $form, 'error' => $error));
    }

    //criando Método de Logout 
    public function logoutAction() {
        $auth = new AuthenticationService; //pegando a autenticação
        $auth->setStorage(new SessionStorage('LivrariaAdmin')); //setando o storage e tratando da autenticação da da livraria admin
        $auth->clearIdentity(); //Limpa a indentidade do camarada  e o cara não esta mais logado no sittema

        return $this->redirect()->toRoute('livraria-admin-auth');
    }

}