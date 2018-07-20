![заставанька](https://github.com/developer-kaczmarek/parsy/raw/master/logo_parsy.gif)
Данный репозиторий содержит ресурсы сайта, который позволяет парсить doc-файл с изменениями для студентов ГБПОУ Волгоградского экономико-технического колледжа и постить сразу в сообщество группы с помощью VK API.

___

## Как это работает?

Необходимо сделать 3 шага:
1) Выбрать из списка файл с изменениями и нажать скачать изменения, выбрать папку для скачивания (В списке присутствуют актуальные файлы с изменениями в расписании);
![шаг1](https://github.com/developer-kaczmarek/parsy/raw/master/шаг1.jpg)
2) Выбрать из списка файл для парсинга и нажать кнопку "показать изменения" (Список состоит из файлов, которые находятся в папке "files");
![шаг2](https://github.com/developer-kaczmarek/parsy/raw/master/шаг2.jpg)
3) Отправить изменения на стену сообщества в Вконтакте (Важно отметить присутствие в textarea символов `%0A`, благодаря им осуществляется перенос строки);
![шаг3](https://github.com/developer-kaczmarek/parsy/raw/master/шаг3.jpg)

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

Для загрузки поста в группу с использованием VK API необходимо указать некоторые параметры:

1) owner_id - идентификатор сообщества, на стене которого должна быть опубликована запись. ВАЖНО: для группы идентификатор начинается со знака -

2) from_group - данный параметр позволяет опубликовывать запись от имени группы, если указать значение 1

3) message - текст сообщения

4) access_token - специальный ключ доступа. Он представляет собой строку из латинских букв и цифр. ([Как получить ключ см. здесь][Как получить ключ см. здесь]:https://vk.com/dev/access_token)

5) v - версия VK API ([Актуальную версию см. здесь]:https://vk.com/dev/versions)

[Весь список параметров см. здесь]:https://vk.com/dev/wall.post

