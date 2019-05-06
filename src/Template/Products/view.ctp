<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Product'), ['action' => 'edit', $product->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Product'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Products'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Keywords'), ['controller' => 'Keywords', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Keyword'), ['controller' => 'Keywords', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="products view large-9 medium-8 columns content">
    <h3><?= h($product->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Product Code') ?></th>
            <td><?= h($product->product_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Name') ?></th>
            <td><?= h($product->product_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Points') ?></th>
            <td><?= h($product->product_points) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Producer') ?></th>
            <td><?= h($product->product_producer) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Store') ?></th>
            <td><?= h($product->product_store) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Url') ?></th>
            <td><?= h($product->product_url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Img') ?></th>
            <td><?= h($product->product_img) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($product->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Amount') ?></th>
            <td><?= $this->Number->format($product->product_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Price') ?></th>
            <td><?= $this->Number->format($product->product_price) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Product Desc') ?></h4>
        <?= $this->Text->autoParagraph(h($product->product_desc)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Keywords') ?></h4>
        <?php if (!empty($product->keywords)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($product->keywords as $keywords): ?>
            <tr>
                <td><?= h($keywords->id) ?></td>
                <td><?= h($keywords->title) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Keywords', 'action' => 'view', $keywords->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Keywords', 'action' => 'edit', $keywords->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Keywords', 'action' => 'delete', $keywords->id], ['confirm' => __('Are you sure you want to delete # {0}?', $keywords->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
