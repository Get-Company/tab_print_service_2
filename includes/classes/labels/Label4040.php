<?php

# Update Autoloader on creating new class with: composer dump-autoload --optimize
require_once 'vendor/autoload.php';

class Label4040 extends Tab_Print_Service
{


    public function __construct()
    {
        parent::__construct();
        $this->setName('Rückenschild 40 40 00');
        $this->setImgId(399);
        $this->setDesc('Selbstklebendes Rückenschild für Orga-Boxen.');
        $this->setId('label4040');

        $this->setWidthOfSheet(210);
        $this->setHeightOfSheet(325);
        $this->setWidthOfBorder(21);
        $this->setHeightOfBorder(0);

        $this->setAmountOfFields(4);
        $this->setAmountOfRows(2);
        $this->setAmountOfColumns(2);
        $this->setFieldsWidthBrutto(85);
        $this->setFieldsWidthNetto(85);
        $this->setFieldsHeightBrutto(149);
        $this->setFieldsHeightNetto(99);
        $this->setType('label');
        $this->setAmountOfLines(6);
        $this->setHeightOfTitleLine(22.5);
        $this->setHeightOfLines(15);


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

        # 1. Label hat einen Rand + Feld Höhe Brutto - Feldhöhe Netto - 27.5 Wegen unterem Rand
        $y = $this->getHeightOfBorder() + ($this->getFieldsHeightBrutto() - $this->getFieldsHeightNetto() - 27.5);

        # Ab 2. Zeile immer ein ganzes Feld Brutto hinzufügen
        if($r >= 2) {
            $y += $this->getFieldsHeightBrutto()  * ($r - 1) + 2;
        }


        # Lines from here
        if($l >= 2)
        {   # Line 2 is about 2mm higher than the others, so +2
            $y += $this->getHeightOfTitleLine() + 2;
        }

        if($l >= 3)
        {
            $y += $this->getHeightOfLines() * ($this->getAmountOfLines() - $l+1);
        }

        return $y;
    }

}