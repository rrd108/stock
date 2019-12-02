<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CakeDCUsersPhinxlog Model
 *
 * @method \App\Model\Entity\CakeDCUsersPhinxlog get($primaryKey, $options = [])
 * @method \App\Model\Entity\CakeDCUsersPhinxlog newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CakeDCUsersPhinxlog[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CakeDCUsersPhinxlog|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CakeDCUsersPhinxlog saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CakeDCUsersPhinxlog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CakeDCUsersPhinxlog[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CakeDCUsersPhinxlog findOrCreate($search, callable $callback = null, $options = [])
 */
class CakeDCUsersPhinxlogTable extends Table
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

        $this->setTable('cake_d_c_users_phinxlog');
        $this->setDisplayField('version');
        $this->setPrimaryKey('version');
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
            ->allowEmptyString('version', null, 'create');

        $validator
            ->scalar('migration_name')
            ->maxLength('migration_name', 100)
            ->allowEmptyString('migration_name');

        $validator
            ->dateTime('start_time')
            ->allowEmptyDateTime('start_time');

        $validator
            ->dateTime('end_time')
            ->allowEmptyDateTime('end_time');

        $validator
            ->boolean('breakpoint')
            ->notEmptyString('breakpoint');

        return $validator;
    }
}
