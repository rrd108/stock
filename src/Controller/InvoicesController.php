<?php
namespace App\Controller;

use App\Controller\AppController;
use Billingo\API\Connector\HTTP\Request;
use Cake\Core\Configure;

/**
 * Invoices Controller
 *
 * @property \App\Model\Table\InvoicesTable $Invoices
 *
 * @method \App\Model\Entity\Invoice[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InvoicesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Storages', 'Invoicetypes', 'Partners']
        ];
        $invoices = $this->paginate($this->Invoices);

        $this->set(compact('invoices'));
    }

    /**
     * View method
     *
     * @param string|null $id Invoice id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $invoice = $this->Invoices->get($id, [
            'contain' => ['Storages', 'Invoicetypes', 'Partners', 'Items.Products']
        ]);

        $this->set('invoice', $invoice);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $invoice = $this->Invoices->newEntity();
        if ($this->request->is('post')) {
            $invoice = $this->Invoices->patchEntity($invoice, $this->request->getData());
            if ($this->Invoices->save($invoice)) {
                $this->Flash->success(__('The invoice has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The invoice could not be saved. Please, try again.'));
        }
        $storages = $this->Invoices->Storages->find('list', ['limit' => 200]);
        $invoicetypes = $this->Invoices->Invoicetypes->find('list', ['limit' => 200]);
        $partners = $this->Invoices->Partners->find('list', ['limit' => 200]);
        $this->set(compact('invoice', 'storages', 'invoicetypes', 'partners'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Invoice id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $invoice = $this->Invoices->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $invoice = $this->Invoices->patchEntity($invoice, $this->request->getData());
            if ($this->Invoices->save($invoice)) {
                $this->Flash->success(__('The invoice has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The invoice could not be saved. Please, try again.'));
        }
        $storages = $this->Invoices->Storages->find('list', ['limit' => 200]);
        $invoicetypes = $this->Invoices->Invoicetypes->find('list', ['limit' => 200]);
        $partners = $this->Invoices->Partners->find('list', ['limit' => 200]);
        $this->set(compact('invoice', 'storages', 'invoicetypes', 'partners'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Invoice id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $invoice = $this->Invoices->get($id);
        if ($this->Invoices->delete($invoice)) {
            $this->Flash->success(__('The invoice has been deleted.'));
        } else {
            $this->Flash->error(__('The invoice could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function billingo(int $id)
    {
        $billingo = new Request([
            'public_key' => Configure::read('Billingo.public_key'),
            'private_key' => Configure::read('Billingo.private_key')
        ]);

        $invoice = $this->Invoices->get($id, ['contain' => ['Partners', 'Items.Products']]);

        $clientData = [
            'name' => $invoice->partner->name,
            'email' => $invoice->partner->email,
            'billing_address' => [
                'street_name' => $invoice->partner->address,
                'street_type' => '',
                'house_nr' => '',
                'city' => $invoice->partner->city,
                'postcode' => $invoice->partner->zip,
                'country' => 'HU',
            ],
            'taxcode' => $invoice->partner->taxnumber ? $invoice->partner->taxnumber : ''
        ];

        $client = $billingo->post('clients', $clientData);
        if (!$client['id']) {
            $error = __('Billingo client creation error');
        }

        $vatCodes = ['x', 27, 5, 18, 'AM', 'EU'];     // TODO get from billingo
        $items = [];
        foreach ($invoice->items as $item) {
            $items[] = [
                'description' => $item->product->name,
                'vat_id' => array_search($item->product->vat, $vatCodes),
                'qty' => $item->quantity,
                'net_unit_price' => $item->price,
                'unit' => 'db',
            ];
        }

        $data = [
            'fulfillment_date' => $invoice->date->format('Y-m-d'),
            'due_date' => $invoice->date->format('Y-m-d'),  // TODO
            'payment_method' => 2,                  // TODO 1: cash, 2: wiretransfer, 4: cod, 5: bank card, 7: paypal
            'comment' => '',
            'template_lang_code' => 'hu',
            'electronic_invoice' => 0,
            'currency' => 'HUF',                    // TODO
            'exchange_rate' => 1,                   // TODO
            'client_uid' => $client['id'],
            'block_uid' => 0,
            'type' => 3,                            // 0: draft, 1: proforma, 3: normal
            'round_to' => 1,                        // 0,1,5,10
            //'bank_account_uid' => 000000000,        // TODO
            'items' => $items
        ];
        $billingoInvoice = $billingo->post('invoices', $data);

        $downloadLink = $billingo->get('invoices/' . $billingoInvoice['id'] . '/code');
        $downloadLink = 'https://www.billingo.hu/access/c:' . $downloadLink['code'];

        $invoice->number = $billingoInvoice['id']
            . '|' . $billingoInvoice['attributes']['invoice_no']
            . '|' . $downloadLink;
        $this->Invoices->save($invoice);
        $this->redirect(['action' => 'view', $id]);
    }
}
