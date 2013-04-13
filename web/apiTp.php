

<?php

class ApiTp{
    private $_ip;
    private $_port;
    private $_secretKey;
    private $_padId;
    
    
    /*
        Constructeur
     */
     public function __construct($ip, $port, $padId, $secretKey){
        $this->_ip = $ip;
   	    $this->_port = $port;
   	    $this->_padId = $padId;
        $this->_secretKey = $secretKey;
     }
    
    // Retourne tout le texte d'un pad
    //
    // En paramètre :
    //    	- IP
    //    	- Port
    //    	- apiKey : clé secrète du pad
    //    	- padID
    public function getAllTextByPad(){
    	$url ="http://".$this->_ip.":".$this->_port."/api/1.2.1/getText?apikey=".$this->_secretKey."&padID=".$this->_padId;
    	$json = file_get_contents($url); // Récupération du texte du pad au format json
    	$data = json_decode($json, TRUE); // transformation du json en tableau
    	return utf8_decode($data['data']['text']);
    }

    // transforme un tableau en json
    public function arrayToJson($array)
    {
        $json = json_encode($array);
        return $json;
    }

    /* ----------------- Le mot le plus long -------------- */
    // Supprime les accents
    public function stripAccents($string){
    	return strtr($string,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ',
   	 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
    }
    // Retourne le nombre de mots
    public function nbWords()
    {
         $data = $this->getAllTextByPad();
    	$string = $data;
    	$string = $this->stripAccents($string);
        $result = str_word_count($string); //compte le nombre de mots dans la chaine
        $myArray["nb_words"] = $result;
    	return $this->arrayToJson($myArray);
    }
    // Retourne un tableau
    // array[0] = le mot le plus long;
    // array[1] = nombre de caractères du mot le plus long
    public function longuestWord()
    {
   	 $data = $this->getAllTextByPad();
    	$array = array();
    	$max_length ="0";
    	$string = $data;
    	$string = str_replace("\n", " ", $string);
    	$tab = explode(" ", $string); //création d'un tableau de mots
    	$nb_words = count($tab);
         	 
    	for($i = 0; $i < $nb_words ; $i++){
    	$length=strlen($tab[$i]);
        	if($max_length <= $length){ //Si le mot le plus long recensé est plus petit que le mot actuel
            	$max_length = $length; //Le mot actuelle devient le mot le plus long
            	$max_word = $tab[$i];
        	}
    	}
        $myArray = array();
    	$myArray["longuest_word"] = $max_word;
    	$myArray["length"] = $max_length;

    	return $this->arrayToJson($myArray);
    }
    
    /**
     * Retourne le nombre de caractères saisie dans le PAD sans compter les espaces
     */   	 
    public function nBChars(){
   	 $txtMessage = $this->getAllTextByPad();
    	//retire les espaces avant et après la chaine de caractères
    	$txtMessage = trim($txtMessage, '\h\t\n\r\0\x0B');
    	$txtMessage = str_replace("\n", "", $txtMessage);
    	//mettre tous les caractères en minuscule
    	$txtMessage = strtolower($txtMessage);
    	//compte le nombre de chaine de caractères
    	$length = strlen(utf8_decode($txtMessage));
        $myarray["nb_chars"] = $length;
    	return $this->arrayToJson($myarray);
    } 

    public function getRepeatedWord($txtMessage, $size=0)
    {
        error_reporting(NULL);
        
        $tempo=strtr(
           $txtMessage,
           "ABCDEFGHIJKLMNOPQRSTUVWXYZ",
           "abcdefghijklmnopqrstuvwxyz");

        $tempo=str_replace(" "," ",trim($txtMessage));

        $tempo=str_replace(","," ",$tempo);
        $tempo=str_replace("."," ",$tempo);
        $tempo=str_replace("\n"," ",$tempo);


        $tabesp=explode(" ",$tempo);
        for($i=0;$i<sizeof($tabesp);$i++)
        {
        $str = explode($tabesp[$i], $txtMessage);
        $nbr_occurence = count($str) - 1;

        $repeated["$tabesp[$i]"] = $nbr_occurence; 
        }
        arsort($repeated);

        return $this->arrayToJson($repeated);
    }


  	 
}

