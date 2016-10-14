<?php include('./includes/title.inc.php'); ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8">
<title>Japan Journey<?php echo "&#8212;{$title}"; ?></title>
<link href="styles/journey.css" rel="stylesheet" type="text/css" media="screen">
</head>

<body>
<div id="header">
    <h1>Japan Journey</h1>
</div>
<div id="wrapper">
    <?php include('./includes/menu.inc.php'); ?>
    <div id="maincontent">
        <h2>Contact Us </h2>
      <p>Ut enim ad minim veniam, quis nostrud exercitation consectetur adipisicing elit. Velit esse cillum dolore ullamco laboris nisi in reprehenderit in voluptate. Mollit anim id est laborum. Sunt in culpa duis aute irure dolor excepteur sint occaecat.</p>
        <form id="feedback" method="post" action="">
            <p>
                <label for="name">Name:</label>
                <input name="name" id="name" type="text" class="formbox">
            </p>
            <p>
                <label for="email">Email:</label>
                <input name="email" id="email" type="text" class="formbox">
            </p>
            <p>
                <label for="comments">Comments:</label>
                <textarea name="comments" id="comments" cols="60" rows="8"></textarea>
            </p>
            <p>
                <input name="send" id="send" type="submit" value="Send message">
            </p>
        </form>
        <pre>
        <?php if ($_POST) {print_r($_POST);} ?>
        </pre>
    </div>
    <?php include('./includes/footer.inc.php'); ?>
</div>
</body>
</html>
