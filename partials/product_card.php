<div class="col-md-6 col-lg-4 col-xl-3">
    <div class="rounded position-relative fruite-item">
        <div class="fruite-img ratio ratio-1x1 border border-secondary rounded-top overflow-hidden">
            <img src="/<?= htmlspecialchars($product['image_url']) ?>" class="img-fluid w-100 rounded-top" alt="<?php echo htmlspecialchars($product['name'])?>">
        </div>
        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
            <h4><?php echo htmlspecialchars($product['name'])?></h4>
            <p><?php echo htmlspecialchars($product['description'])?></p>
            <div class="d-flex justify-content-between flex-lg-wrap">
                <p class="text-dark fs-5 fw-bold mb-0">
                    <?php echo number_format($product['price'], 0, ',', '.') ?> VNĐ
                </p>
                 <form action="add-to-cart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                </form>
            </div>
        </div>
    </div>
</div>