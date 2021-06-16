<?php

# Update Autoloader on creating new class with: composer dump-autoload --optimize
require_once 'vendor/autoload.php';

class Tab2910 extends Tab_Print_Service
{


    public function __construct()
    {
        parent::__construct();
        $this->setName('Quick-Tab 2910');
        $this->setImgId(398);
        $this->setDesc('Der gängigste unter unseren tabs. 2,9cm breit, daher der Name 2910..');
        $this->setId('tab2910');

        $this->setWidthOfSheet(210);
        $this->setHeightOfSheet(316); # 316 Minimale länge um auf 1 Blatt zu bleiben
        $this->setWidthOfBorder(6);
        $this->setHeightOfBorder(5);

        $this->setAmountOfFields(48);
        $this->setAmountOfRows(8);
        $this->setAmountOfColumns(6);
        $this->setFieldsWidthBrutto(29);
        $this->setFieldsWidthNetto(29);
        $this->setFieldsHeightBrutto(35);
        $this->setFieldsHeightNetto(10);
        $this->setType('tab');
    }

    public function getPosX($c)
    {
        # Der Rand von links
        $x = $this->getWidthOfBorder();

        # Beim 1. Feld brauchen wir sonst keinen Abstand
        if($c == 1)
        {
            $x += 0;
        }
        if($c >= 2)
        {
            $x += $this->getFieldsWidthBrutto() * ($c-1);
        }
        if($c >= 3)
        {
            $x += $this->getWidthOfBorder() * 2;
        }
        if($c >= 5)
        {
            $x += $this->getWidthOfBorder() * 2;
        }

        # Richtiger X Wert wird zurückgegeben
        return $x;
    }


    public function getPosY($r, $l = false)
    {
        # 1. Zeile hat einen Rand + Feld Höhe Brutto - Feldhöhe Netto
        $y = $this->getHeightOfBorder()+($this->getFieldsHeightBrutto()-$this->getFieldsHeightNetto());

        # Ab 2. Zeile immer ein ganzes Feld Brutto hinzufügen
        if($r >= 2) {
            $y += $this->getFieldsHeightBrutto() * ($r - 1);
        }

        # Ab 5. Zeile ist ein Offset von 2xRand notwendig - Mitte des Blattes
        if($r >= 5)
        {
            $y += $this->getHeightOfBorder() * 2;
        }

        return $y;
    }

}