-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Мар 07 2021 г., 22:17
-- Версия сервера: 8.0.23
-- Версия PHP: 7.3.27-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `forum`
--

-- --------------------------------------------------------

--
-- Структура таблицы `files`
--

CREATE TABLE `files` (
  `id` int NOT NULL,
  `id_message` int NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_0900_as_cs NOT NULL,
  `url` varchar(256) COLLATE utf8mb4_0900_as_cs NOT NULL
) ;

--
-- Дамп данных таблицы `files`
--

INSERT INTO `files` (`id`, `id_message`, `name`, `url`) VALUES
(1, 1, 'rules', '/files/admin/rule.png'),
(2, 4, 'file', '/files/Sanctum/file.txt'),
(3, 6, 'file1', '/files/RedSup/file1.png'),
(4, 6, 'file2', '/files/RedSup/gifka.gif');

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int NOT NULL,
  `id_theme` int NOT NULL,
  `id_creator` int DEFAULT NULL,
  `date` datetime NOT NULL,
  `text` text COLLATE utf8mb4_0900_as_cs NOT NULL
) ;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `id_theme`, `id_creator`, `date`, `text`) VALUES
(1, 1, 1, '2021-01-26 20:53:59', 'Правило первое: текст-текст-текст...'),
(2, 1, 1, '2021-01-26 20:53:59', 'Правило второе: текст-текст-текст...'),
(3, 2, 1, '2021-01-26 20:53:59', 'Первая тема на форуме и первое сообщение'),
(4, 2, 3, '2021-01-26 20:53:59', 'Ещё одно сообщение в ней'),
(5, 3, 3, '2021-01-26 20:53:59', 'Вторая тема и первое сообщение в ней'),
(6, 3, 5, '2021-01-26 20:53:59', 'Первая пользовательская тема и её сообщение');

-- --------------------------------------------------------

--
-- Структура таблицы `premission`
--

