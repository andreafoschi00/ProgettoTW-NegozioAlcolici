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
            $stmt = $this->db->prepare("SELECT prodotto.nome as nomeProdotto, nomeImmagine, testoMedio, dataInserimento, venditore.nome as nomeVenditore, venditore.cognome as cognomeVenditore
                                        FROM prodotto, venditore
                                        WHERE venditore.ID = prodotto.ID_venditore
                                        ORDER BY prodotto.dataInserimento DESC");
            $stmt->execute();
            $result = $stmt->get_result();
    
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function getRandomProducts($n) {
            $stmt = $this->db->prepare("SELECT nomeImmagine, nome, testoBreve 
                                        FROM prodotto 
                                        ORDER BY RAND() 
                                        LIMIT ?");
            $stmt->bind_param("i", $n);
            $stmt->execute();
            $result = $stmt->get_result();
    
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function getCategories() {
            $stmt = $this->db->prepare("SELECT nome
                                        FROM categoria");
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }
?>