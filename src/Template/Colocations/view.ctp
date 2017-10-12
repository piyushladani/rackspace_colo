<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Colocation $colocation
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Colocation'), ['action' => 'edit', $colocation->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Colocation'), ['action' => 'delete', $colocation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $colocation->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Colocations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Colocation'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Racks'), ['controller' => 'Racks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rack'), ['controller' => 'Racks', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Shelfs'), ['controller' => 'Shelfs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Shelf'), ['controller' => 'Shelfs', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="colocations view large-9 medium-8 columns content">
    <h3><?= h($colocation->id) ?></h3>
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
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($colocation->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('He') ?></th>
            <td><?= $this->Number->format($colocation->he) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total He') ?></th>
            <td><?= $this->Number->format($colocation->total_he) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Shelfs') ?></h4>
        <?php if (!empty($colocation->shelfs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('He') ?></th>
                <th scope="col"><?= __('Rack Id') ?></th>
                <th scope="col"><?= __('Colocation Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($colocation->shelfs as $shelfs): ?>
            <tr>
                <td><?= h($shelfs->id) ?></td>
                <td><?= h($shelfs->he) ?></td>
                <td><?= h($shelfs->rack_id) ?></td>
                <td><?= h($shelfs->colocation_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Shelfs', 'action' => 'view', $shelfs->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Shelfs', 'action' => 'edit', $shelfs->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Shelfs', 'action' => 'delete', $shelfs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shelfs->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
