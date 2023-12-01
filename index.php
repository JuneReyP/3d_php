<?php include 'conn.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-fluid">
        <!-- navbar start -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Topics</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" aria-disabled="true">About</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="" class="nav-link">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- navbar end -->
        <div class="row justify-content-center mt-5">
            <div class="col-md-4">
                <?php
                if (isset($_GET['msg'])) { ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong><?= $_GET['msg'] ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>
                <?php
                if (isset($_GET['edit'])) { ?>
                    <!-- for updating -->
                    <?php
                    $id = $_GET['id'];
                    $queryData = $conn->prepare("SELECT * FROM postings WHERE postingID = ?");
                    $queryData->execute([$id]);

                    foreach ($queryData as $data) { ?>
                        <form action="process.php" method="post" class="shadow p-3">
                            <h2>Update Content</h2>
                            <input type="hidden" name="posting_id" value="<?= $data['postingID'] ?>">
                            <div class="mb-3">
                                <label for="title">Title</label>
                                <input type="text" id="title" class="form-control" name="title" value="<?= $data['title'] ?>">
                            </div>
                            <div class="mb-2">
                                <label for="content">Add Content</label>
                                <textarea name="content" id="content" rows="10" class="form-control"><?= $data['content'] ?></textarea>
                            </div>
                            <div class="mb-2">
                                <button class="btn btn-warning" name="update" type="submit">Update</button>
                            </div>
                        </form>

                    <?php } ?>

                <?php } else { ?>
                    <!-- for adding posting -->
                    <form action="process.php" method="post" class="shadow p-3">
                        <h2>Create Content</h2>
                        <div class="mb-3">
                            <label for="title">Title</label>
                            <input type="text" id="title" class="form-control" name="title">
                        </div>
                        <div class="mb-2">
                            <label for="content">Add Content</label>
                            <textarea name="content" id="content" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="mb-2">
                            <button class="btn btn-success" name="create" type="submit">Create</button>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
        <!-- display content here start -->
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="table shadow mt-5 p-3">
                    <table class="table">
                        <thead>
                            <th>#</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php
                            $cnt = 1;
                            $getData = $conn->query("SELECT * FROM postings");
                            foreach ($getData as $data) { ?>
                                <tr>
                                    <td><?= $cnt++ ?></td>
                                    <td><?= $data['title'] ?></td>
                                    <td><?= $data['content'] ?></td>
                                    <td><a href="index.php?edit&id=<?= $data['postingID'] ?>" class="text-decoration-none">✏️</a> | <a href="process.php?delete&id=<?= $data['postingID'] ?>" class="text-decoration-none">❌</a></td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- display content here end -->
    </div>
</body>

</html>