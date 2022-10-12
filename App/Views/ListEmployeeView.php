<?php 
include_once '/var/www/vlad/Employees/autoload.php';

class ListEmployeeView 
{
    public static function Render($employees){
        $vars['TITLE'] = 'List';
        $action = "/App/Controllers/EmployeeController.php";
        if(stripos($_SERVER["REQUEST_URI"], '/App/Controllers') !== false){
            $action = str_replace('/App/Controllers','',$_SERVER["REQUEST_URI"]);
        }
        $tmp = "";
        foreach($employees as $element){
            $tmp = $tmp. "
            <div class='item'>
                <div class='item__style'>".$element['First_name']."</div>
                <div class='item__style'>".$element['Second_name']."</div>
                <div class='item__style'>".$element['Birthday']."</div>
                <div class='item__style'>".$element['Salary']."$</div>
                <input class='button__body' type='submit' name='btnEdit".$element['id']."' value='Edit'>
                <input class='button__body' type='submit' name='btnDelete".$element['id']."' value='Delete'>
            </div>";
        }
        $vars['BODY'] = "<form class='screen' method='post' action='.".$action."'>
        <div class='table'>
            <div class='table__head'>
                <div class='head__bold'>First name</div>
                <div class='head__bold'>Second name</div>
                <div class='head__bold'>Birthday</div>
                <div class='head__bold'>Salary</div>   
                <div class='free_space'></div> 
                <div class='free_space'></div> 
            </div>
            ${tmp}
        </div>
            <div class='button_zone'>
                <input class='button__foot' type='submit' name='btnAdd' value='Add New'>
                <input class='page_change' type='submit' name='btnDown' value='⇩'>
                <input class='page__number' type='text' readonly='readonly' value='0'/>
                <input class='page_change' type='submit' name='btnUp' value='⇧'>
            </div>
    </form>";
      
    $output = new Template('/var/www/vlad/Employees/index',$vars);
    $html = $output->RenderTemplate();
    unset($output);
    echo $html;
    }
}
?>