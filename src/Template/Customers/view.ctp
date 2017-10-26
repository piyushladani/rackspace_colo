<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Customer'), ['action' => 'edit', $customer->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Customer'), ['action' => 'delete', $customer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customer->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Customers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Colocations'), ['controller' => 'Colocations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Colocation'), ['controller' => 'Colocations', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="customers view large-9 medium-8 columns content">
    <h3><?= h($customer->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($customer->name) ?></td>
        </tr>
      
        <tr>
            <th scope="row"><?= __('Number') ?></th>
            <td><?= h($customer->number) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Colocations') ?></h4>
        <?php if (!empty($customer->colocations)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Location') ?></th>
                <th scope="col"><?= __('Rack') ?></th>
                <th scope="col"><?= __('Shelf Id') ?></th>
                <th scope="col"><?= __('He') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
      
            <?php foreach ($customer->colocations as $colocations): ?>
            <tr>

                <td><?= h($colocations->id) ?></td>
                

                
                <?php 
                //Location,Rack and Shelf ids are replaced with their respective names
                $locid=$colocations->location_id;
                $rackid=$colocations->rack_id;
                $shelfid=$colocations->shelf_id;

                $locations=$loc->find();

        $locations->select(['Locations.name'])
    ->distinct(['Locations.name'])->where(['Locations.id'=>$locid]);
    $locations=$locations->toArray();
    
    $racks=$rack->find();

        $racks->select(['Racks.name'])
    ->distinct(['Racks.name'])->where(['Racks.id'=>$rackid]);
    $racks=$racks->toArray();

    $shelfs=$shelf->find();

    $shelfs->select(['Shelfs.number'])
    ->distinct(['Shelfs.number'])->where(['Shelfs.id'=>$shelfid]);
    $shelfs=$shelfs->toArray();
    #var_dump($group);die();

                ?>
                <td><?= h($locations[0]["name"]) ?></td>
                <td><?= h($racks[0]["name"]) ?></td>
                <td><?= h($shelfs[0]["number"]) ?></td>
                <td><?= h($colocations->he) ?></td>
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
