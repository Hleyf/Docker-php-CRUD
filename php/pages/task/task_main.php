<?php require_once '../../db.php'; ?>
<?php include("../../includes/header.php") ?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-4">
            <?php if (isset($_SESSION['message'])) { ?>
                <div id="alert" class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert" onmouseenter="resetTimeout()" onmouseleave="startTimeout()">
                    <?= $_SESSION['message'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <script>
                    var timeoutId;

                    function startTimeout() {
                        timeoutId = setTimeout(function() {
                            document.getElementById('alert').style.display = 'none';
                        }, 5000);
                    }

                    function resetTimeout() {
                        clearTimeout(timeoutId);
                    }

                    startTimeout();
                </script>
            <?php
                unset($_SESSION['message']);
                unset($_SESSION['message_type']);
            } ?>
            <div class="card card-body">
                <form action="../../crud/save_task.php" method="POST">
                    <div class="form-group p-2">
                        <input type="text" name="title" class="form-control" placeholder="Task Title" autofocus>
                    </div>
                    <div class="form-group p-2">
                        <textarea class="form-control" name="description" rows="2" placeholder="Task description"></textarea>
                    </div>
                    <div class="form-group p-2">
                        <input type="submit" class="btn btn-success btn-block px-2" name="save_task" value="Save Task">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM task";
                    $result_tasks = mysqli_query($db_connection, $query);

                    while ($row = mysqli_fetch_array($result_tasks)) { ?>
                        <tr>
                            <td><?php echo $row['title'] ?></td>
                            <td><?php echo $row['description'] ?></td>
                            <td><?php echo $row['created_at'] ?></td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <a href="../../crud/edit_task.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary flex-fill mx-1">
                                        <i class="fas fa-marker"></i>
                                    </a>
                                    <a href="../../crud/delete_task.php?id=<?php echo $row['id'] ?>" class="btn btn-danger flex-fill mx-1">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </div>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("../../includes/footer.php") ?>