<?php
/**
 * /client.php
 */
header("Content-Type: text/html; charset=utf-8");
header('Cache-Control: no-store, no-cache');
header('Expires: '.date('r'));


/**
 * Пути по-умолчанию для поиска файлов
 */
set_include_path(get_include_path()
    .PATH_SEPARATOR.'classes'
    .PATH_SEPARATOR.'objects');

/**
 ** Функция для автозагрузки необходимых классов
 */
function __autoload($class_name){
    include $class_name.'.class.php';
}

ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);

// Заготовки объектов
class Message{
    public $phone;
    public $text;
    public $date;
    public $type;
}

class MessageList{
    public $message;
}

class Request{
    public $messageList;
}

// создаем объект для отправки на сервер
$req = new Request();
$req->messageList = new MessageList();
$req->messageList->message = new Message();
$req->messageList->message->phone = '79871234567';
$req->messageList->message->text = 'Тестовое сообщение 1';
$req->messageList->message->date = '2013-07-21T15:00:00.26';
$req->messageList->message->type = 15;

$client = new SoapClient(   "https://soap-kasatkin.c9users.io//smsservice.wsdl.php",
                            array( 'soap_version' => SOAP_1_2));
var_dump($client->sendSms($req));