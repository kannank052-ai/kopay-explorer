<?php
include 'config.php';

$sql = "SELECT * FROM places ORDER BY distance_km ASC LIMIT 3";
$featuredResult = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kopay Explorer</title>

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
                    <a class="nav-link active" href="index.php">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="places.php">
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


<!-- Hero Section -->

<section class="hero-section d-flex align-items-center text-center">

    <div class="container">

        <h1 class="display-3 fw-bold">
            Explore Kopay & Jaffna
        </h1>

        <p class="lead">
            Discover beautiful tourist attractions within 25 km of Kopay.
        </p>

        <div class="mt-4">

            <a href="places.php" class="btn btn-warning btn-lg me-2">
                Explore Places
            </a>

            <a href="planner.php" class="btn btn-light btn-lg">
                Plan Your Trip
            </a>

        </div>

    </div>

</section>


<!-- Welcome Section -->

<section class="container py-5">

    <div class="text-center mb-5">

        <h2 class="fw-bold">
            Welcome to Kopay Explorer
        </h2>

        <p class="text-muted">
            Find tourist attractions, view location details and plan your perfect one-day trip.
        </p>

    </div>


    <div class="row g-4">

        <div class="col-md-4">

            <div class="card h-100 text-center shadow">

                <div class="card-body">

                    <h3>📍</h3>

                    <h5 class="card-title fw-bold">
                        Explore Places
                    </h5>

                    <p class="card-text">
                        Discover religious, heritage and nature attractions around Kopay.
                    </p>

                    <a href="places.php" class="btn btn-success">
                        View Places
                    </a>

                </div>

            </div>

        </div>


        <div class="col-md-4">

            <div class="card h-100 text-center shadow">

                <div class="card-body">

                    <h3>🗺️</h3>

                    <h5 class="card-title fw-bold">
                        Google Maps
                    </h5>

                    <p class="card-text">
                        View tourist locations and navigate easily using Google Maps.
                    </p>

                    <a href="places.php" class="btn btn-success">
                        Find Locations
                    </a>

                </div>

            </div>

        </div>


        <div class="col-md-4">

            <div class="card h-100 text-center shadow">

                <div class="card-body">

                    <h3>📅</h3>

                    <h5 class="card-title fw-bold">
                        One-Day Planner
                    </h5>

                    <p class="card-text">
                        Select your favourite places and create your own one-day travel plan.
                    </p>

                    <a href="planner.php" class="btn btn-success">
                        Start Planning
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- Featured Places -->

<section class="container py-5">

    <div class="text-center mb-5">

        <h2 class="fw-bold">
            Featured Tourist Places
        </h2>

        <p class="text-muted">
            Explore some of the closest attractions to Kopay.
        </p>

    </div>


    <div class="row g-4">

        <?php
        if ($featuredResult && mysqli_num_rows($featuredResult) > 0) {

            while ($place = mysqli_fetch_assoc($featuredResult)) {
        ?>

        <div class="col-md-4">

            <div class="card h-100 shadow">

                <?php if (!empty($place['image'])) { ?>

                    <img
                        src="image/<?php echo htmlspecialchars($place['image']); ?>"
                        class="card-img-top place-image"
                        alt="<?php echo htmlspecialchars($place['name']); ?>"
                    >

                <?php } ?>

                <div class="card-body">

                    <h5 class="fw-bold">
                        <?php echo htmlspecialchars($place['name']); ?>
                    </h5>

                    <p class="mb-2">

                        <strong>Category:</strong>

                        <?php echo htmlspecialchars($place['category']); ?>

                    </p>

                    <p class="mb-2">

                        <strong>Distance:</strong>

                        <?php echo htmlspecialchars($place['distance_km']); ?> km

                    </p>

                    <p>
                        <?php echo htmlspecialchars($place['description']); ?>
                    </p>

                    <a
                        href="place-details.php?id=<?php echo $place['id']; ?>"
                        class="btn btn-success"
                    >
                        View Details
                    </a>

                </div>

            </div>

        </div>

        <?php
            }
        }
        ?>

    </div>

</section>


<!-- Call To Action -->

<section class="bg-success text-white text-center py-5">

    <div class="container">

        <h2 class="fw-bold">
            Ready to Explore Jaffna?
        </h2>

        <p class="lead">
            Choose your favourite destinations and create a simple one-day travel plan.
        </p>

        <a href="planner.php" class="btn btn-warning btn-lg">
            Create My Trip
        </a>

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