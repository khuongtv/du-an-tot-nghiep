<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("location: login.php");
    die;
}
require_once "db.php";
$sql = "Select * From likes";
//Chuẩn bị
$stmt = $conn->prepare($sql);
//Thực thi lệnh
$stmt->execute();
//Lấy dữ liệu
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//var_dump($result);
?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Light Bootstrap Dashboard by Creative Tim</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="a/assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="a/ssets/css/animate.min.css" rel="stylesheet" />

    <!--  Light Bootstrap Table core CSS    -->
    <link href="a/assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet" />


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="a/assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
</head>

<body>

    <div class="wrapper">
        <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

            <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="" class="simple-text">
                        QUẢN TRỊ THÔNG TIN
                    </a>
                </div>

                <ul class="nav" style="margin-left: 20px; color: black;">
                    <li>
                        <a href="link1.php">
                            <i class="pe-7s-graph"></i>
                            <p style="color: black;">Danh Mục</p>
                        </a>
                    </li>

                    <li class="active">
                        <a href="link.php">
                            <i class="pe-7s-note2"></i>
                            <p style="color: black;">Sản Phẩm</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="spkm.php">
                            <i class="pe-7s-note2"></i>
                            <p style="color: black;">sản phẩm mới ra mắt</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="slide.php">
                            <i class="pe-7s-note2"></i>
                            <p style="color: black;">slider</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="sale.php">
                            <i class="pe-7s-note2"></i>
                            <p style="color: black;">sale</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="srm.php">
                            <i class="pe-7s-note2"></i>
                            <p style="color: black;">sản phẩm sắp ra mắt</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="spads.php">
                            <i class="pe-7s-note2"></i>
                            <p style="color: black;">sản phẩm yêu thích</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="like.php">
                            <i class="pe-7s-note2"></i>
                            <p style="color: black;">sản phẩm yêu thích pp</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-panel">
            <nav class="navbar navbar-default navbar-fixed">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">quản trị sản phẩm</a>
                        <a style="margin-left: 1200px;" class="navbar-brand" href="logout.php">đăng xuất</a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-dashboard"></i>
                                    <p class="hidden-lg hidden-md">Dashboard</p>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-globe"></i>
                                    <b class="caret hidden-sm hidden-xs"></b>
                                    <span class="notification hidden-sm hidden-xs">5</span>
                                    <p class="hidden-lg hidden-md">
                                        5 Notifications
                                        <b class="caret"></b>
                                    </p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Notification 1</a></li>
                                    <li><a href="#">Notification 2</a></li>
                                    <li><a href="#">Notification 3</a></li>
                                    <li><a href="#">Notification 4</a></li>
                                    <li><a href="#">Another notification</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fa fa-search"></i>
                                    <p class="hidden-lg hidden-md">Search</p>
                                </a>
                            </li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="">
                                    <p>Account</p>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <p>
                                        Dropdown
                                        <b class="caret"></b>
                                    </p>

                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">
                                    <p>Log out</p>
                                </a>
                            </li>
                            <li class="separator hidden-lg hidden-md"></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="content">
                <div class="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="c">

                                <a href="them_like.php">Thêm danh mục</a>
                                <br> <a href="index.php">quay về trang chủ</a>
                                <?php if (isset($_GET['message'])) : ?>
                                    <p><?= $_GET['message'] ?></p>
                                <?php endif; ?>
                                <br><br>
                                <table border="1" style="width: 100%; text-align: center; border-radius: 4px reb;">
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th>mã like</th>

                                            <th>mã sản phẩm like</th>
                                            <th>tên sản phẩm</th>
                                            <th>giới thiệu</th>
                                            <th>chi tiết</th>
                                            <th>ảnh</th>
                                            <th>giá</th>

                                            <th>hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($result as $c) : ?>
                                            <tr>
                                                <td>
                                                    <?= $c['like_id'] ?>
                                                </td>
                                                <td><?= $c['ads_id'] ?></td>
                                                <td><?= $c['like_name'] ?></td>
                                                <td><?= $c['intro'] ?></td>
                                                <td><?= $c['detail'] ?></td>
                                                <td>
                                                    <img src="images/<?= $c['like_image'] ?>" width="120" alt="">
                                                </td>
                                                <td><?= $c['price'] ?></td>

                                                <td>
                                                    <a href="capnhat_like.php?id=<?= $c['like_id'] ?>">Sửa</a> |

                                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="xoa_like.php?id=<?= $c['like_id'] ?>">Xóa</a>

                                                </td>
                                            </tr>

                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div> <br>
                            </center>
                        </div>


                        <div class="col-md-12">
                            <div class="card card-plain">



                            </div>
                        </div>


</body>

<!--   Core JS Files   -->
<script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>


</html>