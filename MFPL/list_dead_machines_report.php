<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "meta.php"; ?>
</head>

<body>

    <?php include "header.php"; ?>
    <!-- ======= Sidebar ======= -->
    <?php include "sidebar.php"; ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>List of Dead Machines</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">List of Dead Machines </li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Dead Machines List</h5>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"></h5>

                            <!-- Table with hoverable rows -->
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">SLN</th>
                                        <th scope="col">Days</th>
                                        <th scope="col">Country</th>
                                        <th scope="col">City</th>
                                        <th scope="col">Street</th>
                                        <!-- <th scope="col">Start Date</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>ABCD1</td>
                                        <td>20 Days</td>
                                        <td>India</td>
                                        <td>Bengaluru</td>
                                        <td>Malleshwaram</td>
                                        <!-- <td>2016-05-25</td> -->
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>ABCD2</td>
                                        <td>10 Days</td>
                                        <td>India</td>
                                        <td>Belagavi</td>
                                        <td>Nehru Nagar</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>ABCD3</td>
                                        <td>15 Days</td>
                                        <td>India</td>
                                        <td>Bengaluru</td>
                                        <td>Jaynagar</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4</th>
                                        <td>ABCD4</td>
                                        <td>14 Days</td>
                                        <td>India</td>
                                        <td>Mumbai</td>
                                        <td>thana</td>
                                    </tr>
                                   
                                </tbody>
                            </table>
                            <!-- End Table with hoverable rows -->

                        </div>
                    </div>



                </div>
            </div>

        </section>

    </main><!-- End #main -->

    <?php include "footer.php"; ?>

</body>

</html>