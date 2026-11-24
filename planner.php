<?php
include 'config.php';

$sql = "SELECT * FROM places ORDER BY distance_km ASC";
$result = mysqli_query($conn, $sql);

$selectedPlaces = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['places'])) {

    $placeIds = $_POST['places'];

    foreach ($placeIds as $placeId) {

        $id = intval($placeId);

        $query = "SELECT * FROM places WHERE id = $id";
        $placeResult = mysqli_query($conn, $query);

        if ($placeResult && mysqli_num_rows($placeResult) > 0) {
            $selectedPlaces[] = mysqli_fetch_assoc($placeResult);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>One-Day Planner - Kopay Explorer</title>

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
                    <a class="nav-link" href="places.php">
                        Places
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="planner.php">
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

    <div class="text-center mb-5">

        <h1 class="fw-bold">
            One-Day Trip Planner
        </h1>

        <p class="text-muted">
            Select the tourist places you want to visit in one day.
        </p>

    </div>


    <form method="POST">

        <div class="row g-4">

            <?php while ($place = mysqli_fetch_assoc($result)) { ?>

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

                            <h5 class="fw-bold">
                                <?php echo htmlspecialchars($place['name']); ?>
                            </h5>

                            <p>
                                <strong>Distance:</strong>
                                <?php echo htmlspecialchars($place['distance_km']); ?> km
                            </p>

                            <p>
                                <strong>Estimated Travel Time:</strong><br>

                                <?php
                                echo !empty($place['estimated_travel_time'])
                                    ? htmlspecialchars($place['estimated_travel_time'])
                                    : 'Not available';
                                ?>
                            </p>

                            <div class="form-check mt-3">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="places[]"
                                    value="<?php echo $place['id']; ?>"
                                    id="place<?php echo $place['id']; ?>"
                                >

                                <label
                                    class="form-check-label fw-bold"
                                    for="place<?php echo $place['id']; ?>"
                                >
                                    Add to My Trip
                                </label>

                            </div>

                        </div>

                    </div>

                </div>

            <?php } ?>

        </div>


        <div class="text-center mt-5">

            <button
                type="submit"
                class="btn btn-success btn-lg px-5"
            >
                Create My One-Day Plan
            </button>

        </div>

    </form>


    <?php if (!empty($selectedPlaces)) { ?>

        <div class="mt-5">

            <h2 class="fw-bold text-center mb-4">
                My One-Day Travel Plan
            </h2>

            <div class="card shadow">

                <div class="card-body">

                    <?php
                    $number = 1;

                    foreach ($selectedPlaces as $selected) {
                    ?>

                        <div class="border-bottom py-3">

                            <h5 class="fw-bold">
                                <?php echo $number; ?>.
                                <?php echo htmlspecialchars($selected['name']); ?>
                            </h5>

                            <p class="mb-1">
                                <strong>Category:</strong>
                                <?php echo htmlspecialchars($selected['category']); ?>
                            </p>

                            <p class="mb-1">
                                <strong>Distance:</strong>
                                <?php echo htmlspecialchars($selected['distance_km']); ?> km
                            </p>

                            <p class="mb-1">
                                <strong>Opening Hours:</strong>
                                <?php echo htmlspecialchars($selected['opening_hours']); ?>
                            </p>

                            <p class="mb-1">
                                <strong>Estimated Travel Time:</strong>
                                <?php echo htmlspecialchars($selected['estimated_travel_time']); ?>
                            </p>

                            <a
                                href="<?php echo htmlspecialchars($selected['map_link']); ?>"
                                target="_blank"
                                class="btn btn-sm btn-outline-primary mt-2"
                            >
                                Google Maps
                            </a>

                        </div>

                    <?php
                        $number++;
                    }
                    ?>

                </div>

            </div>

        </div>

    <?php } ?>

</section>


<footer class="bg-dark text-white text-center py-3">

    <p class="mb-0">
        © 2026 Kopay Explorer | Kovinthamorthy Kannan - E2410259
    </p>

</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>