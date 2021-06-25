<?php
class User {
    private $id;
    private $name;
    private $lastName;
    private $password;
    private $email;
    private $ci;
    private $phone;
    private $birthDate;
    private $db;

    function __construct() {
        $this->db = Database::connect();
    }

    function setName(string $name) { $this->name = $this->testInput($name); }

    function setLastName(string $lastName) { $this->lastName = $this->testInput($lastName); }

    function setPassword(string $password) { 
        $this->password = password_hash($this->testInput($password), PASSWORD_BCRYPT, ['cost' => 4]); 
    }

    function setEmail(string $email) { $this->email = $this->testInput($email); }

    function setCi(string $ci) { $this->ci = $this->testInput($ci); }
    
    function setPhone(string $phone) { $this->phone = $this->testInput($phone); }

    function setBirthDate(string $birthDate) { $this->birthDate = $this->testInput($birthDate); }

    public function save() {
        if($this->validate()) {
            $query = "INSERT INTO users VALUES("
                ."NULL, " 
                ."'{$this->name}', " 
                ."'{$this->lastName}', " 
                ."'{$this->password}', " 
                ."'{$this->email}', "
                ."'{$this->ci}', "
                ."'{$this->phone}', " 
                ."'{$this->birthDate}', " 
                ."'user')"
            ;
            $save = $this->db->query($query);
        }else
            header("Location:".base_url."?controller=user&&action=register");

        $result = false;
        if($save)
            $result = true;

        return $result;
    }

    private function validate(): bool {
        session_start();
        $_SESSION["errors"] = [];
        $nameErr = $lastNameErr = $ciErr = $emailErr = $passwordErr = "";

        #Validation for name and last name
        if (empty($this->name))
            $_SESSION["errors"]["name"] = "Debe ingresar su nombre.";

        if (empty($this->lastName))
            $_SESSION["errors"]["lastName"] = "Debe ingresar su apellido.";

        if (!preg_match("/^[a-zA-Z' ]*$/", $this->name))
            $_SESSION["errors"]["name"] = "Introduzca solamente letras y espacios.";

        if (!preg_match("/^[a-zA-Z' ]*$/", $this->lastName))
            $_SESSION["errors"]["lastName"] = "Introduzca solamente letras y espacios.";

        #Validation for CI
        if (empty($this->ci))
            $_SESSION["errors"]["ci"] = "Debe ingresar su número de cedula.";

        if (!preg_match("/^[0-9]*$/", $this->ci) || strlen($this->ci) < 6 || strlen($this->ci) > 8)
            $_SESSION["errors"]["ci"] = "Debe ingresar un número de cedula válido.";

        #Validation for email
        if (empty($this->email))
            $_SESSION["errors"]["email"] = "Debe ingresar su correo electrónico.";

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION["errors"]["email"] = "La dirección de email es inválida.";
        }

        #Validation for password
        if (empty($this->password))
            $_SESSION["errors"]["password"] = "Debe ingresar una contraseña.";

        if (strlen($this->password) < 6)
            $_SESSION["errors"]["password"] = "La contraseña debe contener al menos 6 caracteres.";

        #Setting session variables for the input values
        $_SESSION["name"] = $this->name;
        $_SESSION["lastName"] = $this->lastName;
        $_SESSION["ci"] = $this->ci;
        $_SESSION["email"] = $this->email;

        $_SESSION["register"] = empty($_SESSION["errors"]);

        if(!$_SESSION["register"])
            return false;

        return true;
    }

    private function testInput(string $data): string {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = $this->db->real_escape_string($data);

        return $data;
    }
}
