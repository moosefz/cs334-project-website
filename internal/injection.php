<?php
  if (isset($_POST['submit']))
  {
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
    foreach ($_POST as $k => $v)
    {
      echo '<p>'.htmlspecialchars($v).'</p>';
    }
    echo '<hr />';
  }
?>