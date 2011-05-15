<?php
class UserController extends Zend_Controller_Action
{

    /**
    * default model
    *
    * @var <User> $_model
    */
    private $_model;

    /**
    * init Controller
    */
    public function init()
    {
        $this->_model = new User();
    }

    /**
    * user list
    */
    public function indexAction()
    {
        // retorna todos os registros da tabela users
        $users = $this->_model->fetchAll();
        // envia o resultado para view
        $this->view->assign('users', $users);
    }

    /**
    * add user
    */
    public function addAction()
    {
        // simulando uma entrada de dados
        $user = array (
            'name'=>'Diogo Matheus',
            'email'=>'dm.matheus@gmail.com'
        );

        // verificando se existe registro usando esse nome
        if($this->_model->isUniqueName($user['name']))
        {
            // caso não tenha registro usando esse nome vamos inserir
            $this->_model->insert($user);
        }

        // redirecionando para lista de usuários
        $this->_helper->redirector('index', 'user');
    }

    /**
    * update user
    */
    public function editAction()
    {
        // simulando uma entrada de dados
        $data = array (
            'email'=>'diogo.matheus@msn.com'
        );

        // atualizando o email do usuário Diogo Matheus
        $where = $this->_model
                      ->getDefaultAdapter()
                      ->quoteInto('name = ?', 'Diogo Matheus');
        $this->_model->update($data, $where);

        // redirecionando para lista de usuários
        $this->_helper->redirector('index', 'user');
    }

    /**
    * delete user
    */
    public function removeAction()
    {
        // removendo o usuário Diogo Matheus
        $where = $this->_model
                      ->getDefaultAdapter()
                      ->quoteInto('name = ?', 'Diogo Matheus');
        $this->_model->delete($where);

        // redirecionando para lista de usuários
        $this->_helper->redirector('index', 'user');
    }
}