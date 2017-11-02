<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->scalar('username')
            ->requirePresence('username', 'create')
            ->notEmpty('username');

        $validator
            ->scalar('password')
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->scalar('confirm_password')
            ->requirePresence('confirm_password', 'create')
            ->notEmpty('confirm_password');
        $validator
            ->add('confirm_password',[
                'compare' => [
                'rule' => ['compareWith', 'password'],
                'message' => 'Sorry, password and confirm password does not matched'
                ]
                ]);

        $validator
            ->scalar('role')
            ->requirePresence('role', 'create')
            ->notEmpty('role')
            ->add('role', 'inList', [
                'rule' => ['inList', ['admin', 'author']],
                'message' => 'Please enter a valid role'
            ]);

        $validator
            ->scalar('password_reset_token')
            ->requirePresence('password_reset_token', 'create')
            ->notEmpty('password_reset_token');

        return $validator;
    }
    public function validationPassword(Validator $validator)
    {
        $validator
                ->add('old_password','custom',[
                    'rule' => function($value, $context){
                        $user = $this->get($context['data']['id']);
                        if($user)
                        {
                            if((new CakeAuthDefaultPasswordHasher)->check($value, $user->password))
                            {
                                return true;
                            }
                        }
                        return false;
                    },
                    'message' => 'Your old password does not match the entered password!',
                ])
                ->notEmpty('old_password');
        
        $validator
                ->add('new_password',[
                    'length' => [
                        'rule' => ['minLength',4],
                        'message' => 'Please enter atleast 4 characters in password your password.'
                    ]
                ])
                ->add('new_password',[
                    'match' => [
                        'rule' => ['compareWith','confirm_password'],
                        'message' => 'Sorry! Password dose not match. Please try again!'
                    ]
                ])
                ->notEmpty('new_password');
        
        $validator
                ->add('confirm_password',[
                    'length' => [
                        'rule' => ['minLength',4],
                        'message' => 'Please enter atleast 4 characters in password your password.'
                    ]
                ])
                ->add('confirm_password',[
                    'match' => [
                        'rule' => ['compareWith','new_password'],
                        'message' => 'Sorry! Password dose not match. Please try again!'
                    ]
                ])
                ->notEmpty('confirm_password');
        
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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->isUnique(['username']));

        return $rules;
    }
}
