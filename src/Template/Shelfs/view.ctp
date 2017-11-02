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
        
        <li><?= $this->Html->link(__('List Shelfs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('List Colocations'), ['controller' => 'Colocations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('List Racks'), ['controller' => 'Racks', 'action' => 'index']) ?> </li>
        <!-- 
        <li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Shelf'), ['action' => 'delete', $shelf->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shelf->id)]) ?> </li>
        <li><?= $this->Html->link(__('New Shelf'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Racks'), ['controller' => 'Racks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rack'), ['controller' => 'Racks', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Colocations'), ['controller' => 'Colocations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Colocation'), ['controller' => 'Colocations', 'action' => 'add']) ?> </li>
    -->
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
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Customer Id') ?></th>
                <th scope="col"><?= __('Location Id') ?></th>
                <th scope="col"><?= __('Rack Id') ?></th>
                <th scope="col"><?= __('Shelf Id') ?></th>
                <th scope="col"><?= __('HU') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($shelf->colocations as $colocations): ?>
            <tr>
                <td><?= h($colocations->id) ?></td>
                <td><?= h($colocations->customer_id) ?></td>
                <td><?= h($colocations->location_id) ?></td>
                <td><?= h($colocations->rack_id) ?></td>
                <td><?= h($colocations->shelf_id) ?></td>
                <td><?= h($colocations->he) ?></td>
                <td><?= h($colocations->user_id) ?></td>
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
