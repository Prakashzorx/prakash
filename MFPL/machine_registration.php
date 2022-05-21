<?php
require_once 'controller/functions.php';
//Start the session.
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "meta.php"; ?>
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>

<body>

    <?php include "header.php"; ?>
    <!-- ======= Sidebar ======= -->
    <?php include "sidebar.php"; ?>
    <?php include "functions.php"; ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Machine Registration</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Machine Registration</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">

            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <button style="float:right;margin-top:15px;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">
                                Add Machine Type
                            </button>
                            <div class="modal fade" id="verticalycentered" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">Add Machine Type</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <!-- Floating Labels Form -->
                                            <form class="row g-3" id="ptype" action="">


                                                <div class="col-md-12">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" autocomplete="off">
                                                        <label for="revision">Product Name</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="revision" name="revision" placeholder="Phone" autocomplete="off">
                                                        <label for="revision">Revision</label>
                                                    </div>
                                                </div>


                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary" id="submit" name="submit">Submit</button>

                                                </div>
                                            </form>



                                        </div>



                                    </div>
                                </div>
                            </div><!-- End Vertically centered Modal-->
                        </div>
                    </div>
                    <!-- Bordered Tabs Justified -->
                    <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-home" type="button" role="tab" aria-controls="home" aria-selected="true">Register</button>
                        </li>
                        <!-- <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Store</button>
                        </li> -->
                        <!--<li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Store</button>
                        </li> -->
                    </ul>
                    <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                        <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel" aria-labelledby="home-tab">

                            <div class="col-lg-12">

                                <div class="card">

                                    <div class="card-body">
                                        <!-- Vertically centered Modal -->
                                        <div class="row">

                                        </div>
                                        <!-- </div>
                                </div>
                            </div>
                            <div class="col-lg-12">

                                <div class="card">

                                    <div class="card-body"> -->
                                        <div class="col-lg-12">
                                            <h5 class="card-title"></h5>
                                            <form class="row g-3" id="addmachine" action="">


                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="name" name="name" autocomplete="off" placeholder="Your Name" required>
                                                        <label for="floatingName">Mac ID  <span style="color:red">*</span></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <select class="form-select" id="ptypeid" aria-label="State" name="ptypeid" placeholder="Machine Type" required>
                                                            <option selected> </option>
                                                            <?php
                                                            $ptypes = getProductTypes();
                                                            foreach ($ptypes as $ptype) {
                                                                //print_r($ptype['name']);
                                                            ?>
                                                                <option value="<?php echo $ptype['id']; ?>"><?php echo $ptype['name'] . " " . $ptype['version']; ?></option>
                                                            <?php
                                                            }
                                                            ?>


                                                        </select>
                                                        <label for="floatingSelect">Machine Type <span style="color:red">*</span></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="macid" name="macid" autocomplete="off" placeholder="Mac ID" maxlength="20" required>
                                                        <label for="floatingName">Machine Number<span style="color:red">*</span></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="sr" name="sr" autocomplete="off" placeholder="Software Revision" maxlength="20" required>
                                                        <label for="floatingName">Software Revision <span style="color:red">*</span></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="mainboard" name="mainboard" autocomplete="off" placeholder="Main Board" maxlength="20" required>
                                                        <label for="floatingName">Main Board <span style="color:red">*</span></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="date" class="form-control" id="manufacturedate" name="manufacturedate" autocomplete="off" min="2021-12-01" max="<?= date('Y-m-d'); ?>" placeholder="PINCODE" required>
                                                        <label for="floatingName">manufacture Date <span style="color:red">*</span></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="date" class="form-control" id="dipatchedate" name="dipatchedate" autocomplete="off" max="<?= date('Y-m-d'); ?>" placeholder="Your Name">
                                                        <label for="floatingName">Dispatche Date</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="date" class="form-control" id="istaldate" name="instaldate" autocomplete="off" max="<?= date('Y-m-d'); ?>" placeholder="PINCODE">
                                                        <label for="floatingName">Installation Date</label>
                                                    </div>
                                                </div>



                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-lg-12">
                                <!-- <div class="card">
                                    <div class="card-body"> -->
                                <h5 class="card-title"></h5>

                                <!-- Bordered Tabs -->
                                <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Machine List</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Update List</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Delete List</button>
                                    </li>
                                </ul>
                                <div class="tab-content pt-2" id="borderedTabContent">
                                    <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Machine List</h5>


                                                <!-- Table with stripped rows -->
                                                <table id="machinelist" class="table datatable display nowrap" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Action</th>
                                                            <th scope="col">Machine Type</th>
                                                            <th scope="col">Mac ID</th>
                                                            <!--                                                    
                                                    <th scope="col">Mac ID</th>
                                                    <th scope="col">Software Revision</th>
                                                    <th scope="col">Main Board</th> -->
                                                            <th scope="col">Manf. Date</th>
                                                            <th scope="col">Dispatche date</th>
                                                            <th scope="col">Instal. date</th>
                                                            <!-- <th scope="col">Action</th> -->
                                                            <!-- <th scope="col">Action</th> -->
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php
                                                        $machines = getMachines();
                                                        $i = 0;
                                                        foreach ($machines as $machine) {
                                                            $i++;
                                                            //print_r($machine);
                                                            $mid = $machine['ptype_id'];
                                                            $ptype = getptype($mid);
                                                            //print_r($ptype);
                                                        ?>
                                                            <tr>
                                                                <th scope="row"><?php echo $i; ?></th>
                                                                <td><button type="submit" class="btn btn-success" onclick="viewmodel(<?php echo $machine['id'];
                                                                                                                                        ?>)"><i class="far fa-edit"></i></button></td>
                                                                <td><?php echo  $ptype['name'] . " " . $ptype['version']; ?></td>
                                                                <td><?php echo  $machine['name']; ?></td>
                                                                <td><?php echo  $machine['manufacturedate']; ?></td>
                                                                <td><?php echo  $machine['dipatchedate']; ?></td>
                                                                <td><?php echo  $machine['instaldate']; ?></td>
                                                                <td style="display:none"><?php echo  $machine['id']; ?></td>
                                                                <td style="display:none"><?php echo  $machine['mac_id']; ?></td>
                                                                <td style="display:none"><?php echo  $machine['sr']; ?></td>
                                                                <td style="display:none"><?php echo  $machine['mainboard']; ?></td>
                                                                <td style="display:none"><?php echo  $machine['ptype_id']; ?></td>
                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Machine List</h5>


                                                <!-- Table with stripped rows -->
                                                <table id="machinelist" class="table datatable display nowrap" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>

                                                            <th scope="col">Machine Type</th>
                                                            <th scope="col">Mac ID</th>
                                                            <th scope="col">Manf._Date</th>
                                                            <th scope="col">Dispatche_date</th>
                                                            <th scope="col">Instal._date</th>
                                                            <th scope="col">Machine Number</th>
                                                            <th scope="col">Software Revision</th>
                                                            <th scope="col">Main Board</th>
                                                            <th scope="col">Reason</th>
                                                            <th scope="col">Updated by</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php
                                                        $machines = getMachinesupdate();
                                                        $i = 0;
                                                        foreach ($machines as $machine) {
                                                            if ($machine['record'] == 1) {
                                                                $i++;
                                                                //print_r($machine);
                                                                $mid = $machine['ptype_id'];
                                                                $ptype = getptype($mid);
                                                                //print_r($ptype);
                                                        ?>
                                                                <tr>
                                                                    <th scope="row"><?php echo $i; ?></th>

                                                                    <td><?php echo  $ptype['name'] . " " . $ptype['version']; ?></td>
                                                                    <td><?php echo  $machine['name']; ?></td>
                                                                    <td><?php echo  $machine['manufacturedate']; ?></td>
                                                                    <td><?php echo  $machine['dipatchedate']; ?></td>
                                                                    <td><?php echo  $machine['instaldate']; ?></td>

                                                                    <td><?php echo  $machine['mac_id']; ?></td>
                                                                    <td><?php echo  $machine['sr']; ?></td>
                                                                    <td><?php echo  $machine['mainboard']; ?></td>
                                                                    <td><?php echo  $machine['reason']; ?></td>
                                                                    <td><?php echo  $machine['person']; ?></td>

                                                                </tr>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="bordered-contact" role="tabpanel" aria-labelledby="contact-tab">
                                    <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Machine List</h5>


                                                <!-- Table with stripped rows -->
                                                <table id="machinelist" class="table datatable display nowrap" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>

                                                            <th scope="col">Machine Type</th>
                                                            <th scope="col">Mac ID</th>
                                                            <th scope="col">Manf._Date</th>
                                                            <th scope="col">Dispatche_date</th>
                                                            <th scope="col">Instal._date</th>
                                                            <th scope="col">Machine Number</th>
                                                            <th scope="col">Software Revision</th>
                                                            <th scope="col">Main Board</th>
                                                            <th scope="col">Reason</th>
                                                            <th scope="col">Updated by</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php
                                                        $machines = getMachinesupdate();
                                                        $i = 0;
                                                        foreach ($machines as $machine) {
                                                            if ($machine['record'] == 2) {
                                                                $i++;
                                                                //print_r($machine);
                                                                $mid = $machine['ptype_id'];
                                                                $ptype = getptype($mid);
                                                                //print_r($ptype);
                                                        ?>
                                                                <tr>
                                                                    <th scope="row"><?php echo $i; ?></th>

                                                                    <td><?php echo  $ptype['name'] . " " . $ptype['version']; ?></td>
                                                                    <td><?php echo  $machine['name']; ?></td>
                                                                    <td><?php echo  $machine['manufacturedate']; ?></td>
                                                                    <td><?php echo  $machine['dipatchedate']; ?></td>
                                                                    <td><?php echo  $machine['instaldate']; ?></td>

                                                                    <td><?php echo  $machine['mac_id']; ?></td>
                                                                    <td><?php echo  $machine['sr']; ?></td>
                                                                    <td><?php echo  $machine['mainboard']; ?></td>
                                                                    <td><?php echo  $machine['reason']; ?></td>
                                                                    <td><?php echo  $machine['person']; ?></td>

                                                                </tr>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- End Bordered Tabs -->

                                <!-- </div>
                                </div> -->

                            </div>
                        </div>
                    </div><!-- End Bordered Tabs Justified -->
                </div>
            </div>
            <div class="modal fade" id="verticalycentered123" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Machine Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="storehome-tab" data-bs-toggle="tab" data-bs-target="#bordered-storehome" type="button" role="tab" aria-controls="storehome" aria-selected="true">View</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="storeedit-tab" data-bs-toggle="tab" data-bs-target="#bordered-storeedit" type="button" role="tab" aria-controls="storeedit" aria-selected="false">Edit</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="storedelete-tab" data-bs-toggle="tab" data-bs-target="#bordered-storedelete" type="button" role="tab" aria-controls="storedelete" aria-selected="false">Delete</button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2" id="borderedTabContent">
                                <div class="tab-pane fade show active" id="bordered-storehome" role="tabpanel" aria-labelledby="storehome-tab">
                                    <?php
                                    //$single_brand = getBrand($id);
                                    //print_r($single_brand);
                                    ?>

                                    <form class="row g-3" id="" action="">


                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="name1" name="name" autocomplete="off" placeholder="Your Name" readonly>
                                                <label for="floatingName">Mac ID</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="machinetype1" name="name" autocomplete="off" placeholder="Your Name" readonly>
                                                <label for="floatingSelect">Machine Type</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="macid1" name="macid" autocomplete="off" placeholder="Your Name" readonly>
                                                <label for="floatingName">Machine Number</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="sr1" name="sr" autocomplete="off" placeholder="PINCODE" readonly>
                                                <label for="floatingName">Software Revsion</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="mainboard1" name="mainboard" autocomplete="off" placeholder="Your Name" readonly>
                                                <label for="floatingName">Main Board</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" id="manufacturedate1" name="manufacturedate" autocomplete="off" placeholder="PINCODE" readonly>
                                                <label for="floatingName">manufacture Date</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" id="dipatchedate1" name="dipatchedate" autocomplete="off" placeholder="Your Name" readonly>
                                                <label for="floatingName">Dispatche Date</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" id="istaldate1" name="instaldate" autocomplete="off" placeholder="PINCODE" readonly>
                                                <label for="floatingName">Installation Date</label>
                                            </div>
                                        </div>



                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">close</button>

                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="bordered-storeedit" role="tabpanel" aria-labelledby="storeedit-tab">
                                    <?php
                                    //$single_brand = getBrand($row['id']);
                                    //print_r($single_brand);
                                    ?>

                                    <form class="row g-3" id="editmachine" action="">

                                        <input type="hidden" class="form-control" id="id2" name="id" autocomplete="off" placeholder="Your Name">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="name2" name="name" autocomplete="off" placeholder="Your Name" readonly>
                                                <label for="floatingName">Mac ID</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="ptypeid2" aria-label="State" name="ptypeid">
                                                    <option selected> </option>
                                                    <?php
                                                    $ptypes = getProductTypes();
                                                    foreach ($ptypes as $ptype) {
                                                        //print_r($ptype['name']);
                                                    ?>
                                                        <option value="<?php echo $ptype['id']; ?>"><?php echo $ptype['name'] . " " . $ptype['version']; ?></option>
                                                    <?php
                                                    }
                                                    ?>


                                                </select>
                                                <label for="floatingSelect">Machine Type</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="macid2" name="macid" autocomplete="off" placeholder="Your Name" required>
                                                <label for="floatingName">Machine Number</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="sr2" name="sr" autocomplete="off" placeholder="PINCODE" required>
                                                <label for="floatingName">Software Revsion</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="mainboard2" name="mainboard" autocomplete="off" placeholder="Your Name" required>
                                                <label for="floatingName">Main Board</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" id="manufacturedate2" name="manufacturedate" autocomplete="off" min="2021-12-01" max=<?= date('Y-m-d'); ?> placeholder="PINCODE" required>
                                                <label for="floatingName">manufacture Date</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" id="dipatchedate2" name="dipatchedate" autocomplete="off" max=<?= date('Y-m-d'); ?> placeholder="Your Name">
                                                <label for="floatingName">Dispatche Date</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" id="istaldate2" name="instaldate" autocomplete="off" max=<?= date('Y-m-d'); ?> placeholder="PINCODE">
                                                <label for="floatingName">Installation Date</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="reason" name="reason" autocomplete="off" placeholder="" required>
                                                <label for="floatingName">Reason to Update <sup style="color:red"> *</sup></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="updateby" name="updateby" autocomplete="off" placeholder="" required>
                                                <label for="floatingName">Updating By <sup style="color:red"> *</sup></label>
                                            </div>
                                        </div>


                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">submit</button>

                                        </div>
                                    </form>

                                </div>
                                <div class="tab-pane fade" id="bordered-storedelete" role="tabpanel" aria-labelledby="storedelete-tab">

                                    <form class="row g-3" id="deletemachine">

                                        <input type="hidden" class="form-control" id="id3" name="id" autocomplete="off" placeholder="Your Name">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="name3" name="name" autocomplete="off" placeholder="Your Name" readonly>
                                                <label for="floatingName">Mac ID</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="reason3" name="reason" placeholder="Mac Id">
                                                <label for="floatingEmail">Reason to Remove <sup style="color:red"> *</sup></label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="personby3" name="person" placeholder="Mac Id">
                                                <label for="floatingEmail">Removing By <sup style="color:red"> *</sup></label>
                                            </div>
                                        </div>


                                        <div class="text-center">
                                            <button type="submit" class="btn btn-danger">Delete</button>

                                        </div>
                                    </form>

                                </div>
                            </div>


                        </div>

                    </div>
                </div>
            </div>

        </section>

    </main><!-- End #main -->

    <?php include "footer.php"; ?>

    <script>
        // function myFunction() {
        //     var minToDate = document.getElementById("manufacturedate").value;
        //     document.getElementById("dipatchedate").setAttribute("min", minToDate);
        // }
        let fDate = document.querySelector('#manufacturedate');
        let tDate = document.querySelector('#dipatchedate');

        fDate.addEventListener('change', function() {
            tDate.min = this.value;
        });

        let fDate1 = document.querySelector('#dipatchedate');
        let tDate1 = document.querySelector('#istaldate');

        fDate1.addEventListener('change', function() {
            tDate1.min = this.value;
        });

        let fDate2 = document.querySelector('#manufacturedate2');
        let tDate2 = document.querySelector('#dipatchedate2');

        fDate2.addEventListener('change', function() {
            tDate2.min = this.value;
        });

        let fDate3 = document.querySelector('#dipatchedate2');
        let tDate3 = document.querySelector('#istaldate2');

        fDate3.addEventListener('change', function() {
            tDate3.min = this.value;
        });



        $(document).ready(function(e) {
            $("#ptype").on('submit', (function(e) {
                e.preventDefault();

                $.ajax({
                    url: "model/add_ptype.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        var obj = jQuery.parseJSON(data);
                        var string1 = obj.error;
                        var output = obj.error_msg;

                        if (obj.error == 0) {
                            Swal.fire({
                                icon: 'success',
                                text: output,
                                timer: 1500

                            })

                            setTimeout(function() {
                                window.location.href = 'machine_registration.php';
                                $("#userlist").load(window.location.href + " #userlist");
                            }, 2000);


                        } else {

                            Swal.fire({
                                icon: 'error',
                                text: output,
                                timer: 1500

                            })
                        }
                    },
                    error: function() {}

                });

            }));
        });


        $(document).ready(function(e) {
            $("#addmachine").on('submit', (function(e) {
                e.preventDefault();

                $.ajax({
                    url: "model/add_machine.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        var obj = jQuery.parseJSON(data);
                        var string1 = obj.error;
                        var output = obj.error_msg;

                        if (obj.error == 0) {
                            Swal.fire({
                                icon: 'success',
                                text: output,
                                timer: 1500

                            })
                            setTimeout(function() {
                                window.location.href = 'machine_registration.php';
                                $("#machinelist").load(window.location.href + " #machinelist");
                            }, 1000);


                        } else {

                            Swal.fire({
                                icon: 'error',
                                text: output,
                                timer: 1500

                            })

                        }
                    },
                    error: function() {}

                });

            }));
        });

        $(document).ready(function(e) {
            $("#editmachine").on('submit', (function(e) {
                e.preventDefault();

                $.ajax({
                    url: "model/edit_machine.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        var obj = jQuery.parseJSON(data);
                        var string1 = obj.error;
                        var output = obj.error_msg;

                        if (obj.error == 0) {
                            Swal.fire({
                                icon: 'success',
                                text: output,
                                timer: 1500

                            })
                            setTimeout(function() {
                                window.location.href = 'machine_registration.php';
                                $("#machinelist").load(window.location.href + " #machinelist");
                            }, 2000);


                        } else {

                            Swal.fire({
                                icon: 'error',
                                text: output,
                                timer: 1500

                            })

                        }
                    },
                    error: function() {}

                });

            }));
        });

        $(document).ready(function(e) {
            $("#deletemachine").on('submit', (function(e) {
                e.preventDefault();

                $.ajax({
                    url: "model/delete_machine.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        var obj = jQuery.parseJSON(data);
                        var string1 = obj.error;
                        var output = obj.error_msg;

                        if (obj.error == 0) {
                            Swal.fire({
                                icon: 'success',
                                text: output,
                                timer: 3000

                            })

                            setTimeout(function() {
                                window.location.href = 'machine_registration.php';
                                $("#machinelist").load(window.location.href + " #machinelist");
                            }, 2000);


                        } else {

                            Swal.fire({
                                icon: 'error',
                                text: output,
                                timer: 3000

                            })
                        }
                    },
                    error: function() {}

                });

            }));
        });


        // $(' #machinelist tr  td').on('click', function() {
        //     $("#verticalycentered123").modal("show");
        //     $("#machinetype1").val($(this).closest('tr').children()[1].textContent);
        //     $("#name1").val($(this).closest('tr').children()[2].textContent);
        //     $("#manufacturedate1").val($(this).closest('tr').children()[3].textContent);

        //     $("#dipatchedate1").val($(this).closest('tr').children()[4].textContent);
        //     $("#istaldate1").val($(this).closest('tr').children()[5].textContent);
        //     $("#id1").val($(this).closest('tr').children()[6].textContent);
        //     $("#macid1").val($(this).closest('tr').children()[7].textContent);
        //     $("#sr1").val($(this).closest('tr').children()[8].textContent);
        //     $("#mainboard1").val($(this).closest('tr').children()[9].textContent);
        //     $("#ptypeid1").val($(this).closest('tr').children()[10].textContent);

        //     $("#machinetype2").val($(this).closest('tr').children()[1].textContent);
        //     $("#name2").val($(this).closest('tr').children()[2].textContent);
        //     $("#manufacturedate2").val($(this).closest('tr').children()[3].textContent);

        //     $("#dipatchedate2").val($(this).closest('tr').children()[4].textContent);
        //     $("#istaldate2").val($(this).closest('tr').children()[5].textContent);
        //     $("#id2").val($(this).closest('tr').children()[6].textContent);
        //     $("#macid2").val($(this).closest('tr').children()[7].textContent);
        //     $("#sr2").val($(this).closest('tr').children()[8].textContent);
        //     $("#mainboard2").val($(this).closest('tr').children()[9].textContent);
        //     $("#ptypeid2").val($(this).closest('tr').children()[10].textContent);


        //     $("#machinetype3").val($(this).closest('tr').children()[1].textContent);
        //     $("#name3").val($(this).closest('tr').children()[2].textContent);
        //     $("#manufacturedate3").val($(this).closest('tr').children()[3].textContent);

        //     $("#dipatchedate3").val($(this).closest('tr').children()[4].textContent);
        //     $("#istaldate3").val($(this).closest('tr').children()[5].textContent);
        //     $("#id3").val($(this).closest('tr').children()[6].textContent);
        //     $("#macid3").val($(this).closest('tr').children()[7].textContent);
        //     $("#sr3").val($(this).closest('tr').children()[8].textContent);
        //     $("#mainboard3").val($(this).closest('tr').children()[9].textContent);
        //     $("#ptypeid3").val($(this).closest('tr').children()[10].textContent);




        // });

        function viewmodel(mid) {

            $.ajax({
                url: "model/getMachineDetails.php",
                type: "POST",
                data: {
                    id: mid
                },
                cache: false,
                success: function(result) {

                    var obj = jQuery.parseJSON(result);

                    $("#verticalycentered123").modal("show");
                    $("#machinetype1").val(obj['ptype']);
                    $("#name1").val(obj['machinename']);
                    $("#manufacturedate1").val(obj['manufacturedate']);

                    $("#dipatchedate1").val(obj['dipatchedate']);
                    $("#istaldate1").val(obj['instaldate']);
                    $("#id1").val(obj['mid']);
                    $("#macid1").val(obj['mac_id']);
                    $("#sr1").val(obj['sr']);
                    $("#mainboard1").val(obj['mainboard']);
                    $("#ptypeid1").val(obj['ptypeid']);


                    //$("#machinetype2").val(obj['ptype']);
                    $("#name2").val(obj['machinename']);
                    $("#manufacturedate2").val(obj['manufacturedate']);

                    $("#dipatchedate2").val(obj['dipatchedate']);
                    $("#istaldate2").val(obj['instaldate']);
                    $("#id2").val(obj['mid']);
                    $("#macid2").val(obj['mac_id']);
                    $("#sr2").val(obj['sr']);
                    $("#mainboard2").val(obj['mainboard']);
                    $("#ptypeid2").val(obj['ptypeid']);


                    $("#id3").val(obj['mid']);
                    $("#name3").val(obj['machinename']);

                }

            });

        }
    </script>
</body>

</html>