<div class="pure-g">
    <nav class="pure-u-1-4" id="product-sidebar">
        <nav id="shop-tab-nav" >
            <div id="category-tab" class="pure-u-1-3 tab" onclick="showTabContent(this.id)">
                <h5 class="heading">Categories</h5>
            </div>
            <div id="search-tab" class="pure-u-1-3 tab" onclick="showTabContent(this.id)">
                <h5 class="heading">Search</h5>
            </div>
            <div id="cart-tab" class="pure-u-1-3 tab" onclick="showTabContent(this.id)">
                <h5 class="heading">Cart</h5>
            </div>

        </nav>

        <!-- Product Categories view -->
        <div id="product" class="product-categories">
            <h5 class="heading product-type" id="all" onclick="getCategory(this.id)">
            ALL
            </h5>
            <?php foreach ($keywords as $keyword): ?>
            <h5 class="heading product-type" id="<?= h($keyword->title) ?>" onclick="getCategory(this.id)">
            <?= h($keyword->title); ?>
            </h5>
            <?php endforeach; ?>
        </div>

        <!-- Search & search definitions view -->
        <div id="search-def">
        <?= $this->Form->control('query', ['default' => $this->request->getQuery('query')]); ?>
        <p>Sort By</p>
        <?= $this->Form->select('sort', ['None', 'Name, Asc', 'Name, Desc', 'Price, Asc', 'Price, Desc', ], ['id' => 'sort-select']); ?>
        <br><br>
        <button class="pure-button" onclick="defineSearch()"><i class="fas fa-search"></i></button>
        </div>

        <!-- Shopping Cart view -->
        <div id="cart" class="product-categories">
            <table id="item-table" class="pure-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Ammount</th>
                        <th>Total</th>
                    </tr>
                </thead>
                
                <tbody>
                </tbody>
            <div class="pure-g">
                <div class="pure-u-2-5">
                    <h6>CART TOTAL</h6>
                </div>
                <div class="pure-u-2-5">
                    <h6 id="cart-total"></h6>
                </div>
                <div class="pure-u-1-5">
                    <button class="pure-button" onclick="updateCart()"><i class="fas fa-sync"></i></button> 
                </div>
            </div>
            </table>
        </div>
    </nav>

    <!-- Store item cards -->
    <div class="products index pure-u-3-4">
    </div>
</div>


<div id='admin-tools'>
    <?= $this->Html->link(__(''), ['action' => 'index'], ['id' => 'admin-logo']) ?>
</div>

<div id="loading">
    <?= $this->Html->image('loading.svg', ['alt' => 'loading']); ?>
</div>

<script>
$('#admin-logo').html('<i class="fas fa-key"></i>')
getCategory('all');
cartGeneration();

// Infinite Scroll found @ https://www.sitepoint.com/jquery-infinite-scrolling-demos/ 
$( document ).ready(function() {
        var win = $(window);
        // Each time the user scrolls
        win.scroll(function() {
            // End of the document reached?
            if ($(document).height() - win.height() == win.scrollTop()) {
                Page++;
            $('#loading').show();
                $.ajax({
                    url: '/products/search',
                    data: {
                        // These variables can be found in the scrips.js file
                        query: searchTerm,
                        sort: sort,
                        direction: direction,
                        searchType: searchType,
                        page: Page
                    },
                    success: function(html) {
                        $('#item-container').append(html);
					$('#loading').hide();
                    },
                    error: function() {
					$('#loading').hide();
                    }
                });
            }
        });
    });

</script>