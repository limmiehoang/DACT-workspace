<?php
$page = 'product';
require_once __DIR__ . '/inc/head.php';
require_once __DIR__ . '/inc/nav.php';
?>

    <div class="container">
        <div class="well">
            <h2>Add a product</h2>
            <p><em>(*) This field is required</em></p>
            <?php echo $data['messages']; ?>
            <form id="product-form" class="form-horizontal" method="post" action="/product/addProduct" autocomplete="off">
                <?php include __DIR__ . '/inc/productForm.php' ?>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php
require_once __DIR__ . '/inc/footer.php';