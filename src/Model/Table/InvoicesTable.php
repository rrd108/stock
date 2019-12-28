<?php
namespace App\Model\Table;

use ArrayObject;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Invoices Model
 *
 * @property \App\Model\Table\StoragesTable&\Cake\ORM\Association\BelongsTo $Storages
 * @property \App\Model\Table\InvoicetypesTable&\Cake\ORM\Association\BelongsTo $Invoicetypes
 * @property \App\Model\Table\PartnersTable&\Cake\ORM\Association\BelongsTo $Partners
 * @property \App\Model\Table\ItemsTable&\Cake\ORM\Association\HasMany $Items
 *
 * @method \App\Model\Entity\Invoice get($primaryKey, $options = [])
 * @method \App\Model\Entity\Invoice newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Invoice[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Invoice|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Invoice saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Invoice patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Invoice[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Invoice findOrCreate($search, callable $callback = null, $options = [])
 */
class InvoicesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('invoices');
        $this->setDisplayField('number');
        $this->setPrimaryKey('id');

        $this->addBehavior(
            'Datalist.Datalist',
            [
                'Partners' => 'name',
                'Products' => 'name'
            ]
        );

        $this->belongsTo('Storages', [
            'foreignKey' => 'storage_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Invoicetypes', [
            'foreignKey' => 'invoicetype_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Partners', [
            'foreignKey' => 'partner_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Items', [
            'foreignKey' => 'invoice_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->date('date')
            ->allowEmptyDate('date');

        $validator
            ->inList('currency', ['HUF', 'EUR']);

        $validator
            ->boolean('sale')
            ->allowEmptyString('sale');

        $validator
            ->scalar('number')
            ->maxLength('number', 255)
            ->notEmptyString('number');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['storage_id'], 'Storages'));
        $rules->add($rules->existsIn(['invoicetype_id'], 'Invoicetypes'));
        $rules->add($rules->existsIn(['partner_id'], 'Partners'));

        return $rules;
    }

    public function beforeFind(Event $event, Query $query, ArrayObject $options, $primary)
    {
        $query->leftJoinWith('Storages', function ($q) {
            return $q->where(['Storages.company_id' => Configure::read('company_id')]);
        });
    }

    public function findWithTotal(Query $query, array $options)
    {
        return $query
            ->select(['total' => $query->func()->sum('Items.price * Items.quantity')])
            ->enableAutoFields(true)
            ->innerJoinWith('Items')
            ->group('Invoices.id');
    }
}
