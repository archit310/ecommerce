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
			     <h2>CHECKOUT</H2>
			 </center>
			 
			 <div class "container">
				     <?php
					     session_start();
						 include('db_con.php');
						 $session = session_id();
						 $now = date('Y-m-d H:i:s');
						 if(isset($_POST['submit']) && isset($_POST['fname'])){
							 $fname = $_POST['fname'];
							 $lname = $_POST['lname'];
							 $email = $_POST['email'];
							 $phone = $_POST['phone'];
							 $address_1 = $_POST['address_1'];
							 $address_2 = $_POST['address_2'];
							 $city = $_POST['city'];
							 $country = $_POST['country'];
							 $state = $_POST['state'];
							 $postcode = $_POST['postcode'];
							 $query = "SELECT `customer_id` FROM `ecomm_customers` WHERE
							      `first_name` = '$fname'
								  `last_name` = '$lname'
								  `email` = '$email'
								  `phone` = '$phone'
								  `address_1` = '$address_1'
								  `address_2` = '$address_2'
								  `city` = '$city'
								  `state` = '$state'
								  `country` = '$country'
								  `zip_code` = '$postcode'";
								  $query_run = mysql_query($query);
                                 if (mysql_num_rows($query_run) > 0) 
								 {
                                 $rows = mysql_fetch_assoc($query_run);
                                 extract($rows);
                                  } 
								  else{
							     $query = "INSERT INTO `ecomm_customers`(`customer_id`, `first_name`, `last_name`, `email`, `phone`, `address_1`, `address_2`, `city`, `state`, `country`, `zip_code`) VALUES ('','$fname','$lname','$email','$phone','$address_1','$address_2','$city','$state','$country','$postcode') ";
								 mysql_query($query);
								 $customer_id = mysql_insert_id();
								  }
								  mysql_free_result($query_run);
								  $query = "INSERT INTO `ecomm_orders`(`order_id`, `order_date`, `customer_id`, `cost_subtotal`,`cost_total`, `shipping_first_name`, `shipping_last_name`, `shipping_email`, `shipping_phone`, `shipping_address_1`, `shipping_address_2`, `shipping_city`, `shipping_state`, `shipping_country`, `shipping_zip_code`) VALUES ('','$now','$customer_id','0.0','0.0','$fname','$lname','$email','$phone','$address_1','$address_2','$city','$state','$country','$postcode')";
								   mysql_query($query);
                                  $order_id = mysql_insert_id();
								  $query = "INSERT INTO `ecomm_order_details`(`order_id`, `order_qty`, `product_code`) 
								  SELECT 
								  '$order_id',`qty`,`product_code`
								  FROM
                                  ecomm_temp_cart
								  WHERE 
								  `session` = '$session'";
								 mysql_query($query);
								 $query = 'DELETE FROM `ecomm_temp_cart` WHERE `session` = "' . $session . '"';
                                 mysql_query($query);
								 $query = 'SELECT
                                 SUM(price * order_qty) AS cost_subtotal
                                 FROM
                                 ecomm_order_details d JOIN ecomm_products p ON
                                 d.product_code = p.product_code
                                 WHERE
                                  order_id = ' . $order_id;
                                  $query_run = mysql_query($query);
                                 $rows = mysql_fetch_assoc($query_run);
                                 extract($rows);
								 $cost_shipping = round($cost_subtotal * 0.25, 2);
                                 $cost_tax = round($cost_subtotal * 0.1, 2);
                                 $cost_total = $cost_subtotal + $cost_shipping + $cost_tax;
								 $query = 'UPDATE ecomm_orders
                                  SET
                                  cost_subtotal = ' . $cost_subtotal . ',
                                 cost_shipping = ' . $cost_shipping . ',
                                 cost_tax = ' . $cost_tax . ',
                                  cost_total = ' . $cost_total . '
                                  WHERE
                                 order_id = ' . $order_id;
                                  mysql_query($query);
                                 ob_start();
						         }
								 else{
							     header('Location:checkout.php');
						         }
					             ?>
				 <hr/>
				 <div class="row">
				     <p>Hey <?php echo '<b>'.$fname.$lname.'</b>'; ?></p>
				     <h3>Your Orders Details</h3>
					 <table class="table table-bordered">
					     <tr>
						     <td>Your Order No.</br>
							 <?php echo $order_id;?></td>
							 <td>Date:</br>
							 <?php echo $now;?></td>
							 <td>Total: </br>
							 <?php echo $cost_total;?></td>
							 <td>Payement Method:</br>
							 Cash On Delivery</td>
							 
						 </tr>
					 </table>
					 <div class="col-md-4" align="left">
					 <h4>Products</h4></br>
					 <?php
					     $query = 'SELECT
                          p.product_code, order_qty, name, description, price
                          FROM
                          ecomm_order_details d JOIN ecomm_products p ON
                          d.product_code = p.product_code
                          WHERE
                          order_id = "' . $order_id . '"
                         ORDER BY
                         p.product_code ASC';
                         $query_run = mysql_query($query);
                         $rows = mysql_num_rows($query_run);
						 while ($row = mysql_fetch_array($query_run)) {
							 extract($row);
							 echo $name .' * '. $order_qty.'</br>';
						 }
					 ?>
					 <h4>Subtotal: <?php echo $cost_total;?></h4>
					 <h4>Payment Method: <p>Cash On Delivery</p></h4>
					 <h4>Total:  <?php echo $cost_total;?></h4>
					 </div>
				 </div>
				 <?php
				     $html_head = ob_get_contents();
                     ob_clean();
				 ?>
				 <div class="row">
					 <div class="col-md-8">
					 <h3>Your Billing information</h3>
					 <hr><br>
					 <div class="col-md-6">
					 <table class="table table-bordered">
					     <tr>
						     <td>Name: </td>
							 <td> <?php echo '<b>'.$fname. ' '. $lname.'</b>'; ?></td>
						 </tr>
						 <tr>
						     <td>Email: </td>
						     <td><?php echo $email;?></td>
						 </tr>
						 <tr>
						     <td>Phone: </td>
							 <td> <?php echo $phone;?></td>
						 </tr>
						 <tr>
						     <td>Address</td>
							 <td><?php echo $address_1;?><br>
							 <?php echo $address_2 .' '. $city  ?><br>
							 <?php echo $state .' '. $country .' '. $postcode ?></td>
						 </tr>
					 </table>
					 </div>
					 </div>
				 </div>
			 </div>
			 <?php
			     $html_body = ob_get_clean();
                 echo $html_head;
				 echo $html_body;
                 $headers = array();
                 $headers[] = 'MIME-Version: 1.0';
                 $headers[] = 'Content-type: text/html; charset="iso-8859-1"';
                 $headers[] = 'Content-Transfer-Encoding: 7bit';
                 $headers[] = 'From: <architpatel100@gmail.com>';
                 $headers[] = 'Bcc: <ap4849859@gmail.com>';
                 mail($email, "Order Confirmation", $html_head . $html_body,
                 join("\r\n", $headers));
			 ?>
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
