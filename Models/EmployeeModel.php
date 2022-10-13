<?php
    include_once '/var/www/vlad/Employees/autoload.php';

    class EmployeeModel extends Model
    {
        public function __construct(){
            parent::__construct();
        }

        public function Start(){
            session_start();
            $this->List(1,0);
        }

        public function PageSwitching($process, $val){
            session_start();
            if($_POST["Token"] === $_SESSION["token"]){
                switch ($process){
                    case 0:
                        $tmp = parent::$DB->SelectWorkerById($val);
                        EditEmployeeView::Render($tmp[0]);
                        break;
                    case 1:
                        AddEmployeeView::Render();
                        break;
                    case 2:
                        $this->List(1,0);
                        break;
                    case 3:
                        $this->Delete($val);
                        $page = (int)$_POST['Page'];
                        $mode = $this->Order($_POST["OrderBy"]);
                        $this->List($page,$mode);
                        break;
                    case 4:
                        $this->Update($val[0],$val[1],$val[2],$val[3],$val[4]);
                        $page = intdiv((int)$val[0], 10);
                        $page++;
                        $this->List($page,0);
                        break;
                    case 5:
                        $this->Create($val[0],$val[1],$val[2],$val[3]);
                        $this->List(1,0);
                        break;
                    case 6:
                        $page = (int)$_POST['Page'];
                        $page++;
                        $mode = $this->Order($_POST["OrderBy"]);
                        $this->List($page,$mode);
                        break;
                    case 7:
                        $page = (int)$_POST['Page'];
                        if($page>1){
                            $page--;
                        }
                        $mode = $this->Order($_POST["OrderBy"]);
                        $this->List($page,$mode);
                        break;
                }
            }else{
                header("HTTP/1.1 404 Access denied");
            }
            
        }

        protected function List($page, $mode){
            $page = ($page-1)*10;
            $tmp = parent::$DB->EmployeeOrderBy($page,$mode);
            $page= ($page/10) +1;
            ListEmployeeView::Render($tmp,$page);
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

        protected function Order($mode){
            switch ($mode){
                case "IdASC":
                    $tmp = 0;
                    break;
                case "IdDSC":
                    $tmp = 1;
                    break;
                case "FirstNameASC":
                    $tmp = 2;
                    break;
                case "FirstNameDSC":
                    $tmp = 3;
                    break;
                case "SecondNameASC":
                    $tmp = 4;
                    break;
                case "SecondNameASC":
                    $tmp = 5;
                    break;
                case "BirthdayASC":
                    $tmp = 6;
                    break;
                case "BirthdayDSC":
                    $tmp = 7;
                    break;
                case "SalaryASC":
                    $tmp = 8;
                    break;
                case "SalaryDSC":
                    $tmp = 9;
                    break;
            }

            return $tmp;
        }

        static function TokinGenerator(){
            $token = sprintf(
                '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                mt_rand(0, 0xffff),
                mt_rand(0, 0xffff),
                mt_rand(0, 0xffff),
                mt_rand(0, 0x0fff) | 0x4000,
                mt_rand(0, 0x3fff) | 0x8000,
                mt_rand(0, 0xffff),
                mt_rand(0, 0xffff),
                mt_rand(0, 0xffff)
            );
            return $token;
        }
    }
?>