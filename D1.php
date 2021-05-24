<?php
 $servername="frwahxxknm9kwy6c.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
 $dBUsername="wbpfsqpbf19x9i7p";
 $dBPassword="drhivouktineutbx";
 $dBName="y07pmyvo0be73diq";
$conn=mysqli_connect($servername,$dBUsername,$dBPassword,$dBName);
$auth=$_GET['auth'];
$user=$_GET['username'];
$sql='SELECT * FROM userauth2 WHERE token=?';
   $stmt=mysqli_stmt_init($conn);
 if(!mysqli_stmt_prepare($stmt,$sql)){
       header("Location:Signin.php?error=SQL1");
       exit();
}
   mysqli_stmt_bind_param($stmt,"s",$auth);
   mysqli_stmt_execute($stmt);
   mysqli_stmt_store_result($stmt);
   $count=mysqli_stmt_num_rows($stmt);
 if (!$count>0){
    header("Location:Signin.php?error=notloggedin");
    exit();
}
$query="SELECT * FROM oders WHERE idOrderConfirmation='Pending'";
$result=mysqli_query($conn,$query);
$count=mysqli_num_rows($result);
   
?>
<html lang="en">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Multikart admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Multikart admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <title>Distribution Agent</title>

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="fontawesome.css">

    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="flag-icon.css">

    <!-- Datatable css-->
    <link rel="stylesheet" type="text/css" href="datatables.css">

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="bootstrap.css">

    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="admin.css">
</head>
<body>

<!-- page-wrapper Start-->
<div class="page-wrapper">

     <!-- Page Header Start-->
    <div class="page-main-header">
        <div class="main-header-right row">
            <div class="main-header-left d-lg-none">
                <div class="logo-wrapper"> </div>
            </div>
            <div class="mobile-sidebar">
                <div class="media-body text-right switch-sm">
                    <label class="switch"><a href="#"><i id="sidebar-toggle" data-feather="align-left"></i></a></label>
                </div>
            </div>
            
        </div>
    </div>
    <!-- Page Header Ends -->

    <!-- Page Body Start-->
    <div class="page-body-wrapper">

        <!-- Page Sidebar Start-->
        <div class="page-sidebar">
            <div class="main-header-left d-none d-lg-block">
                <div class="logo-wrapper"></div>
            </div>
            <div class="sidebar custom-scrollbar">
                <div class="sidebar-user text-center">
                    <div>
                    </div>
                    <h6 class="mt-3 f-14"><?php echo $_GET['username'];?></h6>
                    <p>Distribution Agent</p>
                </div>
                <ul class="sidebar-menu">
                    <li><a class="sidebar-header" href="DH.php?username=<?php echo $_GET['username'];?>&auth=<?php echo $_GET['auth'];?>"><i data-feather="home"></i><span>Dashboard</span></a></li>
                    <li><a class="sidebar-header" href="#"><i data-feather="box"></i><span>Order Preparation</span></a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="Distro.php?username=<?php echo $_GET['username'];?>&auth=<?php echo $_GET['auth'];?>"><i class="fa fa-circle"></i>
                                    <span>Pending orders</span> 
                                </a>
                          
                            </li>
                            <li>
                                <a href="D2.php?username=<?php echo $_GET['username'];?>&auth=<?php echo $_GET['auth'];?>"><i class="fa fa-circle"></i>
                                    <span>Scan pending orders</span> 
                                </a>
                                
                            </li>
                        </ul>
                    </li>
                    
                    
                    
                    <li><a class="sidebar-header" href="#"><i data-feather="chrome"></i><span>Order collection</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="C1.php?username=<?php echo $_GET['username'];?>&auth=<?php echo $_GET['auth'];?>"><i class="fa fa-circle"></i>Collection codes</a></li>
                            
                        </ul>
                    </li>

                    <li><a class="sidebar-header" href="#"><i data-feather="clipboard"></i><span>History</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="#"><i class="fa fa-circle"></i>Transactions</a></li>
                            
                        </ul>
                    </li>

                    <li><a class="sidebar-header" href="#"><i data-feather="bar-chart"></i><span>Reports</span></a></li>
                    
                    <li><a class="sidebar-header" href="Logout.php"><i data-feather="log-in"></i><span>Logout</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Page Sidebar Ends-->

        <!-- Right sidebar Start-->
        
        <!-- Right sidebar Ends-->

        <div class="page-body">

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <h3>Canibuy distribution
                                    <small>Distribution management</small>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item active"><span>Orders pending:</span> <?php print_r($count); ?></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

            <!-- Container-fluid starts-->
            <div class="container-fluid" width="100%">
                <div class="card">
                    <div class="card-header">
                        <h5>Order prepared</h5>
                    </div>
                    <div class="card-body vendor-table" >
                         <div id="hideON">
                         <br>
                         <strong><span>Order number:</strong><span> </span>[000<?php print_r($row['idOrders']); ?>]</span>
                         <br>
                         <br>
                         </div>
                         <div id="hideDP">
                         <strong><span>Durban Poison:</strong><span> </span><?php print_r($row['idOrderDPgrams']); ?> grams</span>
                         <br>
                         <br>
                         </div>
                         <div id="hideOC">
                         <strong><span>Orange Cali:</strong><span> </span><?php print_r($row['idOrderOCgrams']); ?> grams</span>
                         <br>
                         <br>
                         </div>
                         <div id="hideBW">
                         <strong><span>Blunt wrap:</strong><span> </span><?php print_r($row['idOrderBWgrams']); ?> grams</span>
                         <br>
                         <br>
                         </div>
                         <div id="hideCC">
                         <strong><span>Dabcaps:</strong><span> </span><?php print_r($row['idOrderCCbatches']); ?> batches</span>
                         <br>
                         <br>
                         </div>
                         <div id="hidePR">
                         <strong><span>Pre-Rolls:</strong><span> </span><?php print_r($row['idOrderPRjays']); ?> Joints</span>
                         <br>
                         <br>
                         </div>
                         <div id="hideNL">
                         <strong><span>Northern Lights:</strong><span> </span><?php print_r($row['idOrderNLgrams']); ?> grams</span>
                         <br>
                         <br>
                         </div>
                         <div id="hideCCES">
                         <strong><span>DabcapsES:</strong><span> </span><?php print_r($row['idOrderCCESbatches']); ?> batches</span>
                         <br>
                         <br>
                         </div>
                         <div id="hidePE">
                         <strong><span>Pineapple Express:</strong><span> </span><?php print_r($row['idOrderPEgrams']); ?> grams</span>
                         <br>
                         <br>
                         </div>
                         <form action="PH.php" method="get" id="form">
                         <input type="hidden" name="auth" value="<?php echo $_GET['auth'] ?>">
                         <input type="hidden" name="username" value="<?php echo $_GET['username'] ?>">
                         <input type="submit" name="Prepared" value="Next order" id="Blanks" "/>
                         </form>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

        </div>

        <!-- footer start-->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 footer-copyright">
                        <p class="mb-0">Copyright 2020 Plug Tech Creations.</p>
                    </div>
                   
                </div>
            </div>
        </footer>
        <!-- footer end-->

    </div>

