<?php
  require('config.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Location</title>
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

                if(isset($_POST['updateLoc'])){
                  $location_name = sanitise($_POST['location_name']);
				  $editlocationMap = (string)( new SimpleXMLElement($_POST['location_map']))['src'];
                   
                  $dt2=date("Y-m-d H:i:s");
                    $createdby=  $_SESSION['admin']['email'] ;
    
                    $editUpdateCategorySQL = "UPDATE global_location SET location_name = '$location_name',location_map = '$editlocationMap',modified_date = '$dt2',modified_by = '$createdby' WHERE id = '$editId'";
                   
                  if(mysqli_query($connection, $editUpdateCategorySQL)){
                    print('<div class="alert alert-primary small text-center">Location has been updated</div>');
                  }else{
                    print('<div class="alert alert-primary small text-center">Opps!! Something went wrong.</div>');
                  }
                }

                $editCategorySQL = "SELECT * FROM global_location WHERE id = '$editId'";
                $editCategoryResult = mysqli_query($connection, $editCategorySQL);
                if(mysqli_num_rows($editCategoryResult) == 1){
                  $editCategoryRow = mysqli_fetch_assoc($editCategoryResult);
                  ?>

                  <form method="POST" action="">
                    <div class="row">
                      <div class="col-12">
                        <h4 class="mb-4 p-0 text-muted">Edit Location <?php print(ucwords($editCategoryRow['location_name'])); ?></h4>
                      </div>
                      <div class="col-12 pb-4">
                          <div class="border position-relative rounded p-2">
                              <label class="bg-white px-2 position-absolute ml-2 mt-n3 small">Location Name</label>
                              <input type="text" name="location_name" value="<?php print($editCategoryRow['location_name']); ?>" class="form-control border-0 font-weight-bold" required>
                          </div>
                      </div>
					  
					  <div class="col-12 pb-4">
					  <div class="position-relative border rounded p-2">
                    <label class="position-absolute px-2 ml-2 bg-white text-muted small mt-n3">Map URL</label>
                    <input type="text" name="location_map" value="&lt;iframe src=&quot;<?php print($editCategoryRow['location_map']); ?>&quot;&gt;&lt;&sol;iframe&gt;" class="form-control border-0 no-focus font-weight-bold" required>
                </div>
				</div>
				<div class="valid-feedback text-muted font-italic d-block pl-2 mb-4">(Example: &lt;iframe src=&quot;https://www.google.com/maps/embed/?pb=1dnspio1n321nko123&quot;&gt;&lt;&sol;iframe&gt;)</div>
                       
                      <div class="col-12 text-center">
                          <input type="submit" name="updateLoc" class="btn btn-primary w-100 py-3" value="Update Location">
                      </div>
                    </div>
                  </form>
                  <div class="border-top mt-4 pt-4">
                    <a class="btn btn-inverse-primary w-100 py-3" href="location.php">Cancel Edit</a>
                  </div>

                  <?php
                }
                
              }else{

                if(isset($_POST['addNewLocation'])){
                  $location_name = sanitise($_POST['location_name']);
				  $editlocationMap = (string)( new SimpleXMLElement($_POST['location_map']))['src'];
				  
                   
                  $addCategoryURLCheckSQL = "SELECT * FROM global_location WHERE location_name='$location_name'";
                  $addCategoryURLCheckCount = mysqli_num_rows(mysqli_query($connection, $addCategoryURLCheckSQL));
                  if($addCategoryURLCheckCount == 0){
					  $dt2=date("Y-m-d H:i:s");
                    $createdby=  $_SESSION['admin']['email'] ;

                     $addCategorySQL = mysqli_query($connection,"INSERT INTO global_location(`location_name`,`location_map`,`status`,`created_date`,`created_by`)VALUE('$location_name','$editlocationMap','1','$dt2','$createdby')");
                  print('<div class="alert alert-primary text-center small mb-3">Location  has been added</div>');
                  }
					      
                     else{
                    print('<div class="alert alert-danger text-center small mb-3">Opps!! Something went wrong or already exist.</div>');
                  }
                }
				

                ?>

                  <form method="POST" action="">
                    <div class="row">
                      <div class="col-12">
                        <h4 class="mb-4 p-0 text-muted">Add New Location</h4>
                      </div>
                      <div class="col-12 pb-4">
                          <div class="border position-relative rounded p-2">
                              <label class="bg-white px-2 position-absolute ml-2 mt-n3 small">Location Name</label>
                              <input type="text" name="location_name" class="form-control border-0 font-weight-bold" required>
                          </div>
                      </div>
					  <div class="col-12 pb-4">
					  <div class="position-relative border rounded p-2">
                    <label class="position-absolute px-2 ml-2 bg-white text-muted small mt-n3">Map URL</label>
                    <input type="text" name="location_map"   class="form-control border-0 no-focus font-weight-bold" required>
                </div>
				</div>
				<div class="valid-feedback text-muted font-italic d-block pl-2 mb-4">(Example: &lt;iframe src=&quot;https://www.google.com/maps/embed/?pb=1dnspio1n321nko123&quot;&gt;&lt;&sol;iframe&gt;)</div>
                       
                       
                      <div class="col-12 text-center">
                          <input type="submit" name="addNewLocation" class="btn btn-primary w-100 py-3" value="Add Location">
                      </div>
                    </div>
                  </form>

                <?php
              }
            ?>
          </div>

        <?php

            $adminGetCategorySQL = "SELECT * FROM global_location ORDER BY id DESC";

             
            $adminGetCategoryResult = mysqli_query($connection, $adminGetCategorySQL);
            if(mysqli_num_rows($adminGetCategoryResult) > 0){

                print('<div class="cus-shadow p-4">');
                print('<table class="table table-hover table-bordered table-responsive-lg">');
                print('<thead>');
                print('<tr>');
                print('<td>Location Name</td>');
                print('<td>Status</td>');
                print('<td colspan="3">Action</td>');
                print('</tr>');
                print('</thead>');
                print('<tbody>');
                while($adminGetCategoryRow = mysqli_fetch_assoc($adminGetCategoryResult)){
                    print('<tr>');

                        print('<td>'.$adminGetCategoryRow['location_name'].'</td>');

                        if($adminGetCategoryRow['status'] == 1){
                            print('<td><span class="btn btn-success btn-rounded border-success text-left"><i class="fa fa-check-circle"></i> &nbsp;Active&nbsp;&nbsp;</span></td>');
                        }else{
                            print('<td><span class="btn btn-warning btn-rounded border-warning text-left"><i class="fa fa-exclamation-triangle"></i> Inactive</span></td>');
                        }
                        print('<td><a href="'.WEBSITE_URL.'/location.php?edit='.$adminGetCategoryRow['id'].'" class="btn btn-inverse-primary"><i class="fa fa-pencil"></i> Edit</a></td>');
                        print('<td>');
                            if($adminGetCategoryRow['status'] == 1){
                                print('<a href="'.WEBSITE_URL.'/location-update.php?id='.$adminGetCategoryRow['id'].'" class="btn btn-inverse-warning"><i class="fa fa-exclamation-triangle"></i> Deactivate</a>');
                            }else{
                                print('<a href="'.WEBSITE_URL.'/location-update.php?id='.$adminGetCategoryRow['id'].'" class="btn btn-inverse-success">&nbsp;&nbsp;<i class="fa fa-check-circle"></i> Activate&nbsp;&nbsp;&nbsp;</a>');
                            }
                        print('</td>');
                        print('<td>');
                        ?>
                            <button class="btn btn-inverse-danger" data-toggle="modal" data-target="#confirmCategoryDeleteModal" onclick="confirmCategoryDelete('<?php print($adminGetCategoryRow['location_name']); ?>',<?php print($adminGetCategoryRow['id']); ?>);"><i class="fa fa-trash"></i> Delete</button>
                        <?php
                        print('</td>');
                    print('</tr>');
                }
                print('</tbody>');
                print('</table>');

                
              print('</div>');
                
            }else{
                print('<div class="alert alert-primary text-center small">No Location has been added yet</div>');
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
            <h4>Are you sure you want to delete Location <span id="deleteCategoryName"></span>?</h4>
             
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
            document.getElementById("deleteCategoryId").href = "location-update.php?delete="+id;
        }
    </script>

    <?php include('links-footer.php'); ?>
  </body>
</html>