<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard - Kopay Explorer</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<nav class="navbar navbar-dark bg-success">
    <div class="container">

        <a class="navbar-brand fw-bold" href="#">
            Kopay Explorer - Admin
        </a>

        <a href="logout.php" class="btn btn-light">
            Logout
        </a>

    </div>
</nav>


<div class="container py-5">

    <h1 class="fw-bold mb-4">
        Admin Dashboard
    </h1>

    <div class="row g-4">

        <div class="col-md-4">

            <div class="card shadow text-center">

                <div class="card-body">

                    <h4>
                        Manage Places
                    </h4>

                    <p>
                        Add, edit and delete tourist places.
                    </p>

                    <a href="manage-places.php" class="btn btn-success">
                        Manage Places
                    </a>

                </div>

            </div>

        </div>


        <div class="col-md-4">

            <div class="card shadow text-center">

                <div class="card-body">

                    <h4>
                        Add New Place
                    </h4>

                    <p>
                        Add a new tourist attraction.
                    </p>

                    <a href="add-place.php" class="btn btn-primary">
                        Add Place
                    </a>

                </div>

            </div>

        </div>


        <div class="col-md-4">

            <div class="card shadow text-center">

                <div class="card-body">

                    <h4>
                        View Website
                    </h4>

                    <p>
                        Open the public tourist website.
                    </p>

                    <a href="../index.php" class="btn btn-outline-dark">
                        View Website
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>