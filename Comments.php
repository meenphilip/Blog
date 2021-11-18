<?php
require_once "Includes/DB.php";
require_once "Includes/function.php";
require_once "Includes/session.php";

?>

<?php
$_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"];
Confirm_Login();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Comments - Advance CMS System</title>
  <link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css" />
  <script src="fontawesom5/js/all.js"></script>
  <link rel="stylesheet" href="Css/style.css" />
</head>

<body>
  <!--NAVABAR-->
  <div style="height: 10px; background: #27aae1;"></div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#0">MEENTYCOON.COM</a>
      <button class="navbar-toggler" data-target="#navbarcollapseCMS" data-toggle="collapse" aria-controls="navbarcollapseCMS" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div id="navbarcollapseCMS" class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="MyProfile.php"> <i class="fas fa-user text-success"></i> My Profile<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Dashboard.php">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Posts.php">Posts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Categories.php">Categories</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Admins.php">Manage Admins</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="Comments.php">Comments</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Blog.php?page=1">Live Blog</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link text-danger" href="Logout.php"> <i class="fas fa-user-times"></i> LogOut</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div style="height: 10px; background: #27aae1;"></div>
  <!--END OF NAVBAR-->
  <!--HEADER-->
  <header class="bg-dark text-white py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1><i class="fas fa-comments" style="color: #27aae1;"></i> Manage Comments</h1>
        </div>
      </div>
    </div>
  </header>
  <!--END OF HEADER-->
  <section class="container py-2 mb-4">
    <div class="row">
      <div class="col-lg-12" style="min-height: 480px;">
        <?php
        echo ErrorMessage();
        echo SuccessMessage();
        ?>
        <h2 class="text-center">Un-Approved Comments</h2>
        <div class="table-responsive">
          <table class="table table-light table-striped table-hover">
            <thead class="thead-dark">
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Date&Time</th>
                <th scope="col">Name</th>
                <th scope="col">Comment</th>
                <th scope="col">Approve</th>
                <th scope="col">Action</th>
                <th scope="col">Details</th>
              </tr>
            </thead>

            <?php
            global $ConnectingDB;
            $sql = "SELECT * FROM comments WHERE status='OFF' ORDER BY id desc";
            $Execute = $ConnectingDB->query($sql);
            $SrNo = 0;
            while ($DataRows = $Execute->fetch()) {
              $CommentId = $DataRows["id"];
              $DateTimeOfComments = $DataRows["datetime"];
              $CommenterName = $DataRows["name"];
              $CommentContent = $DataRows["comment"];
              $CommentPostId = $DataRows["post_id"];
              $SrNo++;

            ?>
              <tbody>
                <tr>
                  <th scope="row"><?php echo htmlentities($SrNo); ?></th>
                  <td><?php echo htmlentities($DateTimeOfComments); ?></td>
                  <td><?php echo htmlentities($CommenterName); ?></td>
                  <td><?php echo htmlentities($CommentContent); ?></td>
                  <td style="min-width: 140px;"> <a class="btn btn-success" href="ApproveComments.php?id=<?php echo $CommentId; ?>">Approve</a> </td>
                  <td> <a class="btn btn-danger" href="DeleteComments.php?id=<?php echo $CommentId; ?>">Delete</a> </td>
                  <td style="min-width: 140px;"> <a class="btn btn-primary" href="FullPost.php?id=<?php echo $CommentPostId; ?>" target="_blank">Live Preview</a></td>
                </tr>
              </tbody> <?php  } ?>
          </table>
          <h2 class="text-center">Approved Comments</h2>
          <table class="table table-light table-striped table-hover">
            <thead class="thead-dark">
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Date&Time</th>
                <th scope="col">Name</th>
                <th scope="col">Comment</th>
                <th scope="col">Revert</th>
                <th scope="col">Action</th>
                <th scope="col">Details</th>
              </tr>
            </thead>

            <?php
            global $ConnectingDB;
            $sql = "SELECT * FROM comments WHERE status='ON' ORDER BY id desc";
            $Execute = $ConnectingDB->query($sql);
            $SrNo = 0;
            while ($DataRows = $Execute->fetch()) {
              $CommentId = $DataRows["id"];
              $DateTimeOfComments = $DataRows["datetime"];
              $CommenterName = $DataRows["name"];
              $CommentContent = $DataRows["comment"];
              $CommentPostId = $DataRows["post_id"];
              $SrNo++;

            ?>
              <tbody>
                <tr>
                  <th scope="row"><?php echo htmlentities($SrNo); ?></th>
                  <td><?php echo htmlentities($DateTimeOfComments); ?></td>
                  <td><?php echo htmlentities($CommenterName); ?></td>
                  <td><?php echo htmlentities($CommentContent); ?></td>
                  <td style="min-width: 140px;"> <a class="btn btn-warning" href="DisApproveComments.php?id=<?php echo $CommentId; ?>">Dis-Approve</a> </td>
                  <td> <a class="btn btn-danger" href="DeleteComments.php?id=<?php echo $CommentId; ?>">Delete</a> </td>
                  <td style="min-width: 140px;"> <a class="btn btn-primary" href="FullPost.php?id=<?php echo $CommentPostId; ?>" target="_blank">Live Preview</a></td>
                </tr>
              </tbody> <?php  } ?>
          </table>
        </div>
      </div>
    </div>
  </section>
  <!--FOOTER-->
  <!-- <div style="height: 10px; background: #27aae1;"></div> -->
  <footer class="small bg-dark text-white">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <p class="lead text-center">Theme By | Meen Tycoon | <span id="year"></span> &copy; ---- All Rights Reserves</p>
          <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos accusantium, esse velit quam ratione eum laborum itaque natus officia fugit molestias error sequi incidunt laboriosam rerum vel inventore temporibus aspernatur facere modi repellendus deleniti? Fugiat cumque molestias officia error sequi maiores doloribus ex eligendi neque corporis architecto pariatur sapiente ipsam, molestiae dolorem ipsa. Sequi consectetur tempora aliquam cum natus ut?</p>
        </div>
      </div>
    </div>
  </footer>
  <!--END OFFOOTER-->
  <div style="height: 10px; background: #27aae1;"></div>
  <script src="bootstrap4/js/jquery-3.5.1.min.js"></script>
  <script src="bootstrap4/js/bootstrap.bundle.min.js"></script>
  <script>
    $("#year").text(new Date().getFullYear());
  </script>
</body>

</html>