{"filter":false,"title":"home.php","tooltip":"/admin/home.php","ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":19,"column":8},"end":{"row":19,"column":8},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"hash":"539247ce29870f9ff2e114d453f5165364d6a14c","undoManager":{"mark":3,"position":3,"stack":[[{"start":{"row":0,"column":0},"end":{"row":65,"column":7},"action":"insert","lines":["<?php ","include('../functions.php');","","if (!isAdmin()) {","\t$_SESSION['msg'] = \"You must log in first\";","\theader('location: ../login.php');","}","","if (isset($_GET['logout'])) {","\tsession_destroy();","\tunset($_SESSION['user']);","\theader(\"location: ../login.php\");","}","?>","<!DOCTYPE html>","<html>","<head>","\t<title>Home</title>","\t<link rel=\"stylesheet\" type=\"text/css\" href=\"../style.css\">","\t<style>","\t.header {","\t\tbackground: #003366;","\t}","\tbutton[name=register_btn] {","\t\tbackground: #003366;","\t}","\t</style>","</head>","<body>","\t<div class=\"header\">","\t\t<h2>Admin - Home Page</h2>","\t</div>","\t<div class=\"content\">","\t\t<!-- notification message -->","\t\t<?php if (isset($_SESSION['success'])) : ?>","\t\t\t<div class=\"error success\" >","\t\t\t\t<h3>","\t\t\t\t\t<?php ","\t\t\t\t\t\techo $_SESSION['success']; ","\t\t\t\t\t\tunset($_SESSION['success']);","\t\t\t\t\t?>","\t\t\t\t</h3>","\t\t\t</div>","\t\t<?php endif ?>","","\t\t<!-- logged in user information -->","\t\t<div class=\"profile_info\">","\t\t\t<img src=\"../images/admin_profile.png\"  >","","\t\t\t<div>","\t\t\t\t<?php  if (isset($_SESSION['user'])) : ?>","\t\t\t\t\t<strong><?php echo $_SESSION['user']['username']; ?></strong>","","\t\t\t\t\t<small>","\t\t\t\t\t\t<i  style=\"color: #888;\">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> ","\t\t\t\t\t\t<br>","\t\t\t\t\t\t<a href=\"home.php?logout='1'\" style=\"color: red;\">logout</a>","                       &nbsp; <a href=\"create_user.php\"> + add user</a>","\t\t\t\t\t</small>","","\t\t\t\t<?php endif ?>","\t\t\t</div>","\t\t</div>","\t</div>","</body>","</html>"],"id":1}],[{"start":{"row":1,"column":20},"end":{"row":1,"column":21},"action":"remove","lines":["s"],"id":2},{"start":{"row":1,"column":19},"end":{"row":1,"column":20},"action":"remove","lines":["n"]},{"start":{"row":1,"column":18},"end":{"row":1,"column":19},"action":"remove","lines":["o"]},{"start":{"row":1,"column":17},"end":{"row":1,"column":18},"action":"remove","lines":["i"]},{"start":{"row":1,"column":16},"end":{"row":1,"column":17},"action":"remove","lines":["t"]},{"start":{"row":1,"column":15},"end":{"row":1,"column":16},"action":"remove","lines":["c"]},{"start":{"row":1,"column":14},"end":{"row":1,"column":15},"action":"remove","lines":["n"]},{"start":{"row":1,"column":13},"end":{"row":1,"column":14},"action":"remove","lines":["u"]}],[{"start":{"row":1,"column":12},"end":{"row":1,"column":13},"action":"remove","lines":["f"],"id":3}],[{"start":{"row":1,"column":12},"end":{"row":1,"column":13},"action":"insert","lines":["s"],"id":4},{"start":{"row":1,"column":13},"end":{"row":1,"column":14},"action":"insert","lines":["e"]},{"start":{"row":1,"column":14},"end":{"row":1,"column":15},"action":"insert","lines":["r"]},{"start":{"row":1,"column":15},"end":{"row":1,"column":16},"action":"insert","lines":["v"]},{"start":{"row":1,"column":16},"end":{"row":1,"column":17},"action":"insert","lines":["e"]},{"start":{"row":1,"column":17},"end":{"row":1,"column":18},"action":"insert","lines":["r"]}]]},"timestamp":1554578524003}