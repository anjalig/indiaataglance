<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>India At A Glance</title>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" />
<link rel="stylesheet" href="style.css" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
</head>
<body>
<!-- Home -->
<div data-role="page" id="page1">
	 <div data-theme="a" data-role="header">
     <h1 class="tourist_directory_icon">Indian Tourism Office</h1>
	        <div data-role="navbar" data-iconpos="top">
	            <ul>
	                <li>
	                    <a href="index.html" data-transition="fade" data-theme="" data-icon="home">
	                        Home
	                    </a>
	                </li>
	                <li>
	                    <a href="about.html" data-transition="fade" data-theme="" data-icon="info">
	                        About
	                    </a>
	                </li>
	                <li>
	                    <a href="feedback.php" data-transition="fade" data-theme="" data-icon="star">
	                        Feedback
	                    </a>
	                </li>
	            </ul>
	        </div>
	    </div>
<?php
$con=mysqli_connect("localhost","root","anshu","csv_db");
// Check connection
if (mysqli_connect_errno($con))
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$order = 'ORDER BY Category asc';
$q1= "Select * from `awards` where Year='07-08' " . $order;
$res = mysqli_query($con, $q1);
?>
    <div data-role="content">
  		<ul data-autodividers="true" data-role="listview" class="ui-listview" data-filter="true" data-theme="a">
    		<?php 
    			while($row=mysqli_fetch_array($res))
    			{
    		?>
    		<li>
    			<h3 class="ui-li-heading" style="color:#2489ce;"><?php print $row['Category']; ?></h3>
    			<p class="ui-li-desc"><?php print str_replace("\"", "", $row['Recipient']); ?></p>
    			<p class="ui-li-desc"><?php print $row['Address']; ?> </p>
    		</li>
    		<?php } ?>
  		</ul>
		</div>
   <div data-theme="a" data-role="footer" data-position="fixed">
        <h3>
            &copy; 2013, Team Neophytes.
        </h3>
    </div>
</div>
</body>
</html>