CREATE TABLE `premission` (
  `id` int NOT NULL,
  `id_theme` int NOT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_as_cs;

--
-- Дамп данных таблицы `premission`
--

INSERT INTO `premission` (`id`, `id_theme`, `id_user`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 2, 2),
(4, 2, 3),
(5, 3, 1),
(6, 3, 2),
(7, 3, 3),
(8, 4, 1),
(9, 4, 2),
(10, 4, 3),
(11, 4, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `name` varchar(32) COLLATE utf8mb4_0900_as_cs DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_as_cs;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'moderator'),
(3, 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `themes`
--

CREATE TABLE `themes` (
  `id` int NOT NULL,
  `id_creator` int DEFAULT NULL,
  `title` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL,
  `description` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL,
  `date` datetime NOT NULL,
  `active` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_as_cs;

--
-- Дамп данных таблицы `themes`
--

INSERT INTO `themes` (`id`, `id_creator`, `title`, `description`, `date`, `active`) VALUES
(1, 1, 'Правила форума', 'За несоблюдение правил последует неизбежное наказание', '2020-12-15 14:21:01', b'1'),
(2, 1, 'Тема 1', 'Описание темы 1', '2020-12-15 14:21:01', b'1'),
(3, 3, 'Тема 2', 'Описание темы 2', '2020-12-15 14:21:01', b'0'),
(4, 5, 'Тема 3', 'Описание темы 3', '2020-12-15 14:21:01', b'1'),
(5, 10, 'Test, testing & testers', 'Что такое тестирование и с чем его едят', '2020-12-15 14:21:01', b'0'),
(6, 8, 'Странные вещи в интернете', 'Всё необычное и непонятное', '2021-01-13 07:32:01', b'1'),
(7, 5, 'Что происходит за гранью?', 'Существует ли душа, и можем ли мы переродиться с сохранением памяти', '2021-01-29 09:11:14', b'1'),
(8, 1, 'Администрация предупреждает', 'Обновление правил форума', '2021-02-08 17:31:13', b'1'),
(9, 9, 'Закрытая тема', 'Только для избранных .^.', '2021-02-10 07:33:21', b'1'),
(10, 11, 'Тестирование форума', 'Тестовое описание с очень длинным текстом, в котором есть много буков однако  всё ли оно попадёт в описание на главной странице форума? Нужно проверять тестировать и проверять, а потом исправлять, исправлять и исправлять... Фуууф, устал...', '2021-02-17 08:51:13', b'1'),
(11, 3, 'Что происходит на просторах интернета', 'Мемы, котики и разнообразные интересные штуки', '2021-02-20 09:06:29', b'1'),
(12, 7, 'О чем говорят попугаи?', 'Таки Кеша хороший, очень хороший.', '2021-02-23 03:30:14', b'0'),
(13, 10, 'Как узнать свой номер телефона?', '5 способов, которые помогут вам быстро узнать номер телефона', '2021-02-26 12:15:07', b'1'),
(14, 4, 'Браузер Вивальди. Плюсы и минусы.', 'Что это, кто его создал, зачем и почему он стал известен.', '2021-02-28 17:16:29', b'0'),
(15, 9, 'Ваши любимые игры', 'Давайте делиться кто во что играет, и почему', '2021-03-01 10:44:12', b'1'),
(16, 6, 'Да что вы говорите? Или как понять людей.', 'Психология для начинающих', '2021-03-02 20:24:11', b'0'),
(17, 5, 'Неизвестность пугает? не переживай, всё будет супер.', 'Мотивирующие посты', '2021-03-02 04:33:52', b'1'),
(18, 2, 'Модерация бдит. Список забаненных за нарушения.', 'Самые распространенные нарушения, и почему это происходит', '2021-03-03 11:38:17', b'1'),
(19, 7, 'Лучшие из нас... и что с ними стало', 'Олды вспомнят', '2021-03-03 16:21:37', b'1'),
(20, 5, 'Ахтунг, мореплаванье и наши книги', 'Моя рецензия на серию книг \"Господство клана неспящих\"(Мир Вальдиры)', '2021-03-04 02:28:10', b'1'),
(21, 7, 'Некромантия для начинающих или как поднять умертвие', 'Рецензия на серию книг \"Профессиональный некромант\"', '2021-03-05 10:21:48', b'1');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(32) COLLATE utf8mb4_0900_as_cs NOT NULL,
  `password` char(64) COLLATE utf8mb4_0900_as_cs NOT NULL,
  `email` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL,
  `id_role` int NOT NULL DEFAULT '3',
  `fio` varchar(64) COLLATE utf8mb4_0900_as_cs DEFAULT NULL,
  `age` int DEFAULT NULL,
  `ban` bit(1) NOT NULL DEFAULT b'0'
) ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`, `id_role`, `fio`, `age`, `ban`) VALUES
(1, 'admin', '9473d4fad24f8486aba629d8fed91c30798caaeaec91e2bd8b14c8c7a738c34b', 'admin@forum.net', 1, 'Курагендариус Николас Исиус', 23, b'0'),
(2, 'SuperDuperUser', '243bc6dc523ddc025674babab696b8740f32de744b5f401d691637b6b5a99c52', 'strangeuser@mail.ru', 2, NULL, 17, b'0'),
(3, 'Sanctum', '32eaab0b4d5dd6c425c91a4f6be255c5c4616e406476057d8bd5ef1d88f22eb5', 'scififromfuture@gmail.com', 2, 'Киров Егор Александрович', NULL, b'0'),
(4, 'Augustin', '43834af4dae943a5c58607983787720def1b103c6e2fbeed2ce03d57e08864eb', 'saint@vivaldi.com', 3, NULL, 22, b'1'),
(5, 'RedSup', '24c6d25c6635eec5526aaee9bcd87b23bd513c9495080037e5b0f9fb35101338', 'fakemail@secmail.com', 3, 'secret secret secret', 45, b'1'),
(6, 'physicist', '0e497a749df1b0c24b73d6d7cef25035324f54cfe49e24a016faa2207568bea3', 'sarumyanoe@mail.ru', 3, NULL, 32, b'0'),
(7, 'Recruiter', 'a18abf77a3b5be127b69500f08fa95167d294220596e6d445f3efb19d073ae4d', 'wowisbest@gmail.com', 3, NULL, 23, b'1'),
(8, 'OriginalNickname', '0b0784421281ecfe866502b34af4758174330fed93802db72c46d208f53bf0fd', 'originalemail@mail.com', 3, NULL, NULL, b'0'),
(9, 'YourNightMare', '4c53d03223bfe6aa3cf620f743ee0f22fc7ab49afb5fbd0b701b914ab8dadc9a', 'cryingdevil@vivaldi.com', 3, NULL, 88, b'1'),
(10, 'test', '7b3d979ca8330a94fa7e9e1b466d8b99e0bcdea1ec90596c0dcc8d7ef6b4300c', 'test@test.com', 3, NULL, NULL, b'0'),
(11, 'test1', '7b3d979ca8330a94fa7e9e1b466d8b99e0bcdea1ec90596c0dcc8d7ef6b4300c', 'test1@test.com', 3, NULL, NULL, b'0'),
(12, 'falcon', 'c2acd4e1eaa34e890a34d79d89fcb5d9dcc37d126a55ef3a7ad009cf22f43ad2', 'suraevoleg@gmail.com', 1, 'Сураев Олег Николаевич', 18, b'0'),
(13, 'MyLogin', 'dc1e7c03e162397b355b6f1c895dfdf3790d98c10b920c55e91272b8eecada2a', 'ASDA@asda.sa', 3, NULL, NULL, b'0');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_message` (`id_message`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_theme` (`id_theme`),
  ADD KEY `id_creator` (`id_creator`);

--
-- Индексы таблицы `premission`
--
ALTER TABLE `premission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_theme` (`id_theme`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`),
  ADD KEY `id_creator` (`id_creator`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `files`
--
ALTER TABLE `files`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `premission`
--
ALTER TABLE `premission`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`id_message`) REFERENCES `messages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`id_theme`) REFERENCES `themes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`id_creator`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `premission`
--
ALTER TABLE `premission`
  ADD CONSTRAINT `premission_ibfk_1` FOREIGN KEY (`id_theme`) REFERENCES `themes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `premission_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `themes`
--
ALTER TABLE `themes`
  ADD CONSTRAINT `themes_ibfk_1` FOREIGN KEY (`id_creator`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
