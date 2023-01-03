<?php
  require('config.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Product</title>
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

                if(isset($_POST['updateProduct'])){
                  $product_name = sanitise($_POST['product_name']);
				  $product_sku = sanitise($_POST['product_sku']);
				  $category = sanitise($_POST['category']);
				  $unit = sanitise($_POST['unit']);
				  $usage_application = sanitise($_POST['usage_application']);
				  $tax = sanitise($_POST['tax']);
				  $specification = sanitise($_POST['specification']);
				  $search_keywords = sanitise($_POST['search_keywords']);
				  $search_keywords_url = makeslug($search_keywords);
				   
				  $product_name_url = makeslug($product_name);
                   
                  $dt2=date("Y-m-d H:i:s");
                    $createdby=  $_SESSION['admin']['email'] ;
					
					$sql = "select * from global_product where `product_sku` = '$product_sku' and status='1' and  id <>'".$_GET['edit']."' ";
		$query = mysqli_query($connection,$sql);
		$trows = mysqli_num_rows($query);
                 if($trows==0) {
        $insertproduct=mysqli_query($connection,"UPDATE global_product SET product_name = '$product_name',product_sku = '$product_sku',category = '$category',unit = '$unit',usage_application = '$usage_application',tax = '$tax',specification = '$specification',search_keywords = '$search_keywords',search_keywords_url = '$search_keywords_url',product_name_url = '$product_name_url',modified_date = '$dt2',modified_by = '$createdby' WHERE id = '$editId'");
                   

if(isset($_FILES['product']) && count($_FILES['product']['name']) > 0){
                if(file_exists('files') == false){
                    mkdir('files');
                }

                for($i=0; $i<count($_FILES['product']['name']); $i++){
                    $fileExtension = strtolower(pathinfo($_FILES['product']['name'][$i], PATHINFO_EXTENSION));
                    $imagepath=time().mt_rand(10000,99999).$i.'.'.$fileExtension;
                    $fileUploadName = 'files/'.$imagepath;
                    if(move_uploaded_file($_FILES['product']['tmp_name'][$i], $fileUploadName)){
                        $fileURL = WEBSITE_URL.'/'.$fileUploadName;
						$DeleteSQL = "DELETE FROM global_product_image WHERE product_id = '$editId'";
        mysqli_query($connection, $DeleteSQL);
                        mysqli_query($connection,"INSERT INTO `global_product_image`(`product_id`,`image`)VALUES('$editId','$imagepath')");
                    }
                }
            }
				   
                    print('<div class="alert alert-primary small text-center">Product has been updated</div>');
                  }else{
                    print('<div class="alert alert-danger small text-center">Opps!! Something went wrong, or SKU already exist.</div>');
                  }
                }

                $editCategorySQL = "SELECT * FROM global_product WHERE id = '$editId'";
                $editCategoryResult = mysqli_query($connection, $editCategorySQL);
                if(mysqli_num_rows($editCategoryResult) == 1){
                  $editCategoryRow = mysqli_fetch_assoc($editCategoryResult);
                  ?>

                  <form method="POST" action="" enctype="multipart/form-data">
                     
                      <div class="col-12">
                        <h4 class="mb-4 p-0 text-muted">Edit Product <?php print(ucwords($editCategoryRow['product_name'])); ?></h4>
                      </div>
                     <div class="col-12 pb-4">
                          <div class="border position-relative rounded p-2">
                              <label class="bg-white px-2 position-absolute ml-2 mt-n3 small"> Product Name</label>
                              <input type="text" name="product_name" value="<?php print($editCategoryRow['product_name']); ?>" class="form-control border-0 font-weight-bold" required>
                          </div>
                      </div>
					  
                      <div class="col-12 pb-4">
                          <div class="border position-relative rounded p-2">
                              <label class="bg-white px-2 position-absolute ml-2 mt-n3 small"> Product SKU</label>
                              <input type="text" name="product_sku" value="<?php print($editCategoryRow['product_sku']); ?>" class="form-control border-0 font-weight-bold" required>
                          </div>
                      </div>
					  
					   
                <div class="col-12 pb-4">
                  <div class="position-relative border rounded p-2">
                    <label class="position-absolute text-muted small mt-n3 px-2 mx-2 bg-white">Category</label>
                    <select name="category" class="custom-select custom-select-sm border-0 no-focus" required>
                      <option value="">None</option>
                                <?php
                                  $countrySQL = "SELECT * FROM global_category   ORDER BY category_name ASC";
                                  $countryResult = mysqli_query($connection, $countrySQL);
                                  while($countryRow = mysqli_fetch_assoc($countryResult)){
                                    if($countryRow['id'] == $editCategoryRow['category']){
                                      print('<option selected value="'.$countryRow['id'].'">'.$countryRow['category_name'].'</option>');
                                    }else{
                                      print('<option value="'.$countryRow['id'].'">'.$countryRow['category_name'].'</option>');
                                    }
                                  } 
                                ?>
                    </select>
                  </div>
                </div>
				
				<div class="col-12 pb-4">
                  <div class="position-relative border rounded p-2">
                    <label class="position-absolute text-muted small mt-n3 px-2 mx-2 bg-white">Unit</label>
                    <select name="unit" class="custom-select custom-select-sm border-0 no-focus" required>
                      <option value="">None</option>
                                <?php
                                  $countrySQL = "SELECT * FROM global_uom   ORDER BY uom ASC";
                                  $countryResult = mysqli_query($connection, $countrySQL);
                                  while($countryRow = mysqli_fetch_assoc($countryResult)){
                                    if($countryRow['id'] == $editCategoryRow['unit']){
                                      print('<option selected value="'.$countryRow['id'].'">'.$countryRow['uom'].'</option>');
                                    }else{
                                      print('<option value="'.$countryRow['id'].'">'.$countryRow['uom'].'</option>');
                                    }
                                  } 
                                ?>
                    </select>
                  </div>
                </div>
				
				<div class="col-12 pb-4">
                          <div class="border position-relative rounded p-2">
                              <label class="bg-white px-2 position-absolute ml-2 mt-n3 small"> Tax</label>
                              <input type="number" name="tax" value="<?php print($editCategoryRow['tax']); ?>" class="form-control border-0 font-weight-bold" required>
                          </div>
                      </div>
					  
                      <div class="col-12 pb-4">
                          <div class="border position-relative rounded p-2">
                              <label class="bg-white px-2 position-absolute ml-2 mt-n3 small"> Search Keyword</label>
                              <input type="text" name="search_keywords" value="<?php print($editCategoryRow['search_keywords']); ?>" class="form-control border-0 font-weight-bold" required>
                          </div>
                      </div>
					  
					  <div class="position-relative border rounded p-2 mb-4">
        <label class="position-absolute px-2 ml-2 bg-white text-muted small mt-n3">Usage Application</label>
        <textarea name="usage_application" class="form-control border-0 no-focus font-weight-bold" rows="5" required><?php print($editCategoryRow['usage_application']); ?></textarea>
    </div>
					  
					  <div class="position-relative border rounded p-2 mb-4">
        <label class="position-absolute px-2 ml-2 bg-white text-muted small mt-n3">Specification</label>
        <textarea name="specification" class="form-control border-0 no-focus font-weight-bold" rows="5" required><?php print($editCategoryRow['specification']); ?></textarea>
    </div>
	
	<label class="py-0 pl-3 m-0 bg-white text-muted small">Product Image 1(Upload only if you want to update Image)</label>
    <div class="custom-file border-0 mb-4">
        <input type="file" accept="image/*" name="product[]" class="custom-file-input borde-0 no-focus" id="ImageSlider1" oninput="imageSliderChange(this.value, 0);">
        <label class="custom-file-label image-slider-label" for="imageSlider1">Choose Image</label>
    </div>

    <label class="py-0 pl-3 m-0 bg-white text-muted small">Product Image 2 (Upload only if you want to update Image)</label>
    <div class="custom-file border-0 mb-4">
        <input type="file" accept="image/*" name="product[]" class="custom-file-input borde-0 no-focus" id="ImageSlider2" oninput="imageSliderChange(this.value, 1);">
        <label class="custom-file-label image-slider-label" for="imageSlider2">Choose Image</label>
    </div>

    <label class="py-0 pl-3 m-0 bg-white text-muted small">Product Image 3 (Upload only if you want to update Image)</label>
    <div class="custom-file border-0 mb-4">
        <input type="file" accept="image/*" name="product[]" class="custom-file-input borde-0 no-focus" id="ImageSlider3" oninput="imageSliderChange(this.value, 2);">
        <label class="custom-file-label image-slider-label" for="imageSlider3">Choose Image</label>
    </div>
				
               
                       
                      <div class="col-12 text-center">
                          <input type="submit" name="updateProduct" class="btn btn-primary w-100 py-3" value="Update Product">
                      </div>
                    </div>
                  </form>
                  <div class="border-top mt-4 pt-4">
                    <a class="btn btn-inverse-primary w-100 py-3" href="product.php">Cancel Edit</a>
                  </div>

                  <?php
                }
                
              }else{

                if(isset($_POST['addProduct'])){
                  $product_name = sanitise($_POST['product_name']);
				  $product_sku = sanitise($_POST['product_sku']);
				  $category = sanitise($_POST['category']);
				  $unit = sanitise($_POST['unit']);
				  $usage_application = sanitise($_POST['usage_application']);
				  $tax = sanitise($_POST['tax']);
				  $specification = sanitise($_POST['specification']);
				  $search_keywords = sanitise($_POST['search_keywords']);
				  $search_keywords_url = makeslug($search_keywords);
				   
				  $product_name_url = makeslug($product_name);
                   
                  $dt2=date("Y-m-d H:i:s");
                    $createdby=  $_SESSION['admin']['email'] ;
                   
                  $addCategoryURLCheckSQL = "SELECT * FROM global_product WHERE product_sku='$product_sku' and status='1'";
                  $addCategoryURLCheckCount = mysqli_num_rows(mysqli_query($connection, $addCategoryURLCheckSQL));
                  if($addCategoryURLCheckCount == 0){

                  $addCategoryStatus = '1';
                     $addCategorySQL = mysqli_query($connection,"INSERT INTO global_product(`product_name`,`product_sku`,`category`,`unit`,`usage_application`,`tax`,`specification`,`search_keywords`,`search_keywords_url`,`product_name_url`,`status`,`created_date`,`created_by`)
					 VALUE('$product_name','$product_sku','$category','$unit','$usage_application','$tax','$specification','$search_keywords','$search_keywords_url','$product_name_url','1','$dt2','$createdby')");
					 
					 $lastId = mysqli_insert_id($connection);
					 if(isset($_FILES['product']) && count($_FILES['product']['name']) > 0){
                if(file_exists('files') == false){
                    mkdir('files');
                }

                for($i=0; $i<count($_FILES['product']['name']); $i++){
                    $fileExtension = strtolower(pathinfo($_FILES['product']['name'][$i], PATHINFO_EXTENSION));
                    $imagepath= time().mt_rand(10000,99999).$i.'.'.$fileExtension;
                    $fileUploadName = 'files/'.$imagepath;
                    if(move_uploaded_file($_FILES['product']['tmp_name'][$i], $fileUploadName)){
                        $fileURL = WEBSITE_URL.'/'.$fileUploadName;
                        mysqli_query($connection,"INSERT INTO `global_product_image`(`product_id`,`image`)VALUES('$lastId','$imagepath')");
                    }
                }
            }
					 
                  print('<div class="alert alert-primary text-center small mb-3">Product  has been added</div>');
                  }
					      
                     else{
                    print('<div class="alert alert-danger text-center small mb-3">Opps!! Something went wrong or SKU already exist.</div>');
                  }
                }
				

                ?>

                  <form class="pt-4" method="POST" action="" enctype="multipart/form-data">
                     
                      <div class="col-12">
                        <h4 class="mb-4 p-0 text-muted">Add New Product</h4>
                      </div>
                      <div class="col-12 pb-4">
                          <div class="border position-relative rounded p-2">
                              <label class="bg-white px-2 position-absolute ml-2 mt-n3 small"> Product Name</label>
                              <input type="text" name="product_name"   class="form-control border-0 font-weight-bold" required>
                          </div>
                      </div>
					  
                      <div class="col-12 pb-4">
                          <div class="border position-relative rounded p-2">
                              <label class="bg-white px-2 position-absolute ml-2 mt-n3 small"> Product SKU</label>
                              <input type="text" name="product_sku"  class="form-control border-0 font-weight-bold" required>
                          </div>
                      </div>
					  
					   
                <div class="col-12 pb-4">
                  <div class="position-relative border rounded p-2">
                    <label class="position-absolute text-muted small mt-n3 px-2 mx-2 bg-white">Category</label>
                    <select name="category" class="custom-select custom-select-sm border-0 no-focus" required>
                      <option value="">None</option>
                                <?php
                                  $countrySQL = "SELECT * FROM global_category   ORDER BY category_name ASC";
                                  $countryResult = mysqli_query($connection, $countrySQL);
                                  while($countryRow = mysqli_fetch_assoc($countryResult)){
                                    if($countryRow['id'] == $editCategoryRow['category']){
                                      print('<option selected value="'.$countryRow['id'].'">'.$countryRow['category_name'].'</option>');
                                    }else{
                                      print('<option value="'.$countryRow['id'].'">'.$countryRow['category_name'].'</option>');
                                    }
                                  } 
                                ?>
                    </select>
                  </div>
                </div>
				
				<div class="col-12 pb-4">
                  <div class="position-relative border rounded p-2">
                    <label class="position-absolute text-muted small mt-n3 px-2 mx-2 bg-white">Unit</label>
                    <select name="unit" class="custom-select custom-select-sm border-0 no-focus" required>
                      <option value="">None</option>
                                <?php
                                  $countrySQL = "SELECT * FROM global_uom   ORDER BY uom ASC";
                                  $countryResult = mysqli_query($connection, $countrySQL);
                                  while($countryRow = mysqli_fetch_assoc($countryResult)){
                                    if($countryRow['id'] == $editCategoryRow['unit']){
                                      print('<option selected value="'.$countryRow['id'].'">'.$countryRow['uom'].'</option>');
                                    }else{
                                      print('<option value="'.$countryRow['id'].'">'.$countryRow['uom'].'</option>');
                                    }
                                  } 
                                ?>
                    </select>
                  </div>
                </div>
				
				<div class="col-12 pb-4">
                          <div class="border position-relative rounded p-2">
                              <label class="bg-white px-2 position-absolute ml-2 mt-n3 small"> Tax</label>
                              <input type="number" name="tax"  class="form-control border-0 font-weight-bold" required>
                          </div>
                      </div>
					  
                      <div class="col-12 pb-4">
                          <div class="border position-relative rounded p-2">
                              <label class="bg-white px-2 position-absolute ml-2 mt-n3 small"> Search Keyword</label>
                              <input type="text" name="search_keywords" class="form-control border-0 font-weight-bold" required>
                          </div>
                      </div>
					  
					  <div class="position-relative border rounded p-2 mb-4">
        <label class="position-absolute px-2 ml-2 bg-white text-muted small mt-n3">Usage Application</label>
        <textarea name="usage_application" class="form-control border-0 no-focus font-weight-bold" rows="5" required> </textarea>
    </div>
					  
					  <div class="position-relative border rounded p-2 mb-4">
        <label class="position-absolute px-2 ml-2 bg-white text-muted small mt-n3">Specification</label>
        <textarea name="specification" class="form-control border-0 no-focus font-weight-bold" rows="5" required> </textarea>
    </div>
	
	<label class="py-0 pl-3 m-0 bg-white text-muted small">Product Image 1</label>
    <div class="custom-file border-0 mb-4">
        <input type="file" accept="image/*" name="product[]" class="custom-file-input borde-0 no-focus" id="ImageSlider1" oninput="imageSliderChange(this.value, 0);">
        <label class="custom-file-label image-slider-label" for="imageSlider1">Choose Image</label>
    </div>

    <label class="py-0 pl-3 m-0 bg-white text-muted small">Product Image 2</label>
    <div class="custom-file border-0 mb-4">
        <input type="file" accept="image/*" name="product[]" class="custom-file-input borde-0 no-focus" id="ImageSlider2" oninput="imageSliderChange(this.value, 1);">
        <label class="custom-file-label image-slider-label" for="imageSlider2">Choose Image</label>
    </div>

    <label class="py-0 pl-3 m-0 bg-white text-muted small">Product Image 3</label>
    <div class="custom-file border-0 mb-4">
        <input type="file" accept="image/*" name="product[]" class="custom-file-input borde-0 no-focus" id="ImageSlider3" oninput="imageSliderChange(this.value, 2);">
        <label class="custom-file-label image-slider-label" for="imageSlider3">Choose Image</label>
    </div>
                       
                      <div class="col-12 text-center">
                          <input type="submit" name="addProduct" class="btn btn-primary w-100 py-3" value="Add Product">
                      </div>
                    </div>
                  </form>

                <?php
              }
            ?>
          </div>

        <?php

            $adminGetCategorySQL = "SELECT * FROM global_product ORDER BY id DESC";

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
                print('<td>Product Name</td>');
				print('<td>Product SKU</td>');
				print('<td>Specification</td>');
                print('<td>Status</td>');
                print('<td colspan="3">Action</td>');
                print('</tr>');
                print('</thead>');
                print('<tbody>');
                while($adminGetCategoryRow = mysqli_fetch_assoc($adminGetCategoryResult)){
                    print('<tr>');

                        print('<td>'.$adminGetCategoryRow['product_name'].'</td>');
						print('<td>'.$adminGetCategoryRow['product_sku'].'</td>');
						print('<td>'.$adminGetCategoryRow['specification'].'</td>');

                        if($adminGetCategoryRow['status'] == 1){
                            print('<td><span class="btn btn-success btn-rounded border-success text-left"><i class="fa fa-check-circle"></i> &nbsp;Active&nbsp;&nbsp;</span></td>');
                        }else{
                            print('<td><span class="btn btn-warning btn-rounded border-warning text-left"><i class="fa fa-exclamation-triangle"></i> Inactive</span></td>');
                        }
                        print('<td><a href="'.WEBSITE_URL.'/product.php?edit='.$adminGetCategoryRow['id'].'" class="btn btn-inverse-primary"><i class="fa fa-pencil"></i> Edit</a></td>');
                        print('<td>');
                            if($adminGetCategoryRow['status'] == 1){
                                print('<a href="'.WEBSITE_URL.'/product-update.php?id='.$adminGetCategoryRow['id'].'" class="btn btn-inverse-warning"><i class="fa fa-exclamation-triangle"></i> Deactivate</a>');
                            }else{
                                print('<a href="'.WEBSITE_URL.'/product-update.php?id='.$adminGetCategoryRow['id'].'" class="btn btn-inverse-success">&nbsp;&nbsp;<i class="fa fa-check-circle"></i> Activate&nbsp;&nbsp;&nbsp;</a>');
                            }
                        print('</td>');
                        print('<td>');
                        ?>
                            <button class="btn btn-inverse-danger" data-toggle="modal" data-target="#confirmCategoryDeleteModal" onclick="confirmCategoryDelete('<?php print($adminGetCategoryRow['product_name']); ?>',<?php print($adminGetCategoryRow['id']); ?>);"><i class="fa fa-trash"></i> Delete</button>
                        <?php
                        print('</td>');
                    print('</tr>');
                }
                print('</tbody>');
                print('</table>');

                if($totalPage > 1){
                  print('<div class="w-100 pt-3">');
                  print('<ul class="pagination justify-content-center">');
                  print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/product.php"><i class="fa fa-angle-double-left"></i> First</a></li>');
                  if($totalPage <= 9){
                      for($i=1; $i<=$totalPage; $i++){
                          $nextPageLink = WEBSITE_URL.'/product.php?page='.$i;
                          print('<li class="page-item"><a class="page-link text-primary" href="'.$nextPageLink.'">'.$i.'</a></li>');
                      }
                  }else{
                      if($page > 3 && $page < ($totalPage - 2)){
                          print('<li class="page-item disabled"><a class="page-link text-primary" href="#">...</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/product.php?page='.($page-2).'">'.($page-2).'</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/product.php?page='.($page-1).'">'.($page-1).'</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/product.php?page='.$page.'">'.$page.'</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/product.php?page='.($page+1).'">'.($page+1).'</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/product.php?page='.($page+2).'">'.($page+2).'</a></li>');
                          print('<li class="page-item disabled"><a class="page-link text-primary" href="#">...</a></li>');
                      }else{
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/product.php?page=1">1</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/product.php?page=2">2</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/product.php?page=3">3</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/product.php?page=4">4</a></li>');
                          print('<li class="page-item disabled"><a class="page-link text-primary" href="#">...</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/product.php?page='.($totalPage-3).'">'.($totalPage-3).'</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/product.php?page='.($totalPage-2).'">'.($totalPage-2).'</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/product.php?page='.($totalPage-1).'">'.($totalPage-1).'</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/product.php?page='.$totalPage.'">'.$totalPage.'</a></li>');
                      }
                  }
                  print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/product.php?page='.$totalPage.'"> Last <i class="fa fa-angle-double-right"></i></a></li>');
                  print('</ul>');
                  print('</div>');
              }
              print('</div>');
                
            }else{
                print('<div class="alert alert-primary text-center small">No Product has been added yet</div>');
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
            <h4>Are you sure you want to delete Product <span id="deleteCategoryName"></span>?</h4>
             
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
            document.getElementById("deleteCategoryId").href = "product-update.php?delete="+id;
        }
		function imageSliderChange(value, target){
        value = value.replace('C:\\fakepath\\', "");
        document.getElementsByClassName("image-slider-label")[target].innerText = value;
    }
    </script>

    <?php include('links-footer.php'); ?>
  </body>
</html>