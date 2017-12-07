<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Colocation $colocation
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    

    <ul class="side-nav">
    <li class="heading"><?=__('Colocations') ?></li>
    <ul>
        
        <li><?= $this->Form->postLink(__('Delete Colocation'), ['action' => 'delete', $colocation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $colocation->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Colocations'), ['controller' => 'Colocations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Assign Colocation'), ['controller' => 'Colocations', 'action' => 'add']) ?></li>
    </ul>

    
    <li class="heading"><?=__('Customers') ?></li>
    <ul>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Add New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
        
    </ul>

     <li class="heading"><?=__('Locations') ?></li>
    <ul>
        <li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?></li>
        
    </ul>
    
</ul>

    
</nav>
<div class="colocations view large-9 medium-8 columns content">
    <h3><?= h($colocation->customer->name.' ('.$colocation->customer->number.')') ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Customer') ?></th>
            <td><?= $colocation->has('customer') ? $this->Html->link($colocation->customer->name, ['controller' => 'Customers', 'action' => 'view', $colocation->customer->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Location') ?></th>
            <td><?= $colocation->has('location') ? $this->Html->link($colocation->location->name, ['controller' => 'Locations', 'action' => 'view', $colocation->location->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rack') ?></th>
            <td><?= $colocation->has('rack') ? $this->Html->link($colocation->rack->name, ['controller' => 'Racks', 'action' => 'view', $colocation->rack->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shelf') ?></th>
            <td><?= $colocation->has('shelf') ? $this->Html->link($colocation->shelf->number, ['controller' => 'Shelfs', 'action' => 'view', $colocation->shelf->id]) : '' ?></td>
        </tr>
         <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $colocation->has('user') ? $this->Html->link($colocation->user->name, ['controller' => 'Users', 'action' => 'view', $colocation->user->id]) : '' ?></td>
        </tr>
       

        <tr>
            <th scope="row"><?= __('HU') ?></th>
            <td><?= $this->Number->format($colocation->he) ?></td>
        </tr>
    </table>
</div>
