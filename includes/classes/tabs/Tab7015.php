<?php

# Update Autoloader on creating new class with: composer dump-autoload --optimize
require_once 'vendor/autoload.php';

class Tab7015 extends Tab_Print_Service
{
    public $name;

    public function __construct()
    {
        parent::__construct();
        $this->name = 'Big-Tab 7015';
        $this->img_id = 397;
        $this->setDesc('Der Big-Tab signalisiert, da er ein wenig höher als die anderen tabs ist. Auf diesem Tab haben Sie viel Platz. 7015..');
        $this->setId('tab7015');

        $this->setWidthOfSheet(210);
        $this->setHeightOfSheet(316); # 316 Minimale länge um auf 1 Blatt zu bleiben
        $this->setWidthOfBorder(18);
        $this->setHeightOfBorder(11);

        $this->setAmountOfFields(12);
        $this->setAmountOfRows(6);
        $this->setAmountOfColumns(2);
        $this->setFieldsWidthBrutto(70);
        $this->setFieldsWidthNetto(70);
        $this->setFieldsHeightBrutto(43);
        $this->setFieldsHeightNetto(15);
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
        # Feld 2 und 3 brauchen nun die Breite des Feldes + 2x den Rand * die Spalte
        else{

            $x += ($this->getFieldsWidthBrutto()+($this->getWidthOfBorder()*2)) * ($c-1);
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
        if($r >= 4)
        {
            $y += $this->getHeightOfBorder() * 2;
        }

        return $y;
    }

}