<?php
ob_start();
include 'header.php';

?>

<<!-- Hero Section -->
<div class="container-fluid py-5 my-5 hero-section" style="background-image: url('path_to_your_image.jpg'); background-size: cover; background-position: center; position: relative; overflow: hidden;">
<div class="overlay position-absolute top-0 left-0 w-100 h-100" style="background-color: rgba(255, 255, 255, 0.3); z-index: 1;"></div>

  
  <div class="d-flex align-items-center justify-content-center text-center text-white position-relative z-index-2">
    <div class="hero-content animated fadeInUp" style="opacity: 0;">
      <h1 class="display-3 fw-bold mb-4" style="animation: fadeIn 1s ease-in-out forwards;">Welcome to BlankShop</h1>
      <p class="lead mb-4" style="animation: fadeIn 1.5s ease-in-out forwards;">Ayo Temukan Barang atau Produk Kesukaanmu Sekarang !!</p>
      <a href="#products" class="btn btn-primary btn-lg btn-hover-zoom">Beli Sekarang</a>
    </div>
  </div>
</div>

<!-- Add this for animation style -->
<style>
  /* Fade-in animations */
  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: translateY(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  /* Button Hover Zoom Animation */
  .btn-hover-zoom {
    position: relative;
    overflow: hidden;
    transition: transform 0.3s ease-in-out;
  }

  .btn-hover-zoom:hover {
    transform: scale(1.1);
  }

  /* Animations for hero content */
  .animated.fadeInUp {
    animation: fadeInUp 1.5s ease-out forwards;
  }

  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(50px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
</style>


<!-- Main content area -->
<div class="container my-5" id="products">
  <?php include './template/_products.php'; ?>
</div>

<?php
include 'footer.php';
?>