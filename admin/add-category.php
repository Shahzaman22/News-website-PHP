<?php include "header.php";
if($_SESSION['user_role'] == 0){
    header("Location: {$hostname}/admin/post.php");
}

if(isset($_POST['save'])){
    include "config.php";

$category_id = mysqli_real_escape_string($conn,$_POST['category_id']);
$category_name = mysqli_real_escape_string($conn,$_POST['category_name']);
$post = mysqli_real_escape_string($conn,$_POST['post']);

$sql = "SELECT category_id FROM category WHERE category_id = '{$category_id}'";
$result = mysqli_query($conn,$sql) or die("query failed.");
if(mysqli_num_rows($result) > 0){
    echo "Category name already exist";
}else{
    $sql1 = "INSERT INTO category (category_id,category_name,post) VALUES ('{$category_id}','{$category_name}','{$post}')";
    if(mysqli_query($conn,$sql1)){
        header("Location: {$hostname}/admin/category.php");
    }
}

}

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category ID</label>
                          <input type="text" name="category_id" class="form-control" placeholder="Category ID" required>
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="category_name" class="form-control" placeholder="Category Name" required>
                      </div>
                      <div class="form-group">
                          <label>Category post</label>
                          <input type="text" name="post" class="form-control" placeholder="Category post" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
