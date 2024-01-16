<?php

require __DIR__ . "/vendor/autoload.php";
use src\models\User;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    require "./api/bootstrap.php";
    
    $user = new User;
    $user->createUser($_POST);
    echo json_encode(["message" => "user created successfully"]);
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@latest/css/pico.min.css">
</head>
<body>
    
    <main class="container">
    
        <h1>Register</h1>
        
        <form method="post">
            
            <label for="name">
                Name
                <input name="name" id="name">
            </label>
            
            <label for="email">
                Email
                <input name="email" id="email">
            </label>
            
            <label for="password">
                Password
                <input type="password" name="password" id="password">
            </label>
            
            <button>Register</button>
        </form>
    
    </main>
    
</body>
</html>
        
        
        
        
        
        
        
        
        
        
        
        
        