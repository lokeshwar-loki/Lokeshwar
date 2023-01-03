<?php
  require('config.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Dashboard</title>
    <?php include('links.php'); ?>
  </head>
  <body>
    <div class="container-scroller">

      <?php include('header.php'); ?>

      <div class="container-fluid page-body-wrapper">

        <?php include('navigation.php'); ?>

        <div class="main-panel p-4">
          <?php
              $sql = "SELECT (SELECT COUNT(*) FROM global_category where status='1') as totalCategory, (SELECT COUNT(*) FROM global_product where status='1') as totalProduct, (SELECT COUNT(*) FROM global_catalogdownloaded) as totalUser, (SELECT COUNT(*) FROM global_quickpad_enquiry where status='1') as totalenquiry";
              $row = mysqli_fetch_assoc(mysqli_query($connection, $sql));
          ?>
          <div class="row">

            <div class="col-lg-3 col-md-6 col-12 mb-3">
              <div class="p-3 bg-primary text-center text-white rounded ">
                <h3><?php print($row['totalCategory']); ?></h3>
                <h4>Total Category</h4>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-3">
              <div class="p-3 bg-warning text-center text-white rounded ">
                <h3><?php print($row['totalProduct']); ?></h3>
                <h4>Total Product</h4>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-3">
              <div class="p-3 bg-danger text-center text-white rounded ">
                <h3><?php print($row['totalUser']); ?></h3>
                <h4>Total Users</h4>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-3">
              <div class="p-3 bg-success text-center text-white rounded ">
                <h3><?php print($row['totalenquiry']); ?></h3>
                <h4>Total Enquiry</h4>
              </div>
            </div>
            
          </div>

        </div>
      </div>
    </div>

    <?php include('links-footer.php'); ?>
  </body>
</html>