<?php 
include_once '/var/www/vlad/Employees/autoload.php';

class EditEmployeeView 
{

    static function Render($employee){
        $today = date("20y-m-d");
        $vars['TITLE'] = 'Edit';
        $action = "/App/Controllers/EmployeeController.php";
        if(stripos($_SERVER["REQUEST_URI"], '/App/Controllers') !== false){
            $action = str_replace('/Employees/App/Controllers','',$_SERVER["REQUEST_URI"]);
        }else{
            
        }
        $vars['BODY'] = "<form class='screen' method='post' action='.$action'>
        <div class='table'>
            <div class='table__head'>
                <div class='head__bold'>Edit employee</div>  
            </div>
            <div class='add__zone'>
                <div class='add__line'>
                    <div class='add__field'>First Name</div>
                    <input class='add__input' type='input' name='FirstName' placeholder='First Name' value ='".$employee['First_name']."'>
                </div>
                <div class='add__line'>
                    <div class='add__field'>Second name</div>
                    <input class='add__input' type='input' name='SecondName' placeholder='Second Name' value='".$employee['Second_name']."'>
                </div>
                <div class='add__line'>
                    <div class='add__field'>Birthday</div>
                    <input class='add__input' type='date' name='Birthday' min='22-10-08' max='${today}' value='".$employee['Birthday']."'>
                </div>
                <div class='add__line'>
                    <div class='add__field'>Salary</div>
                    <input class='add__input' type='input' name='Salary' placeholder='Salary' value='".$employee['Salary']."'>
                </div>
            </div>
        </div>
        <div class='button_zone'>
            <input class='button__foot' type='submit' name='btnSaveEdit".$employee['id']."' value='Save'>
            <input class='button__foot' type='submit' name='btnCancel' value='Cancel'>
        </div>
    </form>";

    $output = new Template('/var/www/vlad/Employees/index',$vars);
    $html = $output->RenderTemplate();
    unset($output);
    echo $html;
    }
}
?>