<?php
require_once 'config/database.php';

// Get all published posts
$query = "SELECT p.*, u.username as author_name 
          FROM pages p 
          LEFT JOIN users u ON p.author_id = u.id 
          WHERE p.status = 'published' 
          ORDER BY p.created_at DESC";
$result = mysqli_query($conn, $query);
$posts = [];
while ($row = mysqli_fetch_assoc($result)) {
    $posts[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CMS Sederhana</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">
</head>
<body class="hold-transition">
    <div class="wrapper">
        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Latest Posts</h1>
                        </div>
                        <div class="col-sm-6">
                            <a href="login.php" class="btn btn-primary float-right">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <?php foreach ($posts as $post): ?>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="post.php?slug=<?php echo sanitize_output($post['slug']); ?>">
                                            <?php echo sanitize_output($post['title']); ?>
                                        </a>
                                    </h5>
                                    <p class="card-text">
                                        <small class="text-muted">
                                            By <?php echo sanitize_output($post['author_name']); ?> | 
                                            Published on <?php echo date('F j, Y', strtotime($post['created_at'])); ?>
                                        </small>
                                    </p>
                                    <p class="card-text">
                                        <?php 
                                        // Show excerpt of content
                                        echo substr(strip_tags($post['content']), 0, 200) . '...'; 
                                        ?>
                                    </p>
                                    <a href="post.php?slug=<?php echo sanitize_output($post['slug']); ?>" class="btn btn-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/js/adminlte.min.js"></script>
</body>
</html> 