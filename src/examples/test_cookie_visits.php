<?php
$cookie_name = "Leonardo";
$cookie_value = "10";
setcookie($cookie_name, $cookie_value, time() + (3600 * 24));

if(isset($_COOKIE[$cookie_name])) {
  echo "Cookie '" . $cookie_name . "' is set!<br>";
  echo "Value is: " . $_COOKIE[$cookie_name];
} else {
  echo "Cookie named '" . $cookie_name . "' is not set!";
}
?>