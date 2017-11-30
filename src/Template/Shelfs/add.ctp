<?php
/**
 * @var \App\View\AppView $this
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    
     <ul class="side-nav">
       
       
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
        <li><?= $this->Html->link(__('List Customers within Colocation'), ['controller' => 'Colocations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List all Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        </ul>
       
    </ul>
</nav>
<?php

echo $this->Html->script('scriptshelf');
use Cake\Routing\Router;

?>
<div class="shelfs form large-9 medium-8 columns content">
    <?= $this->Form->create($shelf) ?>
    <fieldset>
        <legend><?= __('Add Shelf') ?></legend>
        <?php
            echo $this->Form->control('number');
            echo $this->Form->control('he');
            echo $this->Form->control('free',['options' =>[ 'yes'=>'yes','no'=>'no']]);
            echo $this->Form->control('location_id', ['options' => $locations,'onchange'=>'selectRack()','id'=>'loc','empty' => '-Select Location-']);
            echo $this->Form->control('rack_id',['options' => $racks,'id'=>'rac','empty' => '-Select Rack-']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
