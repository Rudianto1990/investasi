<?php
class Codegen{
    protected $_CI;

    function __construct(){
        $this->_CI=&get_instance();
    }

    function auto($code,$val=null,$numBehind)
    {
        // $this->_CI->load->model('M_code','code'); //load 

        if($val != "" && $val != null)
        {
            $hitung = strlen($code);
            $ambil_angka = substr($val,$hitung,$numBehind);
            $hasil = $ambil_angka+1;

            switch ($numBehind) {
                case '1':
                    return $code.sprintf('%01s',$hasil);
                break;

                case '2':
                    return $code.sprintf('%02s',$hasil);
                break;

                case '3':
                    return $code.sprintf('%03s',$hasil);
                break;

                case '4':
                    return $code.sprintf('%04s',$hasil);
                break;

                case '5':
                    return $code.sprintf('%05s',$hasil);
                break;

                case '6':
                    return $code.sprintf('%06s',$hasil);
                break;

                case '7':
                    return $code.sprintf('%07s',$hasil);
                break;

                case '8':
                    return $code.sprintf('%08s',$hasil);
                break;

                case '9':
                    return $code.sprintf('%09s',$hasil);
                break;
                
                default:
                   return $code.sprintf('%02s',$hasil);
                break;
            }
        }
        else
        {
            switch ($numBehind) {
                case '1':
                    return $code.'1';
                break;

                case '2':
                    return $code.'01';
                break;

                case '3':
                    return $code.'001';
                break;

                case '4':
                    return $code.'0001';
                break;

                case '5':
                    return $code.'00001';
                break;

                case '6':
                    return $code.'000001';
                break;

                case '7':
                    return $code.'0000001';
                break;

                case '8':
                    return $code.'00000001';
                break;

                case '9':
                    return $code.'000000001';
                break;
                
                default:
                    return $code.'01';
                break;
            }
            
        }
        
    }

    



    

    

}