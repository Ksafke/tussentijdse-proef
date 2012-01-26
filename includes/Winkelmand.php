<?php

/*
 * Deze class zorgt ervoor dat we ons mandje kunnen opvullen, 
 * indien een element reeds bestaat in de mand, dan vermeerderen we het aantal
 * 
 * @property array $mand
 * 
 * @method toevoegenAanMand
 * @method verwijderenUitMand
 * @method mandWeergeven
 * 
 */

/**
 * Description of winkelmand
 *
 * @author xavierdekeyster
 */
class Winkelmand {

    public $mand = array();
    
    /**
     * Vult het mandje op
     * @param array $items
     * @return void
     *  
     */
    public function toevoegenAanMand($items) {
        // We lussen over het bestaande mandje om te zien of er reeds een element met hetzelfde id bestaat in onze mand
        foreach ($this->mand as $key => $value) {
            if ($this->mand[$key]['id'] == $items['id']) {
                $this->mand[$key]['aantal'] += $items['aantal'];
                return;// stop met code uit te voeren, we verwachten maar één element en die hebben we gehad!
            }
        }
       // nog geen element in ons mandje, we voegen het dus toe. 
       $this->mand[] = $items;
        
    }
    
    /**
     * verwijdert een element of vermindert het aantal
     * @param array $items
     * @return void 
     */
    public function verwijderenUitMand($items) {
        
        foreach ($this->mand as $key => $value) {
            if ($this->mand[$key]['id'] == $items['id']) {
                $this->mand[$key]['aantal'] -= $items['aantal'];
                return; 
            }else{
               unset($this->mand[$key]); 
            }
        }
        
    }
    
    /**
     * Mandje weergeven als object
     * @return array $this->mand 
     */
    public function mandWeergeven() {
        $value = $this->mand;
        return $this->mand;
    }
    
    /**
     * mand leegmaken
     */
    public function mandLeegmaken() {
        $this->mand = array();
        return $this->mand;
        
    }

}

?>
