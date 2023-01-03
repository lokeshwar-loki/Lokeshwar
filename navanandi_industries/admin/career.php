<?php
  require('config.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Career</title>
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
              if(isset($_GET['edit'])){
                $editId = sanitise($_GET['edit']);

                if(isset($_POST['updateCareer'])){
                  $job_title = sanitise($_POST['job_title']);
				  $description = sanitise($_POST['description']);
				  $total_position = sanitise($_POST['total_position']);
				  $job_location = sanitise($_POST['job_location']);
				  $package = sanitise($_POST['package']);
				   
				   
                  $dt2=date("Y-m-d H:i:s");
                    $createdby=  $_SESSION['admin']['email'] ;
					
					$sql = "select * from global_career where `job_title` = '$job_title' and status='1' and  id <>'".$_GET['edit']."' ";
		$query = mysqli_query($connection,$sql);
		$trows = mysqli_num_rows($query);
                 if($trows==0) {
        $insertproduct=mysqli_query($connection,"UPDATE global_career SET job_title = '$job_title',description = '$description',total_position = '$total_position',job_location = '$job_location',package = '$package', modified_date = '$dt2',modified_by = '$createdby' WHERE id = '$editId'");
                   

 	   
                    print('<div class="alert alert-primary small text-center">Career has been updated</div>');
                  }else{
                    print('<div class="alert alert-primary small text-center">Opps!! Something went wrong.</div>');
                  }
                }

                $editCategorySQL = "SELECT * FROM global_career WHERE id = '$editId'";
                $editCategoryResult = mysqli_query($connection, $editCategorySQL);
                if(mysqli_num_rows($editCategoryResult) == 1){
                  $editCategoryRow = mysqli_fetch_assoc($editCategoryResult);
                  ?>

                  <form method="POST" action="" enctype="multipart/form-data">
                    
                      <div class="col-12">
                        <h4 class="mb-4 p-0 text-muted">Edit Career <?php print(ucwords($editCategoryRow['job_title'])); ?></h4>
                      </div>
                     <div class="col-12 pb-4">
                          <div class="border position-relative rounded p-2">
                              <label class="bg-white px-2 position-absolute ml-2 mt-n3 small"> Job Title</label>
                              <input type="text" name="job_title" value="<?php print($editCategoryRow['job_title']); ?>" class="form-control border-0 font-weight-bold" required>
                          </div>
                      </div>
					  
                      <div class="col-12 pb-4">
                          <div class="border position-relative rounded p-2">
                              <label class="bg-white px-2 position-absolute ml-2 mt-n3 small"> Total Position</label>
                              <input type="number" name="total_position" value="<?php print($editCategoryRow['total_position']); ?>" class="form-control border-0 font-weight-bold" required>
                          </div>
                      </div>
					  
					   
                 
				 
				<div class="col-12 pb-4">
                          <div class="border position-relative rounded p-2">
                              <label class="bg-white px-2 position-absolute ml-2 mt-n3 small"> Job Location</label>
                              <input type="text" name="job_location" value="<?php print($editCategoryRow['job_location']); ?>" class="form-control border-0 font-weight-bold" required>
                          </div>
                      </div>
					  
                      <div class="col-12 pb-4">
                          <div class="border position-relative rounded p-2">
                              <label class="bg-white px-2 position-absolute ml-2 mt-n3 small"> Total Package</label>
                              <input type="text" name="package" value="<?php print($editCategoryRow['package']); ?>" class="form-control border-0 font-weight-bold"  >
                          </div>
                      </div>
					  
					  <div class="position-relative border rounded p-2 mb-4">
        <label class="position-absolute px-2 ml-2 bg-white text-muted small mt-n3">Description</label>
        <textarea name="description" class="form-control border-0 no-focus font-weight-bold" rows="5" required><?php print($editCategoryRow['description']); ?></textarea>
    </div>
					  
                       
                      <div class="col-12 text-center">
                          <input type="submit" name="updateCareer" class="btn btn-primary w-100 py-3" value="Update Career">
                      </div>
                    </div>
                  </form>
                  <div class="border-top mt-4 pt-4">
                    <a class="btn btn-inverse-primary w-100 py-3" href="career.php">Cancel Edit</a>
                  </div>

                  <?php
                }
                
              }else{

                if(isset($_POST['addCareer'])){
                  $job_title = sanitise($_POST['job_title']);
				  $description = sanitise($_POST['description']);
				  $total_position = sanitise($_POST['total_position']);
				  $job_location = sanitise($_POST['job_location']);
				  $package = sanitise($_POST['package']);
				   
                  $dt2=date("Y-m-d H:i:s");
                    $createdby=  $_SESSION['admin']['email'] ;
                   
                  $addCategoryURLCheckSQL = "SELECT * FROM global_career WHERE job_title='$job_title' and status='1'";
                  $addCategoryURLCheckCount = mysqli_num_rows(mysqli_query($connection, $addCategoryURLCheckSQL));
                  if($addCategoryURLCheckCount == 0){

                  $addCategoryStatus = '1';
                     $addCategorySQL = mysqli_query($connection,"INSERT INTO global_career(`job_title`,`description`,`total_position`,`job_location`,`package`,`status`,`created_date`,`created_by`)
					 VALUE('$job_title','$description','$total_position','$job_location','$package','1','$dt2','$createdby')");
					 
					  
					 
                  print('<div class="alert alert-primary text-center small mb-3">Career  has been added</div>');
                  }
					      
                     else{
                    print('<div class="alert alert-danger text-center small mb-3">Opps!! Something went wrong or already exist.</div>');
                  }
                }
				

                ?>

                  <form class="pt-4" method="POST" action="" enctype="multipart/form-data">
                     
                      <div class="col-12">
                        <h4 class="mb-4 p-0 text-muted">Add New Career</h4>
                      </div>
                      <div class="col-12 pb-4">
                          <div class="border position-relative rounded p-2">
                              <label class="bg-white px-2 position-absolute ml-2 mt-n3 small"> Job Title</label>
                              <input type="text" name="job_title"   class="form-control border-0 font-weight-bold" required>
                          </div>
                      </div>
					  
                      <div class="col-12 pb-4">
                          <div class="border position-relative rounded p-2">
                              <label class="bg-white px-2 position-absolute ml-2 mt-n3 small"> Total Position</label>
                              <input type="number" name="total_position"  class="form-control border-0 font-weight-bold" required>
                          </div>
                      </div>
					  
					   		 
				
				<div class="col-12 pb-4">
                          <div class="border position-relative rounded p-2">
                              <label class="bg-white px-2 position-absolute ml-2 mt-n3 small"> Job Location</label>
                              <input type="text" name="job_location"  class="form-control border-0 font-weight-bold" required>
                          </div>
                      </div>
					  
                      <div class="col-12 pb-4">
                          <div class="border position-relative rounded p-2">
                              <label class="bg-white px-2 position-absolute ml-2 mt-n3 small"> Package</label>
                              <input type="text" name="package" class="form-control border-0 font-weight-bold"  >
                          </div>
                      </div>
					  
					   
					  
					  <div class="position-relative border rounded p-2 mb-4">
        <label class="position-absolute px-2 ml-2 bg-white text-muted small mt-n3">Description</label>
        <textarea name="description" class="form-control border-0 no-focus font-weight-bold" rows="5" required> </textarea>
    </div>
	
	 
                       
                      <div class="col-12 text-center">
                          <input type="submit" name="addCareer" class="btn btn-primary w-100 py-3" value="Add Career">
                      </div>
                    </div>
                  </form>

                <?php
              }
            ?>
          </div>

        <?php

            $adminGetCategorySQL = "SELECT * FROM global_career ORDER BY id DESC";

            if(isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0){
              $page = $_GET['page'];
            }else{
                $page = 1;
            }
            $perPage = 20;
            $totalResult = mysqli_num_rows(mysqli_query($connection, $adminGetCategorySQL));
            $totalPage = floor($totalResult/$perPage);
            if($totalPage%$perPage != 0){
                $totalPage++;
            }
            $limit = $perPage*($page-1);
            $adminGetCategorySQL .= " LIMIT $limit , $perPage";

            $adminGetCategoryResult = mysqli_query($connection, $adminGetCategorySQL);
            if(mysqli_num_rows($adminGetCategoryResult) > 0){

                print('<div class="cus-shadow p-4">');
                print('<table class="table table-hover table-bordered table-responsive-lg">');
                print('<thead>');
                print('<tr>');
                print('<td>Job Title</td>');
				print('<td>Description</td>');
				print('<td>Total Vacancy</td>');
                print('<td>Status</td>');
                print('<td colspan="3">Action</td>');
                print('</tr>');
                print('</thead>');
                print('<tbody>');
                while($adminGetCategoryRow = mysqli_fetch_assoc($adminGetCategoryResult)){
                    print('<tr>');

                        print('<td>'.$adminGetCategoryRow['job_title'].'</td>');
						print('<td>'.$adminGetCategoryRow['description'].'</td>');
						print('<td>'.$adminGetCategoryRow['total_position'].'</td>');

                        if($adminGetCategoryRow['status'] == 1){
                            print('<td><span class="btn btn-success btn-rounded border-success text-left"><i class="fa fa-check-circle"></i> &nbsp;Active&nbsp;&nbsp;</span></td>');
                        }else{
                            print('<td><span class="btn btn-warning btn-rounded border-warning text-left"><i class="fa fa-exclamation-triangle"></i> Inactive</span></td>');
                        }
                        print('<td><a href="'.WEBSITE_URL.'/career.php?edit='.$adminGetCategoryRow['id'].'" class="btn btn-inverse-primary"><i class="fa fa-pencil"></i> Edit</a></td>');
                        print('<td>');
                            if($adminGetCategoryRow['status'] == 1){
                                print('<a href="'.WEBSITE_URL.'/career-update.php?id='.$adminGetCategoryRow['id'].'" class="btn btn-inverse-warning"><i class="fa fa-exclamation-triangle"></i> Deactivate</a>');
                            }else{
                                print('<a href="'.WEBSITE_URL.'/career-update.php?id='.$adminGetCategoryRow['id'].'" class="btn btn-inverse-success">&nbsp;&nbsp;<i class="fa fa-check-circle"></i> Activate&nbsp;&nbsp;&nbsp;</a>');
                            }
                        print('</td>');
                        print('<td>');
                        ?>
                            <button class="btn btn-inverse-danger" data-toggle="modal" data-target="#confirmCategoryDeleteModal" onclick="confirmCategoryDelete('<?php print($adminGetCategoryRow['job_title']); ?>',<?php print($adminGetCategoryRow['id']); ?>);"><i class="fa fa-trash"></i> Delete</button>
                        <?php
                        print('</td>');
                    print('</tr>');
                }
                print('</tbody>');
                print('</table>');

                if($totalPage > 1){
                  print('<div class="w-100 pt-3">');
                  print('<ul class="pagination justify-content-center">');
                  print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/career.php"><i class="fa fa-angle-double-left"></i> First</a></li>');
                  if($totalPage <= 9){
                      for($i=1; $i<=$totalPage; $i++){
                          $nextPageLink = WEBSITE_URL.'/career.php?page='.$i;
                          print('<li class="page-item"><a class="page-link text-primary" href="'.$nextPageLink.'">'.$i.'</a></li>');
                      }
                  }else{
                      if($page > 3 && $page < ($totalPage - 2)){
                          print('<li class="page-item disabled"><a class="page-link text-primary" href="#">...</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/career.php?page='.($page-2).'">'.($page-2).'</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/career.php?page='.($page-1).'">'.($page-1).'</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/career.php?page='.$page.'">'.$page.'</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/career.php?page='.($page+1).'">'.($page+1).'</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/career.php?page='.($page+2).'">'.($page+2).'</a></li>');
                          print('<li class="page-item disabled"><a class="page-link text-primary" href="#">...</a></li>');
                      }else{
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/career.php?page=1">1</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/career.php?page=2">2</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/career.php?page=3">3</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/career.php?page=4">4</a></li>');
                          print('<li class="page-item disabled"><a class="page-link text-primary" href="#">...</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/career.php?page='.($totalPage-3).'">'.($totalPage-3).'</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/career.php?page='.($totalPage-2).'">'.($totalPage-2).'</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/career.php?page='.($totalPage-1).'">'.($totalPage-1).'</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/career.php?page='.$totalPage.'">'.$totalPage.'</a></li>');
                      }
                  }
                  print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/career.php?page='.$totalPage.'"> Last <i class="fa fa-angle-double-right"></i></a></li>');
                  print('</ul>');
                  print('</div>');
              }
              print('</div>');
                
            }else{
                print('<div class="alert alert-primary text-center small">No Career has been added yet</div>');
            }

        ?>
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
            <h4>Are you sure you want to delete Career <span id="deleteCategoryName"></span>?</h4>
             
          </div>
          <div class="modal-footer">
            <div class="row w-100">
                <div class="col-6">
                    <button class="btn btn-secondary w-100 py-3" data-dismiss="modal">Close</button></div>
                <div class="col-6">
                    <a href="#" class="btn btn-danger w-100 py-3" id="deleteCategoryId">Delete</a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
        function confirmCategoryDelete(name, id){
            document.getElementById("deleteCategoryName").innerHTML = name;
            document.getElementById("deleteCategoryId").href = "career-update.php?delete="+id;
        }
		function imageSliderChange(value, target){
        value = value.replace('C:\\fakepath\\', "");
        document.getElementsByClassName("image-slider-label")[target].innerText = value;
    }
    </script>

    <?php include('links-footer.php'); ?>
  </body>
</html>