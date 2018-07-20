

Данный репозиторий содержит ресурсы сайта, который позволяет парсить doc-файл с изменениями для студентов ГБПОУ Волгоградского экономико-технического колледжа и постить сразу в сообщество группы с помощью VK API.

___

## Как это работает?

Необходимо сделать 3 шага:
1) Скачать изменения с сайта;
2) Спарсить файл;
3) Отправить изменения на стену сообщества в Вконтакте.

## Обратить внимание

Если необходимо изменить расположение папки с doc-файлом, хранящим изменения в расписании на странице `index.php` ищем следующую строку и вместо `files`указываем свой путь к файлу:

```php
//php code 
$filelist = scandir("files");
```

Для того чтобы получить изменения для своей группы необходимо осуществить поиск следующей строки на странице `index.php` и вставить наименование своей группы вместо `401Пк`:

```php
//php code 
$pos = strpos($content, '401Пк');
```


