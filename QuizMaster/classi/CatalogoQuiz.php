<?php
// Inclusione delle classi necessarie per l'utilizzo di Quiz e Domanda
include_once "classi/Quiz.php";
include_once "classi/Domanda.php";

// Definizione della classe CatalogoQuiz
class CatalogoQuiz 
{
    // Proprietà privata per contenere i quiz
    private $quiz;

    // Costruttore che inizializza il catalogo e chiama la funzione per estrapolare i quiz dal CSV
    public function __construct() {
        $this->quiz = [];
        $this->estrapolaQuizDalCsv();
    }

    // Funzione per estrapolare i quiz dal file CSV
    public function estrapolaQuizDalCsv() {
        // Legge il contenuto del file CSV
        $contenuto = file_get_contents("csv/quizCreati.csv");
        $righe = explode("\r\n", $contenuto);

        $quiz = []; // Array temporaneo per memorizzare i quiz

        foreach ($righe as $riga) {
            $colonne = explode(";", $riga); // Separazione delle colonne

            // Ignora righe incomplete o errate
            if (count($colonne) < 8) {
                continue;
            }

            // Estrazione dei dati del quiz
            $nomeQuiz = $colonne[0];
            $difficoltàQuiz = $colonne[1];
            $richiesta = $colonne[2];
            $opzione1 = $colonne[3];
            $opzione2 = $colonne[4];
            $opzione3 = $colonne[5];
            $opzione4 = $colonne[6];
            $rispostaCorretta = $colonne[7];
            $opzioni = [$opzione1, $opzione2, $opzione3, $opzione4];

            // Creazione di una nuova domanda
            $domanda = new Domanda($richiesta, $rispostaCorretta, $opzioni);

            // Aggiunge la domanda al quiz esistente o crea un nuovo quiz
            if (isset($quiz[$nomeQuiz])) {
                $quiz[$nomeQuiz]->aggiungiDomanda($domanda);
            } else {
                $quizTemp = new Quiz($nomeQuiz, [$domanda], $difficoltàQuiz);
                $quiz[$nomeQuiz] = $quizTemp;
            }
        }

        // Assegna il risultato al catalogo dei quiz
        $this->quiz = $quiz;
    }

    // Ritorna l'elenco dei quiz
    public function getQuiz() {
        return $this->quiz;
    }

    // Ritorna un quiz specifico tramite il nome
    public function ottieniQuizTramiteNome($nomeQuiz) {
        $quizTmp = null;
        foreach ($this->quiz as $elemento) {
            if ($elemento->getNomeQuiz() == $nomeQuiz) {
                $quizTmp = $elemento;
            }
        }
        return $quizTmp;
    }

    // Controlla se un nome di quiz è presente nel catalogo
    public function controllaSeNomeQuizPresente($nomeQuiz) {
        foreach ($this->quiz as $quiz2) {
            if ($quiz2->getNomeQuiz() == $nomeQuiz) {
                return true;
            }
        }
        return false;
    }

    public function eliminaQuizTramiteNome($nomeQuiz) {
        $nuovoQuiz = [];
    
        // Filtra i quiz, escludendo quello con il nome specificato

        foreach ($this->quiz as $quiz2) {
            if ($quiz2->getNomeQuiz()!= $nomeQuiz) {
                $nuovoQuiz[] = $quiz2;
            }
        }

        // Verifica se il quiz è stato effettivamente eliminato
        if (count($nuovoQuiz) == count($this->quiz)) {
            return false; // Nessun quiz eliminato
        }
    
        // Aggiorna l'array dei quiz
        $this->quiz = $nuovoQuiz;
    
        // Salva i quiz aggiornati nel CSV
        $this->salvaQuizSuCsv();
    
        return true;
    }

    private function salvaQuizSuCsv() {
        $righe = [];
    
        foreach ($this->quiz as $quiz) {
            foreach ($quiz->getDomande() as $domanda) {
                $valoriRiga = [
                    $quiz->getNomeQuiz(),
                    $quiz->getDifficoltàQuiz(),
                    $domanda->getRichiesta(),
                    $domanda->getOpzioni()[0],
                    $domanda->getOpzioni()[1],
                    $domanda->getOpzioni()[2],
                    $domanda->getOpzioni()[3],
                    $domanda->getRispostaCorretta()
                ];
            
                // Unisci i valori della riga in una stringa separata da ";"
                $righe[] = implode(";", $valoriRiga);
            }
        }
    
        file_put_contents("csv/quizCreati.csv", implode("\r\n", $righe));
    }
    
    
}
?>
