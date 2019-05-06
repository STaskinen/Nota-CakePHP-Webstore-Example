<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Keyword $keyword
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Keyword'), ['action' => 'edit', $keyword->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Keyword'), ['action' => 'delete', $keyword->id], ['confirm' => __('Are you sure you want to delete # {0}?', $keyword->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Keywords'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Keyword'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="keywords view large-9 medium-8 columns content">
    <h3><?= h($keyword->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($keyword->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($keyword->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Products') ?></h4>
        <?php if (!empty($keyword->products)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Product Amount') ?></th>
                <th scope="col"><?= __('Product Code') ?></th>
                <th scope="col"><?= __('Product Desc') ?></th>
                <th scope="col"><?= __('Product Name') ?></th>
                <th scope="col"><?= __('Product Points') ?></th>
                <th scope="col"><?= __('Product Price') ?></th>
                <th scope="col"><?= __('Product Producer') ?></th>
                <th scope="col"><?= __('Product Store') ?></th>
                <th scope="col"><?= __('Product Url') ?></th>
                <th scope="col"><?= __('Product Img') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($keyword->products as $products): ?>
            <tr>
                <td><?= h($products->id) ?></td>
                <td><?= h($products->product_amount) ?></td>
                <td><?= h($products->product_code) ?></td>
                <td><?= h($products->product_desc) ?></td>
                <td><?= h($products->product_name) ?></td>
                <td><?= h($products->product_points) ?></td>
                <td><?= h($products->product_price) ?></td>
                <td><?= h($products->product_producer) ?></td>
                <td><?= h($products->product_store) ?></td>
                <td><?= h($products->product_url) ?></td>
                <td><?= h($products->product_img) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Products', 'action' => 'view', $products->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Products', 'action' => 'edit', $products->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Products', 'action' => 'delete', $products->id], ['confirm' => __('Are you sure you want to delete # {0}?', $products->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
