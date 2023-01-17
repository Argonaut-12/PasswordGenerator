<!DOCTYPE HTML>
<html lang="en" style="height: 100%;">
<head>
    <meta content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Amaranth' rel='stylesheet'>
    <link rel="apple-touch-icon" sizes="180x180" href="/media/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/media/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/media/favicon-16x16.png">
    <link rel="manifest" href="/media/site.webmanifest">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Password Generator</title>
</head>
<body style="background-color: #2d2d2d; height: 100%; width: 100%; display:flex;justify-content:center;align-items: center">
<div class = "shadow border" style="width:20%; height:35%; padding: 3.5% 2% 0% 2%;border-radius:5% ;font-family:'Amaranth';background-color:#8f8f8f;justify-content: center;align-items: center; min-height: 300px;min-width: 325px">
    <form class="col-md-12" method="post" style="display: grid;justify-items: center">
    <div class="input-group mb-1">
        <label class="input-group-text" for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>
    <div class="input-group mb-1">
        <label class="input-group-text" for="use">Use:</label>
        <input class="form-control" type="text" id="use" name="use">
    </div>
    <button class="btn btn-info" type="submit" value="Submit" name="submit" >Generate</button>
</form>

<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
    </symbol>
    <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </symbol>
</svg>
<?php

if (isset($_POST['submit'])) {
    if (!empty($_POST['name']) && !empty($_POST['use'])) {
        $name = $_POST['name'];
        $use = $_POST['use'];
        $password = generatePassword();
?>
        <br>
        <div class="alert alert-success d-flex align-items-center" role="alert" style="max-width: fit-content; height: 25%;">
            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Success:" style="max-width: 32px; max-height: 18px; fill: gray">
                <use xlink:href="#check-circle-fill" />
            </svg>
            <div> <?php echo "Password for\"". $name . "\" to use in \"" . $use . "\": " . $password ;?> </div>
        </div>
<?php
//save the password to a text file
        /*if (file_exists("password.txt")) {
            $file = fopen("password.txt", "a") or die("Unable to open file!");
            fwrite($file, "Password for\"". $name . "\" to use in \"" . $use . "\": " . $password . "\n");
        } else {
            $file = fopen("password.txt", "w") or die("Unable to open file!");
            fwrite($file, "Password for\"". $name . "\" to use in \"" . $use . "\": " . $password . "\n");
        }
        fclose($file);*/
    }else{
?>
        <br>
        <div class="alert alert-danger d-flex align-items-center" role="alert" style="max-width:fit-content; height: 48px; margin-left: 20%">
            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="danger:" style="max-width: 18px; fill: #a25858">
                <use xlink:href="#exclamation-triangle-fill"/>
            </svg>
            <div> <?php echo "All Fields Required" ;?> </div>
        </div>
<?php
    }
}
function generatePassword($length = 10)
{
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+=';
    $password = '';
    $hasSpecial = false;
    $hasCapital = false;
    while (!$hasSpecial || !$hasCapital) {
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $chars[rand(0, strlen($chars) - 1)];
        }
        $hasSpecial = preg_match('/[!@#$%^&*()_+=]+/', $password);
        $hasCapital = preg_match('/[A-Z]+/', $password);
    }
    return $password;
}
?>
</div>
</body>
</html>