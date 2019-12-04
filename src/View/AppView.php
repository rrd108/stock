<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.0.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\View;

use Cake\Core\Configure;
use Cake\I18n\Number;
use Cake\View\View;
use NumberFormatter;

/**
 * Application View
 *
 * Your application's default view class
 *
 * @link https://book.cakephp.org/3.0/en/views.html#the-app-view
 */
class AppView extends View
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading helpers.
     *
     * e.g. `$this->loadHelper('Html');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadHelper('Form', [
        'templates' => 'Datalist.form-templates',
        'widgets' => [
            'datalistJs' => ['Datalist\View\Widget\DatalistJsWidget']
        ]
        ]);
        $this->loadHelper('Paginator', ['templates' => 'paginator-templates']);
        $this->loadHelper('MenuLink.MenuLink');
        $this->loadHelper('CakeDC/Users.User');

        if (Configure::read('company_id')) {
            Number::defaultCurrency($this->getRequest()->getSession()->read('company')->currency);
            $this->precision = Configure::read('precisions.' . $this->getRequest()->getSession()->read('company')->currency);
        }
    }
}
