<div id="footer">
  <p>&copy;
  <?php
  $startYear = 2006;
  $thisYear = date('y');
  if ($startYear == $thisYear) {
    echo $startYear;
  } else {
    echo "{$startYear}&#8211;{$thisYear}";
  }
  ?>
  David Powers</p>
</div>