<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Storages Controller
 *
 * @property \App\Model\Table\StoragesTable $Storages
 *
 * @method \App\Model\Entity\Storage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StoragesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $storages = $this->Storages->find()
            ->order('Storages.name');

        $this->set([
            'storages' => $storages,
            '_serialize' => ['storages']
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Storage id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $storage = $this->Storages->get($id, [
            'contain' => ['Companies', 'Products']
        ]);

        $this->set('storage', $storage);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $storage = $this->Storages->newEntity();
        if ($this->request->is('post')) {
            $storage = $this->Storages->patchEntity($storage, $this->request->getData());
            if ($this->Storages->save($storage)) {
                $this->Flash->success(__('The storage has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The storage could not be saved. Please, try again.'));
        }
        $companies = $this->Storages->Companies->find('list', ['limit' => 200]);
        $this->set(compact('storage', 'companies'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Storage id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $storage = $this->Storages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $storage = $this->Storages->patchEntity($storage, $this->request->getData());
            if ($this->Storages->save($storage)) {
                $this->Flash->success(__('The storage has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The storage could not be saved. Please, try again.'));
        }
        $companies = $this->Storages->Companies->find('list', ['limit' => 200]);
        $this->set(compact('storage', 'companies'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Storage id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $storage = $this->Storages->get($id);
        if ($this->Storages->delete($storage)) {
            $this->Flash->success(__('The storage has been deleted.'));
        } else {
            $this->Flash->error(__('The storage could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
