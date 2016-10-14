<?php
include('./includes/title.inc.php');
$errors = array();
$missing = array();
// check if the form has been submitted
if (isset($_POST['send'])) {
  // email processing script
  $to = 'david@example.com';
  $subject = 'Feedback from Japan Journey';
  // list expected fields
  $expected = array('name', 'email', 'comments', 'subscribe', 'interests', 'howhear', 'characteristics');
  // set required fields
  $required = array('name', 'comments', 'email', 'subscribe', 'interests', 'howhear', 'characteristics');
  // set default values for variables that might not exist
  if (!isset($_POST['subscribe'])) {
    $_POST['subscribe'] = '';
  }
  if (!isset($_POST['interests'])) {
	$_POST['interests'] = array();
  }
  if (!isset($_POST['characteristics'])) {
	$_POST['characteristics'] = array();
  }
  // minimum number of required check boxes
  $minCheckboxes = 2;
  if (count($_POST['interests']) < $minCheckboxes) {
	$errors['interests'] = true;
  }
  // minimum number of required list items
  $minList = 2;
  if (count($_POST['characteristics']) < $minList) {
	$errors['characteristics'] = true;
  }
  // create additional headers
  $headers = "From: Japan Journey<feedback@example.com>\r\n";
  $headers .= 'Content-Type: text/plain; charset=utf-8';
  require('./includes/processmail.inc.php');
  if ($mailSent) {
	header('Location: http://www.example.com/thank_you.php');
	exit;
  }
}
?>
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
        <?php if (($_POST && $suspect) || ($_POST && isset($errors['mailfail']))) { ?>
          <p class="warning">Sorry, your mail could not be sent. Please try later.</p>
        <?php } elseif ($missing || $errors) { ?>
           <p class="warning">Please fix the item(s) indicated.</p>
        <?php } ?>
      <p>Ut enim ad minim veniam, quis nostrud exercitation consectetur adipisicing elit. Velit esse cillum dolore ullamco laboris nisi in reprehenderit in voluptate. Mollit anim id est laborum. Sunt in culpa duis aute irure dolor excepteur sint occaecat.</p>
        <form id="feedback" method="post" action="">
            <p>
                <label for="name">Name:
                <?php if ($missing && in_array('name', $missing)) { ?>
                  <span class="warning">Please enter your name</span>
                <?php } ?>
                </label>
                <input name="name" id="name" type="text" class="formbox"
                <?php if ($missing || $errors) { 
                 echo 'value="' . htmlentities($name, ENT_COMPAT, 'UTF-8') . '"';
                } ?>>
            </p>
            <p>
                <label for="email">Email:
                <?php if ($missing && in_array('email', $missing)) { ?>
                  <span class="warning">Please enter your email address</span>
                <?php } elseif (isset($errors['email'])) { ?>
                  <span class="warning">Invalid email address</span>
                <?php } ?>
                </label>
                <input name="email" id="email" type="text" class="formbox"
                <?php if ($missing || $errors) { 
                 echo 'value="' . htmlentities($email, ENT_COMPAT, 'UTF-8') . '"';
                } ?>>
            </p>
            <p>
                <label for="comments">Comments:
                <?php if ($missing && in_array('comments', $missing)) { ?>
                  <span class="warning">Please enter your comments</span>
                <?php } ?>
                </label>
                <textarea name="comments" id="comments" cols="60" rows="8"><?php
                if ($missing || $errors) {
                  echo htmlentities($comments, ENT_COMPAT, 'UTF-8');
                } ?></textarea>
	        </p>
			<fieldset id="subscribe">
			<h2>Subscribe to newsletter?
            <?php if ($missing && in_array('subscribe', $missing)) { ?>
               <span class="warning">Please make a selection</span>
            <?php } ?>
            </h2>
			<p>
				<input name="subscribe" type="radio" value="Yes" id="subscribe-yes" 
				<?php
				if ($_POST && $_POST['subscribe'] == 'Yes') { 
				  echo 'checked';
				} ?>>
				<label for="subscribe-yes">Yes</label>
				<input name="subscribe" type="radio" value="No" id="subscribe-no" 
				<?php
				if ($_POST && $_POST['subscribe'] == 'No') {
				  echo 'checked';
				} ?>>
				<label for="subscribe-no">No</label>
			</p>
			</fieldset>
			<fieldset id="interests">
			<h2>Interests in Japan
            <?php if (isset($errors['interests'])) { ?>
              <span class="warning">Please select at least <?php echo $minCheckboxes; ?></span>
            <?php } ?>
            </h2>
			<div>
			<p>
				<input type="checkbox" name="interests[]" value="Anime/manga" id="anime" 
				<?php
				if ($_POST && in_array('Anime/manga', $_POST['interests'])) {
				  echo 'checked';
				} ?>>
				<label for="anime">Anime/manga</label>
			</p>
			<p>
				<input type="checkbox" name="interests[]" value="Arts & crafts" id="art" 
				<?php
				if ($_POST && in_array('Arts & crafts', $_POST['interests'])) {
				  echo 'checked';
				} ?>>
				<label for="art">Arts &amp; crafts</label>
			</p>
			<p>
				<input type="checkbox" name="interests[]" value="Judo, karate, etc" id="judo" 
				<?php
				if ($_POST && in_array('Judo, karate, etc', $_POST['interests'])) {
				  echo 'checked';
				} ?>>
				<label for="judo">Judo, karate, etc</label>
			</p>
			</div>
			<div>
			<p>
				<input type="checkbox" name="interests[]" value="Language/literature" id="lang_lit" 
				<?php
				if ($_POST && in_array('Language/literature', $_POST['interests'])) {
				  echo 'checked';
				} ?>>
				<label for="lang_lit">Language/literature</label>
			</p>
			<p>
				<input type="checkbox" name="interests[]" value="Science & technology" id="scitech" 
				<?php
				if ($_POST && in_array('Science & technology', $_POST['interests'])) {
				  echo 'checked';
				} ?>>
				<label for="scitech">Science &amp; technology</label>
			</p>
			<p>
				<input type="checkbox" name="interests[]" value="Travel" id="travel" 
				<?php
				if ($_POST && in_array('Travel', $_POST['interests'])) {
				  echo 'checked';
				} ?>>
				<label for="travel">Travel</label>
			</p>
			</div>
			</fieldset>
            <p>
				<label for="select">How did you hear of Japan Journey?
                <?php if ($missing && in_array('howhear', $missing)) { ?>
                 <span class="warning">Please make a selection</span>
                <?php } ?>
                </label>
				<select name="howhear" id="howhear">
					<option value=""
					<?php
					if (!$_POST || $_POST['howhear'] == '') {
					  echo 'selected';
					} ?>>Select one</option>
					<option value="foED"
					<?php
					if ($_POST && $_POST['howhear'] == 'foED') {
					  echo 'selected';
					} ?>>friends of ED</option>
					<option value="recommended by friend"
					<?php
					if ($_POST && $_POST['howhear'] == 'recommended by friend') {
					  echo 'selected';
					} ?>>Recommended by a friend</option>
					<option value="search engine"
					<?php
					if ($_POST && $_POST['howhear'] == 'search engine') {
					  echo 'selected';
					} ?>>Search engine</option>
				</select>
			</p>
			<p>
				<label for="select">What characteristics do you associate with Japan?
                <?php if (isset($errors['characteristics'])) { ?>
                  <span class="warning">Please select at least <?php echo $minList; ?></span>
                <?php } ?>
                </label>
				<select name="characteristics[]" size="6" multiple="multiple" id="characteristics">
					<option value="Dynamic"
					<?php
					if ($_POST && in_array('Dynamic', $_POST['characteristics'])) {
					  echo 'selected';
					} ?>>Dynamic</option>
					<option value="Honest"
					<?php
					if ($_POST && in_array('Honest', $_POST['characteristics'])) {
					  echo 'selected';
					} ?>>Honest</option>
					<option value="Pacifist"
					<?php
					if ($_POST && in_array('Pacifist', $_POST['characteristics'])) {
					  echo 'selected';
					} ?>>Pacifist</option>
					<option value="Devious"
					<?php
					if ($_POST && in_array('Devious', $_POST['characteristics'])) {
					  echo 'selected';
					} ?>>Devious</option>
					<option value="Inscrutable"
					<?php
					if ($_POST && in_array('Inscrutable', $_POST['characteristics'])) {
					  echo 'selected';
					} ?>>Inscrutable</option>
					<option value="Warlike"
					<?php
					if ($_POST && in_array('Warlike', $_POST['characteristics'])) {
					  echo 'selected';
					} ?>>Warlike</option>
				</select>
			</p>
            
            <p>
                <input name="send" id="send" type="submit" value="Send message">
            </p>
        </form>
        <pre>
        <?php if ($_POST && isset($mailSent) && $mailSent) {
		  echo htmlentities($message);
		} 
		if ($_POST) {
		   echo 'Missing:';
		   print_r($missing);
		   echo 'howhear: ' . $_POST['howhear'];
		}
		?>
        </pre>
    </div>
    <?php include('./includes/footer.inc.php'); ?>
</div>
</body>
</html>
