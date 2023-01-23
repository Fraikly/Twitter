# Сайт Twitter <img src="https://i.postimg.cc/63VyNqsf/icon.png" style="width:25px">

> **Название проекта:** приближенная функциональная копия сайта twitter

> **Разработчик:** Фролова Арина 

## **Содержание readme**
- [До запуска](#До-запуска)

- [Автоматическое заполнение бд](#Автоматическое-заполнение-бд)

- - [Фотографии](#Фотографии)

- - [Factory](#Factory)

- [Навигация по сайту](#Навигация-по-сайту)

- - [Основные страницы](#Основные-страницы)

- - [Ваши возможности](#Ваши-возможности)

- [Api](#Api)

## **Руководство пользователя**

### **До запуска**
После клонировани проекта на ваш компьютер для запуска сайта необходимо обновить composer. Введите в вашей консоли команду `composer update` и дождитесь полного завершения

Далее вам необходимо создать в корневой папке проекта файл `.env`, пример которого есть в `.env.example`

Для создания всех необходимых таблиц в бд пропишите в консоле `php artisan migrate`

Для возможности загрузки и использования изображения пропишите в консоле `php artisan storage:link`

**Сайт готов к запуску, пропишите в консоле `php artisan serve`**

### **Автоматическое заполнение бд**
Если вы хотите, чтобы на вашем сайте уже были некоторые пользователи, твиты, лайки и прочее, используйте этот пункт как руководство

#### **Фотографии**
С фотографиями создание займет чуть больше времени, но ваш сайт станет выглядеть живее. Для их использования перейдите в директроию `storage/app/public`, 
создайте две папки `photos`,где будут храниться фотографии из твитов и `icons`, с аватарками пользователей. Добавьте в эти директории любые фотографии

> **Обязательно поместите в `icons` любое изображение, назвав его `user.png`. Оно будет использоваться, как стандартное изображение**

#### **Factory**
Зайдите в файл `database/seeders/DatabaseSeeder.php`. Настроить создание объектов вы сможете, используя эти поля:
```
        $NumberOfUsers = 100; //кол-во пользователей
        $NumberOfTwits = 300; //кол-во твитов
        $NumberOfComments = 300; //кол-во комментариев
        $NumberOfLikesForTwits = 10000; //кол-во лайков для твитов
        $NumberOfLikesForComments = 5000; //кол-во лайков для комментариев

        $MaxNumberOfSubscribers = 50; // макс кол-во подписчиков
        $MinNumberOfSubscribers = 0; // мин кол-во подписчиков
```
Затем введите в консоль команду `php artisan migrate --seed`
### **Навигация по сайту**
## **Основные страницы**
При открытии сайта в первый раз вы попадете на главную страницу для не авторизированных пользователей. В таком режиме некоторый функции, такие как:
возможность подписки, написания комментария, лайки и прочие будут для вас недоступны.

![Главная страница для не авторизированных пользователей](https://i.postimg.cc/rpZ9rqfT/1.png)

Воспользуясь ссылкой регистрации в верхнем правом углу сайта, создайте свою страничку. Обратите внимение, что `почта не должна повторяться`

![Страница регистрации](https://i.postimg.cc/DfLq2Q3n/image.png)

Если у вас уже есть аккаунт, используйте вход в систему, вам понадобится лишь почта и пароль

![Страница входа](https://i.postimg.cc/MHmM1DzB/image.png)

После успешной авторизации главная страница чуть измениться. Пора на кого-нибудь подписаться!

![Главная страница для авторизированных пользователей без подписок](https://i.postimg.cc/FsGkRDW5/2.png)

Перейдите на страницу со всеми существующими пользователями. Здесь вы можете воспользоваться поиском, увидеть кол-во подписчиков у каждого пользователя,
а также подписаться или отписаться на любого из них

![Страница пользователи](https://i.postimg.cc/90CzX7yQ/image.png)

Перейдем на страничку другого пользователя. В верхней части вы можете увидеть его аватарку, описание профиля, имя, кол-во его твитов (которые вы увидите ниже), кол-во подписок и подписчиков (которые можете открыть подробнее), а также опциональные кнопки для возможности
подписки/отписки от пользователя

![Страница пользователя](https://i.postimg.cc/JzvnDgjg/image.png)

Перейдем чуть пониже, увидим твиты. В них отображается имя пользователя, создавшего твит, дата создания, текст твита, а также кнопки для: лайка,
открытия комментариев, создания ретвита; справа от каждой из них есть счетчик, указывающий на кол-во уже имеющихся объектов. Максимальное кол-во
фотографий в одном твите составляет 3 штуки, а кол-во символов 400

Чуть ниже твита есть область для написания комментария, где имеется само поле для текста (ограничение составляет 200 символов), ваша аватарка,
имя и кнопка для отправки комментария в бд.

![Твиты](https://i.postimg.cc/LXB6W8GK/image.png)

Чем же отличается ретвит от твита? Как можно увидеть на фотографии ниже, ретвит включает в себя и оригинальный твит, и ответ на него, который также
может быть наполнен фотографиями и текстом. Вы можете перейти на страницу пользователя любого из этих двух твитов, а также осуществлять любые 
действия с ними

![Ретвит](https://i.postimg.cc/Bv2q8vSL/image.png)

Перейдем на страницу комментариев. Комментарий представляет собой текст, до 200 символов, аватарку и имя автора комментария. На каждый из них
можно также поставить лайк. На оригинальные комментарии можно ответить, тогда ваш текст поместиться чуть правее от оригинала

![Комментарии](https://i.postimg.cc/hPhcLs4q/image.png)

## **Ваши возможности**
Страница создания ответа на комментарий выглядит так:

![Создание ответа](https://i.postimg.cc/hjpRxzHj/image.png)

Твои собственные комменатрии имеют дополнительные кнопки: для редактирования и удаления

![Твой комменатрий](https://i.postimg.cc/pLzNC1g3/image.png)

Страница редактирования комментария выглядит так:

![Редактирвоания комменатрия](https://i.postimg.cc/ZnC2df87/image.png)

Перейдем наконец-то на нашу страницу. Как вы можете заметить, вместо кнопок подписаться/отписаться, расположены редактировать и создать новый твит,
а справа от каждого твита появились кнопки для его редактирования и удаления. Также некоторые изменения вы заметите во вкладках подписки и подписчики,
но об этом позже

![Твоя странца](https://i.postimg.cc/QMmynLSY/image.png)

Перейдем на страницу редактирования пользователя. Здесь вы можете поменять имя странички, ее описание (до 160 символов), выбрать новую аватарку
или удалить ее с помощью кнопки в правом верхнем углу

`При удалении страницы все ваши твиты, ретвиты, комментарии, ответы на них, ваши ответы на чужие комменатрии ив аши лайки будут удалены`

![Страница редактирования пользователя](https://i.postimg.cc/kX89Y4Sj/image.png)

Как уже было замечено ранее страницы подписок вашего профиля чуть изменились, вы можете не только искать здесь людей, но и отписываться от них здесь же. 
На странице подписчиков вашего профиля вы можете отписывать их от себя

![Ваши подписки](https://i.postimg.cc/tTYG3CyN/image.png)

Перейдем на страницу создания твита. Здесь вы указываете текст твита (до 400 символов), а также можете выбрать изображения для него (до 3 штук)

![Создание твита](https://i.postimg.cc/RCJzqFgM/image.png)

При редактировании твита вы можете не только поменять текст, но и обновить фотографии. Для этого уберите галочку с пункта "Оставить старые фото".
Если вы хотите добавить новые, а не просто удалить старые фото, выберите их с помощью кнопки "выбрать фото", которая появляется после снятия галочки

![Редактирование твита](https://i.postimg.cc/mDcKcXNd/image.png)

![Редактирование твита без галочки](https://i.postimg.cc/YCMcXxM9/image.png)

Перейдем на последок во вкладку Главная, где после того, как у вас появились подписки, вы сможете видеть их новые твиты и ретвиты

![Главная страница с твитами](https://i.postimg.cc/SRC5dnPC/3.png)

Для выхода из страницы используйте спрятанную кнопку "выйти", наведя на галочку возле имени вашего профиля

![Выход](https://i.postimg.cc/cCYmMswg/image.png)

## **Api**

Сайт предоставляет работу с api. Вот некоторые из возможных роутов:

``http://.../api/users`` для просмотра всех существующих пользователей, есть возможность указания page/per_page

![Api-users-index](https://i.postimg.cc/zXk2fYYz/api-users.png)

``http://.../api/users/{user}/subscribers`` для просмотра подписчиков пользователя

``http://.../api/users/{user}/subscriptions`` для просмотра подписок пользователя

``http://.../api/users/{user}/update`` для обновления данных пользователя

``http://.../api/users/{user}/delete`` для удаления пользователя

``http://.../api/users/{user}`` для просмотра данных о пользователи и его твитов

![Api-users-show](https://i.postimg.cc/4ygwJB8H/api-users-shoe.png)

А также другие роуты для просмотра и взаимодействия с твитами, комментариями, лайками и тд. Все роуты вы можете найти в `routes/api.php`

**Приятного пользования**






