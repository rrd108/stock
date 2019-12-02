<?php


namespace App\Model\Table;
use CakeDC\Users\Model\Table\UsersTable as CakeDCUsersTable;
use Cake\Validation\Validator;
use Cake\Core\Configure;

class AppUsersTable extends CakeDCUsersTable{

	public function initialize(array $config)
	{
		parent::initialize($config);
		$this->setDisplayField('email');
	}

	public function validationDefault(Validator $validator)
	{
		$validator = parent::validationDefault($validator);
		$username = Configure::read('Auth.authenticate.Form.fields.username');
		if ($username === 'email') {
			$validator->remove('username');
			$validator->allowEmpty('username');
		}
		return $validator;
	}

}