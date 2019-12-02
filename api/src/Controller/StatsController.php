<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\Invoice;

class StatsController extends AppController
{
    public function index()
    {
        $this->loadModel('Invoices');
        $this->loadModel('Partners');
        $this->loadModel('Products');

        $totals = [
            'sells' => collection(
                $this->Invoices->find('withTotal')
                    ->where(['sale' => true])
                )->sumOf('total'),
            'purchases' => collection(
                $this->Invoices->find('withTotal')
                    ->where(['sale' => false])
                )->sumOf('total'),
            'stock' => $this->Products->find('stock')->sumOf('stock')
        ];
        $invoices = $this->Invoices->find()->count();
        $partners = $this->Partners->find()->count();
        $products = $this->Products->find()->count();

        $this->set(compact('invoices', 'partners', 'products', 'totals'));
    }
}
