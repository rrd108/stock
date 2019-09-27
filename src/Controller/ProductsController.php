<?php
namespace App\Controller;

use App\Controller\AppController;
use SplFileObject;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 *
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Companies']
        ];
        $products = $this->paginate($this->Products);

        $this->set(compact('products'));
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['Companies', 'Items']
        ]);

        $this->set('product', $product);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $companies = $this->Products->Companies->find('list', ['limit' => 200]);
        $this->set(compact('product', 'companies'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $companies = $this->Products->Companies->find('list', ['limit' => 200]);
        $this->set(compact('product', 'companies'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function stock()
    {
        $products = $this->Products->find('stock');

        $this->set(compact('products'));
    }

    public function import()
    {
        if ($this->request->getData() && is_uploaded_file($this->request->getData('File.tmp_name'))) {
            $fileType = $this->request->getData('File.type');
            $csvMimes = ['text/csv', 'text/comma-separated-values', 'text/plain'];

            if (in_array($fileType, $csvMimes)) {
                $file = new SplFileObject($this->request->getData('File.tmp_name'), 'r');
                $file->setFlags(
                    SplFileObject::READ_CSV | SplFileObject::SKIP_EMPTY
                    |  SplFileObject::READ_AHEAD | SplFileObject::DROP_NEW_LINE
                );
                $file->setCsvControl(';');
                $this->getRequest()->getSession()->write('productImportFile', collection($file));
                $columns = $file->current();

                $this->set(compact('columns'));
                return;
            }

            $this->Flash->error(__('Unrecognized file type: {0}', $fileType));
        }

        if (!is_null($this->request->getData('name'))) {
            $this->getRequest()->getSession()->read('productImportFile')->skip(1)->each(function ($value, $key) {
                // TODO this should be an option to set at the previous step
                if ($value[$this->request->getData('quantity')] > 0) {
                    $data = [
                        'company_id' => 1
                    ];
                    foreach ($this->request->getData() as $key => $column) {
                        if (isset($value[$this->request->getData($key)])) {
                            $data[$key] = $value[$this->request->getData($key)];
                        }
                    }
                    debug($data);
                    // quantity price
                }
            });
        }
    }
}
