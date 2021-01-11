<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\Invoice;
use Cake\Core\Configure;

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
                    ->where([
                        'sale' => true, 'Storages.company_id' => Configure::read('company_id'),
                        'YEAR(Invoices.date)' => date('Y')
                        ])
                )->sumOf('total'),
            'purchases' => collection(
                $this->Invoices->find('withTotal')
                    ->where([
                        'sale' => false, 'Storages.company_id' => Configure::read('company_id'),
                        'YEAR(Invoices.date)' => date('Y')
                        ])
                )->sumOf('total'),
            'stock' => $this->Products->find('stock')->sumOf('stock'),
        ];
        $invoices = $this->Invoices->find()->where([
            'Storages.company_id' => Configure::read('company_id'),
            'YEAR(Invoices.date)' => date('Y')
            ])->count();
        $partners = $this->Partners->find()->count();
        $products = $this->Products->find()->count();

        $stats = [
            'invoices' => $invoices,
            'partners' => $partners,
            'products' => $products,
            'totals' => $totals
        ];

        $this->set(compact('invoices', 'partners', 'products', 'totals', 'stats'));
        $this->set('_serialize', 'stats');
    }
}
