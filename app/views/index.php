<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PRODUCT MANAGEMENT</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #ffffffff;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }
    .page-header {
      margin-bottom: 30px;
    }
    .card {
      border: none;
      border-radius: 12px;
    }
    .table thead {
      background-color: #ffffffff;
      color: #fff;
    }
    .btn-custom {
      border-radius: 8px;
      font-weight: 500;
    }
    .modal-content {
      border-radius: 12px;
    }
    .modal-header {
      border-bottom: none;
    }
    .modal-footer {
      border-top: none;
    }
  </style>
</head>
<body>

<div class="container py-5">
  <!-- Page Header -->
  <div class="page-header text-center">
    <h2 class="fw-bold text-dark">PRODUCT MANAGEMENT</h2>
    <p class="text-muted">Add, Edit, and Manage your Product Records Efficiently.</p>
  </div>

  <!-- Alerts -->
  <div class="mb-3">
    <?php getErrors(); ?>
    <?php getMessage(); ?>
  </div>

  <!-- Add Button -->
  <div class="d-flex justify-content-end mb-3">
    <button class="btn btn-primary btn-custom shadow-sm" data-bs-toggle="modal" data-bs-target="#addModal">
      ADD PRODUCT
    </button>
  </div>

  <!-- Search Form -->
  <form class="mb-3" method="GET" action="">
    <div class="input-group">
      <input type="text" name="search" class="form-control" placeholder="Search products..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
      <button class="btn btn-outline-secondary" type="submit">SEARCH</button>
    </div>
  </form>
  
  <!-- Table Card -->
  <div class="card shadow-sm">
    <div class="card-body p-0">
      <table class="table table-hover align-middle mb-0 text-center">
        <thead>
          <tr>
            <th>PRODUCT NAME</th>
            <th>QUANTITY</th>
            <th>PRICE</th>
            <th>CREATED AT</th>
            <th>UPDATED AT</th>
            <th>ACTIONS</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Simple search
          $search = isset($_GET['search']) ? trim($_GET['search']) : '';
          $filtered = [];
          if (!empty($search) && !empty($getAll)) {
              foreach ($getAll as $product) {
                  if (stripos($product['product_name'], $search) !== false) {
                      $filtered[] = $product;
                  }
              }
          } else {
              $filtered = $getAll;
          }

          // Pagination
          $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
          $perPage = 5;
          $total = count($filtered);
          $totalPages = ceil($total / $perPage);
          $start = ($page - 1) * $perPage;
          $products = array_slice($filtered, $start, $perPage);

          if(!empty($products)): ?>
            <?php foreach($products as $product): ?>
              <tr>
                <td><?= htmlspecialchars($product['product_name']); ?></td>
                <td><?= htmlspecialchars($product['quantity']); ?></td>
                <td>₱<?= htmlspecialchars($product['Price']); ?></td>
                <td><?= htmlspecialchars($product['created_at']); ?></td>
                <td><?= htmlspecialchars($product['updated_at']); ?></td>
                <td>
                  <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#editModal<?= $product['id']; ?>">Edit</button>
                  <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $product['id']; ?>">Delete</button>
                </td>
              </tr>

              <!-- Edit Modal -->
              <div class="modal fade" id="editModal<?= $product['id']; ?>" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <form action="/update-product/<?= $product['id']; ?>" method="POST">
                      <div class="modal-header bg-primary text-white rounded-top">
                        <h5 class="modal-title">EDIT PRODUCT</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <input type="hidden" name="id" value="<?= $product['id']; ?>">
                        <div class="mb-3">
                          <label class="form-label">PRODUCT</label>
                          <input type="text" name="product_name" class="form-control" value="<?= $product['product_name']; ?>" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Quantity</label>
                          <input type="number" name="quantity" class="form-control" value="<?= $product['quantity']; ?>" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">PRICE</label>
                          <input type="number" name="Price" class="form-control" value="<?= $product['Price']; ?>" required>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-custom">UPDATE</button>
                        <button type="button" class="btn btn-light btn-custom" data-bs-dismiss="modal">Cancel</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <!-- Delete Modal -->
              <div class="modal fade" id="deleteModal<?= $product['id']; ?>" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <form action="/delete-product/<?= $product['id']; ?>" method="POST">
                      <div class="modal-header bg-danger text-white rounded-top">
                        <h5 class="modal-title">Delete Product</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <p>Are you sure you want to delete <strong><?= $product['product_name'] ?></strong>?</p>
                        <input type="hidden" name="id" value="<?= $product['id']; ?>">
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-danger btn-custom">Delete</button>
                        <button type="button" class="btn btn-light btn-custom" data-bs-dismiss="modal">Cancel</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="6" class="text-muted">NO PRODUCTS FOUND.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="/create-user" method="POST">
        <div class="modal-header bg-success text-white rounded-top">
          <h5 class="modal-title">Add Product</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="product_name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Quantity</label>
            <input type="number" name="quantity" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" name="Price" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success btn-custom">Add</button>
          <button type="button" class="btn btn-light btn-custom" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Pagination -->
<?php if ($totalPages > 1): ?>
<nav aria-label="Page navigation" class="mt-3">
  <ul class="pagination justify-content-center">
    <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
      <a class="page-link" href="?search=<?= urlencode($search) ?>&page=<?= $page - 1 ?>">Previous</a>
    </li>
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
      <li class="page-item <?= $i == $page ? 'active' : '' ?>">
        <a class="page-link" href="?search=<?= urlencode($search) ?>&page=<?= $i ?>"><?= $i ?></a>
      </li>
    <?php endfor; ?>
    <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
      <a class="page-link" href="?search=<?= urlencode($search) ?>&page=<?= $page + 1 ?>">Next</a>
    </li>
  </ul>
</nav>
<?php endif; ?>

<!-- Back Button (right side) -->
<div class="d-flex justify-content-end mt-2">
  <a href="javascript:history.back()" class="btn btn-secondary btn-custom">Back</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL; ?>/public/js/alert.js"></script>
</body>
</html>
