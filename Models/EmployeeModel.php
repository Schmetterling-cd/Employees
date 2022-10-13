<?php
    include_once '/var/www/vlad/Employees/autoload.php';

    class EmployeeModel extends Model
    {
        public function __construct(){
            parent::__construct();
        }

        public function Start(){
            $this->List(0,10);
        }

        public function PageSwitching($process, $val){
            switch ($process){
                case 0:
                    $tmp = parent::$DB->SelectWorkerById($val);
                    EditEmployeeView::Render($tmp[0]);
                    break;
                case 1:
                    AddEmployeeView::Render();
                    break;
                case 2:
                    $this->List(0,10);
                    exit();
                    break;
                case 3:
                    $this->Delete($val);
                    $page = (int)$_POST['Page'];
                    $from = ($page - 1) * 10;
                    $to = $from + 10;
                    $this->List($from,$to);
                    exit();
                    break;
                case 4:
                    $this->Update($val[0],$val[1],$val[2],$val[3],$val[4]);
                    $from = (intdiv((int)$val[0], 10)) *10;
                    $to = (int)$from + 10;
                    $this->List($from,$to);
                    break;
                case 5:
                    $this->Create($val[0],$val[1],$val[2],$val[3]);
                    $this->List(0,10);
                    break;
                case 6:
                    $page = (int)$_POST['Page'];
                    $page++;
                    $from = ($page - 1) * 10;
                    $to = $from + 10;
                    $this->List($from,$to);
                    break;
                case 7:
                    $page = (int)$_POST['Page'];
                    if($page>1){
                        $page--;
                    }
                    $from = ($page - 1) * 10;
                    $to = $from + 10;
                    $this->List($from,$to);
                    break;
            }
        }

        protected function List($from, $to){
            $tmp = parent::$DB->SelectGroupById($from,$to);
            ListEmployeeView::Render($tmp);
            unset($tmp);
        }

        protected function Update($id,$FirstName,$SecondName,$Birthday,$Salary){
            parent::$DB->UpdateEmployeeInfo($FirstName,$SecondName,$Birthday,$Salary,$id);
        }

        protected function Delete($id){
            parent::$DB->DeleteEmployeeById($id);
        }

        protected function Create($FirstName,$SecondName,$Birthday,$Salary){
            parent::$DB->AddNewEmployee($FirstName,$SecondName,$Birthday,$Salary);
        }

    }
?>