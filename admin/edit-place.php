<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

require_once '../config.php';

if (!isset($_GET['id'])) {
    die("Place ID not found.");
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM places WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Place not found.");
}

$place = mysqli_fetch_assoc($result);

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $distance_km = mysqli_real_escape_string($conn, $_POST['distance_km']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $opening_hours = mysqli_real_escape_string($conn, $_POST['opening_hours']);
    $entrance_fee = mysqli_real_escape_string($conn, $_POST['entrance_fee']);
    $travel_tips = mysqli_real_escape_string($conn, $_POST['travel_tips']);
    $estimated_travel_time = mysqli_real_escape_string($conn, $_POST['estimated_travel_time']);
    $nearby_attractions = mysqli_real_escape_string($conn, $_POST['nearby_attractions']);
    $nearby_facilities = mysqli_real_escape_string($conn, $_POST['nearby_facilities']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $map_link = mysqli_real_escape_string($conn, $_POST['map_link']);
    $image = mysqli_real_escape_string($conn, $_POST['image']);

    $updateSql = "UPDATE places SET
        name = '$name',
        category = '$category',
        distance_km = '$distance_km',
        description = '$description',
        opening_hours = '$opening_hours',
        entrance_fee = '$entrance_fee',
        travel_tips = '$travel_tips',
        estimated_travel_time = '$estimated_travel_time',
        nearby_attractions = '$nearby_attractions',
        nearby_facilities = '$nearby_facilities',
        location = '$location',
        map_link = '$map_link',
        image = '$image'
        WHERE id = $id";

    if (mysqli_query($conn, $updateSql)) {

        $message = "Tourist place updated successfully.";

        $refresh = mysqli_query($conn, "SELECT * FROM places WHERE id = $id");
        $place = mysqli_fetch_assoc($refresh);

    } else {

        $message = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit Place - Kopay Explorer</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="../style.css">

</head>

<body>

<nav class="navbar navbar-dark bg-success">

    <div class="container">

        <a class="navbar-brand fw-bold" href="dashboard.php">
            Kopay Explorer - Admin
        </a>

        <a href="manage-places.php" class="btn btn-light">
            Manage Places
        </a>

    </div>

</nav>


<div class="container py-5">

    <h1 class="fw-bold mb-4">
        Edit Tourist Place
    </h1>


    <?php if (!empty($message)) { ?>

        <div class="alert alert-success">

            <?php echo htmlspecialchars($message); ?>

        </div>

    <?php } ?>


    <form method="POST">

        <div class="row g-3">


            <div class="col-md-6">

                <label class="form-label">
                    Place Name
                </label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="<?php echo htmlspecialchars($place['name']); ?>"
                    required
                >

            </div>


            <div class="col-md-6">

                <label class="form-label">
                    Category
                </label>

                <select
                    name="category"
                    class="form-select"
                    required
                >

                    <option value="Religious"
                        <?php if ($place['category'] == 'Religious') echo 'selected'; ?>>
                        Religious
                    </option>

                    <option value="Heritage"
                        <?php if ($place['category'] == 'Heritage') echo 'selected'; ?>>
                        Heritage
                    </option>

                    <option value="Nature"
                        <?php if ($place['category'] == 'Nature') echo 'selected'; ?>>
                        Nature
                    </option>

                </select>

            </div>


            <div class="col-md-6">

                <label class="form-label">
                    Distance from Kopay (km)
                </label>

                <input
                    type="number"
                    step="0.01"
                    name="distance_km"
                    class="form-control"
                    value="<?php echo htmlspecialchars($place['distance_km']); ?>"
                    required
                >

            </div>


            <div class="col-md-6">

                <label class="form-label">
                    Location
                </label>

                <input
                    type="text"
                    name="location"
                    class="form-control"
                    value="<?php echo htmlspecialchars($place['location']); ?>"
                    required
                >

            </div>


            <div class="col-12">

                <label class="form-label">
                    Description
                </label>

                <textarea
                    name="description"
                    class="form-control"
                    rows="4"
                ><?php echo htmlspecialchars($place['description']); ?></textarea>

            </div>


            <div class="col-md-6">

                <label class="form-label">
                    Opening Hours
                </label>

                <input
                    type="text"
                    name="opening_hours"
                    class="form-control"
                    value="<?php echo htmlspecialchars($place['opening_hours']); ?>"
                >

            </div>


            <div class="col-md-6">

                <label class="form-label">
                    Entrance Fee
                </label>

                <input
                    type="text"
                    name="entrance_fee"
                    class="form-control"
                    value="<?php echo htmlspecialchars($place['entrance_fee']); ?>"
                >

            </div>


            <div class="col-md-6">

                <label class="form-label">
                    Estimated Travel Time
                </label>

                <input
                    type="text"
                    name="estimated_travel_time"
                    class="form-control"
                    value="<?php echo htmlspecialchars($place['estimated_travel_time']); ?>"
                >

            </div>


            <div class="col-md-6">

                <label class="form-label">
                    Image File Name
                </label>

                <input
                    type="text"
                    name="image"
                    class="form-control"
                    value="<?php echo htmlspecialchars($place['image']); ?>"
                >

            </div>


            <div class="col-12">

                <label class="form-label">
                    Travel Tips
                </label>

                <textarea
                    name="travel_tips"
                    class="form-control"
                    rows="3"
                ><?php echo htmlspecialchars($place['travel_tips']); ?></textarea>

            </div>


            <div class="col-12">

                <label class="form-label">
                    Nearby Attractions
                </label>

                <textarea
                    name="nearby_attractions"
                    class="form-control"
                    rows="2"
                ><?php echo htmlspecialchars($place['nearby_attractions']); ?></textarea>

            </div>


            <div class="col-12">

                <label class="form-label">
                    Nearby Facilities
                </label>

                <textarea
                    name="nearby_facilities"
                    class="form-control"
                    rows="2"
                ><?php echo htmlspecialchars($place['nearby_facilities']); ?></textarea>

            </div>


            <div class="col-12">

                <label class="form-label">
                    Google Maps Link
                </label>

                <input
                    type="text"
                    name="map_link"
                    class="form-control"
                    value="<?php echo htmlspecialchars($place['map_link']); ?>"
                >

            </div>


            <div class="col-12 mt-4">

                <button
                    type="submit"
                    class="btn btn-warning"
                >
                    Update Place
                </button>

                <a
                    href="manage-places.php"
                    class="btn btn-outline-secondary"
                >
                    Cancel
                </a>

            </div>

        </div>

    </form>

</div>

</body>

</html>