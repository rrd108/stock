<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SocialAccounts Controller
 *
 * @property \App\Model\Table\SocialAccountsTable $SocialAccounts
 *
 * @method \App\Model\Entity\SocialAccount[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SocialAccountsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $socialAccounts = $this->paginate($this->SocialAccounts);

        $this->set(compact('socialAccounts'));
    }

    /**
     * View method
     *
     * @param string|null $id Social Account id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $socialAccount = $this->SocialAccounts->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('socialAccount', $socialAccount);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $socialAccount = $this->SocialAccounts->newEntity();
        if ($this->request->is('post')) {
            $socialAccount = $this->SocialAccounts->patchEntity($socialAccount, $this->request->getData());
            if ($this->SocialAccounts->save($socialAccount)) {
                $this->Flash->success(__('The social account has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The social account could not be saved. Please, try again.'));
        }
        $users = $this->SocialAccounts->Users->find('list', ['limit' => 200]);
        $this->set(compact('socialAccount', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Social Account id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $socialAccount = $this->SocialAccounts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $socialAccount = $this->SocialAccounts->patchEntity($socialAccount, $this->request->getData());
            if ($this->SocialAccounts->save($socialAccount)) {
                $this->Flash->success(__('The social account has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The social account could not be saved. Please, try again.'));
        }
        $users = $this->SocialAccounts->Users->find('list', ['limit' => 200]);
        $this->set(compact('socialAccount', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Social Account id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $socialAccount = $this->SocialAccounts->get($id);
        if ($this->SocialAccounts->delete($socialAccount)) {
            $this->Flash->success(__('The social account has been deleted.'));
        } else {
            $this->Flash->error(__('The social account could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
