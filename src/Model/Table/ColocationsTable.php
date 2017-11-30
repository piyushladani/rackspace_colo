<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Colocations Model
 *
 * @property \App\Model\Table\CustomersTable|\Cake\ORM\Association\BelongsTo $Customers
 * @property \App\Model\Table\LocationsTable|\Cake\ORM\Association\BelongsTo $Locations
 * @property \App\Model\Table\RacksTable|\Cake\ORM\Association\BelongsTo $Racks
 * @property |\Cake\ORM\Association\BelongsTo $Shelves
 *
 * @method \App\Model\Entity\Colocation get($primaryKey, $options = [])
 * @method \App\Model\Entity\Colocation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Colocation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Colocation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Colocation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Colocation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Colocation findOrCreate($search, callable $callback = null, $options = [])
 */
class ColocationsTable extends Table
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

        $this->setTable('colocations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Locations', [
            'foreignKey' => 'location_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Racks', [
            'foreignKey' => 'rack_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Shelfs', [
            'foreignKey' => 'shelf_id',
            'joinType' => 'INNER'
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            
            ->requirePresence('he', 'create')
            ->notEmpty('he');

        $validator
            ->requirePresence('customer', 'create')
            ->notEmpty('customer');

        $validator
            ->requirePresence('customer_id', 'create')
            ->notEmpty('customer_id');

        $validator
            ->requirePresence('location_id', 'create')
            ->notEmpty('location_id');

        $validator
            ->requirePresence('rack_id', 'create')
            ->notEmpty('rack_id');

        $validator
            ->requirePresence('shelf_id', 'create')
            ->notEmpty('shelf_id');

        $validator
            ->scalar('user')
            ->requirePresence('user', 'create')
            ->notEmpty('user');

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
        $rules->add($rules->existsIn(['customer_id'], 'Customers'));
        $rules->add($rules->existsIn(['location_id'], 'Locations'));
        $rules->add($rules->existsIn(['rack_id'], 'Racks'));
        $rules->add($rules->existsIn(['shelf_id'], 'Shelfs'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }

    public function isOwnedBy($articleId, $userId)
{
    return $this->exists(['id' => $articleId, 'user_id' => $userId]);
}


}
