<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product[]|\Cake\Collection\CollectionInterface $products
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Add a Product'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout']) ?></li>
    </ul>
</nav>
<div class="products index large-9 medium-8 columns content">
    <h3><?= __('Products') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_points') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_producer') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_store') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_url') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_img') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $this->Number->format($product->id) ?></td>
                <td><?= $this->Number->format($product->product_amount) ?></td>
                <td><?= h($product->product_code) ?></td>
                <td><?= h($product->product_name) ?></td>
                <td><?= h($product->product_points) ?></td>
                <td><?= $this->Number->format($product->product_price) ?></td>
                <td><?= h($product->product_producer) ?></td>
                <td><?= h($product->product_store) ?></td>
                <td><?= h($product->product_url) ?></td>
                <td><?= h($product->product_img) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $product->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $product->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id)]) ?>
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
