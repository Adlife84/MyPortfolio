<?php
header("Content-Type: text/html; charset=utf-8");
$name = htmlspecialchars($_POST["name"]);
$email = htmlspecialchars($_POST["email"]);
$tel = htmlspecialchars($_POST["phone"]);

/*
$check = is_array($_POST['check']) ? $_POST['check'] : array();
$check = implode (', ', $check );
$radio = htmlspecialchars($_POST["radio"]);
*/

$refferer = getenv('HTTP_REFERER'); //ссылка на страницу с которой отправлена форма
$date=date("d.m.y"); // число.месяц.год  
$time=date("H:i"); // часы:минуты:секунды 
$myemail = "andreykomolov@gmail.com"; //сюда будут приходить заявки, можно указать несколько адресов через запятую vadimka-08@yandex.ru, 292vadim@rambler.ru


$tema = "Заявка с сайта www.andreykomolov.com"; //тема сооьщения

//формируем тело письма заявки
$message_to_myemail = "Текст письма: 
<br><br>
Имя: $name<br>
E-mail: $email<br>
Телефон: $tel<br>
Источник (ссылка): $refferer<br>

Время: $time<br>
Дата: $date
";

mail($myemail, $tema, $message_to_myemail, "From: andreykomolov.com <andreykomolov@gmail.com> \r\n Reply-To: andreykomolov@gmail.com \r\n"."MIME-Version: 1.0\r\n"."Content-type: text/html; charset=utf-8\r\n" );


// // Блок отправки письма клиенту c вложенным файлом
// $tema = "Тема письма клиенту";
// $message_to_myemail = "
// Текст письма<br>
// Файл: <a href='http://profish24.ru/files/Dounloud.docx' download>Название файла</a>
// ";
// $myemail = $email;
// mail($myemail, $tema, $message_to_myemail, "From: ProFish24.ru <profish24@yandex.ru> \r\n Reply-To: ProFish24.ru \r\n"."MIME-Version: 1.0\r\n"."Content-type: text/html; charset=utf-8\r\n" );


// Блок записи всех заявок в файл на хостинге
$f = fopen("leads.xls", "a+");
fwrite($f," <tr>");    
fwrite($f," <td>$email</td> <td>$name</td> <td>$tel</td>   <td>$date / $time</td>");   
fwrite($f," <td>$refferer</td>");    
fwrite($f," </tr>");  
fwrite($f,"\n ");    
fclose($f);

//Вернет нас обратно на ту же страницу
header("Location: {$_SERVER['HTTP_REFERER']}");
exit;
?>