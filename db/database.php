<?php
    class DatabaseHelper {
        private $db;

        public function __construct($servername, $username, $password, $dbname, $port){
            $this->db = new mysqli($servername, $username, $password, $dbname, $port);
            if ($this->db->connect_error) {
                die("Connection failed: " . $db->connect_error);
            }
        }

        public function getLastIndex() {
            $stmt = $this->db->prepare("SELECT MAX(ID) as ID FROM prodotto");
            $stmt->execute();
            $result = $stmt->get_result();
            $id = $result->fetch_object();

            return $id->ID;
        }

        public function getLatestProducts() {
            $stmt = $this->db->prepare("SELECT prodotto.ID as IDprodotto, prodotto.nome as nomeProdotto, nomeImmagine, testoMedio, dataInserimento, venditore.nome as nomeVenditore, venditore.cognome as cognomeVenditore
                                        FROM prodotto, venditore
                                        WHERE venditore.ID = prodotto.ID_venditore
                                        ORDER BY prodotto.dataInserimento DESC");
            $stmt->execute();
            $result = $stmt->get_result();
    
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function getRandomProducts($n) {
            $stmt = $this->db->prepare("SELECT nomeImmagine, nome, testoBreve, ID 
                                        FROM prodotto 
                                        ORDER BY RAND() 
                                        LIMIT ?");
            $stmt->bind_param("i", $n);
            $stmt->execute();
            $result = $stmt->get_result();
    
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function getCategories() {
            $stmt = $this->db->prepare("SELECT ID, nome
                                        FROM categoria");
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function getProductByID($idProdotto) {
            $stmt = $this->db->prepare("SELECT prodotto.nome as nomeProdotto, nomeImmagine, testoLungo, dataInserimento, venditore.nome as nomeVenditore, venditore.cognome as cognomeVenditore, quantitàDisponibile, prezzoUnitario
                                        FROM prodotto, venditore
                                        WHERE venditore.ID = prodotto.ID_venditore
                                        AND prodotto.ID = ?");
            $stmt->bind_param('i',$idProdotto);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function checkLogin($username, $password){
            $query = "SELECT email FROM cliente WHERE email = ? AND password = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ss',$username, $password);
            $stmt->execute();
            $result = $stmt->get_result();
    
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function getCategoryById($idcategoria) {
            $stmt = $this->db->prepare("SELECT nome 
                                        FROM categoria 
                                        WHERE ID = ?");
            $stmt->bind_param("i", $idcategoria);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function getProductsByCategory($idcategoria) {
            $stmt = $this->db->prepare("SELECT prodotto.ID as IDprodotto, prodotto.nome as nomeProdotto, nomeImmagine, testoMedio, dataInserimento, venditore.nome as nomeVenditore, venditore.cognome as cognomeVenditore
                                        FROM prodotto, venditore
                                        WHERE venditore.ID = prodotto.ID_venditore
                                        AND prodotto.ID_categoria = ?
                                        ORDER BY prodotto.dataInserimento DESC");
            $stmt->bind_param("i", $idcategoria);
            $stmt->execute();
            $result = $stmt->get_result();
    
            return $result->fetch_all(MYSQLI_ASSOC);
            
        }

        public function checkVenditore($username, $password){
            $query = "SELECT email, `password` FROM venditore WHERE email = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('s',$username);
            $stmt->execute();
            $result = $stmt->get_result();
    
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function checkCliente($username, $password){
            $query = "SELECT email, `password` FROM cliente WHERE email = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('s',$username);
            $stmt->execute();
            $result = $stmt->get_result();
    
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }
?>