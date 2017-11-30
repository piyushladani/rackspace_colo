<?php
/**
 * @var \App\View\AppView $this
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
       
       
        <li class="heading"><?=__('Demarcation') ?></li>
        <ul>
        <li><?= $this->Html->link(__('List Racks'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?></li>
         <li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('New Rack'), ['controller' => 'Racks', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('New Shelf'), ['controller' => 'Shelfs', 'action' => 'add']) ?></li>
        </ul>
         <li class="heading"><?=__('Colocations') ?></li>
        <ul>
        <li><?= $this->Html->link(__('List Customers within Colocation'), ['controller' => 'Colocations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Assign Colocation'), ['controller' => 'Colocations', 'action' => 'add']) ?></li>
        </ul>
       
    </ul>
</nav>
<div class="racks form large-9 medium-8 columns content">
    <?= $this->Form->create($rack) ?>
    <fieldset>
        <legend><?= __('Edit Rack') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('location_id', ['options' => $locations]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
