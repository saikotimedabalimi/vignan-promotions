<?php
  require('../includes/database.inc.php');

  $art_sql = "SELECT COUNT(article_id) AS no_of_articles FROM article";
  $art_result = mysqli_query($con, $art_sql);
  $art_data = mysqli_fetch_assoc($art_result);
  $no_of_articles = $art_data['no_of_articles'];

  $cat_sql = "SELECT COUNT(category_id) AS no_of_categories FROM category";
  $cat_result = mysqli_query($con, $cat_sql);
  $cat_data = mysqli_fetch_assoc($cat_result);
  $no_of_categories = $cat_data['no_of_categories'];
?>

<div class="col-md-3">
  <div class="list-group">
    <a href="./index.php" class="list-group-item active main-color-bg">
      <span class="glyphicon glyphicon-link"></span> Quick Links
    </a>
    <a href="./index.php" class="list-group-item">
      <span class="glyphicon glyphicon-home"></span> Dashboard
    </a>
    <a href="./articles.php" class="list-group-item">
      <span class="glyphicon glyphicon-pencil"></span> Articles
      <span class="badge"><?php echo $no_of_articles ?></span>
    </a>
    <a href="./categories.php" class="list-group-item">
      <span class="glyphicon glyphicon-list"></span> Categories
      <span class="badge"><?php echo $no_of_categories ?></span>
    </a>
    <a href="./change-password.php" class="list-group-item">
      <span class="glyphicon glyphicon-cog"></span> Change Password
    </a>
    <a href="./logout.php" class="list-group-item">
      <span class="glyphicon glyphicon-log-out"></span> Logout
    </a>
  </div>
</div>

<style>
  /* Sidebar Styling */
  .list-group {
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
  }

  .list-group-item {
      font-size: 16px;
      font-weight: 500;
      transition: all 0.3s ease-in-out;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border: none;
      padding: 12px 15px;
  }

  /* Hover Effects */
  .list-group-item:hover {
      background: linear-gradient(90deg, #007bff, #0056b3);
      color: white;
      transform: translateX(5px);
  }

  /* Active Item Style */
  .list-group-item.active {
      background: linear-gradient(90deg, #ff512f, #dd2476);
      color: white;
      font-weight: bold;
  }

  .list-group-item .glyphicon {
      margin-right: 8px;
  }

  /* Badge Styling */
  .badge {
      background: #ff512f;
      color: white;
      font-size: 14px;
      font-weight: bold;
      padding: 5px 10px;
      border-radius: 12px;
      animation: pop 0.6s infinite alternate ease-in-out;
  }

  /* Badge Animation */
  @keyframes pop {
      0% {
          transform: scale(1);
      }
      100% {
          transform: scale(1.1);
      }
  }
</style>
