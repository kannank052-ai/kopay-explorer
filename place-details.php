<?php
include 'config.php';

if (!isset($_GET['id'])) {
    die("Place ID not found.");
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM places WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    die("Place not found.");
}

$place = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo htmlspecialchars($place['name']); ?> - Kopay Explorer</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">

        <a class="navbar-brand fw-bold" href="index.php">
            Kopay Explorer
        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

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

    <div class="row g-5">

        <div class="col-lg-6">

            <?php if (!empty($place['image'])) { ?>

                <img
                    src="image/<?php echo htmlspecialchars($place['image']); ?>"
                    class="img-fluid rounded shadow place-detail-image"
                    alt="<?php echo htmlspecialchars($place['name']); ?>"
                >

            <?php } ?>

        </div>


        <div class="col-lg-6">

            <h1 class="fw-bold mb-4">
                <?php echo htmlspecialchars($place['name']); ?>
            </h1>

            <div class="card shadow-sm mb-4">

                <div class="card-body">

                    <p>
                        <strong>Category:</strong><br>
                        <?php echo htmlspecialchars($place['category']); ?>
                    </p>

                    <p>
                        <strong>Distance from Kopay:</strong><br>
                        <?php echo htmlspecialchars($place['distance_km']); ?> km
                    </p>

                    <p>
                        <strong>Location:</strong><br>
                        <?php echo htmlspecialchars($place['location']); ?>
                    </p>

                    <p>
                        <strong>Opening Hours:</strong><br>

                        <?php
                        echo !empty($place['opening_hours'])
                            ? htmlspecialchars($place['opening_hours'])
                            : 'Information not available';
                        ?>
                    </p>

                    <p>
                        <strong>Entrance Fee:</strong><br>

                        <?php
                        echo !empty($place['entrance_fee'])
                            ? htmlspecialchars($place['entrance_fee'])
                            : 'Information not available';
                        ?>
                    </p>

                    <p>
                        <strong>Estimated Travel Time:</strong><br>

                        <?php
                        echo !empty($place['estimated_travel_time'])
                            ? htmlspecialchars($place['estimated_travel_time'])
                            : 'Information not available';
                        ?>
                    </p>

                </div>

            </div>

        </div>

    </div>


    <div class="row mt-5">

        <div class="col-12">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h3 class="fw-bold mb-3">
                        About This Place
                    </h3>

                    <p>
                        <?php echo htmlspecialchars($place['description']); ?>
                    </p>


                    <hr>


                    <h4>
                        Travel Tips
                    </h4>

                    <p>
                        <?php
                        echo !empty($place['travel_tips'])
                            ? htmlspecialchars($place['travel_tips'])
                            : 'Travel tips are not available yet.';
                        ?>
                    </p>


                    <hr>


                    <h4>
                        Nearby Attractions
                    </h4>

                    <p>
                        <?php
                        echo !empty($place['nearby_attractions'])
                            ? htmlspecialchars($place['nearby_attractions'])
                            : 'Nearby attraction information is not available yet.';
                        ?>
                    </p>


                    <hr>


                    <h4>
                        Nearby Facilities
                    </h4>

                    <p>
                        <?php
                        echo !empty($place['nearby_facilities'])
                            ? htmlspecialchars($place['nearby_facilities'])
                            : 'Nearby facility information is not available yet.';
                        ?>
                    </p>


                    <div class="mt-4">

                        <a
                            href="<?php echo htmlspecialchars($place['map_link']); ?>"
                            target="_blank"
                            class="btn btn-primary"
                        >
                            View on Google Maps
                        </a>

                        <a
                            href="places.php"
                            class="btn btn-outline-secondary"
                        >
                            Back to Places
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<footer class="bg-dark text-white text-center py-3">

    <p class="mb-0">
        © 2026 Kopay Explorer | Kovinthamorthy Kannan - E2410259
    </p>

</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>