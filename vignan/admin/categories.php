<?php
  require('./includes/nav.inc.php');  
?>

<style>
  body {
    background: linear-gradient(to right, #6a11cb, #2575fc);
    font-family: Arial, sans-serif;
  }

  .panel {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    animation: fadeIn 1s ease-in-out;
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .table-hover tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.1);
    transition: background 0.3s;
  }

  .pagination .page-item .page-link {
    border-radius: 50px;
    transition: all 0.3s;
  }

  .pagination .page-item .page-link:hover {
    background-color: #ff6b6b;
    color: #fff;
  }

  .btn-primary:hover {
    transform: scale(1.1);
    transition: all 0.3s ease-in-out;
  }
</style>

<!-- BREADCRUMB -->
<section id="breadcrumb">
  <div class="container">
    <ol class="breadcrumb">
      <li><a href="./index.php">Dashboard</a></li>
      <li class="active">Categories</li>
    </ol>
  </div>
</section>

<section id="main">
  <div class="container">
    <div class="col-md-12">
      <?php
        $limit = 5;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;
        $sql = "SELECT * FROM category ORDER BY category_name ASC LIMIT {$offset},{$limit}";
        $result = mysqli_query($con,$sql);
      ?>
      <div class="panel panel-default">
        <div class="panel-heading main-color-bg">
          <h3 class="panel-title">Categories</h3>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-hover article-list">
            <tr>
              <th style="text-align:center">Name</th>
              <th>Image</th>
              <th>Description</th>
              <th>Tag Color</th>
              <th>Actions</th>
            </tr>
            <?php while($data = mysqli_fetch_assoc($result)): ?>
              <tr>
                <td style="text-align:center;"> <?= $data['category_name'] ?> </td>
                <td><img src="../assets/images/category/<?= $data['category_image'] ?>" /></td>
                <td><?= $data['category_description'] ?></td>
                <td><div class="tag <?= $data['category_color'] ?>"> <?= $data['category_name'] ?> </div></td>
                <td>
                  <a class="btn btn-primary" href="./edit-category.php?id=<?= $data['category_id'] ?>">
                    <span class="glyphicon glyphicon-pencil"></span>
                  </a>
                </td>
              </tr>
            <?php endwhile; ?>
          </table>
        </div>
        <div class="text-center">
          <ul class="pagination pg-red">
            <?php
              $paginationQuery = "SELECT * FROM category";
              $paginationResult = mysqli_query($con, $paginationQuery);
              $total_categories = mysqli_num_rows($paginationResult);
              $total_page = ceil($total_categories / $limit);
              if($page > 1) echo '<li class="page-item"><a href="categories.php?page='.($page-1).'" class="page-link">&laquo;</a></li>';
              for($i = 1; $i <= $total_page; $i++) {
                $active = ($i == $page) ? "active" : "";
                echo '<li class="page-item '.$active.'"><a href="./categories.php?page='.$i.'" class="page-link">'.$i.'</a></li>';
              }
              if($total_page > $page) echo '<li class="page-item"><a href="categories.php?page='.($page+1).'" class="page-link">&raquo;</a></li>';
            ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
  require('./includes/footer.inc.php')
?>
