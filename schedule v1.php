<?php

//Breve comentario para prueba de git

//Generemos un conflicto

//Para pull Request

require('../db/model/available_schedules.php');
$schedules = new Schedule;
$schlist = $schedules->getSchedules();

session_start();

$_SESSION['user'] = 'administrator';
if (isset($_SESSION['message'])) { ?>

    <script>
        alert('<?php echo $_SESSION['message'] ?>');
    </script>

<?php
    unset($_SESSION['message']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Schedule</title>
    <link rel="icon" href="../../icon.png">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">



    <script>
        addEventListener("load", function() {
            var elmnt = document.getElementById("for_tables");
            var height = elmnt.offsetHeight;
            document.body.style.height = height + 'px';
        })
    </script>

    <style>
        :root {
            --padding_body_top: 240px;
        }

        *,
        ::after,
        ::before {
            margin: 0;
            padding: 0;
            box-sizing: content-box;
        }

        body {
            box-sizing: border-box;
            position: relative;
            width: 100%;
            background: linear-gradient(45deg, rgba(38, 172, 210, 1) 0%, rgba(85, 24, 191, 1) 100%);
            background-attachment: fixed;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
            padding-top: var(--padding_body_top);
        }

        a,
        a:hover {
            text-decoration: none;
            cursor: pointer;
            color: #FFF;
        }

        h1 {
            position: absolute;
            top: 60px;
            color: #FFF;
            font-family: 'Montserrat', sans-serif !important;
            text-align: center;
            width: calc(100% - 40px);
            font-size: 50px;
        }

        h4 {
            font-family: 'Montserrat', sans-serif !important;
            background: -webkit-linear-gradient(#fb136e, #541cbe);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 30px;
            text-align: center;
            font-size: 30px;
        }

        input:not([type='submit']):not([type='checkbox']),
        .custform div select {
            height: 35px;
            width: 70%;
            padding-left: 15px;
        }

        input:not([type=submit]):not([type=checkbox]):focus,
        .custform div select:focus,
        textarea {
            outline-color: #F7176E;
        }

        label {
            font-weight: 700;
            display: block;
            width: 100%;
            margin: 20px 0px;
        }

        textarea {
            width: 80%;
            height: 80px;
            resize: none;
            font-size: 16px;
        }

        .upper-btns {
            position: relative;
            width: 100%;
            height: 80px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        #search {
            height: 40px;
            width: 300px;
            border-radius: 20px;
            padding-left: 15px;
            border: none;
        }

        #search:focus {
            outline: none;
            border: none;
        }

        .cusbtn {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 40px;
            color: #FFF;
            width: 200px;
            border-radius: 20px;
            background: linear-gradient(45deg, rgba(37,58,147,1) 0%, rgba(247,23,110,1) 100%);
            font-size: 18px;
            font-weight: 500;
            box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, .3);
            overflow: hidden;
        }

        .cusbtn::before {
            content: "";
            overflow: hidden;
            width: 300px;
            position: absolute;
            top: -50%;
            right: -240px;
            height: 300px;
            background: linear-gradient(45deg, rgba(38,172,210,1) 0%, rgba(37,58,147,1) 100%);
            box-shadow: inset 2px 2px 2px 2px rgba(0, 0, 0, .3);
            transform: rotate(20deg);
            z-index: 1;
        }

        .cusbtn span {
            position: relative;
            z-index: 2;
        }

        .for_tables {
            position: absolute;
            top: calc(var(--padding_body_top) + 80px);
            width: calc(100% - 40px);
            min-width: 1200px;
        }

        .table {
            position: relative;
            border-collapse: collapse;
            font-size: 16px;
            font-weight: 400;
            border: solid #DADADA 3px;
            background: #FFF;
            margin: 0;
            box-shadow: 0px 0px 5px 5px rgba(0, 0, 0, .3);
            color: #FFF;
            background: rgba(0, 0, 0, .7);
        }

        .for_sticky {
            position: sticky;
            top: 0;
            z-index: 10;
            width: 100%;
            min-width: 1200px;
        }

        .sticky-table {
            display: table;
            width: 100%;
            box-shadow: none;
        }

        .table td:not(:first-child),
        .table td:not(:nth-child(2)),
        .table th:not(:first-child) {
            width: 150px !important;
        }

        .table td:first-child {
            width: 80px !important;
            padding: 0;
        }

        .table td:nth-child(2) {
            width: 180px !important;
        }

        .table th,
        .table td {
            border: solid 1px #DADADA;
            word-wrap: break-word;
        }

        .table td {
            height: 40px;
            text-align: center;
        }

        .table tr:first-child,
        .table tr:nth-child(2) {
            background: #26ACD2;
            color: #FFF;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .table tr:nth-child(1),
        .table tr:nth-child(2) {
            background: linear-gradient(45deg, rgba(85, 24, 191, 1) 0%, rgba(38, 172, 210, 1) 100%);
        }

        .table tr:not(:first-child):not(:nth-child(2)):hover {
            position: relative;
            background: linear-gradient(45deg, rgba(38, 172, 210, 1) 0%, rgba(38, 128, 185, 1) 51%, rgba(38, 112, 176, 1) 78%, rgba(38, 97, 168, 1) 98%);
            box-shadow: 2px 2px 5px 5px rgba(0, 0, 0, .5);
            z-index: 200;
            cursor: pointer;
        }

        tr:first-child td {
            font-size: 20px;
            height: 50px !important;
        }

        .behind {
            width: 100%;
            margin-bottom: 30px;
        }

        .behind tr:nth-child(2) {
            border-bottom: solid #DADADA 3px;
        }

        .inside_table {
            width: 100%;
        }

        .emp_selection {
            width: 100px !important;
            height: unset;
            padding: 0;
            border: none;
            background: none;
            box-shadow: none;
            color: #FFF;
            text-align-last: center;
        }

        .emp_selection option {
            color: #000;
            text-align: center;
        }

        .backbtn {
            position: absolute;
            top: 20px;
            right: 20px;
            color: #FFF;
            padding: 10px 25px 10px 20px;
            border-radius: 20px;
            border: none;
            background: linear-gradient(45deg, rgba(37,58,147,1) 0%, rgba(247,23,110,1) 100%);
            font-size: 18px;
            font-weight: 500;
            box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, .3);
            overflow: hidden;
        }

        .backbtn::before {
            content: "";
            overflow: hidden;
            width: 300px;
            position: absolute;
            top: -50%;
            right: -250px;
            height: 300px;
            background: linear-gradient(45deg, rgba(38,172,210,1) 0%, rgba(37,58,147,1) 100%);
            box-shadow: inset 2px 2px 2px 2px rgba(0, 0, 0, .3);
            transform: rotate(20deg);
            z-index: 1;
        }

        .backbtn span {
            position: relative;
            z-index: 2;
        }

        .modal {
            background: rgba(0, 0, 0, .5);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: none;
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-window {
            position: relative;
            display: flex;
            justify-content: center;
            background: #FFF;
            max-width: 300px;
            width: 25%;
            min-width: 250px;
            height: auto;
            padding: 50px;
            border-radius: 5px;
        }

        .closebtn {
            position: absolute;
            top: 0px;
            right: 10px;
            color: #F7176E;
            font-size: 26px;
            font-weight: 800;
            padding: 0;
            margin: 0;
            cursor: pointer;
        }

        .box,
        .box2 {
            display: none;
        }

        .custform {
            width: 100%;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .custform div {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            width: 100%;
            margin-bottom: 20px;
        }

        input[type='submit'] {
            position: relative;
            display: flex;
            align-items: center;
            height: 40px;
            color: #FFF;
            padding: 0px 20px;
            border-radius: 5px;
            border: none;
            background: rgba(247, 23, 110, 1);
            font-size: 18px;
            font-weight: 500;
            margin-top: 30px;
            cursor: pointer;
        }

        .convs {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around
        }

        .conv {
            width: 20%;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .conv span {
            display: inline-block;
            margin-right: 5px;
            width: 20px;
            height: 20px;
            border-radius: 3px;
            margin-right: 20px;
        }

        .info_change {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between !important;
            width: auto !important;
            align-items: center;
            margin-bottom: 30px;
        }

        .separator {
            display: none !important;
        }

        @media screen and (max-width: 400px) {

            body {
                padding: 10px;
                padding-top: 270px;
            }

            h1 {
                font-size: 34px;
                top: 90px;
                width: calc(100% - 20px);
            }

            .cusbtn {
                margin: 30px 0 0 0;
                margin-left: unset;
                order: 1;
            }

            #search {
                order: 2;
                margin-top: 30px;
            }

            .upper-btns {
                height: auto;
                justify-content: center;
            }

            .behind {
                position: relative;
                min-width: 1300px;
            }

            .for_tables {
                position: relative;
                top: unset;
                overflow-x: scroll;
                width: 100%;
                min-width: unset;
                margin-top: 30px;
            }

            .sticky-table {
                display: none;
            }

            .modal-window {
                padding: 10px;
            }

            #emp_name {
                width: 80% !important;
                margin-bottom: 10px !important;
                text-align: center;
                padding-left: 0 !important;
            }

            .info_change {
                display: flex;
                flex-direction: row;
                justify-content: space-around !important;
                width: 80%;
                align-items: center !important;
                margin-bottom: 0px !important;
                height: auto;
                overflow-y: scroll;
            }

            .info_change span {
                font-size: 14px;
            }

            .info_change input {
                width: 80% !important;
                margin-bottom: 5px !important;
                padding-left: 0 !important;
                text-align: center;
            }

            .info_change input:not(:first-child) {
                width: 30% !important;
            }

            .separator {
                width: 100% !important;
            }

        }

        /* Form css*/

        .form-control {
            display: block;
            width: 100%;
            height: calc(1.5em + 0.75rem + 2px);
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        @media (prefers-reduced-motion: reduce) {
            .form-control {
                transition: none;
            }
        }

        .form-control::-ms-expand {
            background-color: transparent;
            border: 0;
        }

        .form-control:focus {
            color: #495057;
            background-color: #fff;
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .form-control::-webkit-input-placeholder {
            color: #fff;
            /*#6c757d*/
            opacity: 1;
            font-weight: 400;
        }

        .form-control::-moz-placeholder {
            color: #fff;
            opacity: 1;
            font-weight: 400;
        }

        .form-control:-ms-input-placeholder {
            color: #fff;
            opacity: 1;
            font-weight: 400;
        }

        .form-control::-ms-input-placeholder {
            color: #fff;
            opacity: 1;
            font-weight: 400;
        }

        .form-control::placeholder {
            color: #fff;
            opacity: 1;
            font-weight: 400;
        }

        .form-control:disabled,
        .form-control[readonly] {
            background-color: #e9ecef;
            opacity: 1;
        }

        select.form-control:focus::-ms-value {
            color: #fff;
            background-color: #fff;
        }

        .form-control-file,
        .form-control-range {
            display: block;
            width: 100%;
        }

        .col-form-label {
            padding-top: calc(0.375rem + 1px);
            padding-bottom: calc(0.375rem + 1px);
            margin-bottom: 0;
            font-size: inherit;
            line-height: 1.5;
        }

        .col-form-label-lg {
            padding-top: calc(0.5rem + 1px);
            padding-bottom: calc(0.5rem + 1px);
            font-size: 1.25rem;
            line-height: 1.5;
        }

        .col-form-label-sm {
            padding-top: calc(0.25rem + 1px);
            padding-bottom: calc(0.25rem + 1px);
            font-size: 0.875rem;
            line-height: 1.5;
        }

        .form-control-plaintext {
            display: block;
            width: 100%;
            padding-top: 0.375rem;
            padding-bottom: 0.375rem;
            margin-bottom: 0;
            line-height: 1.5;
            color: #212529;
            background-color: transparent;
            border: solid transparent;
            border-width: 1px 0;
        }

        .form-control-plaintext.form-control-sm,
        .form-control-plaintext.form-control-lg {
            padding-right: 0;
            padding-left: 0;
        }

        .form-control-sm {
            height: calc(1.5em + 0.5rem + 2px);
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }

        .form-control-lg {
            height: calc(1.5em + 1rem + 2px);
            padding: 0.5rem 1rem;
            font-size: 1.25rem;
            line-height: 1.5;
            border-radius: 0.3rem;
        }

        select.form-control[size],
        select.form-control[multiple] {
            height: auto;
        }

        textarea.form-control {
            height: auto;
        }

        .input-group>.form-control,
        .input-group>.form-control-plaintext,
        .input-group>.custom-select,
        .input-group>.custom-file {
            position: relative;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            width: 1%;
            margin-bottom: 0;
        }

        .input-group>.form-control+.form-control,
        .input-group>.form-control+.custom-select,
        .input-group>.form-control+.custom-file,
        .input-group>.form-control-plaintext+.form-control,
        .input-group>.form-control-plaintext+.custom-select,
        .input-group>.form-control-plaintext+.custom-file,
        .input-group>.custom-select+.form-control,
        .input-group>.custom-select+.custom-select,
        .input-group>.custom-select+.custom-file,
        .input-group>.custom-file+.form-control,
        .input-group>.custom-file+.custom-select,
        .input-group>.custom-file+.custom-file {
            margin-left: -1px;
        }

        .input-group>.form-control:focus,
        .input-group>.custom-select:focus,
        .input-group>.custom-file .custom-file-input:focus~.custom-file-label {
            z-index: 3;
        }

        .input-group>.custom-file .custom-file-input:focus {
            z-index: 4;
        }

        .input-group>.form-control:not(:last-child),
        .input-group>.custom-select:not(:last-child) {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .input-group>.form-control:not(:first-child),
        .input-group>.custom-select:not(:first-child) {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        /* Form css*/
    </style>

</head>

<body>


    <?php
    if ($_SESSION['user'] == 'administrator') { ?>
        <h1>Siete Colinas Soluciones SAS' Schedule Management</h1>
    <?php } else { ?>
        <h1>My Schedule</h1>
    <?php } ?>

    <div class="upper-btns">
        <input type="text" id="search" onkeyup="searchTable()" placeholder="Search employee..." title="Type in a name">
        <?php
        if ($_SESSION['user'] == 'administrator') { ?>
            <!--a onclick="modal_show('m01')" class="cusbtn"><span>Manage schedules</span></a-->
            <a href="dashboard.php" class="cusbtn"><span>Dashboard</span></a>
            <a href="create-schedule.php" class="cusbtn"><span>New schedule</span></a>
        <?php } ?>
        <a href="requestsform.php" class="cusbtn"><span>Requests</span></a>
    </div>

    <?php
        $monday = strtotime("last monday");
        $monday = date('w', $monday) == date('w') ? $monday + 7 * 86400 : $monday;

        $tue = strtotime(date("m/d/y", $monday) . " +1 days");
        $wed = strtotime(date("m/d/y", $monday) . " +2 days");
        $thu = strtotime(date("m/d/y", $monday) . " +3 days");
        $fri = strtotime(date("m/d/y", $monday) . " +4 days");
        $sat = strtotime(date("m/d/y", $monday) . " +5 days");
        $sun = strtotime(date("m/d/y", $monday) . " +6 days");

        $tuesday = date("m/d/y", $tue);
        $wednesday = date("m/d/y", $wed);
        $thursday = date("m/d/y", $thu);
        $friday = date("m/d/y", $fri);
        $saturday = date("m/d/y", $sat);
        $startw = date("m/d/y", $monday);
        $endw = date("m/d/y", $sun);

        $dates_list = [$startw, $tuesday, $wednesday, $thursday, $friday, $saturday, $endw];
    ?>

    <div class="for_sticky">
        <table class="sticky-table table">
            <tr>
                <td colspan="9"><?php echo "$startw - $endw "; ?></td>
            </tr>
            <tr style="height:60px">
                <td>Dep</td>
                <td>Analyst</td>
                <td>
                    <div style="font-size: 14px; font-weight: 100">Monday</div>
                    <div><?php echo $startw ?></div>
                </td>
                <td>
                    <div style="font-size: 14px; font-weight: 100">Thursday</div>
                    <div><?php echo $tuesday ?></div>
                </td>
                <td>
                    <div style="font-size: 14px; font-weight: 100">Wednesday</div>
                    <div><?php echo $wednesday ?></div>
                </td>
                <td>
                    <div style="font-size: 14px; font-weight: 100">Thursday</div>
                    <div><?php echo $thursday ?></div>
                </td>
                <td>
                    <div style="font-size: 14px; font-weight: 100">Friday</div>
                    <div><?php echo $friday ?></div>
                </td>
                <td>
                    <div style="font-size: 14px; font-weight: 100">Saturday</div>
                    <div><?php echo $saturday ?></div>
                </td>
                <td>
                    <div style="font-size: 14px; font-weight: 100">Sunday</div>
                    <div><?php echo $endw ?></div>
                </td>
            </tr>
        </table>
    </div>

    <div class="for_tables" id="for_tables">
        <table class="table behind" id="schedule">
            <tr class="sticky-row">
                <td colspan="9"><?php echo "$startw - $endw "; ?></td>
            </tr>
            <tr style="height:60px">
                <td>Dep</td>
                <td>Analyst</td>
                <td>
                    <div style="font-size: 14px; font-weight: 100">Monday</div>
                    <div><?php echo $startw ?></div>
                </td>
                <td>
                    <div style="font-size: 14px; font-weight: 100">Thursday</div>
                    <div><?php echo $tuesday ?></div>
                </td>
                <td>
                    <div style="font-size: 14px; font-weight: 100">Wednesday</div>
                    <div><?php echo $wednesday ?></div>
                </td>
                <td>
                    <div style="font-size: 14px; font-weight: 100">Thursday</div>
                    <div><?php echo $thursday ?></div>
                </td>
                <td>
                    <div style="font-size: 14px; font-weight: 100">Friday</div>
                    <div><?php echo $friday ?></div>
                </td>
                <td>
                    <div style="font-size: 14px; font-weight: 100">Saturday</div>
                    <div><?php echo $saturday ?></div>
                </td>
                <td>
                    <div style="font-size: 14px; font-weight: 100">Sunday</div>
                    <div><?php echo $endw ?></div>
                </td>
            </tr>

            <?php

            include('../../Inside/DBOH.php');

            $sql = "SELECT id, fullName, department FROM employees WHERE active != 'NO'";
            $stmt = mysqli_query($dBconn, $sql);

            $sql2 = "SELECT date, fullName, department, scheduleReason FROM records INNER JOIN employees ON employees.id=records.employeeId INNER JOIN schedulesReasons ON schedulesReasons.id=records.scheduleId WHERE date BETWEEN '" . date("Y-m-d", strtotime($startw)) . "' AND '" . date("Y-m-d", strtotime($endw)) . "' ORDER BY department, fullName, date";

            $stmt2 = mysqli_query($dBconn, $sql2);

            $dep_schedule = [];

            $possible = ['Day off' => '#CCF5FF', "Medical leave" => '#18ABD1', "Vacations" => '#81D374', "Non-Paid license" => '#FFE98C', "No longer required" => '#ED1A70'];

            $deps_count = ['CS', 'DP', 'UW'];

            while ($row = mysqli_fetch_assoc($stmt)) {

                if (array_key_exists($row['department'],  $dep_schedule) and array_key_exists($row['fullName'], $dep_schedule[$row['department']])) {
                    array_push($dep_schedule[$row['department']][$row['fullName']], []);
                } else {
                    $dep_schedule[$row['department']][$row['fullName']] = [];
                }

                $emp_id[$row['fullName']] = $row['id'];
            }

            while ($row = mysqli_fetch_assoc($stmt2)) {
                array_push($dep_schedule[$row['department']][$row['fullName']], $row['scheduleReason']);
            }

            foreach ($dep_schedule as $dep => $dep_info) {
                if (in_array($dep, $deps_count)) {
                    foreach ($dep_info as $emp => $week) {
                        if (count($week) < 7) {
                            continue;
                        } ?>

                        <tr class="selected-row">
                            <td><?php echo $dep ?></td>
                            <td><?php echo $emp ?></td>

                            <?php
                            for ($i = 0; $i <= 6; $i++) {
                                if (array_key_exists($week[$i], $possible)) { ?>
                                    <td style="font-size: 18px; font-weight:700; background-color: <?php echo $possible[$week[$i]] ?>" onclick="modal_show('m02')">
                                        <select style="font-weight: 700; text-shadow: 2px 1px 2px rgba(0,0,0,1)" id="<?php echo ($emp_id[$emp] . "date" . date("Y-m-d", strtotime($dates_list[$i]))) ?>" class="emp_selection" name="schedule" onchange="changeReason(this.id,'<?php echo $emp ?>','<?php echo $dates_list[$i] ?>',$(this).next(),'#' + this.id + ' option:selected')">
                                            <option selected>OFF</option>
                                            <?php
                                            foreach ($schlist as $id => $schedule) {
                                                if (!(array_key_exists($schedule, $possible))) { ?>
                                                    <option class="understaffed" value="<?php echo $id ?>"><?php echo $schedule ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                        <input type="hidden" value="OFF">
                                    </td>
                                <?php } else { ?>
                                    <td>
                                        <select id="<?php echo ($emp_id[$emp] . "date" . date("Y-m-d", strtotime($dates_list[$i]))) ?>" class="emp_selection" name="schedule" onchange="changeReason(this.id,'<?php echo $emp ?>','<?php echo $dates_list[$i] ?>',$(this).next(),'#' + this.id + ' option:selected')">
                                            <?php
                                            foreach ($schlist as $id => $schedule) {
                                                if ($schedule == $week[$i]) {
                                                    $prev_select = $week[$i];
                                            ?>
                                                    <option value="<?php echo $id ?>" selected><?php echo $schedule ?></option>
                                                <?php } else if (!(array_key_exists($schedule, $possible))) { ?>
                                                    <option class="overbooked" value="<?php echo $id ?>"><?php echo $schedule ?></option>
                                            <?php }
                                            } ?>
                                            <option class="reason-opt" value="off">OFF</option>
                                        </select>
                                        <input type="hidden" value="<?php echo $prev_select ?>">
                                    </td>
                            <?php }
                            } ?>
                            <td hidden="true"><input type="checkbox" id="selected-analyst" class="regular-checkbox"></td>
                        </tr>

                    <?php } ?>
                    <?php }
            }

            foreach ($dep_schedule as $dep => $dep_info) {
                if (!(in_array($dep, $deps_count))) {
                    foreach ($dep_info as $emp => $week) {
                        if (count($week) < 7) {
                            continue;
                        } ?>

                        <tr class="selected-row">
                            <td><?php echo $dep ?></td>
                            <td><?php echo $emp ?></td>

                            <?php
                            for ($i = 0; $i <= 6; $i++) {
                                if (array_key_exists($week[$i], $possible)) { ?>
                                    <td style="font-size: 18px; font-weight:700; background-color: <?php echo $possible[$week[$i]] ?>">
                                        <select style="font-weight: 700; text-shadow: 2px 1px 2px rgba(0,0,0,1)" id="<?php echo ($emp_id[$emp] . "date" . date("Y-m-d", strtotime($dates_list[$i]))) ?>" class="emp_selection" name="schedule" onchange="changeReason(this.id,'<?php echo $emp ?>','<?php echo $dates_list[$i] ?>',$(this).next(),'#' + this.id + ' option:selected')">
                                            <option selected>OFF</option>
                                            <?php
                                            foreach ($schlist as $id => $schedule) {
                                                if (!(array_key_exists($schedule, $possible))) { ?>
                                                    <option class="understaffed" value="<?php echo $id ?>"><?php echo $schedule ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                        <input type="hidden" value="OFF">
                                    </td>
                                <?php } else { ?>
                                    <td>
                                        <select id="<?php echo ($emp_id[$emp] . "date" . date("Y-m-d", strtotime($dates_list[$i]))) ?>" class="emp_selection" name="schedule" onchange="changeReason(this.id,'<?php echo $emp ?>','<?php echo $dates_list[$i] ?>',$(this).next(),'#' + this.id + ' option:selected')">
                                            <?php
                                            foreach ($schlist as $id => $schedule) {
                                                if ($schedule == $week[$i]) {
                                                    $prev_select = $week[$i];
                                            ?>
                                                    <option value="<?php echo $id ?>" selected><?php echo $schedule ?></option>
                                                <?php } else if (!(array_key_exists($schedule, $possible))) { ?>
                                                    <option class="overbooked" value="<?php echo $id ?>"><?php echo $schedule ?></option>
                                            <?php }
                                            } ?>
                                            <option class="reason-opt" value="off">OFF</option>
                                        </select>
                                        <input type="hidden" value="<?php echo $prev_select ?>">
                                    </td>
                            <?php }
                            } ?>
                            <td hidden="true"><input type="checkbox" id="selected-analyst" class="regular-checkbox"></td>
                        </tr>

                    <?php }  ?>
            <?php }
            } ?>

            <tr class="conventions">
                <td colspan="9">
                    <div class="convs">
                        <div class="conv">
                            <span style="background-color: #CCF5FF"></span>
                            <p>Day off</p>
                        </div>
                        <div class="conv">
                            <span style="background-color: #18ABD1"></span>
                            <p>Medical leave</p>
                        </div>
                        <div class="conv">
                            <span style="background-color: #FFE98C"></span>
                            <p>Non-paid license</p>
                        </div>
                        <div class="conv">
                            <span style="background-color: #81D374"></span>
                            <p>Vacations</p>
                        </div>
                        <div class="conv">
                            <span style="background-color: #ED1A70"></span>
                            <p>No longer required</p>
                        </div>

                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div id="m01" class="modal">
        <div class="modal-window">
            <span onclick="modal_close('m01')" class="closebtn">&times;</span>

            <form class="custform" action="../db/controller/modschedule.php" method="post">
                <h4>Schedule Management</h4>
                <input type="hidden" id="write-here" name="range" value="">
                <div>
                    <label>Select an action:</label>
                    <select class="select1" name="action">
                        <option>Select</option>
                        <option value="update">Modify schedule</option>
                        <option value="insert_into">Create schedule</option>
                        <option value="delete">Delete schedule</option>
                    </select>
                </div>

                <div class="update box">
                    <div>
                        <label>Select schedule to modify:</label>
                        <select class="select2" name="id">
                            <option>Select</option>
                            <?php
                            foreach ($schlist as $id => $time) {
                                if (!(array_key_exists($time, $possible))) { ?>
                                    <option value="<?php echo $id ?>"><?php echo $time ?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>
                    <div class="modibox box2">
                        <label for="">From: </label>
                        <select name="" id="from_mod" class="for_modify" onchange="writeValuesM(this)">
                            <option>Select</option>
                            <?php
                            for ($i = 0; $i < 24; $i++) {
                                if ($i < 10) { ?>
                                    <option value="<?php echo '0' . $i . ':00'; ?>"><?php echo '0' . $i . ':00'; ?></option>
                                <?php } else { ?>
                                    <option value="<?php echo $i . ':00'; ?>"><?php echo $i . ':00'; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                        <label for="">To: </label>
                        <select name="" id="to_mod" class="for_modify" onchange="writeValuesM(this)">
                            <option>Select</option>
                            <?php
                            for ($i = 0; $i < 24; $i++) {
                                if ($i < 10) { ?>
                                    <option value="<?php echo '0' . $i . ':00'; ?>"><?php echo '0' . $i . ':00'; ?></option>
                                <?php } else { ?>
                                    <option value="<?php echo $i . ':00'; ?>"><?php echo $i . ':00'; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="insert_into box">
                    <label for="">Please, select time range:</label>
                    <label for="">From: </label>
                    <select name="" onchange="writeValuesC(this)">
                        <?php
                        for ($i = 0; $i < 24; $i++) {
                            if ($i < 10) { ?>
                                <option value="<?php echo '0' . $i . ':00'; ?>"><?php echo '0' . $i . ':00'; ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $i . ':00'; ?>"><?php echo $i . ':00'; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                    <label for="">To: </label>
                    <select name="" onchange="writeValuesC(this)">
                        <?php
                        for ($i = 0; $i < 24; $i++) {
                            if ($i < 10) { ?>
                                <option value="<?php echo '0' . $i . ':00'; ?>"><?php echo '0' . $i . ':00'; ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $i . ':00'; ?>"><?php echo $i . ':00'; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>

                <div class="delete box">
                    <div>
                        <label>Select schedule to delete:</label>
                        <select class="select2" name="idd">
                            <option>Select</option>
                            <?php
                            foreach ($schlist as $id => $time) {
                                if (!(array_key_exists($time, $possible))) { ?>
                                    <option value="<?php echo $id ?>"><?php echo $time ?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>
                </div>
                <input type="submit" value="Send" name="Send">
            </form>
        </div>
    </div>

    <div id="m02" class="modal">
        <div class="modal-window" style="border: 1px solid #f7176e">
            <span onclick="modal_close('m02')" class="closebtn">&times;</span>

            <form class="custform sche_changing" action="../db/controller/modschedule.php" method="post">

                <h4>Reason to change shift scheduled</h4>

                <input class="form-control" type="text" id="emp_name" style="width: 60%;  height: 30px; margin-bottom: 2rem" disabled>

                <div class="info_change">

                    <div class="form-group">
                        <input class="form-control" type="text" id="this_date" style="width: 60%; height: 30px" disabled>
                    </div>


                    <span style="font-weight: 600;">From: </span>
                    <div class="form-group">

                        <input class="form-control" type="text" id="from_time" style="width: 60%;  height: 30px" disabled>
                    </div>

                    <span style="font-weight: 600">To: </span>
                    <div class="form-group">

                        <input class="form-control" type="text" id="to_time" style="width: 60%; height: 30px" disabled>
                    </div>

                </div>

                <input id="select_id" type="hidden" name="element_id">

                <label style="text-align: center; margin-top: -1rem">Reason to change shift scheduled: </label>

                <select class="form-control" name="reason" id="reason_shift" required>
                    <option value="" selected disabled>Select reason</option>
                    <option class="overbooked" value="overbooked">Overbooked</option>
                    <option class="understaffed" value="understaffed">In need of personnel</option>
                    <?php
                    foreach ($schlist as $id => $schreason) {
                        if (array_key_exists($schreason, $possible)) { ?>
                            <option class="reason-opt" value="<?php echo $id ?>"><?php echo $schreason ?></option>
                    <?php }
                    } ?>
                </select>
                <input type="submit" value="Send" onclick="updateValue()">
            </form>
        </div>
    </div>

    <a class="backbtn" href="../csenv.php"><span>Home</span></a>

    <!-- jQuery -->
    <script type="text/javascript" src="../jq/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->

    <!-- Script search table -->
    <script>
        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.getElementById("schedule");
            tr = table.getElementsByTagName("tr");
            for (i = 2; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

    <!-- Script for selecting row -->
    <script>
        $('.selected-row').click(function(event) {
            if (!$(event.target).is(":checkbox")) {
                if ($(this).find('#selected-analyst').is(':checked')) {
                    $(this).find('#selected-analyst').prop('checked', false)
                    $(this).removeAttr('style');
                } else {
                    $(this).find('#selected-analyst').prop('checked', true)
                    $(this).css('background', 'linear-gradient(45deg, rgba(38,172,210,1) 0%, rgba(38,128,185,1) 51%, rgba(38,112,176,1) 78%, rgba(38,97,168,1) 98%)');
                }
            }
        })
    </script>

    <script>
        //Script for justifying schedule change
        function changeReason(element_id, employee, date, from_time, to_time) {
            var write = element_id;
            var where = document.getElementById("select_id");
            var write2 = employee;
            var where2 = document.getElementById("emp_name");
            var write3 = date;
            var where3 = document.getElementById("this_date");
            var write4 = $(from_time).val();
            var where4 = document.getElementById("from_time");
            var write5 = $(to_time).text();
            var where5 = document.getElementById("to_time");
            where.value = write;
            where2.value = write2;
            where3.value = write3;
            where4.value = write4;
            where5.value = write5;
            modal_show('m02');
            /* Script to show or hide reason-opt options depending on  previous selection of time range to change */
            var prevSelect = $('#'.concat(element_id)).find('option:selected').attr('class');
            $('#reason_shift option').each(function() {
                var self = $(this);
                self.hide();
                if (self.hasClass(prevSelect)) {
                    self.show();
                }
            });
        }
        //This script prevents refreshing of the webpage after submiting change of availability
        $('.sche_changing').on('submit', function(e) {
            e.preventDefault();
            e.stopPropagation();

            var element_id = $('#select_id').val();
            var new_val = $("#".concat(element_id, " option:selected")).val();
            if (new_val == 'off') {
                new_val = $("#reason_shift option:selected").val();
            }
            var employee = $('#emp_name').val();
            var date = $('#this_date').val();

            $.ajax({
                url: '../db/controller/changeSchedule.php',
                type: 'post',
                data: {
                    element_id: element_id,
                    new_val: new_val
                },
                success: function(response) {
                    alert(employee + '\'s schedule for ' + date + ' has been changed.');
                }
            })
            modal_close('m02');
        });
    </script>

    <script>
        function modal_show(id) {
            document.getElementById(id).style.display = 'flex';
            //document.body.style.overflow = 'hidden';
        }

        function modal_close(id) {
            document.getElementById(id).style.display = 'none';
            location.reload();
            //document.body.style.overflow = 'scroll';
        }
    </script>

    <script>
        /* Function for hiding and showing depending on selection option */
        $(document).ready(function() {
            $(".select1").change(function() {
                $(this).find("option:selected").each(function() {
                    var optionValue = $(this).attr("value");
                    if (optionValue) {
                        $(".box").not("." + optionValue).hide();
                        $("." + optionValue).show();
                    } else {
                        $(".box").hide();
                    }
                });
            }).change();
        });
    </script>

    <script>
        /* Function for hiding and showing depending on selection option */
        $(document).ready(function() {
            $(".select2").change(function() {
                $(this).find("option:selected").each(function() {
                    var optionValue = $(this).attr("value");
                    if (optionValue) {
                        $(".box2").show();
                    } else {
                        $(".box2").hide();
                    }
                });
            }).change();
        });
    </script>

    <!--script>
        /* Function for hiding and showing depending on selection option */
        function reason_appear(element) {
            $(".emp_selection").change(function() {
                $(element).find("option:selected").each(function() {
                    var optionValue = $(element).attr("value");
                    if (optionValue) {
                        $(".box").show();
                    } else {
                        $(".box").hide();
                    }
                });
            }).change();
        };
    </script-->

    <script>
        //these functions return an alert when a change is done
        function getSelectValue(element) {
            var selectedValue = element.value;
            return selectedValue;
        }

        function writeValuesM(select_input) {
            var write = getSelectValue(select_input);
            var where = document.getElementById("write-here");

            if (where.value.indexOf('-') === 6 | where.value.indexOf('-') === 5) {
                var confirmation = confirm('The current selected range of time is ' + where.value + '. Do you want to change it?: ');
                if (confirmation == true) {
                    var selects = document.getElementById('from_mod').options;
                    var selects2 = document.getElementById('to_mod').options;
                    where.value = "";
                    selects[0].selected = true;
                    selects2[0].selected = true;
                    where.value = "";
                    alert('Please select the time range again.')
                }
            } else {

                if (where && where.value) {
                    where.value += ' - ' + write;
                } else {
                    where.value += write;
                }
            }
        }

        function writeValuesC(select_input) {
            var write = getSelectValue(select_input);
            var where = document.getElementById("write-here");

            if (where.value.indexOf('-') === 6 | where.value.indexOf('-') === 5) {
                var confirmation = confirm('Do you want to change the current range time?: ');
                if (confirmation == true) {
                    var selects = document.getElementById('from_cre').options;
                    var selects2 = document.getElementById('to_cre').options;
                    where.value = "";
                    selects[0].selected = true;
                    selects2[0].selected = true;
                    where.value = "";
                    alert('Please select the time range again.')
                }
            } else {

                if (where && where.value) {
                    where.value += ' - ' + write;
                } else {
                    where.value += write;
                }
            }
        }
    </script>

    <!--script type="text/javascript">
        $(document).ready(function(){
        refreshTable();
        });

        function refreshTable(){
            $('#for_tables').load('getTable.php', function(){
            setTimeout(refreshTable, 5000);
            });
        }
    </script-->

</body>

</html>
