<?php
    if(!function_exists('__trans')){
        function __trans($str, $lang){
            $trans_array = [];
            foreach(Config::get('trans')['trans'] as $trans){
                if($trans['english'] === $str || $trans['urdu'] === $str){
                    $trans_array = $trans;
                }
            }
            if(!empty($trans_array)){
                if($lang == "ur"){
                    return $trans_array['urdu'];
                }else{
                    return $trans_array['english'];
                }
            }
            return $str;
        }
    }

    if(!function_exists('transDate')){
        function transDate($date, $lang){
            if($lang == "ur"){
                $trans_dates = Config::get('trans')['date'];
                $ur_date = "";
                $split = explode(" ", $date);
                foreach($split as $chunk){
                    if(array_key_exists($chunk, $trans_dates)){
                        $ur_date = $ur_date . " " . $trans_dates[strtolower($chunk)];
                    }else{
                        $ur_date = $ur_date . " " . $chunk;
                    }
                }
                return $ur_date;
            }
            return $date;
        }
    }

    if(!function_exists('human_date')){
        function human_date($date){
            return Carbon\Carbon::parse($date)->diffForHumans();
        }
    }

    if(!function_exists('format_date')){
        function format_story_date($dateString){
                $date = new DateTime($dateString);
                $new_date = $date->format('l') . "&nbsp;" . $date->format('d') . "&nbsp;" .
                            $date->format('F') ."&nbsp;" . $date->format('Y');

                return $new_date;
        }
    }
    if(!function_exists('titlify')){
        function titlify($slug){
          return ucwords(preg_replace('/[\_\-\ ]+/', ' ', $slug));
        }
    }
    if(!function_exists('format_date_urdu')){
        function format_date_urdu($dateString) {
            $week = array(
                'Monday' => 'پیر',
                'Tuesday' => 'منگل',
                'Wednesday' => 'بدھ',
                'Thursday' => 'جمعرات',
                'Friday' => 'جمعه',
                'Saturday' => 'ہفتہ',
                'Sunday' => 'اتوار'
            );

            $months = array(
                'January' => 'جنوری',
                'February' => 'فروری',
                'March' => 'مارچ',
                'April' => 'اپریل',
                'May' => 'مئی',
                'June' => 'جون',
                'July' => 'جولائی',
                'August' => ' اگست',
                'September' => ' ستمبر',
                'October' => 'اکتوبر',
                'November' => 'نومبر',
                'December' => 'دسمبر'
            );

            $date = new DateTime($dateString);
            $new_date = $week[$date->format('l')] . "&nbsp;" . $date->format('d') . "&nbsp;" .
                $months[$date->format('F')] ."&nbsp;" . $date->format('Y') . "ء" ;

            return $new_date;
        }
    }
?>
