<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Location $location
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Location'), ['action' => 'edit', $location->id]) ?> </li>
        <li><?= $this->Html->link(__('List Locations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('List Colocations'), ['controller' => 'Colocations', 'action' => 'index']) ?> </li>
        <!-- <li><?= $this->Form->postLink(__('Delete Location'), ['action' => 'delete', $location->id], ['confirm' => __('Are you sure you want to delete # {0}?', $location->id)]) ?> </li>
        <li><?= $this->Html->link(__('New Colocation'), ['controller' => 'Colocations', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('New Location'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Racks'), ['controller' => 'Racks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rack'), ['controller' => 'Racks', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Shelfs'), ['controller' => 'Shelfs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Shelf'), ['controller' => 'Shelfs', 'action' => 'add']) ?> </li> -->
    </ul>
</nav>
<div class="locations view large-9 medium-8 columns content">
    <h3><?= h($location->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($location->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?= h($location->address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($location->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Colocations') ?></h4>
        <?php if (!empty($location->colocations)): ?>
        <table cellpadding="0" cellspacing="0">
            
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Customer Name') ?></th>
                <th scope="col"><?= __('Rack') ?></th>
                <th scope="col"><?= __('Shelf Number') ?></th>
                <th scope="col"><?= __('HU') ?></th>
                <th scope="col"><?= __('User') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        
  
            <?php foreach ($location->colocations as $colocations): ?>
                <?php 
                //Location,Rack and Shelf ids are replaced with their respective names
                
                $rackid=$colocations->rack_id;
                $shelfid=$colocations->shelf_id;
                $customerid=$colocations->customer_id;
                $userid=$colocations->user_id;

            
    $customers=$customer->find();

        $customers->select(['Customers.name'])
    ->distinct(['Customers.name'])->where(['Customers.id'=>$customerid]);
    $customers=$customers->toArray();

    $racks=$rack->find();

        $racks->select(['Racks.name'])
    ->distinct(['Racks.name'])->where(['Racks.id'=>$rackid]);
    $racks=$racks->toArray();

    $shelfs=$shelf->find();

    $shelfs->select(['Shelfs.number'])
    ->distinct(['Shelfs.number'])->where(['Shelfs.id'=>$shelfid]);
    $shelfs=$shelfs->toArray();

    $users=$user->find();

    $users->select(['Users.name'])
    ->distinct(['Users.name'])->where(['Users.id'=>$userid]);
    $users=$users->toArray();
    #var_dump($group);die();

                ?>
            <tr>
                <td><?= h($colocations->id) ?></td>
                <td><?= h($customers[0]["name"]) ?></td>
                <td><?= h($racks[0]["name"]) ?></td>
                <td><?= h($shelfs[0]["number"]) ?></td>
                <td><?= h($colocations->he) ?></td>
                <td><?= h($users[0]["name"]) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Colocations', 'action' => 'view', $colocations->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Colocations', 'action' => 'edit', $colocations->id]) ?>
                    <!--<?= $this->Form->postLink(__('Delete'), ['controller' => 'Colocations', 'action' => 'delete', $colocations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $colocations->id)]) ?>-->
                </td>
            </tr>
            <?php endforeach; ?>
            
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Racks') ?></h4>
        <?php if (!empty($location->racks)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Free') ?></th>
                <th scope="col"><?= __('Location Name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($location->racks as $racks): ?>
<?php 
                $locid=$racks->location_id;

                $locations=$loc->find();

        $locations->select(['Locations.name'])
    ->distinct(['Locations.name'])->where(['Locations.id'=>$locid]);
    $locations=$locations->toArray();
    ?>
            <tr>
                <td><?= h($racks->id) ?></td>
                <td><?= $this->Html->link($racks->name, ['controller' => 'Racks', 'action' => 'view', $racks->id]) ; ?></td>
                <td><?= h($racks->free) ?></td>
                <td><?= h($locations[0]["name"]) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Racks', 'action' => 'view', $racks->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Racks', 'action' => 'edit', $racks->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Racks', 'action' => 'delete', $racks->id], ['confirm' => __('Are you sure you want to delete # {0}?', $racks->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Shelfs') ?></h4>
        <?php if (!empty($location->shelfs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Number') ?></th>
                <th scope="col"><?= __('HU') ?></th>
                <th scope="col"><?= __('Free') ?></th>
                <th scope="col"><?= __('Location Name') ?></th>
                <th scope="col"><?= __('Rack Name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($location->shelfs as $shelfs): ?>

            <?php 
                //Location,Rack and Shelf ids are replaced with their respective names
                
                $rackid=$shelfs->rack_id;

            
    $racks=$rack->find();

        $racks->select(['Racks.name'])
    ->distinct(['Racks.name'])->where(['Racks.id'=>$rackid]);
    $racks=$racks->toArray();
    $locid=$shelfs->location_id;

                $locations=$loc->find();

        $locations->select(['Locations.name'])
    ->distinct(['Locations.name'])->where(['Locations.id'=>$locid]);
    $locations=$locations->toArray();

                ?>
            <tr>
                <td><?= h($shelfs->id) ?></td>
                <td><?= h($shelfs->number) ?></td>
                <td><?= h($shelfs->he) ?></td>
                <td><?= h($shelfs->free) ?></td>
                <td><?= h($locations[0]["name"]) ?></td>
                <td><?= h($racks[0]["name"]) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Shelfs', 'action' => 'view', $shelfs->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Shelfs', 'action' => 'edit', $shelfs->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Shelfs', 'action' => 'delete', $shelfs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shelfs->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
