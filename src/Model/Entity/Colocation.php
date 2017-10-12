<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Colocation Entity
 *
 * @property int $id
 * @property int $customer_id
 * @property string $location_id
 * @property string $rack_id
 * @property int $he
 * @property int $total_he
 *
 * @property \App\Model\Entity\Customer $customer
 * @property \App\Model\Entity\Location $location
 * @property \App\Model\Entity\Rack $rack
 * @property \App\Model\Entity\Shelf[] $shelfs
 */
class Colocation extends Entity
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
        'customer_id' => true,
        'location_id' => true,
        'rack_id' => true,
        'he' => true,
        'total_he' => true,
        'customer' => true,
        'location' => true,
        'rack' => true,
        'shelfs' => true
    ];
}
