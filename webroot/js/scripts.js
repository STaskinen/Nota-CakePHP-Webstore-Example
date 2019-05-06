var shoppingCart = {
    'items': [
    ],
    'total': 0
};

var Page = 1;
var sorttype = 0;
var searchTerm = '';
var searchType = '';
var sort;
var direction;
var currentTab = "";

function showTabContent(tabId) {
    if (tabId === "category-tab") {
        document.getElementById("cart").style.display = "none";
        document.getElementById("search-def").style.display = "none";
        document.getElementById("product").style.display = "block";
        document.getElementById("category-tab").style.backgroundColor = '#909090';
        document.getElementById("cart-tab").style.backgroundColor = '#c1c1c1';
        document.getElementById("search-tab").style.backgroundColor = '#c1c1c1';
    } else if (tabId === "cart-tab") {
        document.getElementById("product").style.display = "none";
        document.getElementById("search-def").style.display = "none";
        document.getElementById("cart").style.display = "block";
        document.getElementById("cart-tab").style.backgroundColor = '#909090';
        document.getElementById("category-tab").style.backgroundColor = '#c1c1c1';
        document.getElementById("search-tab").style.backgroundColor = '#c1c1c1';
    } else if (tabId === "search-tab") {
        document.getElementById("cart").style.display = "none";
        document.getElementById("product").style.display = "none";
        document.getElementById("search-def").style.display = "block";
        document.getElementById("search-tab").style.backgroundColor = '#909090';
        document.getElementById("cart-tab").style.backgroundColor = '#c1c1c1';
        document.getElementById("category-tab").style.backgroundColor = '#c1c1c1';
    }
}

// Generating shoppingcart
function cartGeneration () {
    shoppingCart.total = 0;
    shoppingCart.items.forEach(item => {
        shoppingCart.total += item.price*item.ammount;
    });
    $('#item-table tbody').empty();
    $('#cart-total').text(Math.round(shoppingCart.total*100)/100 + ' €');
    shoppingCart.items.forEach(item => {
        $('#item-table tbody').append('<tr class="cart-item" id=' + item.id + '></tr>');
        $('#' + item.id).append('<td>' + item.name + '</td>')
        $('#' + item.id).append('<td>' + item.price + ' €</td>')
        $('#' + item.id).append('<td><input value=' + item.ammount + '></input></td>')
        $('#' + item.id).append('<td>' + Math.round(item.price*item.ammount*100)/100 + ' €</td>')
    })

    ;
}



// Add new item to cart
function pushItem(item) {
    shoppingCart.items.push(item);
}


// Function to add items into the shopping cart.
// Takes in product id and ammount added, fetches item info from database through ajax
// and then call the carGeneration function to regenerate the shopping cart.
function addToCart(productId, ammount) {
 var buildURL = "/products/info/" + productId;
 $.ajax({
     url : buildURL,

     success: function( response )
     {
         var newItem = JSON.parse(response);
         newItem.ammount = ammount;
         var i = 0;
         do {
            if (shoppingCart.items[i] != null){
                if (newItem.id == shoppingCart.items[i].id){
                    shoppingCart.items[i].ammount += ammount;
                    break;
                } else if (i == shoppingCart.items.length -1) {
                    pushItem(newItem);
                }
            } else {
                pushItem(newItem);
            }
            i++;
         } while ( i < shoppingCart.items.length );
         cartGeneration();
     }
 })
}

// Function to update the cart
function updateCart() {
    var inputs = [];
    var ids = [];
    var idsToDrop = [];
    // First we get the new ammounts of each item in the cart.
    $('tr.cart-item input').each( 
        function() {
            inputs.push($(this).val());
        }
    );
    // Then we get the ids of the items in the cart
    $('tr.cart-item').each( 
        function() {
            ids.push($(this).attr('id'));
        }
    );
    // Check that we got an equal ammount of item ammounts and item ids.
    if(inputs.length === ids.length) {
        // Then we start updating the item ammounts in the shoppingCart object.
        for (var i = 0; i < ids.length; i++) {
            // Find the same items in the shoppingCart object
                if(shoppingCart.items[i].id == ids[i]) {
                    // Once items are found in the shoppingCart object, 
                    // check if new ammount <= 0 to find out if we should
                    // drop the item from the cart.
                    if(parseInt(inputs[i]) > 0) {
                        // If everything is fine and dandy we update the new ammount into
                        // the shoppingCart object.
                    shoppingCart.items[i].ammount = parseInt(inputs[i]);
                    } else {
                        // If the ammount <= 0 we add it's id to an array to be dropped later.
                        idsToDrop.push(ids[i]);
                        shoppingCart.items[i].ammount = 0;
                    }
                }
        }
        // Here we go through the idsToDrop array and drop the appropriate items from
        // the shoppingCart object.
        for (var i = 0; i < shoppingCart.items.length; i++) {
            idsToDrop.forEach(id => {
                if (shoppingCart.items[i].id === id) {
                    shoppingCart.items.splice(i,1);
                }
            });
        }
        // After all that is done we regenerate the shopping cart.
        cartGeneration();
    }
    
}

function defineSearch() {
    // First we declare that we are on page one for the infinite scroll in Webstore view.
    Page = 1;
    // We get the searchterm inputted by the user.
    searchTerm = $('#query').val();
    // and what kind of sorting if any.
    sorttype = $('#sort-select').val();
    // There most likely is a better way to do this, but this is functional.
    if (sorttype == 1) {
            sort = 'product_name';
            direction = 'asc';
    } else if (sorttype == 2) {
            sort = 'product_name';
            direction = 'desc';
    } else if (sorttype == 3) {
            sort = 'product_price';
            direction = 'asc';
    } else if (sorttype == 4) {
            sort = 'product_price';
            direction = 'desc';
    } else {
            sort = '';
            direction = '';
    }

    // We then go to get the search results via the getSorted() function.
    getSorted(searchTerm,sort,direction);
    }

    function getSorted(searchTerm,sort,direction) {
        // First we define that this is a 'Free' as in freeform search
        // and not a category search.
        searchType = 'Free';
        
        // Then we do an ajax call to the search functions of the ProductsController
        // to get the info the user wants.
            $.ajax({
                url: "/products/search",
                data: {
                    // What are we searching with
                    query: searchTerm,
                    // How should it be sorted
                    sort: sort,
                    // Ascending or descending order
                    direction: direction,
                    // Freeform or category search.
                    searchType: searchType
                },
                success: function (response) {
                    // Once we get the response from the ajax call
                    // we insert it into the webstore view.
                    $('div.products').html(response);
                }
            })
    }

    // Mostly the same as the getSorted() function
    function getCategory(id) {
        // No sorting
        sort = '';
        // No direction
        direction = '';
        // Set page to 1
        Page = 1;
        // Inform that we shall get products with a specific keyword/category.
        searchType = 'Keyword';
        $('.product-type').css('background-color','#909090')
        // Set the clicked category darker to tell the user what category they are in.
        $('#' + id).css('background-color',' #707070')
        $.ajax({
            url: "/products/search",
            data:{
                query: id,
                searchType: searchType
            },
            success: function (response) {
                $('div.products').html(response);
            }
        })
    }