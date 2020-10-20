<?php

/**
 * Bob is a lackadaisical teenager. 
 * @author Steve Varndell
 */

class Bob {
     
    /**
     * Given an input string, return the appropriate response
     *
     * @param string $input
     * @return string
     */
    public function respondTo(string $input) : string
    {
        
        $input = $this->prepareInput($input);

        // He says 'Fine. Be that way!' if you address him without actually saying anything.
        if(empty($input)) {
            return 'Fine. Be that way!' ;
        }

        // He answers 'Calm down, I know what I'm doing!' if you yell a question at him.
        if($this->isQuestion($input) && $this->isYelling($input)) {
            return "Calm down, I know what I'm doing!" ;
        }

        // Bob answers 'Sure.' if you ask him a question.
        if($this->isQuestion($input)) {
            return 'Sure.' ;
        }
        
        // He answers 'Whoa, chill out!' if you yell at him.
        if($this->isYelling($input)) {
            return 'Whoa, chill out!' ;
        }

        // He answers 'Whatever.' to anything else.
        return 'Whatever.' ;

    }

    /**
     * Prepare string for interrogation
     *
     * @see https://stackoverflow.com/a/10067240 for preg_replace
     * 
     * @param string $input
     * @return string
     */
    private function prepareInput(string $input): string
    {
        // remove white space
        return preg_replace("/^\s+|\s+$/u", "", $input);
    }

    /**
     * Check if a given string ends in a question mark
     *
     * @param string $input
     * @return boolean
     */
    private function isQuestion(string $input) : bool
    {
        return (substr($input, -1) === '?');
    }

    /**
     * Check if all the letters in a string are caps
     * 
     * @see https://stackoverflow.com/a/7264299 regex that strips non letters
     * 
     * @param string $input
     * @return boolean
     */
    private function isYelling(string $input) : bool
    {

        // we only want to test the letters for being uppercase - so strip everything else
        $str = preg_replace('/\PL/u', '', $input);

        // if the string is empty after letters were removed it just contained chars 
        if(empty($str)) {
            return false ;
        }

        // test if letters are caps
        if(ctype_upper($str)) {
            return true ;
        } 

        // transform to UTF-8 to catch unusual chars:
        if(mb_strtoupper($str, 'UTF-8') == $str) {
            return true ;
        }

        return false ;

    }

}