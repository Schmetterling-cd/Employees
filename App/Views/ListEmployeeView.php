<?php 
include_once '/var/www/vlad/Employees/autoload.php';

class ListEmployeeView 
{
    public function __construct()
    {
        $this->Render();
    }

    static function Render(){
        $vars['TITLE'] = 'List';
        $vars['BODY'] = '<div class="screen">
        <div class="table">
            <div class="table__head">
                <div class="head__bold">First name</div>
                <div class="head__bold">Second name</div>
                <div class="head__bold">Birthday</div>
                <div class="head__bold">Salary</div>   
                <div class="free_space"></div> 
                <div class="free_space"></div> 
            </div>
            <div class="item">
                <div class="item__style">Ivanov</div>
                <div class="item__style">Ivan</div>
                <div class="item__style">01.01.1970</div>
                <div class="item__style">500$</div>
                <input class="button__body" type="submit" name="btnEdit" value="Edit">
                <input class="button__body" type="submit" name="btnDelete" value="Delete">
            </div>
            <div class="item">
                <div class="item__style">Ivanov</div>
                <div class="item__style">Ivan</div>
                <div class="item__style">01.01.1970</div>
                <div class="item__style">500$</div>
                <input class="button__body" type="submit" name="btnEdit" value="Edit">
                <input class="button__body" type="submit" name="btnDelete" value="Delete">
            </div>
            <div class="item">
                <div class="item__style">Ivanov</div>
                <div class="item__style">Ivan</div>
                <div class="item__style">01.01.1970</div>
                <div class="item__style">500$</div>
                <input class="button__body" type="submit" name="btnEdit" value="Edit">
                <input class="button__body" type="submit" name="btnDelete" value="Delete">
            </div>
            <div class="item">
                <div class="item__style">Ivanov</div>
                <div class="item__style">Ivan</div>
                <div class="item__style">01.01.1970</div>
                <div class="item__style">500$</div>
                <input class="button__body" type="submit" name="btnEdit" value="Edit">
                <input class="button__body" type="submit" name="btnDelete" value="Delete">
            </div>
        </div>
            <form class="button_zone" method="post" action="EmployeeController.php">
                <input class="button__foot" type="submit" name="btnSave" value="+Add New">
            </form>
    </div>';
      
    $output = new Template('/var/www/vlad/Employees/index',$vars);
    $html = $output->RenderTemplate();
    unset($output);
    echo $html;
    }
}
?>