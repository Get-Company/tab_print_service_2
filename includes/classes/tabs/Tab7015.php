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
        $this->setWidthOfBorder(15);
        $this->setHeightOfBorder(12);

        $this->setAmountOfFields(12);
        $this->setAmountOfRows(6);
        $this->setAmountOfColumns(2);
        $this->setFieldsWidthBrutto(70);
        $this->setFieldsWidthNetto(70);
        $this->setFieldsHeightBrutto(43);
        $this->setFieldsHeightNetto(15);
        $this->setType('tab');

        $this->setFieldsOffsetLeft(2);
        $this->setFieldsOffsetTop(1);
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
        # Feld 2 nun die Breite des Feldes + Abstand zum nächsten Feld
        # TODO Evtl. Getter und Setter für Abstand Mitte vertikal 1 - 2 Feld
        else{

            $x += $this->getFieldsWidthBrutto() + 35;
        }

        # Offset left zu x dazu
        $x += $this->getFieldsOffsetLeft();

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

        # Ab 4. Zeile ist ein Offset von 19 nötig (Classei Logo in der Mitte
        #TODO Evtl. Getter und Setter für Abstand Mitte horizontal 3 - 4 Feld
        if($r >= 4)
        {
            $y += 19;
        }

        # Offset left zu x dazu
        $y += $this->getFieldsOffsetTop();

        # Richtiger y Wert wird zurückgegeben
        return $y;
    }

}