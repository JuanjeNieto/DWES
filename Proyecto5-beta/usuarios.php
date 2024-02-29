<?php
class Usuarios {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function validarUsuario($usuario, $contrasena) {
        // Consulta preparada para validar usuario y contraseña
        $query = $this->db->prepare("SELECT id, pwd FROM usuarios WHERE usuario = :usuario");
        $query->bindParam(':usuario', $usuario);
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result && password_verify($contrasena, $result['pwd'])) {
            return true; // Credenciales válidas
        } else {
            return false; // Credenciales incorrectas
        }
    }
    public function obtenerTodosUsuarios() {
        $query = $this->db->prepare("SELECT id, usuario, email FROM usuarios");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function altaUsuario($usuario, $contrasena, $email) {
        // Consulta preparada para dar de alta un usuario
        $hashedPassword = password_hash($contrasena, PASSWORD_DEFAULT);

        $query = $this->db->prepare("INSERT INTO usuarios (usuario, pwd, email) VALUES (:usuario, :pwd, :email)");
        $query->bindParam(':usuario', $usuario);
        $query->bindParam(':pwd', $hashedPassword);
        $query->bindParam(':email', $email);

        return $query->execute();
    }

    public function modificarUsuario($id, $usuario, $email) {
        // Consulta preparada para modificar datos de usuario
        $query = $this->db->prepare("UPDATE usuarios SET usuario = :usuario, email = :email WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->bindParam(':usuario', $usuario);
        $query->bindParam(':email', $email);

        return $query->execute();
    }

    public function eliminarUsuario($id) {
        // Consulta preparada para eliminar un usuario
        $query = $this->db->prepare("DELETE FROM usuarios WHERE id = :id");
        $query->bindParam(':id', $id);

        return $query->execute();
    }
}
