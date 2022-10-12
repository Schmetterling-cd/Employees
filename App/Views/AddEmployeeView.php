<?php 
include_once '/var/www/vlad/Employees/autoload.php';

class AddEmployeeView 
{

    static function Render(){
        $today = date("20y-m-d");
        $vars['TITLE'] = 'Add';
        $vars['BODY'] = "<form class='screen' method='post' action='./EmployeeController.php'>
        <div class='table'>
            <div class='table__head'>
                <div class='head__bold'>Add employee</div>  
            </div>
            <div class='add__zone'>
                <div class='add__line'>
                    <div class='add__field'>First Name</div>
                    <input class='add__input' type='input' name='FirstName' placeholder='First Name' value=''>
                </div>
                <div class='add__line'>
                    <div class='add__field'>Second name</div>
                    <input class='add__input' type='input' name='SecondName' placeholder='Second Name' value=''>
                </div>
                <div class='add__line'>
                    <div class='add__field'>Birthday</div>
                    <input class='add__input' type='date' name='Birthday' min='22-10-08' max='${today}' value=''>
                </div>
                <div class='add__line'>
                    <div class='add__field'>Salary</div>
                    <input class='add__input' type='input' name='Salary' placeholder='Salary' value=''>
                </div>
            </div>
        </div>
        <div class='button_zone'>
            <input class='button__foot' type='submit' name='btnSaveAdd' value='Save'>
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