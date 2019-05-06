            <div id="item-container">
                <?php foreach ($products as $product): ?>
                <section id="<?= $product->product_name ?>" class="item-card">
                    <?= $this->Html->image('http://placekitten.com/300/256', ['alt' => 'Should have a desc', 'class' => 'pure-img']); ?>
                    <div class="card-body">
                    <h5 class="heading product-title"><?= h($product->product_name) ?></h5>
                    <?= $this->Html->link(__('More Info'), ['action' => 'show', $product->id]) ?>
                    <h6><?= h($product->product_price) ?> €</i></h6>
                    <button type="button" class="pure-button" onclick="addToCart(<?= $product->id ?>, 1 )">Add to Cart</button>
                    </div>
                </section>
                <?php endforeach; ?>
            </div>
            