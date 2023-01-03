<?php
  require('config.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Category</title>
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

                if(isset($_POST['updateCategory'])){
                  $editUpdateCategoryName = sanitise($_POST['category_name']);
                   
                  $dt2=date("Y-m-d H:i:s");
                    $createdby=  $_SESSION['admin']['email'] ;
					
					$sql = "select * from global_category where `category_name` = '$editUpdateCategoryName' and status='1' and  id <>'".$_GET['edit']."' ";
		$query = mysqli_query($connection,$sql);
		$trows = mysqli_num_rows($query);
                 if($trows==0) {
        $insertproduct=mysqli_query($connection,"UPDATE global_category SET category_name = '$editUpdateCategoryName',modified_date = '$dt2',modified_by = '$createdby' WHERE id = '$editId'");
                   
                    print('<div class="alert alert-primary small text-center">Category has been updated</div>');
                  }else{
                    print('<div class="alert alert-danger small text-center">Opps!! Something went wrong,or already exist.</div>');
                  }
                }

                $editCategorySQL = "SELECT * FROM global_category WHERE id = '$editId'";
                $editCategoryResult = mysqli_query($connection, $editCategorySQL);
                if(mysqli_num_rows($editCategoryResult) == 1){
                  $editCategoryRow = mysqli_fetch_assoc($editCategoryResult);
                  ?>

                  <form method="POST" action="">
                    <div class="row">
                      <div class="col-12">
                        <h4 class="mb-4 p-0 text-muted">Edit Category <?php print(ucwords($editCategoryRow['category_name'])); ?></h4>
                      </div>
                      <div class="col-12 pb-4">
                          <div class="border position-relative rounded p-2">
                              <label class="bg-white px-2 position-absolute ml-2 mt-n3 small">Category Name</label>
                              <input type="text" name="category_name" value="<?php print($editCategoryRow['category_name']); ?>" class="form-control border-0 font-weight-bold" required>
                          </div>
                      </div>
                       
                      <div class="col-12 text-center">
                          <input type="submit" name="updateCategory" class="btn btn-primary w-100 py-3" value="Update Category">
                      </div>
                    </div>
                  </form>
                  <div class="border-top mt-4 pt-4">
                    <a class="btn btn-inverse-primary w-100 py-3" href="category.php">Cancel Edit</a>
                  </div>

                  <?php
                }
                
              }else{

                if(isset($_POST['addNewCategory'])){
                  $addCategoryTitle = sanitise($_POST['category_name']);
				  
                   
                  $addCategoryURLCheckSQL = "SELECT * FROM global_category WHERE category_name='$addCategoryTitle'";
                  $addCategoryURLCheckCount = mysqli_num_rows(mysqli_query($connection, $addCategoryURLCheckSQL));
                  if($addCategoryURLCheckCount == 0){
					  $dt2=date("Y-m-d H:i:s");
                    $createdby=  $_SESSION['admin']['email'] ;

                  $addCategoryStatus = '1';
                     $addCategorySQL = mysqli_query($connection,"INSERT INTO global_category(`category_name`,`status`,`created_date`,`created_by`)VALUE('$addCategoryTitle','$addCategoryStatus','$dt2','$createdby')");
                  print('<div class="alert alert-primary text-center small mb-3">Category  has been added</div>');
                  }
					      
                     else{
                    print('<div class="alert alert-danger text-center small mb-3">Opps!! Something went wrong or already exist.</div>');
                  }
                }
				

                ?>

                  <form method="POST" action="">
                    <div class="row">
                      <div class="col-12">
                        <h4 class="mb-4 p-0 text-muted">Add New Category</h4>
                      </div>
                      <div class="col-12 pb-4">
                          <div class="border position-relative rounded p-2">
                              <label class="bg-white px-2 position-absolute ml-2 mt-n3 small">Category Name</label>
                              <input type="text" name="category_name" class="form-control border-0 font-weight-bold" required>
                          </div>
                      </div>
                       
                      <div class="col-12 text-center">
                          <input type="submit" name="addNewCategory" class="btn btn-primary w-100 py-3" value="Add Category">
                      </div>
                    </div>
                  </form>

                <?php
              }
            ?>
          </div>

        <?php

            $adminGetCategorySQL = "SELECT * FROM global_category ORDER BY id DESC";

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
                print('<td>Category Name</td>');
                print('<td>Status</td>');
                print('<td colspan="3">Action</td>');
                print('</tr>');
                print('</thead>');
                print('<tbody>');
                while($adminGetCategoryRow = mysqli_fetch_assoc($adminGetCategoryResult)){
                    print('<tr>');

                        print('<td>'.$adminGetCategoryRow['category_name'].'</td>');

                        if($adminGetCategoryRow['status'] == 1){
                            print('<td><span class="btn btn-success btn-rounded border-success text-left"><i class="fa fa-check-circle"></i> &nbsp;Active&nbsp;&nbsp;</span></td>');
                        }else{
                            print('<td><span class="btn btn-warning btn-rounded border-warning text-left"><i class="fa fa-exclamation-triangle"></i> Inactive</span></td>');
                        }
                        print('<td><a href="'.WEBSITE_URL.'/category.php?edit='.$adminGetCategoryRow['id'].'" class="btn btn-inverse-primary"><i class="fa fa-pencil"></i> Edit</a></td>');
                        print('<td>');
                            if($adminGetCategoryRow['status'] == 1){
                                print('<a href="'.WEBSITE_URL.'/category-status-toggle.php?id='.$adminGetCategoryRow['id'].'" class="btn btn-inverse-warning"><i class="fa fa-exclamation-triangle"></i> Deactivate</a>');
                            }else{
                                print('<a href="'.WEBSITE_URL.'/category-status-toggle.php?id='.$adminGetCategoryRow['id'].'" class="btn btn-inverse-success">&nbsp;&nbsp;<i class="fa fa-check-circle"></i> Activate&nbsp;&nbsp;&nbsp;</a>');
                            }
                        print('</td>');
                        print('<td>');
                        ?>
                            <button class="btn btn-inverse-danger" data-toggle="modal" data-target="#confirmCategoryDeleteModal" onclick="confirmCategoryDelete('<?php print($adminGetCategoryRow['category_name']); ?>',<?php print($adminGetCategoryRow['id']); ?>);"><i class="fa fa-trash"></i> Delete</button>
                        <?php
                        print('</td>');
                    print('</tr>');
                }
                print('</tbody>');
                print('</table>');

                if($totalPage > 1){
                  print('<div class="w-100 pt-3">');
                  print('<ul class="pagination justify-content-center">');
                  print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/category.php"><i class="fa fa-angle-double-left"></i> First</a></li>');
                  if($totalPage <= 9){
                      for($i=1; $i<=$totalPage; $i++){
                          $nextPageLink = WEBSITE_URL.'/category.php?page='.$i;
                          print('<li class="page-item"><a class="page-link text-primary" href="'.$nextPageLink.'">'.$i.'</a></li>');
                      }
                  }else{
                      if($page > 3 && $page < ($totalPage - 2)){
                          print('<li class="page-item disabled"><a class="page-link text-primary" href="#">...</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/category.php?page='.($page-2).'">'.($page-2).'</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/category.php?page='.($page-1).'">'.($page-1).'</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/category.php?page='.$page.'">'.$page.'</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/category.php?page='.($page+1).'">'.($page+1).'</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/category.php?page='.($page+2).'">'.($page+2).'</a></li>');
                          print('<li class="page-item disabled"><a class="page-link text-primary" href="#">...</a></li>');
                      }else{
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/category.php?page=1">1</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/category.php?page=2">2</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/category.php?page=3">3</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/category.php?page=4">4</a></li>');
                          print('<li class="page-item disabled"><a class="page-link text-primary" href="#">...</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/category.php?page='.($totalPage-3).'">'.($totalPage-3).'</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/category.php?page='.($totalPage-2).'">'.($totalPage-2).'</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/category.php?page='.($totalPage-1).'">'.($totalPage-1).'</a></li>');
                          print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/category.php?page='.$totalPage.'">'.$totalPage.'</a></li>');
                      }
                  }
                  print('<li class="page-item"><a class="page-link text-primary" href="'.WEBSITE_URL.'/category.php?page='.$totalPage.'"> Last <i class="fa fa-angle-double-right"></i></a></li>');
                  print('</ul>');
                  print('</div>');
              }
              print('</div>');
                
            }else{
                print('<div class="alert alert-primary text-center small">No Category has been added yet</div>');
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
            <h4>Are you sure you want to delete category <span id="deleteCategoryName"></span>?</h4>
            <small>Deleteing a category deletes all product from that category, Consider Deactivating category</small>
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
            document.getElementById("deleteCategoryId").href = "category-delete.php?id="+id;
        }
    </script>

    <?php include('links-footer.php'); ?>
  </body>
</html>