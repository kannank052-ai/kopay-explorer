<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

require_once '../config.php';

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

    $imageName = "";

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

        $originalName = basename($_FILES['image']['name']);
        $tmpName = $_FILES['image']['tmp_name'];

        $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($extension, $allowedExtensions)) {

            $imageName = time() . '_' . preg_replace(
                '/[^A-Za-z0-9._-]/',
                '_',
                $originalName
            );

            $uploadPath = '../image/' . $imageName;

            if (!move_uploaded_file($tmpName, $uploadPath)) {
                $message = "Image upload failed.";
            }

        } else {

            $message = "Only JPG, JPEG, PNG and WEBP images are allowed.";
        }
    }

    if (empty($message)) {

        $sql = "INSERT INTO places
        (
            name,
            category,
            distance_km,
            description,
            opening_hours,
            entrance_fee,
            travel_tips,
            estimated_travel_time,
            nearby_attractions,
            nearby_facilities,
            location,
            map_link,
            image
        )
        VALUES
        (
            '$name',
            '$category',
            '$distance_km',
            '$description',
            '$opening_hours',
            '$entrance_fee',
            '$travel_tips',
            '$estimated_travel_time',
            '$nearby_attractions',
            '$nearby_facilities',
            '$location',
            '$map_link',
            '$imageName'
        )";

        if (mysqli_query($conn, $sql)) {

            $message = "Tourist place added successfully.";

        } else {

            $message = "Database Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Add Place - Kopay Explorer
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="../style.css"
    >
</head>

<body>

<nav class="navbar navbar-dark bg-success">

    <div class="container">

        <a
            class="navbar-brand fw-bold"
            href="dashboard.php"
        >
            Kopay Explorer - Admin
        </a>

        <a
            href="manage-places.php"
            class="btn btn-light"
        >
            Manage Places
        </a>

    </div>

</nav>


<div class="container py-5">

    <h1 class="fw-bold mb-4">
        Add New Tourist Place
    </h1>


    <?php if (!empty($message)) { ?>

        <div class="alert alert-info">

            <?php echo htmlspecialchars($message); ?>

        </div>

    <?php } ?>


    <form
        method="POST"
        enctype="multipart/form-data"
    >

        <div class="row g-3">


            <div class="col-md-6">

                <label class="form-label">
                    Place Name
                </label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
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

                    <option value="">
                        Select Category
                    </option>

                    <option value="Religious">
                        Religious
                    </option>

                    <option value="Heritage">
                        Heritage
                    </option>

                    <option value="Nature">
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
                ></textarea>

            </div>


            <div class="col-md-6">

                <label class="form-label">
                    Opening Hours
                </label>

                <input
                    type="text"
                    name="opening_hours"
                    class="form-control"
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
                >

            </div>


            <div class="col-md-6">

                <label class="form-label">
                    Tourist Place Image
                </label>

                <input
                    type="file"
                    name="image"
                    class="form-control"
                    accept=".jpg,.jpeg,.png,.webp"
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
                ></textarea>

            </div>


            <div class="col-12">

                <label class="form-label">
                    Nearby Attractions
                </label>

                <textarea
                    name="nearby_attractions"
                    class="form-control"
                    rows="2"
                ></textarea>

            </div>


            <div class="col-12">

                <label class="form-label">
                    Nearby Facilities
                </label>

                <textarea
                    name="nearby_facilities"
                    class="form-control"
                    rows="2"
                ></textarea>

            </div>


            <div class="col-12">

                <label class="form-label">
                    Google Maps Link
                </label>

                <input
                    type="text"
                    name="map_link"
                    class="form-control"
                >

            </div>


            <div class="col-12 mt-4">

                <button
                    type="submit"
                    class="btn btn-success"
                >
                    Add Tourist Place
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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>