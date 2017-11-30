<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Shelf $shelf
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
     <ul class="side-nav">
       <li><?= $this->Form->postLink(__('Delete this shelf'), ['action' => 'delete', $shelf->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shelf->id)]) ?> </li>
       
        <li class="heading"><?=__('Demarcation') ?></li>
        <ul>
        <li><?= $this->Html->link(__('List Shelfs'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Shelf'), ['controller' => 'Shelfs', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?></li>
         <li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?></li>
         <li><?= $this->Html->link(__('List Racks'), ['controller' => 'Racks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Rack'), ['controller' => 'Racks', 'action' => 'add']) ?></li>
        
        </ul>
         <li class="heading"><?=__('Colocations') ?></li>
        <ul>
        <li><?= $this->Html->link(__('Assign Colocation'), ['controller' => 'Colocations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Customers within Colocation'), ['controller' => 'Colocations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List all Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        </ul>
       
    </ul>
</nav>
<div class="shelfs view large-9 medium-8 columns content">
    <h3><?= h($shelf->number) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Free') ?></th>
            <td><?= h($shelf->free) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Location') ?></th>
            <td><?= $shelf->has('location') ? $this->Html->link($shelf->location->name, ['controller' => 'Locations', 'action' => 'view', $shelf->location->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rack') ?></th>
            <td><?= $shelf->has('rack') ? $this->Html->link($shelf->rack->name, ['controller' => 'Racks', 'action' => 'view', $shelf->rack->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($shelf->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Number') ?></th>
            <td><?= $this->Number->format($shelf->number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('HU') ?></th>
            <td><?= $this->Number->format($shelf->he) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Colocations') ?></h4>
        <?php if (!empty($shelf->colocations)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                
                <th scope="col"><?= __('Customer Name') ?></th>
                <th scope="col"><?= __('Customer Number') ?></th>
                <th scope="col"><?= __('Location ') ?></th>
                <th scope="col"><?= __('Rack ') ?></th>
                <th scope="col"><?= __('HU') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($shelf->colocations as $colocations): ?>

            <?php 
                //Location,Rack and Shelf ids are replaced with their respective names
               $locid=$colocations->location_id;
               $rackid=$colocations->rack_id;
               $shelfid=$colocations->shelf_id;
               $customerid=$colocations->customer_id;
               $userid=$colocations->user_id;

               $customers=$customer->find();

               $customers->select(['Customers.name'])
               ->distinct(['Customers.number'])->where(['Customers.id'=>$customerid]);
               $customersname=$customers->toArray();

               $customers->select(['Customers.number'])
               ->distinct(['Customers.number'])->where(['Customers.id'=>$customerid]);
               $customersnumber=$customers->toArray();

               $locations=$loc->find();

               $locations->select(['Locations.name'])
               ->distinct(['Locations.name'])->where(['Locations.id'=>$locid]);
               $locations=$locations->toArray();

               $racks=$rack->find();

               $racks->select(['Racks.name'])
               ->distinct(['Racks.name'])->where(['Racks.id'=>$rackid]);
               $racks=$racks->toArray();

               $users=$user->find();

               $users->select(['Users.name'])
               ->distinct(['Users.name'])->where(['Users.id'=>$userid]);
               $users=$users->toArray();


               ?>
            <tr>
               
                <td><?= $this->Html->link(h($customersname[0]["name"]), ['controller' => 'Customers', 'action' => 'view', $customerid]) ; ?></td>
                <td><?= h($customersnumber[0]["number"]) ?></td>
                <td><?= h($locations[0]["name"]) ?></td>
                <td><?= h($racks[0]["name"]) ?></td>
                <td><?= h($colocations->he) ?></td>
                <td><?= h($users[0]["name"])  ?></td>
                
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
</div>
