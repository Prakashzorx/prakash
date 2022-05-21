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
            <h1>Notifications</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Notifications</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Recent Notifications</h5>

                    <div class="card">
                        <div class="card-body">
                            
                            <!-- Active Table -->
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Notification</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Action</th>
                                        <th scope="col">Date Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Product location Changed from Bengaluru to Mumbai</td>
                                        <td>Location Change</td>
                                        <td>Update Location</td>
                                        <td>2016-05-25 02:02</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Product location Changed from Bengaluru to Mumbai</td>
                                        <td>Location Change</td>
                                        <td>Update Location</td>
                                        <td>2016-05-25 02:02</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Product location Changed from Bengaluru to Mumbai</td>
                                        <td>Location Change</td>
                                        <td>Update Location</td>
                                        <td>2016-05-25 02:02</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4</th>
                                        <td>Product location Changed from Bengaluru to Mumbai</td>
                                        <td>Location Change</td>
                                        <td>Update Location</td>
                                        <td>2016-05-25 02:02</td>
                                    </tr>
                                   
                                </tbody>
                            </table>
                            <!-- End Tables without borders -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <?php include "footer.php"; ?>

</body>

</html>