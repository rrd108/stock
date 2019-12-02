<?php
namespace App\Controller\Api;

use App\Controller\AppController;

class InvoicesController extends AppController
{
    public function index()
    {
        $invoices = $this->Invoices->find()
            ->contain(['Storages', 'Invoicetypes', 'Partners', 'Items'])
            ->order(['Invoices.date' => 'DESC', 'Invoices.id' => 'DESC']);
        $this->set(compact('invoices'));
        $this->set('_serialize', 'invoices');
    }
}
