<?php 
include 'header.php'; 

if(!isset($_SESSION['logged_in'])){
    header("Location: login.php");
}
/**
 if(isset($_SESSION['logged_in'])){
    header("Location: index.php");
}
 */
?>
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
                                <textarea name="content" id="content" class="form-control"><?= $data['content'] ?></textarea>
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
                        <input type="hidden" name="userID" value="<?= $_SESSION['user_id'] ?>">
                        <div class="mb-3">
                            <label for="title">Title</label>
                            <input type="text" id="title" class="form-control" name="title">
                        </div>
                        <div class="mb-2">
                            <label for="content">Add Content</label>
                            <textarea name="content" id="content" class="form-control"></textarea>
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
                            $id = $_SESSION['user_id'];
                            $getData = $conn->prepare("SELECT * FROM postings WHERE user_id = ?");
                            $getData->execute([$id]);
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