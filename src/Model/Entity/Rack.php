<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Rack Entity
 *
 * @property int $id
 * @property string $name
 * @property int $location_id
 *
 * @property \App\Model\Entity\Location $location
 * @property \App\Model\Entity\Shelf[] $shelfs
 */
class Rack extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'location_id' => true,
        'location' => true,
        'shelfs' => true
    ];
}
