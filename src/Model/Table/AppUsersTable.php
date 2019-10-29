<?php
namespace App\Model\Table;

use Cake\Auth\DigestAuthenticate;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Validation\Validator;
use CakeDC\Users\Model\Table\UsersTable as CakeDCUsersTable;

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

	public function beforeSave(Event $event)
    {
        $entity = $event->getData('entity');

        // Make a password for digest auth.
        $entity->secret = DigestAuthenticate::password(
            $entity->email,
            $entity->password,
            env('SERVER_NAME')
        );
        return true;
    }

}