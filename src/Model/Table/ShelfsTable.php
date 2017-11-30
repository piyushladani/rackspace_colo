<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Shelfs Model
 *
 * @property \App\Model\Table\LocationsTable|\Cake\ORM\Association\BelongsTo $Locations
 * @property \App\Model\Table\RacksTable|\Cake\ORM\Association\BelongsTo $Racks
 * @property \App\Model\Table\ColocationsTable|\Cake\ORM\Association\HasMany $Colocations
 *
 * @method \App\Model\Entity\Shelf get($primaryKey, $options = [])
 * @method \App\Model\Entity\Shelf newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Shelf[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Shelf|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Shelf patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Shelf[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Shelf findOrCreate($search, callable $callback = null, $options = [])
 */
class ShelfsTable extends Table
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

        $this->setTable('shelfs');
        $this->setDisplayField('number');
        $this->setPrimaryKey('id');

        $this->belongsTo('Locations', [
            'foreignKey' => 'location_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Racks', [
            'foreignKey' => 'rack_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Colocations', [
            'foreignKey' => 'shelf_id'
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
            
            ->requirePresence('number', 'create')
            ->notEmpty('number');

        $validator
            ->integer('he')
            ->requirePresence('he', 'create')
            ->notEmpty('he');

        $validator
            
            ->requirePresence('free', 'create')
            ->notEmpty('free');

        $validator
            ->scalar('location_id')
            ->requirePresence('location_id', 'create')
            ->notEmpty('location_id');

        $validator
            ->scalar('rack_id')
            ->requirePresence('rack_id', 'create')
            ->notEmpty('rack_id');

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
        $rules->add($rules->existsIn(['rack_id'], 'Racks'));

        return $rules;
    }
}
