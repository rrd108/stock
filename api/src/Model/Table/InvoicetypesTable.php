<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Invoicetypes Model
 *
 * @property \App\Model\Table\InvoicesTable&\Cake\ORM\Association\HasMany $Invoices
 *
 * @method \App\Model\Entity\Invoicetype get($primaryKey, $options = [])
 * @method \App\Model\Entity\Invoicetype newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Invoicetype[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Invoicetype|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Invoicetype saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Invoicetype patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Invoicetype[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Invoicetype findOrCreate($search, callable $callback = null, $options = [])
 */
class InvoicetypesTable extends Table
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

        $this->setTable('invoicetypes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Invoices', [
            'foreignKey' => 'invoicetype_id'
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
            ->scalar('name')
            ->maxLength('name', 45)
            ->allowEmptyString('name');

        return $validator;
    }
}
