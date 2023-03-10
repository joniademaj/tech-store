<?php include("../controller/dashboardController.php"); ?>

<?php if(!isset($_GET["action"])): ?>
    <main class="dashboard-main">
        <section class="side-bar">
            <div class="side-bar-content">
                <div class="side-bar-logo">
                    <img src="../images/logo.png" alt="">
                </div>
                <div class="side-bar-nav">
                    <ul>
                        <li class="active-dashboard"><i class="fa fa-bar-chart"></i><a href=""> Dashboard</a></li>
                        <li><i class="fa fa-list"></i><a href="?action=products"> Products</a></li>
                        <li><i class="fa fa-shopping-cart"></i><a href="?action=orders"> Orders</a></li>
                        <li><i class="fa fa-check"></i><a href=""> Membership</a></li>
                        <li><i class="fa fa-file"></i><a href=""> Content Area</a></li>
                        <li><i class="fa fa-gear"></i><a href=""> Settings</a></li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="main-charts">
            <div class="main-charts-content">
                <div class="search">
                    <form action="">
                        <input type="text" class="search" placeholder="Search...">
                    </form>
                </div>
                <div class="total-sales">
                    <div class="total-sales-content">
                        <p style="color: #383838;">Total Sales</p>
                        <p class="total">$500,917.00</p>
                        <p class="profit-percentage" style="font-weight: bold; color: green">
                            <i class="fa fa-arrow-up"></i>
                            15%
                        </p>
                    </div>
                    <div class="year">
                        <a href="">Last Year</a>
                    </div>
                </div>
                <div id="columnchart_material" class="chart"></div>
                <div class="growing-rates">
                    <div class="rates">
                        <div class="rate">
                            <div class="rate-img">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="info">
                                <p>Daily Viewers</p>
                                <p>31,555 <span style="color: green;"> <i class="fa fa-arrow-up"></i> 20%</span></p>
                            </div>
                        </div>
                        <div class="rate">
                            <div class="rate-img">
                                <i class="fa fa-shopping-bag"></i>
                            </div>
                            <div class="info">
                                <p>Total Orders</p>
                                <p>31,555 <span style="color: red;"> <i class="fa fa-arrow-down"></i> 20%</span></p>
                            </div>
                        </div>
                        <div class="rate">
                            <div class="rate-img">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="info">
                                <p>Conversion Rate</p>
                                <p>31,555 <span style="color: green;"> <i class="fa fa-arrow-up"></i> 20%</span></p>
                            </div>
                        </div>
                        <div class="rate">
                            <div class="rate-img">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <div class="info">
                                <p>Daily Viewers</p>
                                <p>31,555 <span style="color: red;"> <i class="fa fa-arrow-down"></i> 20%</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="most-ordered-products">
                    <div>
                        <div class="title">
                            <p style="color: #383838;font-family: 'Source Sans Pro', sans-serif;">Top products</p>
                        </div>
                        <div class="dashboard-product-info">
                            <div class="image">
                                <img src="images/iphone.webp" alt="">
                                <div>
                                    <p>Iphone 14 Pro Max</p>
                                    <p>Iphone 14 Pro Max 512GB 10 orders</p>
                                </div>
                            </div>
                            <div class="inventory">
                                <p>Inventory</p>
                                <p>555</p>
                            </div>
                            <div>
                                <p>Price</p>
                                <p>$1,555.90</p>
                            </div>
                            <div>
                                <p>Sale</p>
                                <p>$2,555.90</p>
                            </div>
                            <div>
                                <p>Today</p>
                                <p>$5,555.90</p>
                            </div>
                        </div>
                        <div class="dashboard-product-info">
                            <div class="image">
                                <img src="images/iphone.webp" alt="">
                                <div>
                                    <p>Iphone 14 Pro Max</p>
                                    <p>Iphone 14 Pro Max 512GB 10 orders</p>
                                </div>
                            </div>
                            <div class="inventory">
                                <p>Inventory</p>
                                <p>555</p>
                            </div>
                            <div>
                                <p>Price</p>
                                <p>$1,555.90</p>
                            </div>
                            <div>
                                <p>Sale</p>
                                <p>$2,555.90</p>
                            </div>
                            <div>
                                <p>Today</p>
                                <p>$5,555.90</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="activity">
            <div class="activity-content">
                <div class="admin-profile">
                    <i class="fa fa-ellipsis-v"></i>
                    <i class="fa fa-bell"></i>
                    <div class="profile">
                    <?php 
                        if(isset($_SESSION["user_id"])){
                            $id = $_SESSION["user_id"];
                        }
                        $user = $db->getUserById($id);
                        $userLogo = null;
                        if($user != null){
                            $userLogo = $user["full_name"][0];
                        }
                    ?>
                    <a style="text-decoration: none;" href="" class="user"> <?php echo $userLogo; ?></a>

                    </div>
                </div>
                <div class="activity-header">
                    <p>Activity</p>
                    <a href="">Insight</a>
                </div>
                <div class="activity-body">
                    <div class="activity-card">
                        <p>Active Visitors right now</p>
                        <p class="viewers">3243</p>
                        <p style="font-size: 13px;">Page view per minute</p>
                        <div id="piechart" style="background-color: transparent; width: 310px; height: 130px;"></div>
                    </div>
                </div>
            </div>
        </section>

    </main>
    <?php endif; ?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Activity', 'Hours per Day'],
          ['Male',     11],
          ['Female',      2],
          ['Not Specified',  2],
        ]);

        var options = {
          title: 'Activity'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses', 'Profit'],
          ['2014', 1000, 400, 200],
          ['2015', 1170, 460, 250],
          ['2016', 660, 1120, 300],
          ['2017', 1030, 540, 350],
          ['2018', 660, 600, 800],
          ['2019', 660, 500, 900],
          ['2020', 660, 400, 800],
          ['2021', 660, 700, 1000],
          ['2022', 660, 300, 1200]
        ]);

        var options = {
          chart: {
            title: 'Company Performance',
            subtitle: 'Sales, Expenses, and Profit: 2014-2022',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
</body>
</html>