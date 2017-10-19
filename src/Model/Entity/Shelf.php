<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Shelf Entity
 *
 * @property int $id
 * @property int $number
 * @property int $he
 * @property string $free
 * @property int $location_id
 * @property int $rack_id
 *
 * @property \App\Model\Entity\Location $location
 * @property \App\Model\Entity\Rack $rack
 * @property \App\Model\Entity\Colocation[] $colocations
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
        'number' => true,
        'he' => true,
        'free' => true,
        'location_id' => true,
        'rack_id' => true,
        'location' => true,
        'rack' => true,
        'colocations' => true
    ];
}
