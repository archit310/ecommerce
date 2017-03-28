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
		  <link rel="stylesheet" href="css/productslider.css"/>
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
                             <li><a href="store.html">Store</a></li>
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
                         <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                             <ul class="nav nav-tabs">
                                 <li class="active"><a data-toggle="tab" onclick="myfunction1()" href="#login">Login</a></li>
                                 <li><a data-toggle="tab"  onclick="myfunction()" href="#signup">SignUp</a></li>
                             </ul>
                         </div>
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
			 <div class="container">
			     <div class="row">
				     <?php
					     include('db_con.php');
					     session_start();
						 $product_code = isset($_GET['product_code']) ? $_GET['product_code'] : '';
						 $query = "SELECT
                         name, description, price
                         FROM
                         ecomm_products
                         WHERE
                         product_code = '$product_code'";
						 $query_run = mysql_query($query);
						 if (mysql_num_rows($query_run) != 1) {
                         header('Location: shop.php');
                         mysql_free_result($result);
                         mysql_close($db);
                         exit();
                         }
						 $row = mysql_fetch_array($query_run);
						 extract($row);
					   ?> 
				     <div class="col-md-6">
				     <img src="images/product/<?php echo $product_code;?>.jpg" class="img-responsive"/>
					 </div>
					 <div class="col-md-6">
					     <h3><?php echo $name;?></h3><br>
						 <p><strong><?php echo $price;?></strong></p>
						 <form class="form-inline" method="post" action="update_cart.php">
						     <input type="hidden" name="product_code"
                             value="<?php echo $product_code; ?>"/>
							 <input type="hidden" name="redirect" value="<?php echo 'view_product.php?product_code='.$product_code; ?>"/>
							 <?php
							     $session = session_id();
                                 $query = 'SELECT
                                 qty
                                 FROM
                                 ecomm_temp_cart
                                 WHERE
                                 session = "' . $session . '" AND
                                 product_code = "' . $product_code . '"';
								 $query_run = mysql_query($query);
								 if (mysql_num_rows($query_run) > 0) {
                                 $row = mysql_fetch_assoc($result);
                                 extract($row);
                                 } else {
                                  $qty = 0;
                                 }
							     mysql_free_result($query_run);
							     
							 
							   ?>
						     <div class="form-group ">
							     <input type="text" name="qty" id="qty" value="<?php echo $qty;?>" placeholder="Quantitiy" class="form-control"></input>
							 </div>
							 <?php
							     if($qty>0){
									 ?>
									 <div class="form-group">
							         <div class="col-md-10">
							         <input type="submit" name="submit" class="btn btn-primary" value="Change Qty" aria-label="Left Align"> 
                                     </div>
							         </div>
									 <?php
								 }else{
									 ?>
									  <div class="form-group">
							         <div class="col-md-10">
							         <input type="submit" name="submit" class="btn btn-primary" value="Add to Cart" aria-label="Left Align"> 
                                     </div>
							         </div>
									 <?php
								 }
							   ?>
						 </form><br>
						 <p><?php echo $description;?></p><br><br>
						 <ul>
						     <li>Second edition</li>
							 <li>Endrew Torenbumb</li>
							 <li>New Edition 2017</li>
						 </ul>
					 </div>
				 </div>
				 <div class = "row">
				     <div class="col-md-12">
					     <ul class="nav nav-tabs">
                             <li class="active"><a data-toggle="tab" href="#description">Description</a></li>
                             <li><a data-toggle="tab" href="#ai">Additional Information</a></li>
                             <li><a data-toggle="tab" href="#rev">Reivews</a></li>
    
                         </ul>

                         <div class="tab-content">
                             <div id="description" class="tab-pane fade in active">
                                 <h3>Description</h3>
                                 <p><?php echo $description;?></p>
                              </div>
                             <div id="ai" class="tab-pane fade">
                                 <h3>Additional Information</h3>
                                 <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                             </div>
                             <div id="rev" class="tab-pane fade">
                                 <h3>Reivews</h3>
                                 <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                             </div>
 
                         </div>
					 </div>
				 </div>
			 </div>
			 <hr>
			  <div class="container">
			     <center>
				     <h3>Releated Product</h3>
				 </center>
            <div class="col-md-9">
            </div>
            <div class="col-md-3">
                <div class="controls pull-right hidden-xs">
                    <a class="left fa fa-chevron-left btn btn" href="#carousel-example"
                        data-slide="prev"></a><a class="right fa fa-chevron-right btn" href="#carousel-example"
                            data-slide="next"></a>
                </div>
            </div>
        </div>
        <div id="carousel-example" class="carousel slide hidden-xs" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12">
                            <div class="col-item">
                                <div class="info">
                                    Rs. 100
                                </div>
                                <div class="photo">
                                    <img src="images/store/1.jpg" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Add to cart</a>
                                        </p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <div class="col-item">
                                <div class="info">
                                    Rs. 100
                                </div>

                                <div class="photo">
                                    <img src="images/store/2.jpg" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Add to cart</a>
                                        </p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <div class="col-item">
                                <div class="info">
                                   Rs. 150
                                </div>

                                <div class="photo">
                                    <img src="images/store/3.png" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Add to cart</a>
                                        </p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <div class="col-item">
                                <div class="info">
                                    Rs. 190
                                </div>
                               <div class="photo">
                                    <img src="images/store/4.png" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Add to cart</a>
                                        </p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12">
                            <div class="col-item">
                                <div class="info">
                                    Rs. 100
                                </div>
                                <div class="photo">
                                    <img src="images/store/5.jpg" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Add to cart</a>
                                        </p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <div class="col-item">
                                <div class="info">
                                    Rs. 100
                                </div>

                                <div class="photo">
                                    <img src="images/store/6.jpg" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Add to cart</a>
                                        </p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <div class="col-item">
                                <div class="info">
                                   Rs. 100
                                </div>

                                <div class="photo">
                                    <img src="images/store/7.jpg" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Add to cart</a>
                                        </p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <div class="col-item">
                                <div class="info">
                                    Rs. 100
                                </div>

                                <div class="photo">
                                    <img src="images/store/10.jpg" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Add to cart</a>
                                        </p>
                                       
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
		</script>
   </body>
</html>
