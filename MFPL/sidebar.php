<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <?php
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
            $url = "https://";
        else
            $url = "http://";
        // Append the host(domain name, ip) to the URL.   
        $url .= $_SERVER['HTTP_HOST'];

        // Append the requested resource location to the URL   
        $url .= $_SERVER['REQUEST_URI'];

        //echo $url;
        $myFile = pathinfo($url);

        // Show the file name
        //print_r($myFile);
        $string = $myFile['filename'];
        ?>
        <?php
        //echo basename(__FILE__);
        if (strcmp($string, "index") != 0) {
        ?>


            <li class="nav-item">
                <a class="nav-link collapsed" href="index.php">
                    <i class="bi bi-grid"></i>
                    <span>DASHBOARD</span>
                </a>
            </li><!-- End Dashboard Nav -->
        <?php
        } else {
        ?>
            <li class="nav-item">
                <a class="nav-link " href="index.php">
                    <i class="bi bi-grid"></i>
                    <span>DASHBOARD</span>
                </a>
            </li>
        <?php
        }
        ?>
        <?php
        //echo basename(__FILE__);
        if (strcmp($string, "user_management") != 0) {
        ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="user_management.php">
                    <i class="bi bi-people"></i>
                    <span>USER MANAGEMENT</span>
                </a>
            </li><!-- End Dashboard Nav -->
        <?php
        } else {
        ?>
            <li class="nav-item">
                <a class="nav-link " href="user_management.php">
                    <i class="bi bi-people"></i>
                    <span>USER MANAGEMENT</span>
                </a>
            </li>
        <?php
        }
        ?>
        <?php
        //echo basename(__FILE__);
        if (strcmp($string, "brand_registration") != 0) {
        ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="brand_registration.php">
                    <i class="bi bi-tags"></i>
                    <span>BRAND REGISTRATION</span>
                </a>
            </li>
        <?php
        } else {
        ?>
            <li class="nav-item">
                <a class="nav-link " href="brand_registration.php">
                    <i class="bi bi-tags"></i>
                    <span>BRAND REGISTRATION</span>
                </a>
            </li>
        <?php
        }
        ?>
        <?php
        //echo basename(__FILE__);
        if (strcmp($string, "machine_registration") != 0) {
        ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="machine_registration.php">
                    <i class="bi bi-display"></i>
                    <span>MACHINE REGISTRATION</span>
                </a>
            </li>
        <?php
        } else {
        ?>
            <li class="nav-item">
                <a class="nav-link " href="machine_registration.php">
                    <i class="bi bi-display"></i>
                    <span>MACHINE REGISTRATION</span>
                </a>
            </li>
        <?php
        }
        ?>
        <?php
        //echo basename(__FILE__);
        if (strcmp($string, "device_management") != 0) {
        ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="device_management.php">
                    <i class="bi bi-robot"></i>
                    <span>DEVICE MANAGEMENT</span>
                </a>
            </li><!-- End Dashboard Nav -->
        <?php
        } else {
        ?>
            <li class="nav-item">
                <a class="nav-link " href="device_management.php">
                    <i class="bi bi-robot"></i>
                    <span>DEVICE MANAGEMENT</span>
                </a>
            </li>
        <?php
        }
        ?>

        <?php
        //echo basename(__FILE__);
        if (strcmp($string, "recipe_update") != 0) {
        ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="recipe_update.php">
                    <i class="bi bi-display"></i>
                    <span>RECIPE UPDATE</span>
                </a>
            </li>
        <?php
        } else {
        ?>
            <li class="nav-item">
                <a class="nav-link " href="recipe_update.php">
                    <i class="bi bi-display"></i>
                    <span>RECIPE UPDATE</span>
                </a>
            </li>
        <?php
        }
        ?>






        <?php
        $vals = array('TCPRegister', 'TCPManagement', 'tcp_report');
        if (in_array($string, $vals)) {
           // echo basename(__FILE__);

        ?>
            <li class="nav-item">
            <a class="nav-link " data-bs-target="#components-nav1" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>TCP</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav1" class="nav-content  " data-bs-parent="#sidebar-nav">
                    <?php
                    //echo basename(__FILE__);
                    if (strcmp($string, "TCPRegister") == 0) {
                    ?>
                        <li>
                            <a href="TCPRegister.php" class="active">
                                <i class="bi bi-circle"></i><span>TCP Register</span>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li>
                            <a href="TCPRegister.php">
                                <i class="bi bi-circle"></i><span>TCP Register</span>
                            </a>
                        </li>
                    <?php

                    }
                    ?>
                </ul>
                <ul id="components-nav1" class="nav-content  " data-bs-parent="#sidebar-nav">
                    <?php
                    //echo basename(__FILE__);
                    if (strcmp($string, "TCPManagement") == 0) {
                    ?>
                        <li>
                            <a href="TCPManagement.php" class="active">
                                <i class="bi bi-circle"></i><span>TCP Management</span>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li>
                            <a href="TCPManagement.php">
                                <i class="bi bi-circle"></i><span>TCP Management</span>
                            </a>
                        </li>
                    <?php

                    }
                    ?>
                </ul>

                <ul id="components-nav1" class="nav-content  " data-bs-parent="#sidebar-nav">
                    <?php
                    //echo basename(__FILE__);
                    if (strcmp($string, "tcp_report") == 0) {
                    ?>
                        <li>
                            <a href="tcp_report.php" class="active">
                                <i class="bi bi-circle"></i><span>TCP Report</span>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li>
                            <a href="tcp_report.php">
                                <i class="bi bi-circle"></i><span>TCP Report</span>
                            </a>
                        </li>
                    <?php

                    }
                    ?>
                </ul>
            </li>
        <?php
        } else {
        ?>
        
            <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav1" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>TCP</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav1" class="nav-content collapse  " data-bs-parent="#sidebar-nav">
                    <?php
                    //echo basename(__FILE__);
                    if (strcmp($string, "TCPRegister") == 0) {
                    ?>
                        <li>
                            <a href="TCPRegister.php" class="active">
                                <i class="bi bi-circle"></i><span>TCP Register</span>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li>
                            <a href="TCPRegister.php">
                                <i class="bi bi-circle"></i><span>TCP Register</span>
                            </a>
                        </li>
                    <?php

                    }
                    ?>
                </ul>


                <ul id="components-nav1" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <?php
                    //echo basename(__FILE__);
                    if (strcmp($string, "TCPManagement") == 0) {
                    ?>
                        <li>
                            <a href="TCPManagement.php" class="active">
                                <i class="bi bi-circle"></i><span>TCP Management</span>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li>
                            <a href="TCPManagement.php">
                                <i class="bi bi-circle"></i><span>TCP Management</span>
                            </a>
                        </li>
                    <?php

                    }
                    ?>
                </ul>


                <ul id="components-nav1" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <?php
                    //echo basename(__FILE__);
                    if (strcmp($string, "tcp_report") == 0) {
                    ?>
                        <li>
                            <a href="tcp_report.php" class="active">
                                <i class="bi bi-circle"></i><span>TCP Report</span>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li>
                            <a href="tcp_report.php">
                                <i class="bi bi-circle"></i><span>TCP Report</span>
                            </a>
                        </li>
                    <?php

                    }
                    ?>
                </ul>
            </li>
        <?php
        }
        ?>

        <?php
        //echo basename(__FILE__);
        $vals = array('recipe_count_report', 'rcbrandwise', 'most_selling_recipe', 'live_machine_report', 'dead_machines_report', 'category_count', 'error_count', 'maintainance_report', 'failure_count', 'recipe_process');
        if (in_array($string, $vals)) {
            //execute code here
            // }
            //if (strcmp($string, "#") != 0) {
        ?>
            <li class="nav-item">
                <a class="nav-link " data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>REPORTS</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content  " data-bs-parent="#sidebar-nav">
                    <?php
                    //echo basename(__FILE__);
                    if (strcmp($string, "recipe_count_report") == 0) {
                    ?>
                        <li>
                            <a href="recipe_count_report.php" class="active">
                                <i class="bi bi-circle"></i><span>Recipe Count</span>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li>
                            <a href="recipe_count_report.php">
                                <i class="bi bi-circle"></i><span>Recipe Count</span>
                            </a>
                        </li>
                    <?php

                    }
                    ?>
                    <?php
                    //echo basename(__FILE__);
                    if (strcmp($string, "rcbrandwise") == 0) {
                    ?>
                        <li>
                            <a href="rcbrandwise.php" class="active">
                                <i class="bi bi-circle active"></i><span>Overall Recipe Count </span>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li>
                            <a href="rcbrandwise.php">
                                <i class="bi bi-circle"></i><span>Overall Recipe Count </span>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    //echo basename(__FILE__);
                    if (strcmp($string, "most_selling_recipe") == 0) {
                    ?>
                        <li>
                            <a href="most_selling_recipe.php" class="active">
                                <i class="bi bi-circle active"></i><span>Most Selling Recipe</span>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li>
                            <a href="most_selling_recipe.php">
                                <i class="bi bi-circle"></i><span>Most Selling Recipe </span>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    //echo basename(__FILE__);
                    if (strcmp($string, "live_machine_report") == 0) {
                    ?>
                        <li>
                            <a href="live_machine_report.php" class="active">
                                <i class="bi bi-circle active"></i><span>Live Machines</span>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li>
                            <a href="live_machine_report.php">
                                <i class="bi bi-circle"></i><span>Live Machines</span>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    //echo basename(__FILE__);
                    if (strcmp($string, "dead_machines_report") == 0) {
                    ?>
                        <li>
                            <a href="dead_machines_report.php" class="active">
                                <i class="bi bi-circle active"></i><span>Offline Machines</span>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li>
                            <a href="dead_machines_report.php">
                                <i class="bi bi-circle"></i><span>Offline Machines</span>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    //echo basename(__FILE__);
                    if (strcmp($string, "category_count") == 0) {
                    ?>
                        <li>
                            <a href="category_count.php" class="active">
                                <i class="bi bi-circle active"></i><span>Category Count</span>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li>
                            <a href="category_count.php">
                                <i class="bi bi-circle"></i><span>Category Count</span>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    //echo basename(__FILE__);
                    if (strcmp($string, "error_count") == 0) {
                    ?>
                        <li>
                            <a href="error_count.php" class="active">
                                <i class="bi bi-circle active"></i><span>Error Count</span>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li>
                            <a href="error_count.php">
                                <i class="bi bi-circle"></i><span>Error Count</span>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    //echo basename(__FILE__);
                    if (strcmp($string, "maintainance_report") == 0) {
                    ?>
                        <li>
                            <a href="maintainance_report.php" class="active">
                                <i class="bi bi-circle active"></i><span>Maintainance Report</span>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li>
                            <a href="maintainance_report.php">
                                <i class="bi bi-circle"></i><span>Maintainance Report</span>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    //echo basename(__FILE__);
                    if (strcmp($string, "failure_count") == 0) {
                    ?>
                        <li>
                            <a href="failure_count.php" class="active">
                                <i class="bi bi-circle active"></i><span>Failure Count</span>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li>
                            <a href="failure_count.php">
                                <i class="bi bi-circle"></i><span>Failure Count</span>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    //echo basename(__FILE__);
                    if (strcmp($string, "recipe_process") == 0) {
                    ?>
                        <li>
                            <a href="recipe_process.php" class="active">
                                <i class="bi bi-circle"></i><span>Recipe Process Report</span>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li>
                            <a href="recipe_process.php">
                                <i class="bi bi-circle"></i><span>Recipe Process Report</span>
                            </a>
                        </li>
                    <?php

                    }
                    ?>
                    <!-- <?php
                    //echo basename(__FILE__);
                    // if (strcmp($string, "tcp_report") == 0) {
                    // ?>
                        <li>
                            <a href="tcp_report.php" class="active">
                                <i class="bi bi-circle"></i><span>TCP Report</span>
                            </a>
                        </li>
                    <?php
                    //} else {
                    ?>
                        <li>
                            <a href="tcp_report.php">
                                <i class="bi bi-circle"></i><span>TCP Report</span>
                            </a>
                        </li>
                    <?php

                   // }
                    ?> -->
                    <!-- <li>
                    <a href="list_dead_machines_report.php">
                        <i class="bi bi-circle"></i><span>List of Dead Machines</span>
                    </a>
                </li>
                <li>
                    <a href="recipe_list.php">
                        <i class="bi bi-circle"></i><span>Recipe List By SLN</span>
                    </a>
                </li> -->

                </ul>
            </li>
        <?php
        } else {
        ?>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>REPORTS</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <?php
                    //echo basename(__FILE__);
                    if (strcmp($string, "recipe_count_report") == 0) {
                    ?>
                        <li>
                            <a href="recipe_count_report.php" class="active">
                                <i class="bi bi-circle"></i><span>Recipe Count</span>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li>
                            <a href="recipe_count_report.php">
                                <i class="bi bi-circle"></i><span>Recipe Count</span>
                            </a>
                        </li>
                    <?php

                    }
                    ?>
                    <?php
                    //echo basename(__FILE__);
                    if (strcmp($string, "rcbrandwise") == 0) {
                    ?>
                        <li>
                            <a href="rcbrandwise.php" class="active">
                                <i class="bi bi-circle active"></i><span>Overall Recipe Count </span>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li>
                            <a href="rcbrandwise.php">
                                <i class="bi bi-circle"></i><span>Overall Recipe Count </span>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    //echo basename(__FILE__);
                    if (strcmp($string, "most_selling_recipe") == 0) {
                    ?>
                        <li>
                            <a href="most_selling_recipe.php" class="active">
                                <i class="bi bi-circle active"></i><span>Most Selling Recipe</span>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li>
                            <a href="most_selling_recipe.php">
                                <i class="bi bi-circle"></i><span>Most Selling Recipe </span>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    //echo basename(__FILE__);
                    if (strcmp($string, "live_machine_report") == 0) {
                    ?>
                        <li>
                            <a href="live_machine_report.php" class="active">
                                <i class="bi bi-circle active"></i><span>Live Machines</span>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li>
                            <a href="live_machine_report.php">
                                <i class="bi bi-circle"></i><span>Live Machines</span>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    //echo basename(__FILE__);
                    if (strcmp($string, "dead_machines_report") == 0) {
                    ?>
                        <li>
                            <a href="dead_machines_report.php" class="active">
                                <i class="bi bi-circle active"></i><span>Offline Machines</span>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li>
                            <a href="dead_machines_report.php">
                                <i class="bi bi-circle"></i><span>Offline Machines</span>
                            </a>
                        </li>
                    <?php
                    }
                    ?>

                    <?php
                    //echo basename(__FILE__);
                    if (strcmp($string, "category_count") == 0) {
                    ?>
                        <li>
                            <a href="category_count.php" class="active">
                                <i class="bi bi-circle active"></i><span>Category Count</span>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li>
                            <a href="category_count.php">
                                <i class="bi bi-circle"></i><span>Category Count</span>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    //echo basename(__FILE__);
                    if (strcmp($string, "error_count") == 0) {
                    ?>
                        <li>
                            <a href="error_count.php" class="active">
                                <i class="bi bi-circle active"></i><span>Error Count</span>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li>
                            <a href="error_count.php">
                                <i class="bi bi-circle"></i><span>Error Count</span>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    //echo basename(__FILE__);
                    if (strcmp($string, "maintainance_report") == 0) {
                    ?>
                        <li>
                            <a href="maintainance_report.php" class="active">
                                <i class="bi bi-circle active"></i><span>Maintainance Report</span>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li>
                            <a href="maintainance_report.php">
                                <i class="bi bi-circle"></i><span>Maintainance Report</span>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    //echo basename(__FILE__);
                    if (strcmp($string, "failure_count") == 0) {
                    ?>
                        <li>
                            <a href="failure_count.php" class="active">
                                <i class="bi bi-circle active"></i><span>Failure Count</span>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li>
                            <a href="failure_count.php">
                                <i class="bi bi-circle"></i><span>Failure Count</span>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    //echo basename(__FILE__);
                    if (strcmp($string, "recipe_process") == 0) {
                    ?>
                        <li>
                            <a href="recipe_process.php" class="active">
                                <i class="bi bi-circle"></i><span>Recipe Process Report</span>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li>
                            <a href="recipe_process.php">
                                <i class="bi bi-circle"></i><span>Recipe Process Report</span>
                            </a>
                        </li>
                    <?php

                    }
                    ?>
                    <?php
                    //echo basename(__FILE__);
                   // if (strcmp($string, "tcp_report") == 0) {
                    ?>
                        <!-- <li>
                            <a href="tcp_report.php" class="active">
                                <i class="bi bi-circle"></i><span>TCP Report</span>
                            </a>
                        </li> -->
                    <?php
                   // } else {
                    ?>
                        <!-- <li>
                            <a href="tcp_report.php">
                                <i class="bi bi-circle"></i><span>TCP Report</span>
                            </a>
                        </li> -->
                    <?php

                   // }
                    ?>

                </ul>
            </li>
        <?php
        }
        ?>

        <!-- End Components Nav -->
        <!-- 
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Forms</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="forms-elements.html">
              <i class="bi bi-circle"></i><span>Form Elements</span>
            </a>
          </li>
          <li>
            <a href="forms-layouts.html">
              <i class="bi bi-circle"></i><span>Form Layouts</span>
            </a>
          </li>
          <li>
            <a href="forms-editors.html">
              <i class="bi bi-circle"></i><span>Form Editors</span>
            </a>
          </li>
          <li>
            <a href="forms-validation.html">
              <i class="bi bi-circle"></i><span>Form Validation</span>
            </a>
          </li>
        </ul>
      </li> -->
        <!-- End Forms Nav -->


    </ul>

</aside><!-- End Sidebar-->