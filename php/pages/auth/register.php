<?php include("../../includes/header.php") ?>
<div class="d-flex justify-content-center align-items-center vh-100 vw-100">
    <container class="container p-4  shadow" style="width: 400px;">
        <form action="../../crud/register_user.php" method="post">
            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="email" id="form2Example1" class="form-control" name="email" />
                <label class="form-label">Email address</label>
            </div>
            <div class="text-danger">
                <?php
                if (isset($_SESSION["emailErrMessage"])) {
                    echo $_SESSION["emailErrMessage"];
                    unset($_SESSION["emailErrMessage"]);
                }
                ?>
            </div>
            <!-- User Name input -->
            <div class="form-outline mb-4">
                <input type="text" id="form2Example1" class="form-control" name="userName" />
                <label class="form-label">User Name</label>
            </div>
            <div class="text-danger">
                <?php
                if (isset($_SESSION["userNameErrMessage"])) {
                    echo $_SESSION["userNameErrMessage"];
                    unset($_SESSION["userNameErrMessage"]);
                }
                ?>
            </div>
            <!-- Password input -->
            <div class="form-outline mb-4">
                <input type="password" id="form2Example2" class="form-control" name="password" />
                <label class="form-label">Password</label>
            </div>
            <div class="text-danger">
                <?php
                if (isset($_SESSION["passwordErrMessage"])) {
                    echo $_SESSION["passwordErrMessage"];
                    unset($_SESSION["passwordErrMessage"]);
                }
                ?>
            </div>
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">Register</button>
            <div class="text-danger">
                <?php
                if (isset($_SESSION["errorMessage"])) {
                    echo $_SESSION["errorMessage"];
                    unset($_SESSION["errorMessage"]);
                }
                ?>
            </div>
            <div class="text-success">
                <?php
                if (isset($_SESSION["successMessage"])) {
                    echo $_SESSION["successMessage"];
                    unset($_SESSION["successMessage"]);
                }
                ?>
            </div>
            <div class="text-center">
                <p>Already a member? <a href="login.php">Login</a></p>
            </div>
        </form>
    </container>
</div>

<?php include("../../includes/footer.php") ?>