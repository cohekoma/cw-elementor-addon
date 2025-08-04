jQuery(document).ready(function($){
    function fetchProducts(sort = '') {
        $('.cwea-loading').show();
        $('.cwea-gallery-grid').empty();

        $.ajax({
            url: cwea_ajax_obj.api_url,
            method: 'GET',
            success: function(response) {
                $('.cwea-loading').hide();
                let products = response.products || response;
                
                if(sort === 'price_asc') {
                    products.sort((a,b) => a.price - b.price);
                } else if(sort === 'price_desc') {
                    products.sort((a,b) => b.price - a.price);
                }

                let html = '';
                $.each(products, function(index, product){
                    html += `
                        <div class="cwea-product-item">
                            <img src="${product.thumbnail}" alt="${product.title}">
                            <h3>${product.title}</h3>
                            <p>$${product.price}</p>
                            <p class="cwea-category">${product.category}</p>
                            <a class="cwea-view-details" href="/product/${product.id}">View Details</a>
                        </div>
                    `;
                });
                $('.cwea-gallery-grid').html(html);
            },
            error: function() {
                $('.cwea-loading').hide();
                $('.cwea-gallery-grid').html('<p>Failed to load products.</p>');
            }
        });
    }

    fetchProducts();

    $('#cwea-sort').on('change', function(){
        fetchProducts($(this).val());
    });
});
