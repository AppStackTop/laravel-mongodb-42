# laravel-mongodb-42

a slightly modified version of jenssegers/laravel-mongodb: for laravel 4.2 using php7 mongodb driver

it's based on commit ebab4ebd025860e61b9313f43baaa474601735f8 of https://github.com/jenssegers/laravel-mongodb

What I've changed for 4.2

* use ReminderServiceProvider.php and DatabaseReminderRepository.php for password resets

* use SoftDeletingTrait

* always return false on shouldUseCollections metho