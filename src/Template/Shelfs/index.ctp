<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Shelf[]|\Cake\Collection\CollectionInterface $shelfs
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Shelf'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Racks'), ['controller' => 'Racks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Rack'), ['controller' => 'Racks', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Colocations'), ['controller' => 'Colocations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Colocation'), ['controller' => 'Colocations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="shelfs index large-9 medium-8 columns content">
    <h3><?= __('Shelfs') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('he') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rack_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('colocation_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($shelfs as $shelf): ?>
            <tr>
                <td><?= $this->Number->format($shelf->id) ?></td>
                <td><?= $this->Number->format($shelf->he) ?></td>
                <td><?= $shelf->has('rack') ? $this->Html->link($shelf->rack->name, ['controller' => 'Racks', 'action' => 'view', $shelf->rack->id]) : '' ?></td>
                <td><?= $shelf->has('colocation') ? $this->Html->link($shelf->colocation->id, ['controller' => 'Colocations', 'action' => 'view', $shelf->colocation->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $shelf->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $shelf->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $shelf->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shelf->id)]) ?>
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
