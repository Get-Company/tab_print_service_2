<?php
require_once 'vendor/autoload.php';

class Tab_Print_Service
{
    #Service Infos
    public $version = '0.5';
    public $img_path;
    public $img_id;
    public $desc;
    public $id;

    # Sheet
    public $name;
    public $width_of_sheet;
    public $height_of_sheet;
    public $width_of_border;
    public $height_of_border;
    public $amount_of_lines;
    public $height_of_lines;
    public $height_of_title_line;
    public $type;

    # Fields
    public $amount_of_fields;
    public $amount_of_rows;
    public $amount_of_columns;
    public $fields_width_brutto;
    public $fields_height_brutto;
    public $fields_width_netto;
    public $fields_height_netto;
    public $fields_offset_left;
    public $fields_offset_top;


    public function __construct()
    {
        $this->setImgPath('https://www.classei.de/de/?option=com_joomgallery&controller=images&view=image&format=raw&type=orig&id=');
        $this->setId(get_class($this));
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @param string $version
     */
    public function setVersion(string $version)
    {
        $this->version = $version;
    }

    /**
     * @return mixed
     */
    public function getImgPath()
    {
        return $this->img_path;
    }

    /**
     * @param mixed $img_path
     */
    public function setImgPath($img_path)
    {
        $this->img_path = $img_path;
    }

    /**
     * @return mixed
     */
    public function getImgId()
    {
        return $this->img_id;
    }

    /**
     * @param mixed $img_id
     */
    public function setImgId($img_id)
    {
        $this->img_id = $img_id;
    }

    /**
     * @return mixed
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * @param mixed $desc
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getWidthOfSheet()
    {
        return $this->width_of_sheet;
    }

    /**
     * @param mixed $width_of_sheet
     */
    public function setWidthOfSheet($width_of_sheet)
    {
        $this->width_of_sheet = $width_of_sheet;
    }

    /**
     * @return mixed
     */
    public function getHeightOfSheet()
    {
        return $this->height_of_sheet;
    }

    /**
     * @param mixed $height_of_sheet
     */
    public function setHeightOfSheet($height_of_sheet)
    {
        $this->height_of_sheet = $height_of_sheet;
    }

    /**
     * @return mixed
     */
    public function getWidthOfBorder()
    {
        return $this->width_of_border;
    }

    /**
     * @param mixed $width_of_border
     */
    public function setWidthOfBorder($width_of_border)
    {
        $this->width_of_border = $width_of_border;
    }

    /**
     * @return mixed
     */
    public function getHeightOfBorder()
    {
        return $this->height_of_border;
    }

    /**
     * @param mixed $height_of_border
     */
    public function setHeightOfBorder($height_of_border)
    {
        $this->height_of_border = $height_of_border;
    }

    /**
     * @return mixed
     */
    public function getAmountOfLines()
    {
        return $this->amount_of_lines;
    }

    /**
     * @param mixed $amount_of_lines
     */
    public function setAmountOfLines($amount_of_lines)
    {
        $this->amount_of_lines = $amount_of_lines;
    }

    /**
     * @return mixed
     */
    public function getHeightOfLines()
    {
        return $this->height_of_lines;
    }

    /**
     * @param mixed $height_of_lines
     */
    public function setHeightOfLines($height_of_lines)
    {
        $this->height_of_lines = $height_of_lines;
    }

    /**
     * @return mixed
     */
    public function getHeightOfTitleLine()
    {
        return $this->height_of_title_line;
    }

    /**
     * @param mixed $height_of_title_line
     */
    public function setHeightOfTitleLine($height_of_title_line)
    {
        $this->height_of_title_line = $height_of_title_line;
    }

    /**
     *
     * @return string The Type of sheet
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Possible Types
     *
     * There are 2 possible Types: <strong>label</strong> and <strong>tab</strong>
     * @param string $type The Type of sheet
     */
    public function setType($type )
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getAmountOfFields()
    {
        return $this->amount_of_fields;
    }

    /**
     * @param mixed $amount_of_fields
     */
    public function setAmountOfFields($amount_of_fields)
    {
        $this->amount_of_fields = $amount_of_fields;
    }

    /**
     * @return mixed
     */
    public function getAmountOfRows()
    {
        return $this->amount_of_rows;
    }

    /**
     * @param mixed $amount_of_rows
     */
    public function setAmountOfRows($amount_of_rows)
    {
        $this->amount_of_rows = $amount_of_rows;
    }

    /**
     * @return mixed
     */
    public function getAmountOfColumns()
    {
        return $this->amount_of_columns;
    }

    /**
     * @param mixed $amount_of_columns
     */
    public function setAmountOfColumns($amount_of_columns)
    {
        $this->amount_of_columns = $amount_of_columns;
    }

    /**
     * @return mixed
     */
    public function getFieldsWidthBrutto()
    {
        return $this->fields_width_brutto;
    }

    /**
     * @param mixed $fields_width_brutto
     */
    public function setFieldsWidthBrutto($fields_width_brutto)
    {
        $this->fields_width_brutto = $fields_width_brutto;
    }

    /**
     * @return mixed
     */
    public function getFieldsHeightBrutto()
    {
        return $this->fields_height_brutto;
    }

    /**
     * @param mixed $fields_height_brutto
     */
    public function setFieldsHeightBrutto($fields_height_brutto)
    {
        $this->fields_height_brutto = $fields_height_brutto;
    }

    /**
     * @return mixed
     */
    public function getFieldsWidthNetto()
    {
        return $this->fields_width_netto;
    }

    /**
     * @param mixed $fields_width_netto
     */
    public function setFieldsWidthNetto($fields_width_netto)
    {
        $this->fields_width_netto = $fields_width_netto;
    }

    /**
     * @return mixed
     */
    public function getFieldsHeightNetto()
    {
        return $this->fields_height_netto;
    }

    /**
     * @param mixed $fields_height_netto
     */
    public function setFieldsHeightNetto($fields_height_netto)
    {
        $this->fields_height_netto = $fields_height_netto;
    }


    /**
     * @return mixed
     */
    public function getFieldsOffsetLeft()
    {
        return $this->fields_offset_left;
    }

    /**
     * @param mixed $fields_offset_left
     */
    public function setFieldsOffsetLeft($fields_offset_left)
    {
        $this->fields_offset_left = $fields_offset_left;
    }

    /**
     * @return mixed
     */
    public function getFieldsOffsetTop()
    {
        return $this->fields_offset_top;
    }

    /**
     * @param mixed $fields_offset_top
     */
    public function setFieldsOffsetTop($fields_offset_top)
    {
        $this->fields_offset_top = $fields_offset_top;
    }


    /**
     * Get Pos X
     *
     * Get the position of x with the current column $c given. This is handmade and calculated in the classes to be as precise as possible
     * @param $c
     */
    public function getPosX($c)
    {

    }

    /**
     * Get Pos Y
     *
     * Get the position of y with the current row $r given. This is handmade and calculated in the classes to be as precise as possible
     * @param $r
     */
    public function getPosY($r, $l = false)
    {

    }

}