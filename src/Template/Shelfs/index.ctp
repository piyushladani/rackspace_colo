<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Shelf[]|\Cake\Collection\CollectionInterface $shelfs
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
<div class="shelfs index large-9 medium-8 columns content">
    <h3><?= __('Shelfs') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                
                <th scope="col"><?= $this->Paginator->sort('number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('he','HU') ?></th>
                <th scope="col"><?= $this->Paginator->sort('free') ?></th>
                <th scope="col"><?= $this->Paginator->sort('location_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rack_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($shelfs as $shelf): ?>
            <tr>
                
                <td><?= $this->Number->format($shelf->number) ?></td>
                <td><?= $this->Number->format($shelf->he) ?></td>
                <td><?= h($shelf->free) ?></td>
                <td><?= $shelf->has('location') ? $this->Html->link($shelf->location->name, ['controller' => 'Locations', 'action' => 'view', $shelf->location->id]) : '' ?></td>
                <td><?= $shelf->has('rack') ? $this->Html->link($shelf->rack->name, ['controller' => 'Racks', 'action' => 'view', $shelf->rack->id]) : '' ?></td>
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
