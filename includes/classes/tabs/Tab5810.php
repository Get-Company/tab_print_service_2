<?php

# Update Autoloader on creating new class with: composer dump-autoload --optimize
require_once 'vendor/autoload.php';

class Tab5810 extends Tab_Print_Service
{


    public function __construct()
    {
        parent::__construct();
        $this->setName('Quick-Tab 5810');
        $this->setImgId(396);
        $this->setDesc('Der gängigste unter unseren Tabs. 5,8cm breit, daher der Name 5810..');
        $this->setId('tab5810');

        $this->setWidthOfSheet(210);
        $this->setHeightOfSheet(320); # 316 Minimale länge um auf 1 Blatt zu bleiben
        $this->setWidthOfBorder(5);
        $this->setHeightOfBorder(5);

        $this->setAmountOfFields(24);
        $this->setAmountOfRows(8);
        $this->setAmountOfColumns(3);
        $this->setFieldsWidthBrutto(58);
        $this->setFieldsWidthNetto(58);
        $this->setFieldsHeightBrutto(35);
        $this->setFieldsHeightNetto(10);
        $this->setType('tab');

        $this->setFieldsOffsetLeft(2);
        $this->setFieldsOffsetTop(1);
    }

    public function getPosX($c)
    {
        /*
        ----------------------------------------------
        | 6|    58    |12|    58    |12|    58    | 6|
        |  |          |  |          |  |          |  |
        |  |          |  |          |  |          |  |
        | 6|    58    |12|    58    |12|    58    | 6|
        |  |          |  |          |  |          |  |
        |  |          |  |          |  |          |  |
        | 6|    58    |12|    58    |12|    58    | 6|
        |  |          |  |          |  |          |  |
        |  |          |  |          |  |          |  |
        ----------------------------------------------
        */
        # Beim 1. Feld brauchen wir sonst keinen Abstand
        $x = $this->getWidthOfBorder();

        if($c == 1)
        {
            $x += 0;
        }
        # Feld 2 braucht nun die Breite des Feldes (58) + 12 / Ab Feld 3 2x Breite des Feldes + 2 * 12
        elseif($c >= 2){

            $x += ($this->getFieldsWidthBrutto() + 12) * ($c-1);
        }

        # Offset left zu x dazu
        $x += $this->getFieldsOffsetLeft();

        # Richtiger X Wert wird zurückgegeben
        return $x;
    }


    public function getPosY($r, $l = false)
    {
        # 1. Zeile hat einen Rand (6) + Feld Höhe Brutto (35) - Feldhöhe Netto (10) + 1 Sicherheits mm (1) = 32
        $y = $this->getHeightOfBorder()+($this->getFieldsHeightBrutto()-$this->getFieldsHeightNetto()); //+1);

        # Ab 2. Zeile immer ein ganzes Feld Brutto hinzufügen
        if($r >= 2) {
            $y += $this->getFieldsHeightBrutto() * ($r - 1);
        }

        # Ab 5. Zeile ist ein Offset von 2xRand notwendig - Mitte des Blattes
        if($r >= 5)
        {
            $y += $this->getHeightOfBorder() * 2;
        }

        # Offset left zu x dazu
        $y += $this->getFieldsOffsetTop();

        # Richtiger y Wert wird zurückgegeben
        return $y;
    }

}