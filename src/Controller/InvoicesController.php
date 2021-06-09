<?php
namespace App\Controller;

use App\Controller\AppController;
use Billingo\API\Connector\HTTP\Request;
use Cake\Core\Configure;
use SplFileObject;

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
        $year = $this->request->query['year'] ?? date('Y');
        $month = $this->request->query['month'] ?? date('m');
        $invoices = $this->Invoices->find()
            ->contain(['Storages', 'Invoicetypes', 'Partners', 'Items'])
            ->where(['YEAR(Invoices.date)' => $year, 'MONTH(Invoices.date)' => $month])
            ->order(['Invoices.date' => 'DESC', 'Invoices.id' => 'DESC']);

        $this->set([
            'invoices' => $invoices,
            '_serialize' => ['invoices']
        ]);
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
            'contain' => ['Storages.Companies', 'Invoicetypes', 'Partners.Groups', 'Items.Products']
        ]);

        $this->set('invoice', $invoice);
        $this->set(['_serialize' => ['invoice']]);
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
            $data = $this->request->getData();
            $invoice = $this->Invoices->patchEntity($invoice, $data);
            if ($this->Invoices->save($invoice)) {
                //$this->Flash->success(__('The invoice has been saved.'));

                // new selling prices should be saved
                // TODO if they are not equal with defaults
                if (!$data['sale']) {
                    foreach ($data['items'] as $item) {
                        foreach ($item['selling_prices'] as $groupId => $sPrice) {
                            $sellingPrice = $this->Invoices->Items->Products->GroupsProducts->newEntity();
                            $sellingPrice = $this->Invoices->Items->Products->GroupsProducts->patchEntity(
                                $sellingPrice,
                                [
                                    'product_id' => $item['product_id'],
                                    'group_id' => $groupId,
                                    'price' => $sPrice
                                ]
                            );
                            $this->Invoices->Items->Products->GroupsProducts->save($sellingPrice);
                        }
                    }
                }
                //return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The invoice could not be saved. Please, try again.'));
        }
        /*$storages = $this->Invoices->Storages->find('list', ['limit' => 200])->order('name');
        $invoicetypes = $this->Invoices->Invoicetypes->find('list', ['limit' => 200])->order('name');
        $partners = $this->Invoices->Partners->find()->contain('Groups')->order('Partners.name');
        $groups = $this->Invoices->Partners->Groups->find()->where(['percentage']);
        // TODO handling currencies
        $products = $this->Invoices->Items->Products->find('purchasePrice', ['currency' => 'HUF'])->order('name');
        $this->set(compact('invoice', 'storages', 'invoicetypes', 'partners', 'groups', 'products'));*/
        $this->set([
            'invoice' => $invoice,
            '_serialize' => ['invoice']
        ]);
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
            $this->Invoices->save($invoice);
        }
        $storages = $this->Invoices->Storages->find('list', ['limit' => 200]);
        $invoicetypes = $this->Invoices->Invoicetypes->find('list', ['limit' => 200]);
        $partners = $this->Invoices->Partners->find('list', ['limit' => 200]);
        $this->set(compact('invoice', 'storages', 'invoicetypes', 'partners'));
        $this->set(['_serialize' => ['invoice']]);
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
        $invoice->status = 'd';
        $this->Invoices->save($invoice);
        $this->set(compact('invoice'));
        $this->set(['_serialize' => ['invoice']]);
    }

    public function billingo(int $id)
    {
        $company = $this->Invoices->Storages->Companies->get(Configure::read('company_id'));
        $billing = json_decode($company->billing);
        $billingo = new Request([
            'public_key' => $billing->Billingo->public_key,
            'private_key' => $billing->Billingo->private_key
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
                'description' => $item->product->name . ' ' . $item->product->code . ' ' . $item->product->size,
                'vat_id' => array_search($item->product->vat, $vatCodes),
                'qty' => $item->quantity,
                'net_unit_price' => $item->price,
                'unit' => 'db',
            ];
        }

        $data = [
            'fulfillment_date' => $this->request->getQuery('fulfillment_date'),
            'due_date' => $this->request->getQuery('due_date'),
            'payment_method' => (int) $this->request->getQuery('payment_method'), // 1: cash, 2: wiretransfer, 4: cod, 5: bank card, 7: paypal
            'comment' => $this->request->getQuery('invoice_comment'),
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

        $invoice->number = $invoice->number
            . '|' . $billingoInvoice['attributes']['invoice_no']
            . '|' . $downloadLink;
        $this->Invoices->save($invoice);
        $this->set([
            'invoice' => $invoice,
            '_serialize' => ['invoice']
        ]);
    }

    public function import()
    {
        $storages = $this->Invoices->Storages->find('list');
        $partners = $this->Invoices->Partners->find('list');
        $this->set(compact('partners', 'storages'));

        // step 1 file just uploaded
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

        // step 2 fields associated with csv columns
        if (!is_null($this->request->getData('name'))) {
            $storage = $this->Invoices->Storages->get($this->request->getData('storage'));

            $data = [
                'storage_id' => $this->request->getData('storage'),
                'invoicetype_id' => 2,  // szállító levél
                'partner_id' => $this->request->getData('partner'),
                'date' => $this->request->getData('date'),
                'number' => 'IMP/' . date('Y-m-d H:i'),
                'sale' => false,
                'items' => []
            ];
            $minimumQuantity = $this->request->getData('importZero') ? -1 : 0;
            $i = 0;
            // TODO currency is not saved
            $this->getRequest()->getSession()->read('productImportFile')->skip(1)->each(
                function ($value, $key) use (&$data, $minimumQuantity, &$i, $storage) {
                    if ($value[$this->request->getData('quantity')] > $minimumQuantity) {
                        foreach ($this->request->getData() as $key => $column) {
                            if (in_array($key, ['quantity', 'price'])
                                && isset($value[$this->request->getData($key)])) {
                                $data['items'][$i][$key] = $value[$this->request->getData($key)];
                            }
                        }
                        $data['items'][$i]['currency'] = $this->request->getData('currency');
                        $data['items'][$i]['product'] = [
                            'company_id' => $storage->company_id,
                            'name' => $value[$this->request->getData('name')],
                            'size' => isset($value[$this->request->getData('size')]) ? $value[$this->request->getData('size')]: '',
                            'code' => isset($value[$this->request->getData('code')]) ? $value[$this->request->getData('code')] : '',
                            'vat' => $value[$this->request->getData('vat')]
                        ];
                        $i++;
                    }
                }
            );

            $invoice = $this->Invoices->newEntity();
            $invoice = $this->Invoices->patchEntity($invoice, $data, ['associated' => ['Items.Products']]);
            if ($this->Invoices->save($invoice)) {
                $this->Flash->success(__('The invoice has been saved.'));
                $this->getRequest()->getSession()->delete('productImportFile');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The invoice could not be saved. Please, try again.'));
        }
    }
}