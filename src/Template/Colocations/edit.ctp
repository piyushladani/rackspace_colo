<?php
/**
 * @var \App\View\AppView $this
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $colocation->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $colocation->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Colocations'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        
        <li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?></li>
        <!-- 
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Racks'), ['controller' => 'Racks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Rack'), ['controller' => 'Racks', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Shelfs'), ['controller' => 'Shelfs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Shelf'), ['controller' => 'Shelfs', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    -->
    </ul>
</nav>
<?php
    echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');
    echo $this->Html->script('scripts');
?>
<div class="colocations form large-9 medium-8 columns content">
    <?= $this->Form->create($colocation) ?>
    <fieldset>
        <legend><?= __('Edit Colocation') ?></legend>
        <?php
            echo $this->Form->control('customer_id', ['options' => $customers]);
            echo $this->Form->control('location_id', ['options' => $locations,'onchange'=>'selectRack()','id'=>'loc','empty' => '-Select Location-']);
            echo $this->Form->control('rack_id',['options' => $racks,'onchange'=>'selectShelf()','id'=>'rac','empty' => '-Select Rack-']);
            echo $this->Form->control('shelf_id',['options' => $shelfs,'id'=>'shelf','empty' => '-Select Shelf-']);
            echo $this->Form->control('he');
            echo $this->Form->control('user', ['value' => $users,'readonly' => 'readonly']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
