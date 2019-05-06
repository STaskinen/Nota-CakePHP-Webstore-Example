<?php 
$selling_points = preg_split("/[\s,]+/", $product->product_points);
?>
<div class="products">
<?= $this->Html->link(__('Back to the store'), ['controller' => 'Products', 'action' => 'webstore']) ?>
<br>
<h1><?= h($product->product_name) ?></h1>
<?= $this->Html->image('http://placekitten.com/300/256', ['alt' => 'Should have a desc', 'class' => 'pure-img']); ?>
<h3>Availability: 
    <?php if ($product->product_store == 0 && $product->product_amount == 0) {
    echo 'Not Available';
} elseif ($product->product_store == 0) {
    echo 'Central Storage';
} else {
    echo 'In Store';
}?>
</h3>
<h3>Price: <?= h($product->product_price) ?></h3>
<h3>Features:</h3>
<ul>
<?php foreach ($selling_points as $selling_point): ?>
    <li><?= h($selling_point) ?></li>
<?php endforeach; ?>
</ul>
<div>
    <h3>Product Description:</h3>
    <p> <?= h($product->product_desc) ?>
    </p>
</div>
<h3>Product Maker: <?= h($product->product_producer) ?></h3>
<h3>Product Code: <?= h($product->product_code) ?></h3>
<?= $this->Html->link('Additional Info', $product->product_url) ?>
</div>
