<?php
    session_start();
    $pageTitle = 'Edit Flights';
    include 'init.php';
    include $template . 'header.php';
    include $template . 'navbar.php';
    if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) {
        header('Location: login.php');
    }
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        /*
         *
         * Update Query Syntax
         *
         * */
        $sql = "UPDATE flight SET aircraft_id = ?, dep_location = ?, arrival_location = ?, dep_time = ?, arrival_time = ?, price = ?, airline = ? WHERE flight_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $_POST['aircraft_id']);
        $stmt->bindParam(2, $_POST['dep_location']);
        $stmt->bindParam(3, $_POST['arrival_location']);
        $stmt->bindParam(4, $_POST['dep_time']);
        $stmt->bindParam(5, $_POST['arrival_time']);
        $stmt->bindParam(6, $_POST['price']);
        $stmt->bindParam(7, $_POST['airline']);
        $stmt->bindParam(8, $_POST['flight_id']);
        $stmt->execute();
        header('Location: flight-manage.php');
    }
?>
    <div class="row mx-auto container col-11 col-md-8 d-flex justify-content-center">
        <div class="my-5 col-md-6 col-11">
            <!--Edit Flight-->
            <h3 class="text-center">Edit Flight</h3>
            <?php
                $sql = "SELECT * FROM flight where flight_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $_GET['flight_id']);
                $stmt->execute();
                $flight = $stmt->fetch(PDO::FETCH_ASSOC);
            ?>
            <form class="form" action="update-flight.php" method="POST">
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
                            if($aircraft['aircraft_id'] == $flight['aircraft_id'])
                                echo "<option value='" . $aircraft['aircraft_id'] . "' selected>" . $aircraft['name'] . "</option>";
                            else
                                echo "<option value='" . $aircraft['aircraft_id'] . "'>" . $aircraft['name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <input type="hidden" name="flight_id" value="<?=$_GET['flight_id']?>">
                <div class="form-group my-4">

                    <label>Departure Location</label>
                    <input type="text" name="dep_location" class="form-control" aria-describedby="" value="<?=$flight['dep_location']?>">
                </div>
                <div class="form-group my-4">
                    <label>Arrival Location</label>
                    <input type="text" name="arrival_location" class="form-control" aria-describedby="" value="<?=$flight['arrival_location']?>">
                </div>
                <div class="form-group my-4">
                    <label>Departure Time</label>
                    <input type="datetime-local" name="dep_time" class="form-control" aria-describedby="" value="<?=$flight['dep_time']?>">
                </div>
                <div class="form-group my-4">
                    <label>Arrival Time</label>
                    <input type="datetime-local" name="arrival_time" class="form-control" aria-describedby="" value="<?=$flight['arrival_time']?>">
                </div>

                <div class="form-group my-4 position-relative">
                    <label>Flight Price</label>
                    <input type="number" name="price" class="form-control" value="<?=$flight['price']?>">
                </div>
                <div class="form-group my-4">
                    <label>Airline</label>
                    <input type="text" name="airline" class="form-control" value="<?=$flight['airline']?>">
                </div>
                <div class="row justify-content-center">
                    <button type="submit" class="btn button mt-4 w-md-50 w-75"> Update </button>
                </div>
            </form>
        </div>

    </div>

<?php
include $template . 'footer.php';
?>