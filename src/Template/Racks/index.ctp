<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rack[]|\Cake\Collection\CollectionInterface $racks
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    
     <ul class="side-nav">
        <li class="heading"><?=__('Location') ?></li>
         <ul>
        <li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?></li>
        </ul>
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
<div class="racks index large-9 medium-8 columns content">
    <h3><?= __('Racks') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                
                <th scope="col"><?= $this->Paginator->sort('location_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($racks as $rack): ?>
            <tr>
                
                <td><?= h($rack->name) ?></td>
               
                <td><?= $rack->has('location') ? $this->Html->link($rack->location->name, ['controller' => 'Locations', 'action' => 'view', $rack->location->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $rack->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $rack->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $rack->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rack->id)]) ?>
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
