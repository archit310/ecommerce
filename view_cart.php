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
                             <li ><a href="about.html">About Us</a></li>
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
                         <!-- button -->
                         <div class="modal-footer">
                             <button class="btn btn-primary btn-block">SignUp</button>
                         </div>
                     </div>
                 </div>
             </div>
			 	 <center>
				     <h2>CART</h2>
				 </center>
			 <div class="container">
			   <?php
			     include('db_con.php');
                 session_start();
                 $session = session_id();
                 $query = 'SELECT
                 t.product_code, qty,
                 name, description, price
                 FROM
                      ecomm_temp_cart t JOIN ecomm_products p ON
                      t.product_code = p.product_code
                 WHERE
                      session = "' . $session . '"
                 ORDER BY
                      t.product_code ASC';
			     $query_run = mysql_query($query);
			      $rows = mysql_num_rows($query_run);
			     if($rows == 1){
						 echo '<p> You Have Currrently 1 Product In Your Cart</p>';
					 }else{
						 echo '<h3>You Have '. $rows . ' Product In Your Cart </h3><br>';
					 }
					 ?>
					 <?php
					 if($rows>0){
						 ?>
					  <table class="table table-bordered">
					  <thead style="background-color:#e5e5e5;">
						     <tr>
							     <th>Product</th>
								 <th>Price</th>
								 <th>Quantity</th>
								 <th>Price</th>
							 </tr>
						 </thead>
					  <?php
					 while($row = mysql_fetch_array($query_run)){
					 extract($row);
					 ?>
						 <tbody>
						     <tr>
							     <td><?php echo $name;?></td>
								 <td><?php echo $price;?></td>
								 <td>
								     <form class="form-inline" action="update_cart.php" method="post">
									 <div class="form-group">
									     <div class="col-md-2">
										 <input type="hidden" name="product_code" value="<?php echo $product_code; ?>"/>
								         <input type="text" class="form-control" name="qty" value="<?php echo $qty;?>"/>
										 </div>
									 </div>
									 <input type="submit"class="btn btn-primary" value="Update Cart" name="submit"/>
									 <input type="submit" name="remove_item" value="Remove Item" class="btn btn-primary"/>
									 </form>
								 </td>
								 <td><?php echo $price*$qty;?></td>
							 </tr>
						 </tbody>
					 <?php
					 $total += $price*$qty;
					 }
			    ?>
				</table>
				<div class="row">
				  <div class="col-md-6">
				     <h4>CART TOTALS</h4>
					 <table class="table table-bordered">
					     <thead style="background-color:#e5e5e5;">
						     <th>Subtotal</th>
							 <td><?php echo $total;?></td>
						 </thead>
						 <tbody>
						     <th>Total</th>
							 <td><?php echo $total;?></td>
						 </tbody>
					 </table>
					 <form action="checkout.php" method="post">
					 <input type="submit" class="btn btn-primary" name="submit" value="Proceed to checkout"/>
					 </form>
				  </div>
				</div>
				<?php
					 }
					 else{
						 echo 'Your Cart is currently Empty'.'<br>'.'<br>';
						 ?>
						 <a href="shop.php" class="btn btn-primary" role="button">Return To Shop</a>
						 <?php
					 }
				?>
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
		</script>
   </body>
</html>
