<?php

# Update Autoloader on creating new class with: composer dump-autoload --optimize
require_once 'vendor/autoload.php';

class Label4041 extends Tab_Print_Service
{


    public function __construct()
    {
        parent::__construct();
        $this->setName('Rückenschild 40 41 00');
        $this->setImgId(399);
        $this->setDesc('Selbstklebendes Rückenschild für Orga-Boxen.');
        $this->setId('label4041');

        $this->setWidthOfSheet(210);
        $this->setHeightOfSheet(320);
        $this->setWidthOfBorder(23);
        $this->setHeightOfBorder(7);

        $this->setAmountOfFields(6);
        $this->setAmountOfRows(3);
        $this->setAmountOfColumns(2);
        $this->setFieldsWidthBrutto(82);
        $this->setFieldsWidthNetto(82);
        $this->setFieldsHeightBrutto(94);
        $this->setFieldsHeightNetto(70);
        $this->setType('label');
        $this->setAmountOfLines(5);
        $this->setHeightOfTitleLine(18);
        $this->setHeightOfLines(13);


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

        # 1. Label hat einen Rand + Feld Höhe Brutto - Feldhöhe Netto - 5 Wegen unterem Rand
        $y = $this->getHeightOfBorder()+($this->getFieldsHeightBrutto()-$this->getFieldsHeightNetto() - 5);

        # Ab 2. Zeile immer ein ganzes Feld Brutto hinzufügen
        if($r >= 2) {
            $y += $this->getFieldsHeightBrutto()  * ($r - 1);
        }


        # Ab hier die Zeilen
        if($l >= 2)
        {
            $y += $this->getHeightOfTitleLine();
        }

        if($l >= 3)
        {
            # Example       13              *       (5 - 3 + 1)8current line
            $y += $this->getHeightOfLines() * ($this->getAmountOfLines() - $l+1);
        }

        #
        return $y;
    }

}