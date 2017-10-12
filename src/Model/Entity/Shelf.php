<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Shelf Entity
 *
 * @property int $id
 * @property int $he
 * @property int $rack_id
 * @property int $colocation_id
 *
 * @property \App\Model\Entity\Rack $rack
 * @property \App\Model\Entity\Colocation $colocation
 */
class Shelf extends Entity
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
        'he' => true,
        'rack_id' => true,
        'colocation_id' => true,
        'rack' => true,
        'colocation' => true
    ];
}
