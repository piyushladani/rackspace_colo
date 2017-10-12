<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rack $rack
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Rack'), ['action' => 'edit', $rack->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Rack'), ['action' => 'delete', $rack->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rack->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Racks'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rack'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Shelfs'), ['controller' => 'Shelfs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Shelf'), ['controller' => 'Shelfs', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="racks view large-9 medium-8 columns content">
    <h3><?= h($rack->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($rack->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Location') ?></th>
            <td><?= $rack->has('location') ? $this->Html->link($rack->location->name, ['controller' => 'Locations', 'action' => 'view', $rack->location->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($rack->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Shelfs') ?></h4>
        <?php if (!empty($rack->shelfs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('He') ?></th>
                <th scope="col"><?= __('Rack Id') ?></th>
                <th scope="col"><?= __('Colocation Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($rack->shelfs as $shelfs): ?>
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
