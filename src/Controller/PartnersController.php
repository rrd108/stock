<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Partners Controller
 *
 * @property \App\Model\Table\PartnersTable $Partners
 *
 * @method \App\Model\Entity\Partner[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PartnersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {

        $partners = $this->Partners->find()
            ->contain('Groups')
            ->order('Partners.name');

        $this->set([
            'partners' => $partners,
            '_serialize' => ['partners']
        ]);

    }

    /**
     * View method
     *
     * @param string|null $id Partner id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $partner = $this->Partners->get($id, [
            'contain' => ['Groups', /*'Invoices.Invoicetypes', 'Invoices.Items'*/]
        ]);
        $this->set('partner', $partner);
        $this->set(['_serialize' => ['partner']]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $partner = $this->Partners->newEntity();
        if ($this->request->is('post')) {
            $partner = $this->Partners->patchEntity($partner, $this->request->getData());
            $this->Partners->save($partner);
        }
        $companies = $this->Partners->Companies->find('list', ['limit' => 200]);
        $groups = $this->Partners->Groups->find('list', ['limit' => 200]);
        $this->set([
            'partner' => $partner,
            '_serialize' => ['partner']
        ]);
    }

    /**
     * Edit method
     *
     * @param string|null $id Partner id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $partner = $this->Partners->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $partner = $this->Partners->patchEntity($partner, $this->request->getData());
            $this->Partners->save($partner);
        }
        $this->set(compact('partner'));
        $this->set([
            'partner' => $partner,
            '_serialize' => ['partner']
        ]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Partner id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $partner = $this->Partners->get($id);
        if ($this->Partners->delete($partner)) {
            $this->Flash->success(__('The partner has been deleted.'));
        } else {
            $this->Flash->error(__('The partner could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}