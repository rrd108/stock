<?php
namespace App\Controller;

use CakeDC\Users\Controller\AppController as CakeDCAppController;
use App\Model\Table\AppUsersTable;
use Cake\Event\Event;
use CakeDC\Users\Controller\Component\UsersAuthComponent;
use CakeDC\Users\Controller\Traits\LoginTrait;
use CakeDC\Users\Controller\Traits\RegisterTrait;

class AppUsersController extends CakeDCAppController
{
    use LoginTrait;
    use RegisterTrait;

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow('getToken');
    }

    public function beforeFilter(Event $event)
    {
        $this->getEventManager()->off($this->Csrf);
        $this->Security->setConfig('unlockedActions', ['getToken']);
    }

    public function getToken()
    {
        $user = $this->Auth->identify();
        debug($user);
        $this->set(compact('user'));
        $this->set('_serialize', 'user');
    }
}
