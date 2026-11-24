<?php
include 'config.php';

$search = "";
$category = "";

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
}

if (isset($_GET['category'])) {
    $category = mysqli_real_escape_string($conn, $_GET['category']);
}

$sql = "SELECT * FROM places WHERE 1";

if (!empty($search)) {
    $sql .= " AND name LIKE '%$search%'";
}

if (!empty($category)) {
    $sql .= " AND category = '$category'";
}

$sql .= " ORDER BY distance_km ASC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Places - Kopay Explorer</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-success">

    <div class="container">

        <a class="navbar-brand fw-bold" href="index.php">
            Kopay Explorer
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="index.php">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="places.php">
                        Places
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="planner.php">
                        One-Day Planner
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="admin/login.php">
                        Admin
                    </a>
                </li>

            </ul>

        </div>

    </div>

</nav>


<section class="container py-5">

    <div class="text-center mb-4">

        <h1 class="fw-bold">
            Tourist Places Around Kopay
        </h1>

        <p class="text-muted">
            Explore tourist attractions within 25 km of Kopay.
        </p>

    </div>


    <!-- Search and Filter -->

    <form method="GET" class="row g-3 mb-5">

        <div class="col-md-6">

            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search tourist place..."
                value="<?php echo htmlspecialchars($search); ?>"
            >

        </div>


        <div class="col-md-4">

            <select
                name="category"
                class="form-select"
            >

                <option value="">
                    All Categories
                </option>

                <option
                    value="Religious"
                    <?php if ($category == 'Religious') echo 'selected'; ?>
                >
                    Religious
                </option>

                <option
                    value="Heritage"
                    <?php if ($category == 'Heritage') echo 'selected'; ?>
                >
                    Heritage
                </option>

                <option
                    value="Nature"
                    <?php if ($category == 'Nature') echo 'selected'; ?>
                >
                    Nature
                </option>

            </select>

        </div>


        <div class="col-md-2">

            <button
                type="submit"
                class="btn btn-success w-100"
            >
                Search
            </button>

        </div>

    </form>


    <!-- Places Cards -->

    <div class="row g-4">

        <?php

        if ($result && mysqli_num_rows($result) > 0) {

            while ($place = mysqli_fetch_assoc($result)) {

        ?>

        <div class="col-md-6 col-lg-4">

            <div class="card h-100 shadow">

                <?php if (!empty($place['image'])) { ?>

                    <img
                        src="image/<?php echo htmlspecialchars($place['image']); ?>"
                        class="card-img-top place-image"
                        alt="<?php echo htmlspecialchars($place['name']); ?>"
                    >

                <?php } ?>


                <div class="card-body">

                    <h5 class="card-title fw-bold">

                        <?php
                        echo htmlspecialchars($place['name']);
                        ?>

                    </h5>


                    <p class="mb-2">

                        <strong>
                            Category:
                        </strong>

                        <?php
                        echo htmlspecialchars($place['category']);
                        ?>

                    </p>


                    <p class="mb-2">

                        <strong>
                            Distance:
                        </strong>

                        <?php
                        echo htmlspecialchars($place['distance_km']);
                        ?>

                        km

                    </p>


                    <p class="card-text">

                        <?php
                        echo htmlspecialchars($place['description']);
                        ?>

                    </p>


                    <p>

                        <strong>
                            Location:
                        </strong>

                        <?php
                        echo htmlspecialchars($place['location']);
                        ?>

                    </p>


                    <div class="d-flex gap-2 flex-wrap">

                        <a
                            href="place-details.php?id=<?php echo $place['id']; ?>"
                            class="btn btn-success"
                        >
                            View Details
                        </a>


                        <a
                            href="<?php echo htmlspecialchars($place['map_link']); ?>"
                            target="_blank"
                            class="btn btn-outline-primary"
                        >
                            Google Maps
                        </a>

                    </div>

                </div>

            </div>

        </div>

        <?php

            }

        } else {

        ?>

        <div class="col-12">

            <div class="alert alert-warning text-center">

                No tourist places found.

            </div>

        </div>

        <?php
        }
        ?>

    </div>

</section>


<footer class="bg-dark text-white text-center py-3">

    <p class="mb-0">

        © 2026 Kopay Explorer |
        Kovinthamorthy Kannan - E2410259

    </p>

</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>