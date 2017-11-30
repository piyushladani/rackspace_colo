<?php
/**
 * @var \App\View\AppView $this
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    
     <ul class="side-nav">
       
       
        <li class="heading"><?=__('Demarcation') ?></li>
        <ul>
        <li><?= $this->Html->link(__('List Locations'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('New Rack'), ['controller' => 'Racks', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('New Shelf'), ['controller' => 'Shelfs', 'action' => 'add']) ?></li>
        </ul>
         <li class="heading"><?=__('Colocations') ?></li>
        <ul>
        <li><?= $this->Html->link(__('List Customers within Colocation'), ['controller' => 'Colocations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Assign Colocation'), ['controller' => 'Colocations', 'action' => 'add']) ?></li>
        </ul>
        <li class="heading"><?=$this->Html->link(__('Administration'), ['controller' => 'Users', 'action' => 'index']) ?></li>

    </ul>
</nav>
<div class="locations form large-9 medium-8 columns content">
    <?= $this->Form->create($location) ?>
    <fieldset>
        <legend><?= __('Add Location') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('address');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
