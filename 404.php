<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 - Not Found</title>
</head>
<body>
<h1 style="margin-top: 0;">Not Found</h1>
<p>
The requested URL was not found on this server.<br>
<br>
If you think this is a mistake, <a href="https://github.com/wyattwas/personal-website/issues/new?title=Error%3A%20Not%20found">make an issue</a> to report it!<br>
You can also contact the server admin at <a href="mailto: <?php echo $_SERVER['SERVER_ADMIN']; ?>" ><?php echo $_SERVER['SERVER_ADMIN']; ?></a>
</p>
<a href="index">Go back home</a>
<hr>
<address><i><?php echo $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT']; ?></i></address>
</body>
</html>