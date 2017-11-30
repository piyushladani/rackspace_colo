<?php
/**
 * @var \App\View\AppView $this
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
      
        <li class="heading"><?=__('Colocations') ?></li>
        <ul>
        <li><?= $this->Html->link(__('List Customers within Colocation'), ['controller' => 'Colocations', 'action' => 'index']) ?></li>
        
        </ul>
        
        <li class="heading"><?=__('Demarcation') ?></li>
         <ul>
       
        <li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('New Rack'), ['controller' => 'Racks', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('New Shelf'), ['controller' => 'Shelfs', 'action' => 'add']) ?></li>
        </ul>
        
    </ul>
</nav>
<?php

echo $this->Html->script('scripts');
use Cake\Routing\Router;

?>
<div class="colocations form large-9 medium-8 columns content">
    <?= $this->Form->create($colocation) ?>
    <fieldset>
        <legend><?= __('Add Colocation') ?></legend>
        <?php
        echo $this->Form->control('customer', ['type'=>'text','placeholder'=>'Type customer name']);
        echo $this->Form->control('customer_id', ['type'=>'hidden']);
        echo $this->Form->control('location_id', ['options' => $locations,'onchange'=>'selectRack()','id'=>'loc','empty' => '-Select Location-']);
        echo $this->Form->control('rack_id',['options' => $racks,'onchange'=>'selectShelf()','id'=>'rac','empty' => '-Select Rack-']);
        echo $this->Form->control('shelf_id',['options' => $shelfs,'onchange'=>'selectHU()','id'=>'shelf']);
        echo $this->Form->input('he',['readonly' => 'readonly']);
        echo $this->Form->control('user', ['value' => $users,'readonly' => 'readonly']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
<script type="text/javascript">
    $(document).ready(function($){
        $('#customer').autocomplete({

            source:'<?php echo Router::url(array('controller' => 'Customers', 'action' => 'getall')); ?>',
            minLength: 1,
            select: function(event, ui) {
                event.preventDefault();
                $("#customer").val(ui.item.label);
                $("#customer-id").val(ui.item.value);

            },
            focus: function(event, ui) {
                event.preventDefault();
                $("#customer").val(ui.item.label);
            }
        });
    });
</script>