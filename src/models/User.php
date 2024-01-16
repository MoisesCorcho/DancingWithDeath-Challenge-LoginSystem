<?php

namespace src\models;

use src\libraries\Database;

/**
 * Class User
 * 
 * Represents a model for managing users in the database.
 */
class User
{

    /** @var Database $db Instance of the Database class for handling database operations.*/
    private Database $db;

    /**
     * Constructor method to initialize the Database instance.
     */
    public function __construct()
    {
        $this->db = new Database;
    }

    public function createUser(array $data): int
    {
        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";

        $password_hash = password_hash($data["password"], PASSWORD_DEFAULT);

        $this->db->query($sql);
        $this->db->bind(":name", $data["name"]);
        $this->db->bind(":email", $data["email"]);
        $this->db->bind(":password", $password_hash);
        $this->db->execute();

        return $this->db->returnLastIdInserted();
    }

    public function getByEmail(string $email): array | false
    {
        $sql = "SELECT * FROM users WHERE email = :email";

        $this->db->query($sql);
        $this->db->bind(":email", $email);
        $this->db->execute();

        return $this->db->single();
    }

    public function getByID(int $id): array | false
    {
        $sql = "SELECT * FROM users WHERE id = :id";

        $this->db->query($sql);
        $this->db->bind(":id", $id);
        $this->db->execute();

        return $this->db->single();
    }

}