</div>

<!-- latest jquery-->
<script src="jquery-3.3.1.min.js"></script>

<!-- Bootstrap js-->
<script src="popper.min.js"></script>
<script src="bootstrap.js"></script>

<!-- feather icon js-->
<script src="feather.min.js"></script>
<script src="feather-icon.js"></script>

<!-- Sidebar jquery-->
<script src="sidebar-menu.js"></script>

<!-- Datatables js-->
<script src="jquery.dataTables.min.js"></script>
<script src="custom-basic.js"></script>

<!--Customizer admin-->
<script src="admin-customizer.js"></script>

<!-- lazyload js-->
<script src="lazysizes.min.js"></script>

<!--right sidebar js-->
<script src="chat-menu.js"></script>

<!--script admin-->
<script src="admin-script.js"></script>

<script>
function hideOrder(){
	

   document.getElementById("hideDP").style.display = "none";
   document.getElementById("hideCC").style.display = "none";
   document.getElementById("hideOC").style.display = "none";
   document.getElementById("hideBW").style.display = "none";
   document.getElementById("hidePR").style.display = "none";
   document.getElementById("hideCCES").style.display = "none";
   document.getElementById("hideNL").style.display = "none";
   document.getElementById("hidePE").style.display = "none";
   document.getElementById("hideON").style.display = "none";

}
hideOrder();
</script>
</body>

<!-- Mirrored from themes.pixelstrap.com/multikart/back-end/list-vendor.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 25 Oct 2020 12:38:33 GMT -->
</html>
