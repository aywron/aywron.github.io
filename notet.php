<?php
include('conn/conn.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Announcements</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <style>
         body {
      margin: 0;
      background-color: #a7b4bf;
      overflow-x: hidden;
    }

        .main-panel, .card {
            margin: auto;
            height: 90vh;
            overflow-y: auto;
        }
        
        .note-content {
            max-height: 20em;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
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
.container {
  background-color: #163259;
  margin-right: 20%;
  color: white;
  font-size: 20px;
  width: 100%;
  font-family: 'Times New Roman', Times, serif;
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


    </style>
<link rel="icon" type="image/x-icon" href="/schedule/a.png">
</head>
<body>
<div class="menu-container">
  <div class="container">
    <h2>Los Banos Ward</h2>
    <h4> Organization Planners</h4>
  </div>
  <a class="dropbtn" href="home.html">Home</a>
  <a class="dropbtn" href="split.html">About</a>
  <a class="dropbtn" href="index.php">Calendar</a>
  <a class="dropbtn" href="login/index.php">Log out</a>
</div>
</div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Account
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Vew Account</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Log Out</a>
                    </div>
                </li>
                <li class="nav-item">
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <div class="main-panel mt-4 ml-5 col-11">
        <div class="row">

            <!-- Add Note -->
            <div class="col-md-4 border-right">
                <div class="card">
                    <div class="card-header">
                        Add Note
                    </div>
                    <div class="card-body">
                        <form method="post" action="endpoint/add_note.php">
                            <div class="form-group">
                                <label for="noteTitle">Title</label>
                                <input type="text" class="form-control" id="noteTitle" name="note_title" placeholder="Title">
                                <small id="emailHelp" class="form-text text-muted">Title of your note</small>
                            </div>
                            <div class="form-group">
                                <label for="note">Note</label>
                                <textarea class="form-control" id="note" name="note_content" rows="23"></textarea>
                            </div>
                            <button type="submit" class="btn btn-secondary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Notes Details
                        <a href="all_notes.php" class="float-right">View All Notes</a>
                    </div>

                    <div class="card-body">
                        <div class="data-item">
                            <ul class="list-group">

                            <?php
                            include('conn/conn.php');

                            $stmt = $conn->prepare("SELECT * FROM `tbl_notes`");
                            $stmt->execute();

                            $result = $stmt->fetchAll();

                            foreach ($result as $row) {
                                $noteID = $row['tbl_notes_id'];
                                $noteTitle = $row['note_title'];
                                $noteContent = $row['note'];
                                $noteDateTime = $row['date_time'];

                                // Convert the date_time value to a formatted date and time string
                                $formattedDateTime = date('F j, Y H:i A', strtotime($noteDateTime));
                            ?>
                                <li class="list-group-item mt-2">
                                    <div class="btn-group float-right">
                                        <a href="endpoint/update_note.php?edit=<?php echo $noteID ?>"><button type="button" class="btn btn-sm btn-light" title="Show"><i class="fa fa-pencil"></i></button></a>
                                        <button onclick="delete_note('<?php echo $noteID ?>')" type="button" class="btn btn-sm btn-light" title="Remove"><i class="fa fa-trash"></i></button>
                                    </div>
                                    <h3 style="text-transform:uppercase;"><b><?php echo $noteTitle ?></b></h3>
                                    <p class="note-content"><?php echo $noteContent ?></p>
                                    <small class="block text-muted text-info">Created: <i class="fa fa-clock-o text-info"></i> <?php echo $formattedDateTime ?></small>
                                </li>
                            <?php
                            }
                            ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <script>
        function delete_note(id) {

        if (confirm("Do you confirm to delete this note?")) {
            window.location = "endpoint/delete_note.php?delete=" + id
        }
        }
    </script>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>