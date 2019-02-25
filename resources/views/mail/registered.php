<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>You have been registered!</title>
</head>
<body>
<p>Somebody has registered your email in <?=env('APP_NAME', 'No name app');?></p>

<p>To finish registration you must set <a href="<?=$url;?>">your email</a></p>
</body>
</html>
