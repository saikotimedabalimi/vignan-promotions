<?php
  require('./includes/nav.inc.php');  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #667eea, #764ba2);
            color: #fff;
            margin: 0;
            padding: 0;
            animation: fadeIn 1s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .panel {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s;
        }
        .panel:hover {
            transform: scale(1.03);
        }

        .well {
            background: rgba(255, 255, 255, 0.2);
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            transition: 0.3s;
        }
        .well:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .table img {
            width: 50px;
            border-radius: 5px;
            transition: 0.3s;
        }
        .table img:hover {
            transform: scale(1.2);
        }

        .btn {
            transition: 0.3s;
        }
        .btn:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <section id="main">
        <div class="container">
            <div class="row">
                <?php
                    $user_sql = "SELECT COUNT(user_id) AS no_of_users FROM user";
                    $user_result = mysqli_query($con, $user_sql);
                    $user_data = mysqli_fetch_assoc($user_result);
                    $no_of_users = $user_data['no_of_users'];
                    require('./includes/quick-links.inc.php');
                ?>
                <div class="col-md-9">
                    <div class="panel">
                        <div class="panel-heading main-color-bg">
                            <h3 class="panel-title">Overview</h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-4">
                                <div class="well dash-box">
                                    <h2><span class="glyphicon glyphicon-pencil"></span> <?php echo $no_of_articles;?></h2>
                                    <h4>Articles</h4>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="well dash-box">
                                    <h2><span class="glyphicon glyphicon-list-alt"></span> <?php echo $no_of_categories;?></h2>
                                    <h4>Categories</h4>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="well dash-box">
                                    <h2><span class="glyphicon glyphicon-user"></span> <?php echo $no_of_users;?></h2>
                                    <h4>Users</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <?php require('./includes/footer.inc.php'); ?>
</body>
</html>
