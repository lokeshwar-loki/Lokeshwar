<?php
  require('config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Unit of Measurement</title>
  <?php include('links.php'); ?>
</head>

<body>
  <div class="container-scroller">

    <?php include('header.php'); ?>

    <div class="container-fluid page-body-wrapper">

      <?php include('navigation.php'); ?>

      <div class="main-panel">
        <div class="p-4">

          <div class="cus-shadow p-4 mb-5">
            <?php
              if(isset($_GET['edit']) && is_numeric($_GET['edit'])){
                $editId = sanitise($_GET['edit']);



                if(isset($_POST['edituom']) && isset($_POST['uom']) && !empty($_POST['uom'] )){
                  $uom = sanitise($_POST['uom']);
                  $name = sanitise($_POST['name']);
				  $dt2=date("Y-m-d H:i:s");
                    $createdby=  $_SESSION['admin']['email'] ;
                  
	 	 $sql = "select * from global_uom where `uom` = '$uom' and status='1' and  id <>'".$_GET['edit']."' ";
		$query = mysqli_query($connection,$sql);
		$trows = mysqli_num_rows($query);
                 if($trows==0) {
                  $insertuom=mysqli_query($connection, "UPDATE `global_uom` SET `name` = '$name',`uom` = '$uom',`modified_date` = '$dt2',`modified_by` = '$createdby'  WHERE `id` = $editId");
                    print('<div class="alert alert-primary text-center small">Unit '.$uom.' has been updated</div>');
                  }else{
                    print('<div class="alert alert-danger text-center small">Opps!! Something went wrong..or Already Exist.</div>');
                  }
                }
                
                

                $editTagResult = mysqli_query($connection, "SELECT * FROM global_uom WHERE `id` = '$editId'");
                if(mysqli_num_rows($editTagResult) == 1){
                  $editTagRow = mysqli_fetch_assoc($editTagResult);
                  ?>
                  <form class="p-4" method="POST" action="">
                    <h4 class="mb-4">Edit Unit</h4>
                    <div class="mb-4 border rounded p-2 position-relative">
                      <label class="position-absolute mt-n3 px-2 bg-white text-muted small">Unit Code</label>
                      <input type="text" name="uom" value="<?php print($editTagRow['uom']); ?>" class="form-control border-0 no-focus font-weight-bold">
                    </div>
                    
                    <div class="mb-4 border rounded p-2 position-relative">
                      <label class="position-absolute mt-n3 px-2 bg-white text-muted small">Unit Name</label>
                      <input type="text" name="name" value="<?php print($editTagRow['name']); ?>" class="form-control border-0 no-focus font-weight-bold">
                    </div>
                    
                    <input type="submit" name="edituom" value="Update Unit" class="btn btn-primary py-3 w-100">
                  </form>
                  <?php
                }else{
                  print('<div class="alert alert-danger text-center small">Invalid Unit</div>');
                }
              }else{
                   
                if(isset($_POST['addNewuom']) && isset($_POST['uom']) && !empty($_POST['uom'])){
                  $uom = sanitise($_POST['uom']);
                  $name = sanitise($_POST['name']);
				  $dt2=date("Y-m-d H:i:s");
                    $createdby=  $_SESSION['admin']['email'] ;
                   $sql = "select * from global_uom where `uom` = '$uom' and  `status` = '1'";
	$query = mysqli_query($connection,$sql);
	$trows = mysqli_num_rows($query);
 
                  if($trows==0){
                  $insertsql=mysqli_query($connection, "INSERT INTO `global_uom`(`uom`,`name`,`created_date`,`created_by`)VALUES('$uom','$name','$dt2','$createdby')");
                    print('<div class="alert alert-primary text-center small">Unit '.$uom.' has been added</div>');
                  }
	
                  else{
                    print('<div class="alert alert-danger text-center small">Opps!! Something went wrong..or Already Exist.</div>');
                  }
	
                }
            ?>
            <form class="p-4" method="POST" action="">
              <h4 class="mb-4">Add New Unit</h4>
              <div class="mb-4 border rounded p-2 position-relative">
                <label class="position-absolute mt-n3 px-2 bg-white text-muted small">Unit Code</label>
                <input type="text" name="uom" class="form-control border-0 no-focus font-weight-bold">
              </div>
              
              <div class="mb-4 border rounded p-2 position-relative">
                <label class="position-absolute mt-n3 px-2 bg-white text-muted small">Unit Name</label>
                <input type="text" name="name" class="form-control border-0 no-focus font-weight-bold">
              </div>
              <input type="submit" name="addNewuom" value="Add New Unit" class="btn btn-primary py-3 w-100">
            </form>
            <?php
              }
            ?>
          </div>

          <div class="cus-shadow p-4">
          <div class="table-responsive ">
            <?php

              $sql = "SELECT * FROM `global_uom` ORDER BY `id` ASC";

              if(isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0){
                $page = $_GET['page'];
              }else{
                  $page = 1;
              }
              $perPage = 20;
              $totalResult = mysqli_num_rows(mysqli_query($connection, $sql));
              $totalPage = floor($totalResult/$perPage);
              if($totalPage%$perPage != 0){
                  $totalPage++;
              }
              $limit = $perPage*($page-1);
              $sql .= " LIMIT $limit , $perPage";

              $tagTableResult = mysqli_query($connection, $sql);
              if(mysqli_num_rows($tagTableResult) > 0){
                print('<table class="table table-bordered table-hover">');
                print('<thead>');
                print('<tr>');
                print('<td>Code</td>');
                 print('<td>Name</td>');
                print('<td>Status</td>');
                print('<td colspan="3">Action</td>');
                print('</tr>');
                print('</thead>');
                print('<tbody>');
                while($tagTableRow = mysqli_fetch_assoc($tagTableResult)){
                  print('<tr>');
                  print('<td>'.$tagTableRow['uom'].'</td>');
                  print('<td>'.$tagTableRow['name'].'</td>');
                  if($tagTableRow['status'] == 1){
                    print('<td><span class="btn btn-success btn-rounded"><i class="fa fa-check-circle mr-2"></i>Active</span></td>');
                  }else if($tagTableRow['status'] == 0){
                    print('<td><span class="btn btn-warning btn-rounded"><i class="fa fa-exclamation-triangle mr-2"></i>Inactive</span></td>');
                  }else{
                    print('<td>N&#47;A</td>');
                  }
                  print('<td><a class="btn btn-inverse-primary" href="'.WEBSITE_URL.'/uom.php?edit='.$tagTableRow['id'].'"><i class="fa fa-pencil"></i> Edit</a></td>');
                  if($tagTableRow['status'] == 1){
                    print('<td><a class="btn btn-inverse-warning" href="'.WEBSITE_URL.'/uom-status-toggle.php?id='.$tagTableRow['id'].'"><i class="fa fa-exclamation-triangle mr-2"></i>Deactivate</a></td>');
                  }else{
                    print('<td><a class="btn btn-inverse-success" href="'.WEBSITE_URL.'/uom-status-toggle.php?id='.$tagTableRow['id'].'"><i class="fa fa-check-circle mr-2"></i>Activate</a></td>');
                  }
                  print('<td>');
                  ?>
                   <!-- <button class="btn btn-inverse-danger" data-toggle="modal" data-target="#confirmCategoryDeleteModal" onclick="confirmCategoryDelete('<?php print($tagTableRow['name']); ?>',<?php print($tagTableRow['tag_id']); ?>);"><i class="fa fa-trash"></i> Delete</button>-->
                  <?php
                  print('</td>');
                  print('</tr>');
                }
                print('</tbody>');
                print('</table>');

                if($totalPage > 1){
                  print('<div class="w-100 pt-3">');
                  print('<ul class="pagination justify-content-center">');
                  print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/uom.php"><i class="fa fa-angle-double-left"></i> First</a></li>');
                  if($totalPage <= 9){
                      for($i=1; $i<=$totalPage; $i++){
                          $nextPageLink = WEBSITE_URL.'/uom.php?page='.$i;
                          print('<li class="page-item"><a class="page-link text-primary" href="'.$nextPageLink.'">'.$i.'</a></li>');
                      }
                  }else{
                      if($page > 3 && $page < ($totalPage - 2)){
                          print('<li class="page-item disabled"><a class="page-link text-primary" href="#">...</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/uom.php?page='.($page-2).'">'.($page-2).'</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/uom.php?page='.($page-1).'">'.($page-1).'</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/uom.php?page='.$page.'">'.$page.'</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/uom.php?page='.($page+1).'">'.($page+1).'</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/uom.php?page='.($page+2).'">'.($page+2).'</a></li>');
                          print('<li class="page-item disabled"><a class="page-link text-primary" href="#">...</a></li>');
                      }else{
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/uom.php?page=1">1</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/uom.php?page=2">2</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/uom.php?page=3">3</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/uom.php?page=4">4</a></li>');
                          print('<li class="page-item disabled"><a class="page-link text-primary" href="#">...</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/uom.php?page='.($totalPage-3).'">'.($totalPage-3).'</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/uom.php?page='.($totalPage-2).'">'.($totalPage-2).'</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/uom.php?page='.($totalPage-1).'">'.($totalPage-1).'</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/uom.php?page='.$totalPage.'">'.$totalPage.'</a></li>');
                      }
                  }
                  print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/uom.php?page='.$totalPage.'"> Last <i class="fa fa-angle-double-right"></i></a></li>');
                  print('</ul>');
                  print('</div>');
              }



              }else{
                print('<div class="alert alert-primary m-0 text-center small">No Unit has been added yet</div>');
              }
            ?>
          </div>
          </div>


        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="confirmCategoryDeleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header border-0 p-4">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center pb-5 px-4">
          <h4>Are you sure you want to delete Unit <span id="deleteCategoryName"></span>?</h4>
          <small>Deleting a Unit will delete all Product with that Unit</small>
        </div>
        <div class="modal-footer">
          <div class="row w-100">
            <div class="col-6">
              <button class="btn btn-secondary w-100 py-3" data-dismiss="modal">Close</button>
            </div>
            <div class="col-6">
              <a href="#" class="btn btn-danger w-100 py-3" id="deleteCategoryId">Delete</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function confirmCategoryDelete(name, id) {
      document.getElementById("deleteCategoryName").innerHTML = name;
      document.getElementById("deleteCategoryId").href = "units-delete.php?id=" + id;
    }
  </script>

  <?php include('links-footer.php'); ?>
</body>

</html>