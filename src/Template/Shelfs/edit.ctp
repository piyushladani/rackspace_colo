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
                ['action' => 'delete', $shelf->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $shelf->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Shelfs'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Racks'), ['controller' => 'Racks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Rack'), ['controller' => 'Racks', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Colocations'), ['controller' => 'Colocations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Colocation'), ['controller' => 'Colocations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="shelfs form large-9 medium-8 columns content">
    <?= $this->Form->create($shelf) ?>
    <fieldset>
        <legend><?= __('Edit Shelf') ?></legend>
        <?php
            echo $this->Form->control('he');
            echo $this->Form->control('rack_id', ['options' => $racks]);
            echo $this->Form->control('colocation_id', ['options' => $colocations]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
