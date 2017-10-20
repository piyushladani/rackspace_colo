<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Customer'), ['action' => 'edit', $customer->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Customer'), ['action' => 'delete', $customer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customer->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Customers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Colocations'), ['controller' => 'Colocations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Colocation'), ['controller' => 'Colocations', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="customers view large-9 medium-8 columns content">
    <h3><?= h($customer->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($customer->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($customer->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Number') ?></th>
            <td><?= h($customer->number) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Colocations') ?></h4>
        <?php if (!empty($customer->colocations)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Customer Id') ?></th>
                <th scope="col"><?= __('Location Id') ?></th>
                <th scope="col"><?= __('Rack Id') ?></th>
                <th scope="col"><?= __('Shelf Id') ?></th>
                <th scope="col"><?= __('He') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($customer->colocations as $colocations): ?>
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
