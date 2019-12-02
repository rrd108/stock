<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CakeDCUsersPhinxlog Controller
 *
 * @property \App\Model\Table\CakeDCUsersPhinxlogTable $CakeDCUsersPhinxlog
 *
 * @method \App\Model\Entity\CakeDCUsersPhinxlog[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CakeDCUsersPhinxlogController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $cakeDCUsersPhinxlog = $this->paginate($this->CakeDCUsersPhinxlog);

        $this->set(compact('cakeDCUsersPhinxlog'));
    }

    /**
     * View method
     *
     * @param string|null $id Cake D C Users Phinxlog id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cakeDCUsersPhinxlog = $this->CakeDCUsersPhinxlog->get($id, [
            'contain' => []
        ]);

        $this->set('cakeDCUsersPhinxlog', $cakeDCUsersPhinxlog);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cakeDCUsersPhinxlog = $this->CakeDCUsersPhinxlog->newEntity();
        if ($this->request->is('post')) {
            $cakeDCUsersPhinxlog = $this->CakeDCUsersPhinxlog->patchEntity($cakeDCUsersPhinxlog, $this->request->getData());
            if ($this->CakeDCUsersPhinxlog->save($cakeDCUsersPhinxlog)) {
                $this->Flash->success(__('The cake d c users phinxlog has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cake d c users phinxlog could not be saved. Please, try again.'));
        }
        $this->set(compact('cakeDCUsersPhinxlog'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Cake D C Users Phinxlog id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cakeDCUsersPhinxlog = $this->CakeDCUsersPhinxlog->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cakeDCUsersPhinxlog = $this->CakeDCUsersPhinxlog->patchEntity($cakeDCUsersPhinxlog, $this->request->getData());
            if ($this->CakeDCUsersPhinxlog->save($cakeDCUsersPhinxlog)) {
                $this->Flash->success(__('The cake d c users phinxlog has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cake d c users phinxlog could not be saved. Please, try again.'));
        }
        $this->set(compact('cakeDCUsersPhinxlog'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Cake D C Users Phinxlog id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cakeDCUsersPhinxlog = $this->CakeDCUsersPhinxlog->get($id);
        if ($this->CakeDCUsersPhinxlog->delete($cakeDCUsersPhinxlog)) {
            $this->Flash->success(__('The cake d c users phinxlog has been deleted.'));
        } else {
            $this->Flash->error(__('The cake d c users phinxlog could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
