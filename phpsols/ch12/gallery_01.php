<?php include('./includes/title.inc.php');  ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Japan Journey
<?php if (isset($title)) {echo "&#8212;{$title}";} ?>
</title>
<link href="styles/journey.css" rel="stylesheet" type="text/css" media="screen">
</head>
<body>
<div id="header">
    <h1>Japan Journey </h1>
</div>
<div id="wrapper">
    <?php include('./includes/menu.inc.php'); ?>
    <div id="maincontent">
        <h2>Images of Japan</h2>
      <p id="picCount">Displaying 1 to 6 of 8</p>
        <div id="gallery">
            <table id="thumbs">
                <tr>
					<!--This row needs to be repeated-->
                    <td><a href="gallery.php"><img src="images/thumbs/basin.jpg" alt="" width="80" height="54"></a></td>
                </tr>
				<!-- Navigation link needs to go here -->
            </table>
            <div id="main_image">
                <p><img src="images/basin.jpg" alt="" width="350" height="237"></p>
                <p>Water basin at Ryoanji temple, Kyoto</p>
            </div>
        </div>
    </div>
    <?php include('./includes/footer.inc.php'); ?>
</div>
</body>
</html>