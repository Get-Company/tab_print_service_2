<?php
require_once 'vendor/autoload.php';

/**
 * Paths for twig and Twig loading
 **/
$loader =  new \Twig\Loader\FilesystemLoader([
    'templates/',
    'templates/print',
    'templates/choose',
    'templates/assets/js'
]);
$twig = new \Twig\Environment($loader,['debug' => true]);

$twig->addExtension(new \Twig\Extension\DebugExtension());


/**
 * All the classes needed must be defined here:
 *
 * Update Autoloader on creating new class with: composer update -o --optimize-autoloader
 **/
$tabPrintService = new Tab_Print_Service();
$tab5810 = new Tab5810();
$tab7015 = new Tab7015();
$tab2810 = new Tab2810();
$tab2910 = new Tab2910();
$tab5710 = new Tab5710();
$label4041 = new Label4041();
$label4040 = new Label4040();

/**
 * Select a Sheet - Choose
 *
 * If a sheet is choosen, the form is submitted. Check the $_GET Parameter
 * and clean/filter the string
 */
$tab_form = null;
if(isset($_GET['sheet']))
{
    # URL is better than string - was tested with script tags and console.log in the GET Parameters
    $tab_filtered= filter_var($_GET['sheet'], FILTER_SANITIZE_URL);
    
    # If a tab_form object is not available, jump to index.php
    if(class_exists($tab_filtered)) {
        $tab_form = new $tab_filtered;
    } else {
        // Do stuff for when class does not exist
        header('location: index.php');
    }
}




/**
 * Form handling of a sheet
 *
 * All the fields are loaded in $fields_array.
 *
 */
#TODO add html filter to the $_Post. Content of $fields_array is not validated
$fields_array = null;

if(isset($_POST) && !empty($_POST))
{
        $fields_array = $_POST;

        foreach($fields_array['blob'] as &$blob)
        {
            if(!empty($blob))
            {
                $baseFromJavascript = $blob;
                $baseToPHP = explode(',', $baseFromJavascript);
                $data = $baseToPHP[1];
                $blob = $data;
            }
        }

        $pdf = new CreatePDF($tab_form);
        $pdf->build($fields_array);

        
}


/**
 * Render the template, related to $tab_filtered
 * If a sheet is choosen, make it the $form_type for rendering the appropriate template
 */
$template = 'index.html.twig';
if($tab_form)
{
    $template= "print/form_".$tab_form->type.".html.twig";
}

/**
 *
 */
echo $twig->render($template,[
    'tab_print_service' => $tabPrintService,
    'tab5810' => $tab5810,
    'tab7015' => $tab7015,
    'tab2810' => $tab2810,
    'tab2910' => $tab2910,
    'tab5710' => $tab5710,
    'label4041' => $label4041,
    'label4040' => $label4040,
    'tab_form' => $tab_form,
    'fields_array' => $fields_array
]);

