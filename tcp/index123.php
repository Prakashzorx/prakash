<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>TCP data </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css'>
    <link rel='stylesheet' href='https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css'>
    <link rel='stylesheet' href='https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css'>
    <link rel="stylesheet" href="./style.css">

</head>

<body>
    <?php
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "Mukunda@123";
    $dbname = "test";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT * FROM `tcpdata` ORDER BY `id` DESC";
    $Subject = mysqli_query($conn, $sql);
    if ($Subject->num_rows > 0) {

        //print_r($user);exit;

        while ($row = mysqli_fetch_assoc($Subject)) {
            $i++;

           // $rawdata[$i] = $row;
        }
    }
    $i = 0;
    //print_r($rawdata);exit;
    ?>
    <!-- partial:index.partial.html -->
    <div class="container">


        <div class="row">

            <div class="col-12">
                <h3 class="titulo-tabla">Clientes Registrados </h3>


                <table id="ejemplo" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Alarm Type</th>
                            <th>Signal Streanth</th>
                            <th>Wifi Status</th>
                            <th>Tempearature</th>
                            <th> Battery Voltage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($rawdata as $data) {
                            $i++;
                            //print_r($data);exit;
                            $input = $data['rct_timestamp'];
                            // print_r($input);
                            $timestamp = strtotime($input);
                            // print_r($timestamp);
                            $date = date('d/M/Y', $timestamp);
                            $time = date('h:i:s', $timestamp);
                            // print_r($date);
                            //print_r($time);
                            //exit;
                            $at = $data['alarm_type'];
                            if (strcmp($at, 'aa') == 0) {
                                $alarm_type = 'Interval Data';
                            } else
                            if (strcmp($at, '10') == 0) {
                                $alarm_type = 'Low Battery Alarm';
                            } else
                            if (strcmp($at, 'a0') == 0) {
                                $alarm_type = 'Temperature Over Threshold';
                            } else
                            if (strcmp($at, 'a1') == 0) {
                                $alarm_type = 'Temperature sensor abnormal';
                            } else
                            if (strcmp($at, '61') == 0) {
                                $alarm_type = 'External Power Disconnected';
                            }
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo $time; ?></td>
                                <td><?php echo $alarm_type; ?></td>
                                <td><?php echo $data['wifi']; ?></td>
                                <td><?php echo $data['wifistatus']; ?></td>
                                <td><?php echo $data['temp']; ?></td>
                                <td><?php echo $data['battery_voltage']; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                        </tfoot>
                </table>




            </div>
        </div>






    </div>
    <!-- partial -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js'></script>
    <script src='https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js'></script>
    <script src='https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js'></script>
    <script src='https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js'></script>
    <script src='https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js'></script>
    <script src='https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js'></script>
    <script src='https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js'></script>
    <script src='https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js'></script>
    <script src="./script.js"></script>

</body>

</html>