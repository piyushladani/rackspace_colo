<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Colocation[]|\Cake\Collection\CollectionInterface $colocations
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Colocation'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <!-- <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Racks'), ['controller' => 'Racks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Rack'), ['controller' => 'Racks', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Shelfs'), ['controller' => 'Shelfs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Shelf'), ['controller' => 'Shelfs', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li> -->
    </ul>
</nav>
<div class="colocations index large-9 medium-8 columns content">
    <h3><?= __('Colocations') ?></h3>

    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('customer_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('location_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rack_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shelf_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('he','HU') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($colocations as $colocation): ?>
            <tr>
                <td><?= $this->Number->format($colocation->id) ?></td>
                <td><?= $colocation->has('customer') ? $this->Html->link($colocation->customer->name, ['controller' => 'Customers', 'action' => 'view', $colocation->customer->id]) : '' ?></td>
                <td><?= $colocation->has('location') ? $this->Html->link($colocation->location->name, ['controller' => 'Locations', 'action' => 'view', $colocation->location->id]) : '' ?></td>
                <td><?= $colocation->has('rack') ? $this->Html->link($colocation->rack->name, ['controller' => 'Racks', 'action' => 'view', $colocation->rack->id]) : '' ?></td>
                <td><?= $colocation->has('shelf') ? $this->Html->link($colocation->shelf->number, ['controller' => 'Shelfs', 'action' => 'view', $colocation->shelf->id]) : '' ?></td>
                <td><?= $this->Number->format($colocation->he) ?></td>
                <td><?= $colocation->has('user') ? $this->Html->link($colocation->user->name, ['controller' => 'Users', 'action' => 'view', $colocation->user->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $colocation->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $colocation->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $colocation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $colocation->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
