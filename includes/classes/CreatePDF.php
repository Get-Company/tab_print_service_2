<?php

require_once 'vendor/autoload.php';


class CreatePDF
{
    public $sheet;
    public $tcpdf;

    public function __construct($sheet)
    {
        # Get the Sheet
        $this->sheet = $sheet;

        # Get the PDF Class and do settings
        $this->tcpdf = new TCPDF();
        // Load Font
        $this->tcpdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $this->tcpdf->SetMargins(
            $sheet->getWidthOfBorder(),     #Left
            $sheet->getHeightOfBorder(),    #Top
            $sheet->getWidthOfBorder(),     #Right
            $sheet->getHeightOfBorder()     #Bottom
        );
        $this->tcpdf->SetCreator('Tab Druck Service v'.$sheet->getVersion());
        $this->tcpdf->SetAuthor('Florian Buchner www.classei.de');
        $this->tcpdf->SetTitle($sheet->getName());
        // remove default header/footer
        $this->tcpdf->setPrintHeader(false);
        $this->tcpdf->setPrintFooter(false);
        $this->tcpdf->setImageScale(10);
        # Collect all child classes
        foreach (glob('tabs/*.php') as $file)
        {
            require_once $file;

            // get the file name of the current file without the extension
            // which is essentially the class name
            $this->child_classes = basename($file, '.php');

        }
    }

    /**
     * The function is called in the Row&Collumns loop. It creates the fields
     */
    public function build($fields_array)
    {
        $this->tcpdf->AddPage('P',[
            $this->sheet->getWidthOfSheet(),
            $this->sheet->getHeightOfSheet()
            ]);
        # This is set by the html of each textfield
        $this->tcpdf->SetFont('Helvetica','B',8);

        # The type of Sheet, wheter its a tab or a label
        $type = $this->sheet->getType();

        if($type == '' || $type == 'tab')
        {
            $this->tabLoop($fields_array);

        }elseif($type == 'label')
        {
            $this->labelLoop($fields_array);
        }
        $current_time = new Datetime("now");
        $file = '/'.$this->sheet->getID().'_'.$current_time->format('U').'.pdf';
        $this->tcpdf->Output($file,'D');

        $file_check = __DIR__.'/temp'.$file;
        #$this->tcpdf->Output($file_check, F);


        # For Testpurpose
        $this->tcpdf->Output("test.pdf", 'I');
    }


    public function tabLoop($fields_array){
        # Needed if you use the tiny MCE
        $i = 0;

        # Loop Rows $r
        for($r=1;$r<=$this->sheet->amount_of_rows;$r++)
        {
            # The Y is set here while handling the rows
            $y = $this->sheet->getPosY($r);

            # $y + The offset set by the client
            $y = $y + $fields_array['offset_top'];

            # Loop Columns $c
            for($c=1; $c<=$this->sheet->amount_of_columns;$c++)
            {
                $x = $this->sheet->getPosX($c);

                # $x + The offset set by the client
                $x = $x + $fields_array['offset_left'];

                $this->tcpdf->SetXY($x,$y);
                
                # If Tiny MCE
                $this->addText("PosX: ".$x."<br/> PosY: ".$y);
                #$this->addImage($fields_array['blob'][$i], $x, $y);
                $i++;

            }

        }
    }

    public function labelLoop($fields_array){
        # Needed if you use the tiny MCE
        $i = 1;

        # Loop Rows $r
        for($r=1;$r<=$this->sheet->getAmountOfRows(); $r++)
        {

            # Loop Columns $c
            for($c=1; $c<=$this->sheet->getAmountOfColumns(); $c++)
            {
                $x = $this->sheet->getPosX($c);


                # Loop Lines $l
                for($l=1; $l<=$this->sheet->getAmountOfLines(); $l++) {

                    $y = $this->sheet->getPosY($r, $l);

                    $this->tcpdf->SetXY($x, $y);
                    $debug_text = "PosX:".$x."|PosY:".$y." W:".$this->sheet->getFieldsWidthBrutto().'|H:'.$this->sheet->getFieldsHeightBrutto().'|R:'.$r.'|L:'.$l;
                    $this->addText($debug_text, false, $l);

                    # Fit the name attribute of the form textarea array
                    # Example: text_Tab5810_13
                    #$this->addText($fields_array['text_'.$this->sheet->getID().'_'.$r.$c]);


                    # There is a bug in tinymce, number 1 mce_1 is omitted?
                    # Not anymore with tinymce 5?
                    /*
                    if($i == 1)
                    {
                        $i = 2;
                    }
                    */

                    # If Tiny MCE
                    #$this->addText($fields_array['tinymce_'.$i], false, $l);

                    
                    $i++;
                }




            }# EOF $c

        }# EOF $r
    }
    /**
     * @param $text String of text
     * @param $align Possible alignments L, C, R, J
     *
     * return Object Multicell
     */
    public function addText($text, $align = false, $l = false)
    {
        if($align == null || empty($align))
        {
            $align = 'L';
        }
        if($text == null)
        {
            $text = '';
        }

        $width = $this->sheet->getFieldsWidthNetto();
        $height = $this->sheet->getFieldsHeightNetto();

        /**
         * If $l means if there are lines and if there is a Title Line defined
         */

        if($l == 1 && $this->sheet->getHeightOfTitleLine() != null)
        {
            $height = $this->sheet->getHeightOfTitleLine();
        }
        elseif($l >= 2 && $this->sheet->getHeightOfTitleLine() != null)
        {
            $height = $this->sheet->getHeightOfLines();
        }

        $this->tcpdf->MultiCell(
            $width,
            $height,
            $text,
            0,
            't',
            false,
            1,
            '',
            '',
            true,
            0,
            true,
            false,
            '',
            'T'
        );
    }


    public function addImage($file, $x, $y)
    {

        $imgdata = base64_decode($file);

        # The '@' character is used to indicate that follows an image data stream and not an image file name
        # The -1 on FieldsWidth is for all fields that are aligned to the right. When adding border from the left
        # the image is pushed to the left and outside the print area
        $this->tcpdf->Image('@'.$imgdata, $x, $y, $this->sheet->getFieldsWidthBrutto() - 1, false, false, false, false, true, 400);


    }





}