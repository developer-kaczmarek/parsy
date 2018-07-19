<?php
$message=htmlspecialchars($_POST['textarea']);
/*
Для загрузки поста в группу с использованием VK API необходимо указать некоторые параметры:
1) owner_id - идентификатор сообщества, на стене которого должна быть опубликована запись. ВАЖНО: для группы идентификатор начинается со знака -
2) from_group - данный параметр позволяет опубликовывать запись от имени группы, если указать значение 1
3) message - текст сообщения
4) access_token - специальный ключ доступа. Он представляет собой строку из латинских букв и цифр. (Как получить ключ см. здесь -> https://vk.com/dev/access_token)
5) v - версия VK API (актуальную версию см. здесь -> https://vk.com/dev/versions)
Весь список параметров см. здесь -> https://vk.com/dev/wall.post
*/
$id="your_id";
$token="your_token";

header("Location: https://api.vk.com/method/wall.post?owner_id=".$id."&from_group=1&message=".$message."&access_token=".$token."&v=5.70");