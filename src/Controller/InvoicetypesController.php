<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Invoicetypes Controller
 *
 * @property \App\Model\Table\InvoicetypesTable $Invoicetypes
 *
 * @method \App\Model\Entity\Invoicetype[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InvoicetypesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $invoicetypes = $this->Invoicetypes->find()
            ->order('Invoicetypes.name');

        $this->set([
            'invoicetypes' => $invoicetypes,
            '_serialize' => ['invoicetypes']
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Invoicetype id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $invoicetype = $this->Invoicetypes->get($id, [
            'contain' => ['Invoices']
        ]);

        $this->set('invoicetype', $invoicetype);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $invoicetype = $this->Invoicetypes->newEntity();
        if ($this->request->is('post')) {
            $invoicetype = $this->Invoicetypes->patchEntity($invoicetype, $this->request->getData());
            if ($this->Invoicetypes->save($invoicetype)) {
                $this->Flash->success(__('The invoicetype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The invoicetype could not be saved. Please, try again.'));
        }
        $this->set(compact('invoicetype'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Invoicetype id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $invoicetype = $this->Invoicetypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $invoicetype = $this->Invoicetypes->patchEntity($invoicetype, $this->request->getData());
            if ($this->Invoicetypes->save($invoicetype)) {
                $this->Flash->success(__('The invoicetype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The invoicetype could not be saved. Please, try again.'));
        }
        $this->set(compact('invoicetype'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Invoicetype id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $invoicetype = $this->Invoicetypes->get($id);
        if ($this->Invoicetypes->delete($invoicetype)) {
            $this->Flash->success(__('The invoicetype has been deleted.'));
        } else {
            $this->Flash->error(__('The invoicetype could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
