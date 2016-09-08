<?php
    class Game{
        private $word;
        private $letter_array;
        private $displayed_word = "";
        private $guessed_letter;
        private $guessed_letters_right;
        private $guessed_letters_wrong;

        function __construct($newword) {
            $this->word = $newword;
        }

        function setWord($word){
            $this->word = (string) $word;
        }
        function getWord(){
            return $this->word;
        }
        function setLetter($guessed_letter){
            $this->guessed_letter = (string) $guessed_letter;
        }
        function getLetter(){
            return $this->guessed_letter;
        }
        function save(){
          // array_push($_SESSION['target_word'], $this);
          $_SESSION['target_word'] = $this;
        }
        static function getTarget(){
          return $_SESSION['target_word'];
        }
        function setGuess($guess){
          $this->guessed_letter = (string) $guess;
        }

        function hideWord(){
          $this->letter_array = str_split($this->word);

          foreach($this->letter_array as $letter){
            $this->displayed_word .= "_ ";
          }
          return $this->displayed_word;
        }

        function takeGuess(){
          $this->displayed_word .= "";
          foreach($this->letter_array as $letter){
            if($letter = $this->guessed_letter){
              $this->displayed_word .= $letter;
            }
            else{
              $this->displayed_word .= "_ ";
            }
          }
        }

        function getDisplay(){
          return $this->displayed_word;
        }
    }

?>
