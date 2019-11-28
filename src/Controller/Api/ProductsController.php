<?php
namespace App\Controller\Api;

use App\Controller\AppController;

class ProductsController extends AppController
{
    public function stock()
    {
        $products = $this->Products->find('purchasePrice', ['currency' => 'HUF'])
            ->find('stock')
            ->order('Products.name');

        $this->set(compact('products'));
        $this->set('_serialize', 'products');
    }
}
