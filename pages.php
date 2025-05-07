<?php
session_start();
require_once 'config/database.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Handle page deletion
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    mysqli_query($conn, "DELETE FROM pages WHERE id = $id");
    header("Location: pages.php");
    exit();
}

// Handle page creation/update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $slug = strtolower(str_replace(' ', '-', $title));
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $author_id = $_SESSION['user_id'];
    
    if (isset($_POST['id'])) {
        // Update existing page
        $id = (int)$_POST['id'];
        mysqli_query($conn, "UPDATE pages SET title = '$title', slug = '$slug', content = '$content', status = '$status' WHERE id = $id");
    } else {
        // Create new page
        mysqli_query($conn, "INSERT INTO pages (title, slug, content, status, author_id) VALUES ('$title', '$slug', '$content', '$status', $author_id)");
    }
    header("Location: pages.php");
    exit();
}

// Get all pages
$pages = mysqli_query($conn, "SELECT p.*, u.username as author_name FROM pages p LEFT JOIN users u ON p.author_id = u.id ORDER BY p.created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pages Management - CMS Sederhana</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="logout.php">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>
        </ul>
    </nav>

    <!-- Main Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="index.php" class="brand-link">
            <span class="brand-text font-weight-light">CMS Sederhana</span>
        </a>
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages.php" class="nav-link active">
                            <i class="nav-icon fas fa-file"></i>
                            <p>Pages</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="users.php" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Users</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Pages Management</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Pages List</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pageModal">
                                        Add New Page
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Slug</th>
                                            <th>Author</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($page = mysqli_fetch_assoc($pages)): ?>
                                        <tr>
                                            <td><?php echo $page['id']; ?></td>
                                            <td><?php echo htmlspecialchars($page['title']); ?></td>
                                            <td><?php echo htmlspecialchars($page['slug']); ?></td>
                                            <td><?php echo htmlspecialchars($page['author_name']); ?></td>
                                            <td>
                                                <span class="badge badge-<?php echo $page['status'] === 'published' ? 'success' : 'warning'; ?>">
                                                    <?php echo ucfirst($page['status']); ?>
                                                </span>
                                            </td>
                                            <td><?php echo $page['created_at']; ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-info edit-page" 
                                                        data-id="<?php echo $page['id']; ?>"
                                                        data-title="<?php echo htmlspecialchars($page['title']); ?>"
                                                        data-content="<?php echo htmlspecialchars($page['content']); ?>"
                                                        data-status="<?php echo $page['status']; ?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <a href="?delete=<?php echo $page['id']; ?>" class="btn btn-sm btn-danger" 
                                                   onclick="return confirm('Are you sure you want to delete this page?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Modal -->
    <div class="modal fade" id="pageModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add/Edit Page</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="pageId">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" id="title" required>
                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            <textarea class="form-control" name="content" id="content" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2024 <a href="#">CMS Sederhana</a>.</strong> All rights reserved.
    </footer>
</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script>
$(document).ready(function() {
    $('#content').summernote({
        height: 300,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });

    $('.edit-page').click(function() {
        var id = $(this).data('id');
        var title = $(this).data('title');
        var content = $(this).data('content');
        var status = $(this).data('status');
        
        $('#pageId').val(id);
        $('#title').val(title);
        $('#content').summernote('code', content);
        $('#status').val(status);
        
        $('#pageModal').modal('show');
    });
    
    $('#pageModal').on('hidden.bs.modal', function() {
        $('#pageId').val('');
        $('#title').val('');
        $('#content').summernote('code', '');
        $('#status').val('draft');
    });
});
</script>
</body>
</html> 