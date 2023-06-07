<?php
    require_once("./functionConnexion/ConnexionDocker.php");
    require("./Terminal.php");

    class TypeTerminal {
        private int $id_type_terminal;
        private Terminal $type_terminal;

        public function __construct($id_type_terminal, $type_terminal) {
            if($id_type_terminal!=0) {
                $this->fetchTypeTerminalById($id_type_terminal);
            }
            else {
                $this->id_type_terminal = $id_type_terminal;
                $this->type_terminal = $type_terminal;
            }
        }

        private function fetchTypeTerminalById($id) {
            $dbo = connexion();
            $req = $dbo -> execSQL("SELECT * FROM TypeTerminal WHERE id_type_terminal =" . $id);
            unset($dbo);
            foreach($req as $lesrequeteTab) {
                $this->id_type_terminal = $lesrequeteTab["id_type_terminal"];
                $this->type_terminal = $lesrequeteTab["type_terminal"];
            }
        }

        public function getId_TypeTerminal() {
            return $this->id_type_terminal;
        }
        public function getTypeTerminal() {
            return $this->type_terminal;
        }

        public function setId_TypeTerminal($id_type_terminal) {
            $this->id_type_terminal = $id_type_terminal;
        }
        public function setTypeTerminal($type_terminal) {
            $this->type_terminal = $type_terminal;
        }
    }
?>