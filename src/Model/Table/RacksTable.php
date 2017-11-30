<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Racks Model
 *
 * @property \App\Model\Table\LocationsTable|\Cake\ORM\Association\BelongsTo $Locations
 * @property \App\Model\Table\ColocationsTable|\Cake\ORM\Association\HasMany $Colocations
 * @property \App\Model\Table\ShelfsTable|\Cake\ORM\Association\HasMany $Shelfs
 *
 * @method \App\Model\Entity\Rack get($primaryKey, $options = [])
 * @method \App\Model\Entity\Rack newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Rack[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Rack|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Rack patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Rack[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Rack findOrCreate($search, callable $callback = null, $options = [])
 */
class RacksTable extends Table
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

        $this->setTable('racks');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Locations', [
            'foreignKey' => 'location_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Colocations', [
            'foreignKey' => 'rack_id'
        ]);
        $this->hasMany('Shelfs', [
            'foreignKey' => 'rack_id'
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
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('location_id')
            ->requirePresence('location_id', 'create')
            ->notEmpty('location_id');

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
        $rules->add($rules->existsIn(['location_id'], 'Locations'));

        return $rules;
    }
}
