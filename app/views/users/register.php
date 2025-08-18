<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<style>

</style>
<body>  

<div class="container d-flex align-center justify-content-center mt-5">
 

  <div class="card shadow p-4 w-100 position-relative  overflow-hidden" style="max-width:400px">
<div class="position-absolute top-0 mt-3 w-100" style="z-index: 10; max-width:90%">
       <?php getErrors(); ?>
           <?php getMessage(); ?>
     </div>
    <h3 class="mb-4">Register User</h3>

    <form action="/create-user" method="POST">
      
      <div class="mb-3">
        <label for="first_name" class="form-label">First Name</label>
        <input type="text" class="form-control" name="first_name" required value="<?= $_POST['first_name'] ?? '' ?>">
      </div>

      <div class="mb-3">  
        <label for="last_name" class="form-label">Last Name</label>
        <input type="text" class="form-control"  name="last_name" required value="<?= $_POST['last_name'] ?? '' ?>">
      </div>

      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control"  name="username"  required value="<?= $_POST['username'] ?? '' ?>">
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email"  class="form-control"  name="email"  required value="<?= $_POST['email'] ?? '' ?>">
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" required name="password">
      </div>

      <button type="submit" class="btn btn-primary w-100">Submit</button>

    </form>
  </div>
</div>
<script src="<?= BASE_URL; ?>/public/js/alert.js"></script>
</body>
</html>
