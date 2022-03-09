<?php
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    try {
        $connection = new PDO("mysql:host=127.0.0.1:3306;dbname=taskillity",'root','root');
    } catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }
        $query = $connection->prepare("SELECT * FROM usuario WHERE email=:email");
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->execute();
     
        $result = $query->fetch(PDO::FETCH_ASSOC);
     
        if (!$result) {
            echo '<p class="error">Username password combination is wrong!</p>';
        } else {
            if ($password == $result['password']) {
                $_SESSION['user_id'] = $result['id'];
                echo '<p class="success">Congratulations, you are logged in with the id '. $result['id'].'</p>'; 
            } else {
                echo '<p class="error">Username password combination is wrong!</p>';
            }
        }