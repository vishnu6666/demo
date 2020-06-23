<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logic extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
    }

    public function swip()
    {
        // swaip value using declare third variable
            $a = 'test';
            $b = '22';    
            $temp = $a;
            $a=$b;
            $b = $temp;
            echo'<br>'. $a;
            echo'<br>'. $b;

        // swaip value without declare third variable
            $x = 10;
            $y = 250;
            $x = $x+$y;
            $y = $x-$y;
            $x = $x-$y;

            echo'<br>'. $x;
            echo'<br>'. $y;

    }

    public function sum()
    {
        // sum number
        $array = ['1','2.3','3.55','5.5','5.5'];
        echo'<br>'. array_sum($array);

        // sum number of unique value
        $array1 = ['1','2.3','3.55','5.5','5.5'];
        echo'<br>'. array_sum(array_unique($array1));

        // sum from assocciative array
        $array2 = array(
                            'one' => 10,
                            'two' => 10,
                            'theree' => 10,
                            'four' => 10,
                        );
        echo'<pre>';
        print_r(array_sum(array_values($array2)));

        // sum from multidimantion assocciative array
        $array3 = array(
                        "0" => array( 
                                        "no" => 7,  
                                        "name" => "Duck"
                                    ),
                        "1" => array( 
                                        "no" => 7,  
                                        "name" => "dynamic", 
                                    ),
                        "2" => array( 
                                        "no" => 8,  
                                        "name" => "gradual",
                                    ) 
                    );

        $val = 0;
        foreach ($array3 as $key => $array_val) {
            $val +=$array_val['no'];
        }

        echo'<pre>';
        print_r($array3);
        echo $val;

    }
}