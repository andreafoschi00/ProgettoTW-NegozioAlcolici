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
            $stmt = $this->db->prepare("SELECT prodotto.ID as IDprodotto, prodotto.nome as nomeProdotto, nomeImmagine, testoLungo, dataInserimento, venditore.ID as IDvenditore, venditore.nome as nomeVenditore, venditore.cognome as cognomeVenditore, quantitàDisponibile, prezzoUnitario
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

        public function getProductsWithFilters($categorie, $filtro) {
            $count = str_repeat("?,", count($categorie)-1)."?";
            $types = str_repeat("s", count($categorie));
            $query = "";
            switch($filtro) {
                case "piurecenti" :
                    $query = "SELECT prodotto.ID as IDprodotto, quantitàDisponibile, prodotto.nome as nomeProdotto, nomeImmagine, testoMedio, dataInserimento, venditore.nome as nomeVenditore, venditore.cognome as cognomeVenditore
                            FROM prodotto, venditore, categoria
                            WHERE venditore.ID = prodotto.ID_venditore
                            AND prodotto.ID_categoria = categoria.ID
                            AND categoria.nome IN ($count)
                            ORDER BY prodotto.dataInserimento DESC";
                    break;
                case "menorecenti" :
                    $query = "SELECT prodotto.ID as IDprodotto, quantitàDisponibile, prodotto.nome as nomeProdotto, nomeImmagine, testoMedio, dataInserimento, venditore.nome as nomeVenditore, venditore.cognome as cognomeVenditore
                            FROM prodotto, venditore, categoria
                            WHERE venditore.ID = prodotto.ID_venditore
                            AND prodotto.ID_categoria = categoria.ID
                            AND categoria.nome IN ($count)
                            ORDER BY prodotto.dataInserimento";
                    break;
                case "alfabetico" :
                    $query = "SELECT prodotto.ID as IDprodotto, quantitàDisponibile, prodotto.nome as nomeProdotto, nomeImmagine, testoMedio, dataInserimento, venditore.nome as nomeVenditore, venditore.cognome as cognomeVenditore
                            FROM prodotto, venditore, categoria
                            WHERE venditore.ID = prodotto.ID_venditore
                            AND prodotto.ID_categoria = categoria.ID
                            AND categoria.nome IN ($count)
                            ORDER BY nomeProdotto";
                    break;
                case "moltidisponibili" :
                    $query = "SELECT prodotto.ID as IDprodotto, quantitàDisponibile, prodotto.nome as nomeProdotto, nomeImmagine, testoMedio, dataInserimento, venditore.nome as nomeVenditore, venditore.cognome as cognomeVenditore
                            FROM prodotto, venditore, categoria
                            WHERE venditore.ID = prodotto.ID_venditore
                            AND prodotto.ID_categoria = categoria.ID
                            AND prodotto.quantitàDisponibile >= 20
                            AND categoria.nome IN ($count)
                            ORDER BY prodotto.quantitàDisponibile DESC";
                    break;
                case "pochidisponibili" :
                    $query = "SELECT prodotto.ID as IDprodotto, quantitàDisponibile, prodotto.nome as nomeProdotto, nomeImmagine, testoMedio, dataInserimento, venditore.nome as nomeVenditore, venditore.cognome as cognomeVenditore
                            FROM prodotto, venditore, categoria
                            WHERE venditore.ID = prodotto.ID_venditore
                            AND prodotto.ID_categoria = categoria.ID
                            AND prodotto.quantitàDisponibile < 10
                            AND categoria.nome IN ($count)
                            ORDER BY prodotto.quantitàDisponibile DESC";
                    break;
            }
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('sssssss', ...$categorie);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function getProductsFromID($ids) {
            $count = str_repeat("?,", count($ids)-1)."?";
            $types = str_repeat("i", count($ids));
            $stmt = $this->db->prepare("SELECT prodotto.ID as IDprodotto, prodotto.nome as nomeProdotto, nomeImmagine, dataInserimento, quantitàDisponibile, prezzoUnitario
                                        FROM prodotto
                                        WHERE prodotto.ID in ($count)");
            $stmt->bind_param($types, ...$ids);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function getIDfromMail($email, $rank) {
            $stmt = $this->db->prepare("SELECT ID
                                        FROM $rank
                                        WHERE email = ?");
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $id = $result->fetch_object();

            return $id->ID;
        }

        public function getPersonalInformationFromID($id, $rank) {
            $stmt = $this->db->prepare("SELECT ID, nome, cognome, dataNascita, email
                                        FROM $rank
                                        WHERE ID = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function getOrdersFromID($id) {
            $stmt = $this->db->prepare("SELECT ID as IDordine, costoTotale, dataOraOrdine
                                        FROM ordine
                                        WHERE ID_cliente = ?
                                        ORDER BY dataOraOrdine DESC");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function getLast24hoursOrders() {
            $stmt = $this->db->prepare("SELECT ID as IDordine, costoTotale, dataOraOrdine
                                        FROM ordine
                                        WHERE DATE(dataOraOrdine) = CURDATE()");
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function getNotificationsFromID($id, $rank) {
            $query = "";
            if($rank == "cliente") {
                $query = "SELECT ID, testo, tipo, letta
                          FROM notifica
                          WHERE ID_cliente = ?
                          ORDER BY letta";
            } else {
                $query = "SELECT ID, testo, tipo, letta
                            FROM notifica
                            WHERE ID_venditore = ?
                            ORDER BY letta";
            }
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function addOrderWithNoCreditCard($indirizzo, $tipoPagamento, $costoTotale, $clientID) {
            $stmt = $this->db->prepare("INSERT INTO ordine (costoTotale, tipoPagamento, indirizzoSpedizione, dataOraOrdine, ID_cliente) 
                                        VALUES (?, ?, ?, CURRENT_TIMESTAMP(), ?)");
            $stmt->bind_param('dssi', $costoTotale, $tipoPagamento, $indirizzo, $clientID);
            $stmt->execute();                  
        }

        public function addOrderWithCreditCard($indirizzo, $tipoPagamento, $costoTotale, $numcarta, $datacarta, $cvvcarta, $clientID) {
            $stmt = $this->db->prepare("INSERT INTO ordine (costoTotale, tipoPagamento, indirizzoSpedizione, dataOraOrdine, numeroCarta, dataScadenzaCarta, cvv, ID_cliente) 
                                        VALUES (?, ?, ?, CURRENT_TIMESTAMP(), ?, ?, ?, ?)");
            $stmt->bind_param('dssisii', $costoTotale, $tipoPagamento, $indirizzo, $numcarta, $datacarta, $cvvcarta, $clientID);
            $stmt->execute();
        }

        public function getLastOrderID() {
            $stmt = $this->db->prepare("SELECT MAX(ID) AS ID
                                        FROM ordine");
            $stmt->execute();
            $result = $stmt->get_result();
            $id = $result->fetch_object();

            return $id->ID;
        }

        public function addProductToOrder($IDordine, $IDProdotto, $quantità) {
            $stmt = $this->db->prepare("INSERT INTO prodotto_in_ordine (ID_ordine, ID_prodotto, quantitàAcquistata) 
                                        VALUES (?, ?, ?)");
            $stmt->bind_param('iii', $IDordine, $IDProdotto, $quantità);
            $stmt->execute();
        }

        public function getActualQuantityFromID($ID) {
            $stmt = $this->db->prepare("SELECT quantitàDisponibile AS quantità
                                        FROM prodotto
                                        WHERE ID = ?");
            $stmt->bind_param('i', $ID);
            $stmt->execute();
            $result = $stmt->get_result();
            $quantità = $result->fetch_object();

            return $quantità->quantità;
        }

        public function updateProductAvailableQuantity($IDProdotto, $quantitaAttuale, $quantitaAcquistata) {
            $stmt = $this->db->prepare("UPDATE prodotto 
                                        SET quantitàDisponibile = ? 
                                        WHERE ID = ?");
            $quantitaAttuale -= $quantitaAcquistata;
            $stmt->bind_param('ii', $quantitaAttuale, $IDProdotto);
            $stmt->execute();
        }

        public function sendNotificationToClient($message, $id) {
            $stmt = $this->db->prepare("INSERT INTO notifica (testo, tipo, letta, ID_cliente) 
                                        VALUES (?, 'spedizione', '0', ?)");
            $stmt->bind_param('si', $message, $id);
            $stmt->execute();
        }

        public function sendNotificationToSeller($message, $id) {
            $stmt = $this->db->prepare("INSERT INTO notifica (testo, tipo, letta, ID_venditore) 
                                        VALUES (?, 'esaurimento', '0', ?)");
            $stmt->bind_param('si', $message, $id);
            $stmt->execute();
        }

        public function markNotificationAsReadWithID($id) {
            $stmt = $this->db->prepare("UPDATE notifica 
                                        SET letta = 1 
                                        WHERE ID = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
        }

        public function getNumberOfUnderadNotification($email, $table) {
            $attr = $table == "cliente" ? "ID_cliente" : "ID_venditore";
            $stmt = $this->db->prepare("SELECT COUNT(letta) as letta
                                        FROM notifica, $table
                                        WHERE $table.email = ?
                                        AND $table.ID = notifica.$attr
                                        AND letta = 0");

            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $quantità = $result->fetch_object();

            return $quantità->letta;
        }

        public function getClientEmails(){
            $query = "SELECT email FROM cliente";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
    
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function getSellerEmails(){
            $query = "SELECT email FROM venditore";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
    
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function insertUser($nome, $cognome, $dataNascita, $email, $password){
            $stmt = $this->db->prepare("INSERT INTO cliente (nome, cognome, dataNascita, email, `password`) 
                                        VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param('sssss', $nome, $cognome, $dataNascita, $email, $password);
            $stmt->execute();
        }

        public function getProductsFromOrder($id){
            $stmt = $this->db->prepare("SELECT prodotto.nome AS nomeProdotto, nomeImmagine, quantitàAcquistata, prezzoUnitario
                                        FROM prodotto, prodotto_in_ordine, ordine
                                        WHERE ordine.ID = ? AND prodotto_in_ordine.ID_ordine = ordine.ID
                                        AND prodotto_in_ordine.ID_prodotto = prodotto.ID");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);

        }

        public function getPersonalInformationFromEmail($email, $rank) {
            $stmt = $this->db->prepare("SELECT  nome, cognome, dataNascita, email
                                        FROM $rank
                                        WHERE email = ?");
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_row();
        }

        public function updatePersonalInfo($nome, $cognome, $data, $email, $rank){
            $stmt = $this->db->prepare("UPDATE $rank 
                                        SET nome = ?, cognome = ?, dataNascita = ?
                                        WHERE email = ?");
            $stmt->bind_param('ssss', $nome, $cognome, $data, $email);
            $stmt->execute();
        }

        public function insertProduct($idVenditore, $titolo, $img, $quantità, $disponibilità, $prezzo, $testoBreve, $testoMedio, $testoLungo, $dataInserimento, $categoria){
            $stmt = $this->db->prepare("INSERT INTO prodotto (ID_venditore, nome, nomeImmagine, quantitàDisponibile, tipoDisponibilità, prezzoUnitario,
            testoBreve, testoMedio, testoLungo, dataInserimento, ID_categoria) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
             $stmt->bind_param('issisdssssi', $idVenditore, $titolo, $img, $quantità, $disponibilità, $prezzo, $testoBreve, $testoMedio, $testoLungo, $dataInserimento, $categoria);
             $stmt->execute();
        }

        public function getIdByCategory($category){
            $stmt = $this->db->prepare("SELECT ID
                                        FROM categoria 
                                        WHERE nome = ?");
            $stmt->bind_param("s", $category);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function getSellerProducts($id) {
            $stmt = $this->db->prepare("SELECT prodotto.ID as IDprodotto, prodotto.nome as nomeProdotto, nomeImmagine, testoMedio, dataInserimento, venditore.nome as nomeVenditore, venditore.cognome as cognomeVenditore
                                        FROM prodotto, venditore
                                        WHERE prodotto.ID_venditore = ? AND venditore.ID = prodotto.ID_venditore
                                        ORDER BY prodotto.dataInserimento DESC");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
    
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function getIdSeller($email) {
            $stmt = $this->db->prepare("SELECT ID
                                        FROM venditore
                                        WHERE email = ?");
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();
    
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }
?>