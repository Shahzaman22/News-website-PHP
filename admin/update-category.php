<?php include "header.php"; 
if($_SESSION['user_role'] == 0){
    header("Location: {$hostname}/admin/post.php");
}

if(isset($_POST['update'])){

    include "config.php";
$catid = mysqli_real_escape_string($conn,$_POST['category_id']); 
$category_name = mysqli_real_escape_string($conn,$_POST['category_name']);
$post = mysqli_real_escape_string($conn,$_POST['post']);

$sql = "UPDATE category SET category_name = '{$category_name}', post = '{$post}' WHERE category_id = {$catid}";
if(mysqli_query($conn,$sql)){
    header("Location: {$hostname}/admin/category.php");
    }
}

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">

            <?php 
                include "config.php";
        $catid = $_GET['id'];        
        $sql1 = "SELECT * FROM category WHERE category_id = {$catid}";
        $result = mysqli_query($conn,$sql1) or die("Query failed");
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){

         
            ?>

                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="category_id"  class="form-control" value="<?php echo $row['category_id']; ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="category_name" class="form-control" value="<?php echo $row['category_name']; ?>"  placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Category post</label>
                          <input type="text" name="post" class="form-control" value="<?php echo $row['post']; ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="update" class="btn btn-primary" value="Update" required />
                  </form>
                <?php 
                   }
                }
                ?>

                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
