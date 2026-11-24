<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include '../config.php';

$sql = "SELECT * FROM places ORDER BY id ASC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Places - Kopay Explorer</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<nav class="navbar navbar-dark bg-success">

    <div class="container">

        <a class="navbar-brand fw-bold" href="dashboard.php">
            Kopay Explorer - Admin
        </a>

        <div>

            <a href="dashboard.php" class="btn btn-light">
                Dashboard
            </a>

            <a href="logout.php" class="btn btn-outline-light">
                Logout
            </a>

        </div>

    </div>

</nav>


<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1 class="fw-bold">
            Manage Tourist Places
        </h1>

        <a href="add-place.php" class="btn btn-success">
            + Add New Place
        </a>

    </div>


    <div class="table-responsive">

        <table class="table table-bordered table-striped align-middle">

            <thead class="table-dark">

                <tr>

                    <th>ID</th>

                    <th>Image</th>

                    <th>Name</th>

                    <th>Category</th>

                    <th>Distance</th>

                    <th>Location</th>

                    <th>Actions</th>

                </tr>

            </thead>


            <tbody>

                <?php
                if ($result && mysqli_num_rows($result) > 0) {

                    while ($place = mysqli_fetch_assoc($result)) {
                ?>

                <tr>

                    <td>
                        <?php echo $place['id']; ?>
                    </td>


                    <td>

                        <?php if (!empty($place['image'])) { ?>

                            <img
                                src="../image/<?php echo htmlspecialchars($place['image']); ?>"
                                width="100"
                                height="70"
                                style="object-fit: cover;"
                                alt=""
                            >

                        <?php } else { ?>

                            No Image

                        <?php } ?>

                    </td>


                    <td>
                        <?php echo htmlspecialchars($place['name']); ?>
                    </td>


                    <td>
                        <?php echo htmlspecialchars($place['category']); ?>
                    </td>


                    <td>
                        <?php echo htmlspecialchars($place['distance_km']); ?> km
                    </td>


                    <td>
                        <?php echo htmlspecialchars($place['location']); ?>
                    </td>


                    <td>

                        <a
                            href="edit-place.php?id=<?php echo $place['id']; ?>"
                            class="btn btn-warning btn-sm"
                        >
                            Edit
                        </a>

                        <a
                            href="delete-place.php?id=<?php echo $place['id']; ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this place?');"
                        >
                            Delete
                        </a>

                    </td>

                </tr>

                <?php
                    }

                } else {
                ?>

                <tr>

                    <td colspan="7" class="text-center">
                        No tourist places found.
                    </td>

                </tr>

                <?php
                }
                ?>

            </tbody>

        </table>

    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>