<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');

        $this->loadComponent('CakeDC/Users.UsersAuth');

        $companyId = $this->request->getData('company') ? $this->request->getData('company') : $this->request->query('company');
        if(!$companyId && $this->getRequest()->getSession()->read('company')) {
            $companyId = $companyId ? $companyId : $this->getRequest()->getSession()->read('company')->id;
        }
        if ($companyId) {
            Configure::write('company_id', $companyId);
        }

        Configure::write('CakePdf', [
            'engine' => 'CakePdf.Mpdf',
            'margin' => [
                'bottom' => 15,
                'left' => 50,
                'right' => 30,
                'top' => 45
            ],
        ]);

        if ($this->request->getHeaderLine('ApiKey') || $this->request->getQuery('ApiKey')) {
            $this->Auth->config('storage', 'Memory');
            $this->Auth->config('unauthorizedRedirect', 'false');
            $this->Auth->config('checkAuthIn', 'Controller.initialize');
            $this->Auth->config('loginAction', false);
        }
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        if (!Configure::read('company_id')
            && $this->Auth->user('id')
            && ($this->name != 'Companies' || $this->request->getParam('action') != 'setDefault')) {
            $this->redirect(['plugin' => false, 'controller' => 'Companies', 'action' => 'setDefault']);
        }
    }

    public function beforeRender(Event $event)
    {
        // Note to myself: CORS errors in vue can mean there was a server side PHP error, not necessary a real cors error

        parent::beforeRender($event);
        $this->response = $this->response->cors($this->request)
            ->allowOrigin(['localhost:8080', 'localhost.stockr'])
            ->allowMethods(['GET', 'POST'])
            ->allowHeaders(['X-CSRF-Token', 'Origin', 'X-Requested-With', 'Content-Type', 'Accept'])
            ->allowCredentials()
            ->exposeHeaders(['Link'])
            ->maxAge(300)
            ->build();
    }
}
