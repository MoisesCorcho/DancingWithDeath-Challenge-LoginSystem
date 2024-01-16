<?php

namespace src\libraries;

use PDO;

class RefreshTokenGateway
{
    private Database $conn;
    private string $key;
    
    public function __construct(string $key)
    {
        $this->key = $key;
        $this->conn = new Database;
    }
    
    public function create(string $token, int $expiry): int
    {
        $hash = hash_hmac("sha256", $token, $this->key);
        
        $sql = "INSERT INTO refresh_token (token_hash, expires_at)
                VALUES (:token_hash, :expires_at)";
                
        $this->conn->query($sql);

        $this->conn->bind(":token_hash", $hash, PDO::PARAM_STR);
        $this->conn->bind(":expires_at", $expiry, PDO::PARAM_INT);

        return $this->conn->execute();
    }
    
    public function delete(string $token): int
    {
        $hash = hash_hmac("sha256", $token, $this->key);
        
        $sql = "DELETE FROM refresh_token
                WHERE token_hash = :token_hash";
                
        $this->conn->query($sql);

        $this->conn->bind(":token_hash", $hash, PDO::PARAM_STR);
        
        $this->conn->execute();
        
        return $this->conn->rowCount();
    }
    
    public function getByToken(string $token): array | false
    {
        $hash = hash_hmac("sha256", $token, $this->key);
        
        $sql = "SELECT *
                FROM refresh_token
                WHERE token_hash = :token_hash";
                
        $this->conn->query($sql);
        
        $this->conn->bind(":token_hash", $hash, PDO::PARAM_STR);
        
        $this->conn->execute();

        return (array) $this->conn->single();
    }
    
    public function deleteExpired(): int
    {
        $sql = "DELETE FROM refresh_token
                WHERE expires_at < UNIX_TIMESTAMP()";
            
        $this->conn->query($sql);
        
        return $this->conn->rowCount();
    }
}













