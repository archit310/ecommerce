<!DOCTYPE html>
<html lang="en">
     <head>
         <title>BookStore</title>
		 <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity=  "sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		 <link rel="stylesheet" href="css/style.css"/>
     </head>
     <body>
		     <nav class="navbar navbar-inverse">
                 <div class="container-fluid">
                     <div class="navbar-header">
                         <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                         <span class="icon-bar"></span>
                         <span class="icon-bar"></span>
                         <span class="icon-bar"></span>                        
                         </button>
                         <a class="navbar-brand" href="index.html">THEBOOKSTORE</a>
                     </div>
                     <div class="collapse navbar-collapse" id="myNavbar">
                         <ul class="nav navbar-nav">
                             <li ><a href="index.html">Home</a></li>
                             <li><a href="shop.php">Store</a></li>
                             <li><a href="about.html">About Us</a></li>
							 <li><a href="contact.html">Contact us</a></li>
                         </ul>
                         <ul class="nav navbar-nav navbar-right">
                             <li><a href="#" data-toggle="modal" data-target="#popUpWindow"><span class="glyphicon glyphicon-user"></span> Login/SignUp</a></li>
                             <li><a href="view_cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
                     </ul>
                     </div>
                 </div>
             </nav>
			 <div class="modal fade" id="popUpWindow">
                 <div class="modal-dialog">
                     <div class="modal-content">
                         <!-- header -->
                         <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                             <ul class="nav nav-tabs">
                                 <li class="active"><a data-toggle="tab" onclick="myfunction1()" href="#login">Login</a></li>
                                 <li><a data-toggle="tab"  onclick="myfunction()" href="#signup">SignUp</a></li>
                             </ul>
                         </div>
                         <!-- body (form) -->
                          <div class="modal-body">
							 <div class="tab-content">
							     <div id="login" class="tab-pane fade in active">
								     <form role="form">
                                     <div class="form-group">
                                     <input type="email" class="form-control" placeholder="Email">
                                     </div>
                                     <div class="form-group">
                                     <input type="password" class="form-control" placeholder="Password">
                                      </div>
									  <div  class="checkbox">
									       <label><input type="checkbox"> Remember me</label>
									  </div>
                                     </form>
								 </div>	
								 <div style="display:none" id="signup" class="tab-pane fade in active">
								     <form role="form" action="add_order.php">
                                     <div class="form-group">
                                     <input type="text" class="form-control" placeholder="Name">
                                     </div>
                                     <div class="form-group">
                                     <input type="text" class="form-control" placeholder="Mob No.">
                                     </div>
									 <div class="form-group">
                                     <input type="email" class="form-control" placeholder="Email">
                                     </div>
									 <div class="form-group">
                                     <input type="password" class="form-control" placeholder="Password">
                                     </div>
									 <div class="form-group">
                                     <input type="password" class="form-control" placeholder="Confirm Password">
                                     </div>
                                     </form>
								 </div>	
							 </div>
                         </div>
                         <div class="modal-footer">
                             <button class="btn btn-primary btn-block">SignUp</button>
                         </div>
                     </div>
                 </div>
             </div>
			 <div class="jumbotron" id="jumbotron">
                  <h1>Books</h1>      
                  <p>Books are best friend we have</p>
               </div>
			     <?php
                 include('db_con.php');
                 $query = 'SELECT
                  product_code, name, price
                  FROM
                 ecomm_products
                 ORDER BY
                 product_code ASC';
                 $query_run = mysql_query($query);
                 ?>
                 <div class="container">
                 <div class="row">
                 <?php
                 while($rows = mysql_fetch_array($query_run)){
	              extract($rows);
	              ?> 
	     <div class="col-md-3">
		     <a href="view_product.php?product_code=<?php echo $product_code;?>">
		     <div class="panel panel-primary">
			     <div class="panel-heading"><?php echo $name;?></div>
				     <div class="panel-body" >
						 <center>
					     <img class="img-responsive" src="images/product/<?php echo $product_code;?>.jpg"/>
						 </center>
					 </div>
				 <div class="panel-footer"><?php echo $price;?></div>
			 </div>
			 </a>
	     </div>
	  <?php
      }
     ?>
  </div>
  </div>
             <footer class="site-footer">
			     <div class="container">
				     
				     <p>Follow Us On</p>
					 <div class="row">
					 <div class="col-md-4">
					 <ul class="footer-menu">
					     <li>
						     <a href="#">Facebook</a>
						 </li>
						 <li>
						     <a href="#">Twitter</a>
						 </li>
						 <li>
						     <a href="#">Google +</a>
						 </li>
					 </ul>
					 </div>
					 <div class="col-md-8">
					     <p>Copyright &copy; THEBOOKSTORE 2017</p>
					 </div>
					 </div>
				 </div>
			 </footer>
		 <script>
		 function myfunction(){
		     document.getElementById('signup').style.display='block';
		 }
		 function myfunction1(){
		     document.getElementById('signup').style.display= 'none';
			 
		 }
		 function myMap() {
  var mapCanvas = document.getElementById("map");
  var mapOptions = {
    center: new google.maps.LatLng(51.5, -0.2), zoom: 10
  };
  var map = new google.maps.Map(mapCanvas, mapOptions);
		</script>
   </body>
</html>
