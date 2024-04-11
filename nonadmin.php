<?php require_once('db-connect.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./fullcalendar/lib/main.min.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./fullcalendar/lib/main.min.js"></script>
    <style>
        :root {
            --bs-success-rgb: 71, 222, 152 !important;
        }

        html,
        body {
            height: 100%;
            width: 100%;
            font-family: 'Times New Roman', Times, serif;
            font-size: 14px;
        }

        .btn-info.text-light:hover,
        .btn-info.text-light:focus {
            background: #000;
        }
        table, tbody, td, tfoot, th, thead, tr {
            border-color: #ededed !important;
            border-style: solid;
            border-width: 1px !important;
        }

        .dropbtn {
    background-color: #163259;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
    text-decoration: none;
    margin-top: 70px;
    font-family: 'Times New Roman', Times, serif;
  }

  .dropbtn:hover, .dropbtn:focus {
    background-color: #7080ea;
    color: white; 
  }

  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #163259;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(24, 10, 56, 0.2);
    z-index: 1;
    border-bottom-left-radius: 20px; 
  border-bottom-right-radius: 20px; 
  }

  .dropdown-content a {
    color: rgb(255, 241, 241);
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    
  }

  .dropdown-content a:hover {
    background-color: #39359f;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
  }

  .dropdown:hover .dropdown-content {
    display: block;
    
  }
.container11 {
  background-color: #163259;
  margin-right: 40%;
  color: white;
  font-size: 10px;
  width: 100%;
  margin-top: 20px;
}
  .menu-container {
  display: flex;
  background-color: #163259;
  padding: 10px;
justify-content: flex-end;

}

.menu-container > * {
  padding: 3;
}


.flexbox {
  background: linear-gradient(155deg, #163259, #163259, #163259);
  width:25%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}

.search {
  margin: 0px;
}

.search > h3 {
  font-weight: normal;
}

.search > div {
  display: inline-block;
  position: relative;
  filter: drop-shadow(0 1px #0091c2);
}

.search > div > input {
  color: white;
  font-size: 16px;
  background: transparent;
  width: 250px;
  height: 2px;
  padding: 14px;
  border: solid 3px white;
  outline: none;
  border-radius: 35px;
  transition: width 0.5s;
  margin-top: 75px;

}

.search > div > input::placeholder {
  color: #efefef;
  opacity: 0;
  transition: opacity 150ms ease-out;
}

.search > div > input:focus::placeholder {
  opacity: 1;
}

.search > div > input:focus,
.search > div > input:not(:placeholder-shown) {
  width: 250px;
}
    </style>
</head>
<link rel="icon" type="image/x-icon" href="/schedule/a.png">
<title>Announcements</title>
<body class="bg-light">
    
<div class="menu-container">
  <div class="container11">
    <h2>Los Baños Ward</h2>
    <h4> Organization Planners</h4>
  </div>
  <a class="dropbtn" href="home1.html">Home</a>
  <a class="dropbtn" href="split.html">About</a>
  <a class="dropbtn" href="nonadmin.php">Calendar</a>
  <a class="dropbtn" href="login/index.php">Log in</a>

</div>
</div>
    <div class="container py-5" id="page-container">
        <div class="row">
            <div class="col-md-9">
                <div id="calendar"></div>
            </div>
            
    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title">Schedule Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body rounded-0">
                    <div class="container-fluid">
                        <dl>
                            <dt class="text-muted">Title</dt>
                            <dd id="title" class="fw-bold fs-4"></dd>
                            <dt class="text-muted">Description</dt>
                            <dd id="description" class=""></dd>
                            <dt class="text-muted">Start</dt>
                            <dd id="start" class=""></dd>
                            <dt class="text-muted">End</dt>
                            <dd id="end" class=""></dd>
                        </dl>
                    </div>
                </div>
                <div class="modal-footer rounded-0">
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php 
$schedules = $conn->query("SELECT * FROM `schedule_list`");
$sched_res = [];
foreach($schedules->fetch_all(MYSQLI_ASSOC) as $row){
    $row['sdate'] = date("F d, Y h:i A",strtotime($row['start_datetime']));
    $row['edate'] = date("F d, Y h:i A",strtotime($row['end_datetime']));
    $sched_res[$row['id']] = $row;
}
?>
<?php 
if(isset($conn)) $conn->close();
?>
</body>
<script>
    var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')
</script>
<script src="./js/script.js"></script>

</html>