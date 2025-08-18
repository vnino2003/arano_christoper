<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<style>
    body, html {
        height: 100%;
        margin: 0;
    }

    .sidebar {
        min-width: 200px;
        max-width: 200px;
        height: 100vh;
        list-style: none;
        display: flex;
        flex-direction: column;
        padding: 1rem;
    }

    .sidebar a {
        display: block;
        padding: 0.8rem 1rem;
        color: white;
        text-decoration: none;
        margin-bottom: 0.5rem;
        border-radius: 0.25rem;
        transition: background-color 0.3s;
    }

    .sidebar a:hover { background-color: #ffc0cb; color: #000;   }
    .content { flex: 1; padding: 1.5rem; overflow-x: auto; display: flex;  flex-direction: column; }
    .stats-card { color: white; height: 100%; }
    .table-container { max-height: 400px; overflow-y: auto; }
    .badge{
        padding: 0.5rem 0.8rem;
        cursor: pointer
    }

</style>
</head>
<body>

<div class="d-flex">

    <ul class="sidebar bg-primary">
        <li><a href="#">Home</a></li>
        <li><a href="#">User</a></li>
        <li><a href="#">Product</a></li>
        <li><a href="#">Reports</a></li>
        <li><a href="#">Settings</a></li>
    </ul>

    <div class="content">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Users Management</h3>
            <a href="/create-user" class="btn btn-success">Add New User</a>
        </div>

        <?php getMessage(); ?>

        <div class="table-container table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($getAll as $user): ?>
                    <tr>
                        <td><?=$user['id'];?></td>
                        <td><?=$user['first_name'];?></td>
                        <td><?=$user['last_name'];?></td>
                        <td><?=$user['username'];?></td>
                        <td><?=$user['email'];?></td>
                        <td>
                            <span class="badge bg-primary" data-bs-toggle="modal" data-bs-target="#editModal<?=$user['id'];?>">Edit</span>
                            <span class="badge bg-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?=$user['id'];?>">Delete</span>

                        </td>
                    </tr>

                   
                    <div class="modal fade" id="deleteModal<?=$user['id'];?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-danger">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete <strong><?=$user['first_name'].' '.$user['last_name'];?></strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form action="/admin-delete/<?=$user['id'];?>" method="POST" style="display:inline;">
                                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="editModal<?=$user['id'];?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="/admin-edit/<?=$user['id'];?>" method="POST">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?=$user['id'];?>">
                                        <div class="mb-3">
                                            <label class="form-label">First Name</label>
                                            <input type="text" name="first_name" class="form-control" value="<?=$user['first_name'];?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Last Name</label>
                                            <input type="text" name="last_name" class="form-control" value="<?=$user['last_name'];?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Username</label>
                                            <input type="text" name="username" class="form-control" value="<?=$user['username'];?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" value="<?=$user['email'];?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<script src="<?= BASE_URL; ?>/public/js/alert.js"></script>



</body>
</html>
