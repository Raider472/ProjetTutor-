<?php
    require_once("./functionConnexion/ConnexionDocker.php");
    require("./Terminal.php");

    class EmplacementTerminal {
        private int $id_emplacement_terminal;
        private Terminal $emplacement_terminal;

        public function __construct($id_emplacement_terminal, $emplacement_terminal) {
            if($id_emplacement_terminal!=0) {
                $this->fetchEmplacementTerminalById($id_emplacement_terminal);
            }
            else {
                $this->id_emplacement_terminal = $id_emplacement_terminal;
                $this->emplacement_terminal = $emplacement_terminal;
            }
        }

        private function fetchEmplacementTerminalById($id) {
            $dbo = connexion();
            $req = $dbo -> execSQL("SELECT * FROM EmplacementTerminalById WHERE id_emplacement_terminal =" . $id);
            unset($dbo);
            foreach($req as $lesrequeteTab) {
                $this->id_emplacement_terminal = $lesrequeteTab["id_emplacement_terminal"];
                $this->emplacement_terminal = $lesrequeteTab["emplacement_terminal"];
            }
        }

        public function getId_EmplacementTerminal() {
            return $this->id_emplacement_terminal;
        }
        public function getEmplacementTerminal() {
            return $this->emplacement_terminal;
        }

        public function setId_EmplacementTerminal($id_emplacement_terminal) {
            $this->id_emplacement_terminal = $id_emplacement_terminal;
        }
        public function setEmplacementTerminal($emplacement_terminal) {
            $this->emplacement_terminal = $emplacement_terminal;
        }
    }
?>
