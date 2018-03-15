<?php

setcookie("uname", "test", time()+3600);
setcookie("pass", "wrong", time()+3600);
echo "Gave you a bad cookie! Now test stuff.";

?>