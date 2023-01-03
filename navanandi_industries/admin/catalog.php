<?php
  require('config.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Catalog</title>
    <?php include('links.php'); ?>
    <style>
    .dropdown-toggle:after { content: none !important; }
    </style>
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

                if(isset($_POST['updateCatalog'])){
                  $catalog_name = sanitise($_POST['catalog_name']);
				 
                  
                  $dt2=date("Y-m-d H:i:s");
                    $createdby=  $_SESSION['admin']['email'] ;

					
				$sql = "select * from global_catalogs where `catalog_name` = '$catalog_name' and status='1' and  id <>'".$_GET['edit']."' ";
		$query = mysqli_query($connection,$sql);
		$trows = mysqli_num_rows($query);
                 if($trows==0) {
                  $insertuom=mysqli_query($connection, "UPDATE `global_catalogs` SET `catalog_name` = '$catalog_name' ,`modified_date` = '$dt2',`modified_by` = '$createdby'  WHERE `id` = $editId");
                     if(isset($_FILES['banner']) && $_FILES['banner']['size'] > 0){
						 
                  if(file_exists('files') == false){
                    mkdir('files');
                  }
                   $fileExtension = strtolower(pathinfo($_FILES['banner']['name'], PATHINFO_EXTENSION));
                  
                  $imagepath=time().mt_rand(10000,99999).$_FILES['banner']['name'];
                  $fileUploadName = 'files/'.$imagepath;
                  
                  if(move_uploaded_file($_FILES['banner']['tmp_name'], $fileUploadName)){
                    $image = time().mt_rand(10000,99999).$_FILES['banner']['name'];
				  mysqli_query($connection,"UPDATE `global_catalogs` SET `catalog` = '$imagepath' WHERE `id` = '$editId'");
					 
                  }
                }
					
					print('<div class="alert alert-primary text-center small">Catalog '.$catalog_name.' has been updated</div>');
                  }else{
                    print('<div class="alert alert-danger text-center small">Opps!! Something went wrong..or Already Exist.</div>');
                  }
				
                }

                $editCategorySQL = "SELECT * FROM global_catalogs WHERE id = '$editId'";
                $editCategoryResult = mysqli_query($connection, $editCategorySQL);
                if(mysqli_num_rows($editCategoryResult) == 1){
                  $editCategoryRow = mysqli_fetch_assoc($editCategoryResult);
                  ?>

                  <form method="POST" action="" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-12">
                        <h4 class="mb-4 p-0 text-muted">Edit Catalog  </h4>
                      </div>
				
						 <div class="col-12 pb-4">
                          <div class="border position-relative rounded p-2">
                              <label class="bg-white px-2 position-absolute ml-2 mt-n3 small"> Catalog Name</label>
                              <input type="text" name="catalog_name" value="<?php print($editCategoryRow['catalog_name']); ?>" class="form-control border-0 font-weight-bold" required>
                          </div>
                      </div>
				   
					  <label class="py-0 pl-3 m-0 bg-white text-muted small">Image (Upload only if you want to update Image)</label>
                <div class="custom-file border-0 mb-4">
                    <input type="file" accept="image/*" name="banner" class="custom-file-input borde-0 no-focus" id="inputImage" oninput="inputImageChange(this.value);">
                    <label class="custom-file-label" id="inputImageLabel" for="inputImage">Choose Image</label>
                </div>
				
                       
                      <div class="col-12 text-center">
                          <input type="submit" name="updateCatalog" class="btn btn-primary w-100 py-3" value="Update Catalog">
                      </div>
                    </div>
                  </form>
                  <div class="border-top mt-4 pt-4">
                    <a class="btn btn-inverse-primary w-100 py-3" href="catalog.php">Cancel Edit</a>
                  </div>

                  <?php
                }
                
              }else{
		  
		  
              if(isset($_POST['addCatalog'])){
                $catalog_name = sanitise($_POST['catalog_name']);
				 
                $image = null;
                $dt2=date("Y-m-d H:i:s");
                    $createdby=  $_SESSION['admin']['email'] ;

                if(isset($_FILES['banner']) && $_FILES['banner']['size'] > 0){
                  if(file_exists('files') == false){
                    mkdir('files');
                  }
                  $fileExtension = strtolower(pathinfo($_FILES['banner']['name'], PATHINFO_EXTENSION));
                  
                  $imagepath=time().mt_rand(10000,99999).$_FILES['banner']['name'];
                  $fileUploadName = 'files/'.$imagepath;
                  
                  if(move_uploaded_file($_FILES['banner']['tmp_name'], $fileUploadName)){
                    $image = time().mt_rand(10000,99999).$_FILES['banner']['name'];;
					
                  }
                }
				
				$addCategoryURLCheckSQL = "SELECT * FROM global_catalogs WHERE catalog_name='$catalog_name'";
                  $addCategoryURLCheckCount = mysqli_num_rows(mysqli_query($connection, $addCategoryURLCheckSQL));
                  if(($addCategoryURLCheckCount == 0) and (!is_null($imagepath))){
					  $dt2=date("Y-m-d H:i:s");
                    $createdby=  $_SESSION['admin']['email'] ;

                     $addCategorySQL = mysqli_query($connection,"INSERT INTO global_catalogs(`catalog_name`,`status`,`catalog`,`created_date`,`created_by`)VALUE('$catalog_name','1','$imagepath','$dt2','$createdby')");
                  print('<div class="alert alert-primary text-center small mb-3">Catalog  has been added</div>');
                  }
				  
				  else{
                    print('<div class="alert alert-danger text-center small">Opps!! Something went wrong, or already exist.</div>');
                  }

                

              }
            ?>
            <form method="POST" action="" enctype="multipart/form-data">
              <h4 class="text-center mb-4 pb-4">Add New Catalog</h4>
              <div class="row">
                <div class="col-md-12 col-12 mb-4">
                  <div class="position-relative border rounded p-2">
                    <label class="position-absolute text-muted small mt-n3 px-2 mx-2 bg-white">Catalog Name</label>
                    <input type="text" name="catalog_name" class="form-control border-0 no-focus font-weight-bold" required>
                  </div>
                </div>
                 
              </div>
             
              
              <label class="py-0 pl-3 m-0 bg-white text-muted small">Upload Catalog  </label>
              <div class="custom-file border-0 mb-4">
                <input type="file" accept="image/*" name="banner" class="custom-file-input borde-0 no-focus" id="inputImage" oninput="inputImageChange(this.value);" required>
                <label class="custom-file-label" id="inputImageLabel" for="inputImage">Choose file</label>
              </div>
              <input type="submit" name="addCatalog" value="Add Catalog" class="btn btn-primary w-100 py-3">
            </form>
			<?php
              }
            ?>
          </div>

          <div class="p-4 cus-shadow mt-5">
          <div class="table-responsive ">
              <?php
                $advertiseSQL = "SELECT * FROM `global_catalogs` ORDER BY `id` DESC";
                $advertiseResult = mysqli_query($connection, $advertiseSQL);
				 if(mysqli_num_rows($advertiseResult) > 0){
                  print('<table class="table table-bordered table-hover">');
                  print('<thead>');
                  print('<tr>');
                  print('<td>Name</td>');
                  print('<td>Status</td>');
                  print('<td>Action</td>');
                  print('</tr>');
                  print('</thead>');
                  print('<tbody>');
                  while($advertiseRow = mysqli_fetch_assoc($advertiseResult)){
                    print('<tr>');
                    print('<td>'.$advertiseRow['catalog_name'].'</td>');
                     
					if($advertiseRow['status'] == 1){
                            print('<td><span class="btn btn-success btn-rounded border-success text-left"><i class="fa fa-check-circle"></i> &nbsp;Active&nbsp;&nbsp;</span></td>');
                        }else{
                            print('<td><span class="btn btn-warning btn-rounded border-warning text-left"><i class="fa fa-exclamation-triangle"></i> Inactive</span></td>');
                        }
                        print('<td><a href="'.WEBSITE_URL.'/catalog.php?edit='.$advertiseRow['id'].'" class="btn btn-inverse-primary"><i class="fa fa-pencil"></i> Edit</a></td>');
                        print('<td>');
                            if($advertiseRow['status'] == 1){
                                print('<a href="'.WEBSITE_URL.'/catalog-edit.php?id='.$advertiseRow['id'].'" class="btn btn-inverse-warning"><i class="fa fa-exclamation-triangle"></i> Deactivate</a>');
                            }else{
                                print('<a href="'.WEBSITE_URL.'/catalog-edit.php?id='.$advertiseRow['id'].'" class="btn btn-inverse-success">&nbsp;&nbsp;<i class="fa fa-check-circle"></i> Activate&nbsp;&nbsp;&nbsp;</a>');
                            }
                        print('</td>');
                        print('<td>');
                        ?>
                            <button class="btn btn-inverse-danger" data-toggle="modal" data-target="#confirmCategoryDeleteModal" onclick="confirmCategoryDelete('<?php print($advertiseRow['catalog_name']); ?>',<?php print($advertiseRow['id']); ?>);"><i class="fa fa-trash"></i> Delete</button>
                        <?php
                        print('</td>');
                    print('</tr>');
                }
                print('</tbody>');
                print('</table>');
				
				}else{
                  print('<div class="alert alert-primary text-center m-0 small">No Catalog was found.</div>');
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
            <h4>Are you sure you want to delete Catalog <span id="deleteCategoryName"></span>?</h4>
             
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
            document.getElementById("deleteCategoryId").href = "catalog-edit.php?delete="+id;
        }
	
        function inputImageChange(value){
          value = value.replace('C:\\fakepath\\', "");
          document.getElementById("inputImageLabel").innerText = value;
        }
    </script>

    <?php include('links-footer.php'); ?>
  </body>
</html>