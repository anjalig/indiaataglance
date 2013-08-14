<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>India at a Glance</title>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" />
<link rel="stylesheet" href="style.css" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
</head>
<body>
<!-- Home -->
<div data-role="page" id="page1">
	 <div data-theme="a" data-role="header">
	 <h1 class="search_hotel_icon">Available Hotels</h1>
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
if($_POST){
$con=mysqli_connect("localhost","root","anshu","csv_db");
// Check connection
if (mysqli_connect_errno($con))
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$state = $_POST["sstate"];
$type = $_POST["stype"];
$order = 'ORDER BY ih.Name asc';
if ($state == "00" && $type == "00")				//Query for All state and All Types
{
	$q1 = "SELECT ih.*, gc.longitude, gc.latitude FROM `indian_hotels` ih INNER JOIN `geocode` gc ON ih.Name= gc.Name " . $order;

}

else if ($state == "00")						//Query for All state and Selected Types
{
	$q1 = "SELECT ih.*, gc.longitude, gc.latitude FROM `indian_hotels` ih INNER JOIN `geocode` gc ON ih.Name= gc.Name WHERE ih.Type='$type' " . $order;

}

else if ($type == "00")							//Query for Selected state and All Types
{
	$q1 = "SELECT ih.*, gc.longitude, gc.latitude FROM `indian_hotels` ih INNER JOIN `geocode` gc ON ih.Name= gc.Name WHERE ih.State_id='$state' " . $order;

}

else											//Query for Selected state and Selected Types
{


	$q1 = "SELECT ih.*, gc.longitude, gc.latitude FROM `indian_hotels` ih INNER JOIN `geocode` gc ON ih.Name= gc.Name WHERE ih.State_id='$state' AND ih.Type='$type' " . $order;

}
$res = mysqli_query($con, $q1);
$num=mysqli_num_rows($res);
/* I am checking NULL value here */
if($num==0)
{
  ?>
  <div data-role="content">
  <h2>Sorry!! No info available <a href="index.html" data-icon="arrow-l" data-iconpos="notext" class="backbtn">Go Back </a> and try again</h2>
	</div>
	<?php 
}
else
{
?>
    <div data-role="content">
  		<ul data-autodividers="true" data-role="listview" class="ui-listview" data-filter="true" data-theme="a">
    		<?php 
    			while($row=mysqli_fetch_array($res))
    			{
    		?>
    		<li>
    			<img src="<?php echo $row['img']; ?>"/>
    			<h3 class="ui-li-heading"><a href="<?php print $row['Website']; ?>" target="_blank" ><?php print $row['Name']; ?></a></h3>
    			<p class="ui-li-desc"><?php print str_replace("\"", "", $row['Address']); ?></p>
    			<p class="ui-li-desc"><img src="website.png" height="15" width="15"><?php print $row['Website']; ?>,<img src="phone white.png" height="15" width="15"> <?php print $row['Phone'];?>, <img src="pin_map.png" height="15" width="15"> <a href="<?php print "viewHotel.php?id=" . urlencode($row['Name']) . "&lat=" . urlencode($row['latitude']). "&lng=" . urlencode($row['longitude']); ?>" target="_parent"/>
                View In Map</a></p>
    		</li>
    		<?php } ?>
  		</ul>
		</div>
		<?php 
}
		} 
else {
		?>
		<div data-role="content">
		  <h2>Invalid Search Request <a href="index.html" data-icon="arrow-l" data-iconpos="notext" class="backbtn">Go Back </a> and try again</h2>
		</div>
<?php }?>
	
	    <div data-theme="a" data-role="footer" data-position="fixed">
        <h3>
            &copy; 2013, Team Neophytes.
        </h3>
    </div>
</div>
</body>
</html>
