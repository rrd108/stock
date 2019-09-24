<?php
namespace App\Controller;

use App\Controller\AppController;

class StatsController extends AppController
{
    public function index()
    {
        $this->loadModel('Invoices');
        $this->loadModel('Partners');
        $this->loadModel('Products');

        $invoices = $this->Invoices->find()->count();
        $partners = $this->Partners->find()->count();
        $products = $this->Products->find()->count();

        $this->set(compact('invoices', 'partners', 'products'));
    }
}
