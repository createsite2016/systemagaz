<?php
/**
 * Created by andrej on 10.11.15.
 * Модуль вывода комментариев в формате JSON для класса Showzadach.java
 */



/**
 * Человекопонятная русская дата (и время)
 *
 * @param string $date_input Что-то хоть как-то похожее на дату
 * @param bool $time Показывать время
 * @return string
 */
function date_smart($date_input, $time=true) {
	$monthes = array(
		'', 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня',
		'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'
	);
	$date = strtotime($date_input);

	//Время
	if($time) $time = ' G:i';
	else $time = '';

	//Сегодня, вчера, завтра
	if(date('Y') == date('Y',$date)) {
		if(date('z') == date('z', $date)) {
			$result_date = date('Сегодня'.$time, $date);
		} elseif(date('z') == date('z',mktime(0,0,0,date('n',$date),date('j',$date)+1,date('Y',$date)))) {
			$result_date = date('Вчера'.$time, $date);
		} elseif(date('z') == date('z',mktime(0,0,0,date('n',$date),date('j',$date)-1,date('Y',$date)))) {
			$result_date = date('Завтра'.$time, $date);
		}

		if(isset($result_date)) return $result_date;
	}

	//Месяца
	$month = $monthes[date('n',$date)];

	//Года
	if(date('Y') != date('Y', $date)) $year = 'Y г.';
	else $year = '';

	$result_date = date('j '.$month.' '.$year.$time, $date);
	return $result_date;
}


//for ($i = 0; $i < count($data); $i++)
//  {
//         foreach($data as $i => $val) 
//         { 
//           $data[$i]['datatime'] = date_smart($data[$i]['datatime']);
//  	     }
    
//  }

  ?>