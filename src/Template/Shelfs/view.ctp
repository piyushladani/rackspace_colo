<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Shelf $shelf
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Shelf'), ['action' => 'edit', $shelf->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Shelf'), ['action' => 'delete', $shelf->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shelf->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Shelfs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Shelf'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Racks'), ['controller' => 'Racks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rack'), ['controller' => 'Racks', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Colocations'), ['controller' => 'Colocations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Colocation'), ['controller' => 'Colocations', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="shelfs view large-9 medium-8 columns content">
    <h3><?= h($shelf->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Rack') ?></th>
            <td><?= $shelf->has('rack') ? $this->Html->link($shelf->rack->name, ['controller' => 'Racks', 'action' => 'view', $shelf->rack->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Colocation') ?></th>
            <td><?= $shelf->has('colocation') ? $this->Html->link($shelf->colocation->id, ['controller' => 'Colocations', 'action' => 'view', $shelf->colocation->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($shelf->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('He') ?></th>
            <td><?= $this->Number->format($shelf->he) ?></td>
        </tr>
    </table>
</div>
