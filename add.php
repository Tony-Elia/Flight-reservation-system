<?php
session_start();
    $pageTitle = 'Add Flights';
    include 'init.php';
    include $template . 'header.php';
    include $template.'navbar.php';
    if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) {
        header('Location: login.php');
    }
    if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_GET['aircraft'])){
        $aircraftName = $_POST['aircraftName'];
        $ecoSeats = $_POST['ecoSeats'];
        $busSeats = $_POST['busSeats'];
        $fSeats = $_POST['fSeats'];
        $model = $_POST['model'];
        $mxWeight = $_POST['mxWeight'];
        $date = $_POST['date'];
        $totalChairs = (int)$ecoSeats + (int)$busSeats + (int)$fSeats;
        /*
         * Insert Query
         *
         * */
        $sql = "INSERT INTO aircraft(name, max_weight, number_of_seats, manufacture_date, model)
                values('$aircraftName', '$mxWeight', '$totalChairs', '$date', '$model');";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $aircraftId = $conn->lastInsertId();
        $sql = "INSERT INTO seat(aircraft_id, class_type) values";

        for($i = 0; $i < $ecoSeats; $i++) {
            $sql .= "('$aircraftId', 'Economic'),";
        }
        for($i = 0; $i < $busSeats; $i++) {
            $sql.= "('$aircraftId', 'Business'),";
        }
        for($i = 0; $i < $fSeats; $i++) {
            $sql .= "('$aircraftId', 'First Class'),";
        }
        // remove last comma
        $sql = substr($sql, 0, -1);
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        header('Location: add.php');
    }
if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_GET['flight'])){

    $sql = "INSERT INTO flight (aircraft_id, dep_location, arrival_location, dep_time,arrival_time, price, airline)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $_POST['aircraft_id']);
    $stmt->bindParam(2, $_POST['dep_location']);
    $stmt->bindParam(3, $_POST['arrival_location']);
    $stmt->bindParam(4, $_POST['dep_time']);
    $stmt->bindParam(5, $_POST['arrival_time']);
    $stmt->bindParam(6, $_POST['price']);
    $stmt->bindParam(7, $_POST['airline']);
    $stmt->execute();
    header('Location: add.php');
}
?>
<div class="row mx-auto container col-11 col-md-8 d-flex justify-content-center">
    <div class="my-5 col-md-6 col-11">
        <!--Edit Profile-->
        <h3 class="text-center">Add Aircraft</h3>
        <form class="form" action="add.php?aircraft=true" method="POST">
            <div class="form-group my-4">
                <label>Aircraft Name</label>
                <input type="text" name="aircraftName" class="form-control" aria-describedby="">
            </div>
            <div class="form-group my-4">
                <label>Model</label>
                <input type="text" name="model" class="form-control" aria-describedby="">
            </div>
            <div class="form-group my-4">
                <label>Economics Seats</label>
                <input type="number" name="ecoSeats" class="form-control" aria-describedby="">
            </div>
            <div class="form-group my-4">
                <label>Business Seats</label>
                <input type="number" name="busSeats" class="form-control" aria-describedby="">
            </div>

            <div class="form-group my-4">
                <label>First Class Seats</label>
                <input type="number" name="fSeats" class="form-control">
            </div>
            <div class="form-group my-4 position-relative">
                <label>Max Weight</label>
                <input type="number" name="mxWeight" class="form-control">
            </div>
            <div class="form-group my-4">
                <label>Manufacture Date</label>
                <input type="date" name="date" class="form-control">
            </div>
            <div class="row justify-content-center">
<!--                <input type="hidden" name="user_id" value="--><?php //= $_SESSION['user'] ?><!--">-->
                <button type="submit" class="btn button mt-4 w-md-50 w-75"> Add </button>
            </div>
        </form>
    </div>
    <div class="my-5 col-md-6 col-11">
        <!--Edit Profile-->
        <h3 class="text-center">Add Flight</h3>

        <form class="form" action="add.php?flight=true" method="POST">

            <div class="form-group my-4">
                <?php
                $sql = "SELECT * FROM aircraft";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $aircrafts = $stmt->fetchAll();
                ?>
                Select aircraft
                <select class="form-select" name="aircraft_id">
                <?php
                    foreach ($aircrafts as $aircraft) {
                        echo "<option value='" . $aircraft['aircraft_id'] . "'>" . $aircraft['name'] . "</option>";
                    }
                ?>
                </select>
            </div>
            <div class="form-group my-4">
                <label>Departure Location</label>
                <input type="text" name="dep_location" class="form-control" aria-describedby="">
            </div>
            <div class="form-group my-4">
                <label>Arrival Location</label>
                <input type="text" name="arrival_location" class="form-control" aria-describedby="">
            </div>
            <div class="form-group my-4">
                <label>Departure Time</label>
                <input type="datetime-local" name="dep_time" class="form-control" aria-describedby="">
            </div>
            <div class="form-group my-4">
                <label>Arrival Time</label>
                <input type="datetime-local" name="arrival_time" class="form-control" aria-describedby="">
            </div>

            <div class="form-group my-4 position-relative">
                <label>Flight Price</label>
                <input type="number" name="price" class="form-control">
            </div>
            <div class="form-group my-4">
                <label>Airline</label>
                <input type="text" name="airline" class="form-control">
            </div>
            <div class="row justify-content-center">
                <button type="submit" class="btn button mt-4 w-md-50 w-75"> Add </button>
            </div>
        </form>
    </div>

</div>

<?php
include $template . 'footer.php';
?>