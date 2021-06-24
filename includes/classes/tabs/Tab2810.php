<?php

# Update Autoloader on creating new class with: composer dump-autoload --optimize
require_once 'vendor/autoload.php';

class Tab2810 extends Tab_Print_Service
{


    public function __construct()
    {
        parent::__construct();
        $this->setName('Folien-Tab 2810');
        $this->setImgId(452);
        $this->setDesc('selbstklebend für schmutzgeschützte Beschriftungen. Das Beschriftungsschildchen wird von einer transparenten Schutzfolie umschlossen. Verfügbare Farben 00-09,');
        $this->setId('tab2810');

        $this->setWidthOfSheet(210);
        $this->setHeightOfSheet(316); # 316 Minimale länge um auf 1 Blatt zu bleiben
        $this->setWidthOfBorder(9);
        $this->setHeightOfBorder(25);

        $this->setAmountOfFields(48);
        $this->setAmountOfRows(8);
        $this->setAmountOfColumns(6);
        $this->setFieldsWidthBrutto(29);
        $this->setFieldsWidthNetto(29);
        $this->setFieldsHeightBrutto(10);
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
            $x += 9;
        }
        if($c >= 5)
        {
            $x += 9;
        }

        # Offset left zu x dazu
        $x += $this->getFieldsOffsetLeft();

        # Richtiger X Wert wird zurückgegeben
        return $x;
    }


    public function getPosY($r, $l = false)
    {
        # 1. Zeile hat einen Rand 25
        $y = $this->getHeightOfBorder();

        # Ab 2. Zeile ist der Abstand der Felder 2mm mehr
        if($r >= 2) {
            $y += ( $this->getFieldsHeightNetto() + ($this->getHeightOfBorder()+1) ) * ($r - 1);
        }

        return $y;
    }

}