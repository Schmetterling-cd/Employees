<?php 
include_once '/var/www/vlad/Employees/autoload.php';

class ListEmployeeView 
{
    public static function Render($employees,$page){
        $token = EmployeeController::TokinGenerator();
        $_SESSION["token"]= $token;
        $vars['TITLE'] = 'List';
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
        $vars['BODY'] = "<form class='screen' method='post' action='./index.php'>
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
                <input class='page__number' type='input' name='Page' value='$page' />
                <input class='page_change' type='submit' name='btnUp' value='⇧'>
                <select type='submit' name='OrderBy'>
                    <option name='OrderBy' selected value='".$_POST['OrderBy']."'>Previos</option>
                    <option name='OrderBy' value='IdASC'>Id ASC</option>
                    <option name='OrderBy' value='IdDSC'>Id DSC</option>
                    <option name='OrderBy' value='FirstNameASC'>First Name ASC</option>
                    <option name='OrderBy' value='FirstNameDSC'>First Name DSC</option>
                    <option name='OrderBy' value='SecondNameASC'>Second Name ASC</option>
                    <option name='OrderBy' value='SecondNameDSC'>Second Name DSC</option>
                    <option name='OrderBy' value='BirthdayASC'>Birthday ASC</option>
                    <option name='OrderBy' value='BirthdayDSC'>Birthday DSC</option>
                    <option name='OrderBy' value='SalaryASC'>Salary ASC</option>
                    <option name='OrderBy' value='SalaryDSC'>Salary DSC</option>
                </select>
            </div>
            <input type='hidden' name='Token' value='$token'>
    </form>";
      
    $output = new Template('/var/www/vlad/Employees/index',$vars);
    $html = $output->RenderTemplate();
    unset($output);
    echo $html;
    }
}
?>