<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rack $rack
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        
        <li><?= $this->Form->postLink(__('Delete Rack'), ['action' => 'delete', $rack->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rack->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Racks'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('List Colocations'), ['controller' => 'Colocations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('List Shelfs'), ['controller' => 'Shelfs', 'action' => 'index']) ?> </li>
        <!-- 
        <li><?= $this->Html->link(__('Edit Rack'), ['action' => 'edit', $rack->id]) ?> </li>
        <li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('New Rack'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('New Colocation'), ['controller' => 'Colocations', 'action' => 'add']) ?> </li>
        
        <li><?= $this->Html->link(__('New Shelf'), ['controller' => 'Shelfs', 'action' => 'add']) ?> </li>
    -->
    </ul>
</nav>
<div class="racks view large-9 medium-8 columns content">
    <h3><?= h($rack->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($rack->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Free') ?></th>
            <td><?= h($rack->free) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Location') ?></th>
            <td><?= $rack->has('location') ? $this->Html->link($rack->location->name, ['controller' => 'Locations', 'action' => 'view', $rack->location->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($rack->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Colocations') ?></h4>
        <?php if (!empty($rack->colocations)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Customer Name') ?></th>
                <th scope="col"><?= __('Location Id') ?></th>
                
                <th scope="col"><?= __('Shelf Id') ?></th>
                <th scope="col"><?= __('HU') ?></th>
                <th scope="col"><?= __('User') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($rack->colocations as $colocations): ?>

                 <?php 
                //Location,Rack and Shelf ids are replaced with their respective names
                $locid=$colocations->location_id;
                $rackid=$colocations->rack_id;
                $shelfid=$colocations->shelf_id;
                $customerid=$colocations->customer_id;

                $customers=$customer->find();

    $customers->select(['Customers.name'])
    ->distinct(['Customers.number'])->where(['Customers.id'=>$customerid]);
    $customers=$customers->toArray();

                $locations=$loc->find();

        $locations->select(['Locations.name'])
    ->distinct(['Locations.name'])->where(['Locations.id'=>$locid]);
    $locations=$locations->toArray();
    
    $shelfs=$shelf->find();

    $shelfs->select(['Shelfs.number'])
    ->distinct(['Shelfs.number'])->where(['Shelfs.id'=>$shelfid]);
    $shelfs=$shelfs->toArray();
    #var_dump($group);die();

                ?>

            <tr>
                <td><?= h($colocations->id) ?></td>
                <td><?= h($customers[0]["name"]) ?></td>
                <td><?= h($locations[0]["name"]) ?></td>
                <td><?= h($shelfs[0]["number"]) ?></td>
                <td><?= h($colocations->he) ?></td>
                <td><?= h($colocations->user) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Colocations', 'action' => 'view', $colocations->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Colocations', 'action' => 'edit', $colocations->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Colocations', 'action' => 'delete', $colocations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $colocations->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>


    </div>
    <div class="related">
        <h4><?= __('Related Shelfs') ?></h4>
        <?php if (!empty($rack->shelfs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Number') ?></th>
                <th scope="col"><?= __('He') ?></th>
                <th scope="col"><?= __('Location Id') ?></th>
                <th scope="col"><?= __('Rack Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($rack->shelfs as $shelfs): ?>
            <tr>
                <td><?= h($shelfs->id) ?></td>
                <td><?= h($shelfs->number) ?></td>
                <td><?= h($shelfs->he) ?></td>
                <td><?= h($shelfs->location_id) ?></td>
                <td><?= h($shelfs->rack_id) ?></td>
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
