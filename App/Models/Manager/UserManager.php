<?php

namespace App\Models\Manager;

use App\Core\Database;
use App\Models\Entity\User;

class UserManager
{
    private Database $db;

    public function __construct()
    {
        //$this->db=new PDO("mysql:host=localhost;dbname=hoteldanton;charset=utf8;port=8889", "root","root");
        $this->db = new Database();
    }

    /**
     * @param User $user
     * @return bool
     */
    public function insertUser(User $user): bool
    {
        $stmt = $this->db->prepare("INSERT INTO users (firstname,email,password_hash,role,lastname,age,username,country) VALUES (?,?,?,?,?,?,?,?)");
        $register_valid = $stmt->execute([$user->getFirstname(), $user->getEmail(), $user->getPassword(), $user->getRole(), $user->getLastname(), $user->getAge(), $user->getUsername(), $user->getCountry()]);
        return $register_valid;
    }

    /**
     * @param string $email
     * @return mixed
     */
    public function getUserByEmail(string $email): mixed
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email=:email");
        $stmt->execute(["email" => $email]);
        $user = $stmt->fetch();
        return $user;
    }

    /**
     * @param int $userId
     * @return mixed
     */
    public function getUserById(int $userId): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id=:id");
        $stmt->execute(["id" => $userId]);
        $userData = $stmt->fetch();

        if (!$userData) {
            return null;
        }

        return new User(
            $userData['firstname'],
            $userData['email'],
            $userData['password_hash'],
            $userData['role'],
            $userData['lastname'],
            $userData['age'],
            $userData['username'],
            $userData['country']
        );
    }

    /**
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function verifyPassword(string $email, string $password): bool
    {
        $user = $this->getUserByEmail($email);
        if ($user && password_verify($password, $user['password_hash'])) {
            return true;
        }
        return false;
    }

    public function updatePassword(string $email, string $newPassword): bool
    {
        $stmt = $this->db->prepare("UPDATE users SET password_hash = ? WHERE email = ?");
        $result = $stmt->execute([$newPassword, $email]);
        return $result;
    }

    public function updateUserProfile(string $currentEmail, string $firstname, string $lastname, string $email): bool
    {
        $stmt = $this->db->prepare("UPDATE users SET firstname = ?, lastname = ?, email = ? WHERE email = ?");
        return $stmt->execute([$firstname, $lastname, $email, $currentEmail]);
    }


    public function getAllUsers(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function deleteUser(int $userId): bool
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$userId]);
    }

    public function updateUserRole(int $userId, string $role): bool
    {
        $stmt = $this->db->prepare("UPDATE users SET role = ? WHERE id = ?");
        return $stmt->execute([$role, $userId]);
    }
}
