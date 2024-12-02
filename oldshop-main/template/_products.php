<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $product_id = $_POST['product_id'];
  $quantity = $_POST['quantity'];
  $user_id = $_SESSION['user_id'];

  $data = [
    'product_id' => $product_id,
    'user_id' => $user_id,
    'quantity' => $quantity
  ];

  if (addToCart($data)) {
    echo "
    <script>
        if (confirm('Product berhasil ditambahkan ke cart.\nProceed to cart?')) {
          window.location.href = 'cart.php';
        } else {
          window.location.href = '/';
        }
    </script>
    ";
  } else {
    echo "
    <script>
        alert('Product sudah ada di cart');
        window.location.href = '/';
    </script>
    ";
  }
}
?>

<h1 class="mb-4 text-center">Produk</h1>
<div class="row">
  <?php $i = 1;
  if ($products):
    foreach ($products as $row): ?>
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-lg rounded-4 transition-transform transform-hover">
          <div class="card-img-container overflow-hidden rounded-top">
            <img src="assets/<?= $row['image'] ?>" class="card-img-top img-1-1 transition-transform hover-scale" alt="Product Image 1"
              onerror="this.src='https://via.placeholder.com/150'">
          </div>
          <div class="card-body d-flex flex-column">
            <h5 class="card-title text-dark font-weight-bold">
              <a href="/detail.php?id=<?= $row['id'] ?>" class="text-dark"><?= $row['name'] ?></a>
            </h5>
            <p class="card-text text-muted"><?= excerpt($row['description']) ?></p>
            <p class="card-text text-primary"><strong>Rp. <?= number_format($row['price']) ?></strong></p>
            <div class="mt-auto d-flex flex-column gap-2">
              <!-- Form to add product to cart -->
              <form action="" method="post" class="d-flex flex-column gap-3">
                <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                <div class="d-flex gap-2 align-items-center">
                  <label for="quantity" class="font-weight-semibold">Jumlah:</label>
                  <div class="input-group">
                    <button type="button" class="btn btn-outline-secondary decrement" onclick="decrement(<?= $row['id'] ?>)">-</button>
                    <input type="text" name="quantity" id="quantity-<?= $row['id'] ?>" class="form-control text-center" value="1" readonly>
                    <button type="button" class="btn btn-outline-secondary increment" onclick="increment(<?= $row['id'] ?>, <?= $row['stock'] ?>)">+</button>
                  </div>
                </div>
                <?php if (isset($_SESSION['login'])): ?>
                  <?php if ($row['stock'] > 1): ?>
                    <button type="submit" class="btn btn-primary hover-zoom mt-2">Buy Now</button>
                  <?php else: ?>
                    <button class="btn btn-danger disabled mt-2">Not Available</button>
                  <?php endif; ?>
                <?php endif; ?>
              </form>
              <span class="text-secondary fs-6">Stock: <?= $row['stock'] ?></span>
              <?php if (isAdmin()): ?>
                <div class="d-flex gap-2 mt-3">
                  <a class="btn btn-success" href="/product/edit.php?id=<?= $row['id'] ?>">Edit</a>
                  <a class="btn btn-danger" href="/product/remove.php?id=<?= $row['id'] ?>">Remove</a>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <?php $i++ ?>
    <?php endforeach;
  else: ?>
    <div class="container mt-5 text-center">
      <p>Produk Kosong nihh!.</p>
      <a href="/" class="btn btn-secondary">Kembali ke halaman utama</a>
    </div>
  <?php endif; ?>
</div>

<script>
  function increment(id, max) {
    const quantityField = document.getElementById('quantity-' + id);
    let currentValue = parseInt(quantityField.value);
    if (currentValue < max) {
      quantityField.value = currentValue + 1;
    }
  }

  function decrement(id) {
    const quantityField = document.getElementById('quantity-' + id);
    let currentValue = parseInt(quantityField.value);
    if (currentValue > 1) {
      quantityField.value = currentValue - 1;
    }
  }
</script>

<style>
  .btn-outline-secondary {
    border-radius: 50%;
    width: 40px;
    height: 40px;
    font-size: 1.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
  }

  .btn-outline-secondary:hover {
    background-color: #f7f7f7;
    transform: scale(1.1);
  }

  .form-control {
    width: 50px;
    font-size: 1rem;
    text-align: center;
    font-weight: bold;
    border: none;
  }

  .input-group {
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .btn-primary {
    background-color: #8A2BE2;
    border-color: #8A2BE2;
    border-radius: 8px;
    padding: 12px;
    transition: all 0.3s ease;
  }

  .btn-primary:hover {
    background-color: #6a1d9b;
    border-color: #6a1d9b;
  }

  .btn-danger.disabled {
    background-color: #e0e0e0;
    border-color: #d0d0d0;
  }

  .btn-success, .btn-danger {
    border-radius: 8px;
    transition: all 0.3s ease;
  }

  .card {
    border: 1px solid #ddd;
    border-radius: 15px;
    background-color: #fff;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  }

  .transition-transform:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
  }

  .hover-scale:hover {
    transform: scale(1.1);
  }

  .hover-zoom:hover {
    transform: scale(1.05);
  }
</style>
