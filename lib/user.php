<?php

function addUser(PDO $pdo, string $first_name, string $last_name, string $email, string $password, $role = "user")
{
   // On hash le mot de passe avant stockage
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user (first_name, last_name, email, password, role)
            VALUES (:first_name, :last_name, :email, :password, :role)";

    $query = $pdo->prepare($sql);
    $query->bindParam(':first_name', $first_name);
    $query->bindParam(':last_name', $last_name);
    $query->bindParam(':email', $email);
    $query->bindParam(':password', $hashedPassword);
    $query->bindParam(':role', $role);

    return $query->execute();
}

function verifyUserLoginPassword(PDO $pdo, string $email, string $password)
{
   $sql = "SELECT * FROM user WHERE email = :email LIMIT 1";
    $query = $pdo->prepare($sql);
    $query->bindParam(':email', $email);
    $query->execute();

    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        return $user;
    }

    return false;
}
