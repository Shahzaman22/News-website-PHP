<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                  <h2 class="page-heading">Category Name</h2>
                  <?php 
                   include "config.php";
                   if(isset($_GET['cid'])){
                    $cat_id =$_GET['cid'];
                }

                   $limit = 3;
                   if (isset($_GET['page'])) {
                       $page = $_GET['page'];
                   } else {
                       $page = 1;
                   }
                   $offset = ($page - 1) * $limit;

                   $sql = "SELECT * FROM post
                   LEFT JOIN category ON category.category_id = post.category
                   LEFT JOIN user ON user.user_id = post.author WHERE post.category = {$cat_id} ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";

                $result = mysqli_query($conn, $sql) or die('query failed.');
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                   ?>

                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?id=<?php echo $row['post_id']; ?>"><img src="admin/upload/<?php echo $row['post_img']; ?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?id=<?php echo $row['post_id']; ?>'><?php echo $row['title']; ?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php'><?php echo $row['category']; ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php'><?php echo $row['author']; ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $row['post_date']; ?>
                                            </span>
                                        </div>
                                        <p class="description">
                                        <?php echo substr($row['description'],0,110). "..."; ?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id']; ?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                            <?php 
                }
            }else{
             echo   "<h2>No Record Found</h2>";
            }
                            ?>
                        </div>
                        <?php 
                        $sql1 = "SELECT * FROM category";
                        $result1 = mysqli_query($conn, $sql1) or die("failed");
                        if(mysqli_num_rows($result1) > 0){
                            
                            $total_records = mysqli_num_rows($result1);
                            $total_page = ceil($total_records / $limit);
                            echo "<ul class='pagination admin-pagination'>";
                        }
            
                        if($page > 1){
                            echo '<li><a href="index.php?page='. ($page - 1) .'">Prev</a></li>';
                        }
            
                        for($i = 1;$i <= $total_page; $i++){
                            
                            if($i == $page){
                            $active = "active";
                        }else{
                            $active = "";
                        } 
                    echo "<li class='$active'><a href='index.php?page={$i}'>{$i}</a></li>";   
            
                        }
            
                    if($page < $total_page){
                        echo '<li><a href="index.php?page='.($page + 1) .'">Next</a></li>';
                    }    
                            echo "</ul>";
                            ?>
                    
                
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
