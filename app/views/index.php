<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student CRUD</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <h2 class="mb-4 text-center">Student Records</h2>

  <div class="mb-3">
    <?php getErrors(); ?>
    <?php getMessage(); ?>
  </div>

  <div class="d-flex justify-content-end mb-3">
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">+ Add Student</button>
  </div>

  <div class="card shadow">
    <div class="card-body">
      <table class="table table-bordered table-striped text-center">
        <thead class="table-dark">
          <tr>
            <th>Student ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Course</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if(!empty($getAll)): ?>
            <?php foreach($getAll as $student): ?>
              <tr>
                <td><?= htmlspecialchars($student['student_id']); ?></td>
                <td><?= htmlspecialchars($student['first_name']); ?></td>
                <td><?= htmlspecialchars($student['last_name']); ?></td>
                <td><?= htmlspecialchars($student['course']); ?></td>
                <td>
                  <span class="badge bg-primary" data-bs-toggle="modal" data-bs-target="#editModal<?= $student['id']; ?>">Edit</span>
                  <span class="badge bg-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $student['id']; ?>">Delete</span>
                </td>
              </tr>

          
              <div class="modal fade" id="editModal<?= $student['id']; ?>" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form action="/update-user/<?= $student['id']; ?>" method="POST">
                      <div class="modal-header">
                        <h5 class="modal-title">Edit Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <input type="hidden" name="id" value="<?= $student['id']; ?>">
                        <div class="mb-3">
                          <label class="form-label">Student ID</label>
                          <input type="text" name="student_id" class="form-control" value="<?= $student['student_id']; ?>" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">First Name</label>
                          <input type="text" name="first_name" class="form-control" value="<?= $student['first_name']; ?>" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Last Name</label>
                          <input type="text" name="last_name" class="form-control" value="<?= $student['last_name']; ?>" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Course</label>
                          <input type="text" name="course" class="form-control" value="<?= $student['course']; ?>" required>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

           
              <div class="modal fade" id="deleteModal<?= $student['id']; ?>" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form action="/delete-user/<?= $student['id']; ?>" method="POST">
                      <div class="modal-header">
                        <h5 class="modal-title">Delete Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <p>Are you sure you want to delete <strong><?= $student['first_name']." ".$student['last_name']; ?></strong>?</p>
                        <input type="hidden" name="id" value="<?= $student['id']; ?>">
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="5">No students found.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="/create-user" method="POST">
        <div class="modal-header">
          <h5 class="modal-title">Add Student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Student ID</label>
            <input type="text" name="student_id" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Course</label>
            <input type="text" name="course" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Add</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL; ?>/public/js/alert.js"></script>
</body>
</html>
