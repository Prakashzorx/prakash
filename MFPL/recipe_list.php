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
            <h1>Recipe List By Day Wise</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Recipe List by Day Wise</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Recipes List</h5>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Search Accourding To</h5>

                            <!-- Floating Labels Form -->
                            <form class="row g-3">

                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="floatingSelect" aria-label="State">
                                            <option selected>..</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                        <label for="floatingSelect">SLN</label>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="floatingSelect" aria-label="State">
                                            <option selected>..</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                        <label for="floatingSelect">Recipe Name</label>
                                    </div>
                                </div> -->
                                <!-- <br> -->

                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="floatingEmail" placeholder="From Date">
                                        <label for="floatingEmail">From Date</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="floatingEmail" placeholder="To Date">
                                        <label for="floatingEmail">To Date</label>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>

                                </div>
                            </form><!-- End floating Labels Form -->

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"></h5>

                            <!-- Table with hoverable rows -->
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Days</th>
                                        <th scope="col">SLN</th>
                                        <th scope="col">Recipe Type</th>
                                        <th scope="col">Recipe Name</th>
                                        <th scope="col">Start Time</th>
                                        <th scope="col">End time</th>
                                        <th scope="col">Error Code</th>
                                        <th scope="col">Final Output</th>
                                        <!-- <th scope="col">Start Date</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>2016-05-25</td>
                                        <td>ZF0GTY2304</td>
                                        <td>noodles</td>
                                        <td>friedrice</td>
                                        <td>12/10/22, 10:10:30</td>
                                        <td>12/10/22, 10:10:40</td>
                                        <td>EX</td>
                                        <td>SUCCESSFULL</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>2016-05-25</td>
                                        <td>ZF0GTY2304</td>
                                        <td>noodles</td>
                                        <td>friedrice</td>
                                        <td>12/10/22, 10:10:30</td>
                                        <td>12/10/22, 10:10:40</td>
                                        <td>EX</td>
                                        <td>SUCCESSFULL</td>
                                    </tr>
                                    <tr>
                                    <th scope="row">3</th>
                                        <td>2016-05-25</td>
                                        <td>ZF0GTY2304</td>
                                        <td>noodles</td>
                                        <td>friedrice</td>
                                        <td>12/10/22, 10:10:30</td>
                                        <td>12/10/22, 10:10:40</td>
                                        <td>EX</td>
                                        <td>SUCCESSFULL</td>
                                    </tr>
                                    <tr>
                                    <th scope="row">4</th>
                                        <td>2016-05-25</td>
                                        <td>ZF0GTY2304</td>
                                        <td>noodles</td>
                                        <td>friedrice</td>
                                        <td>12/10/22, 10:10:30</td>
                                        <td>12/10/22, 10:10:40</td>
                                        <td>EX</td>
                                        <td>SUCCESSFULL</td>
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