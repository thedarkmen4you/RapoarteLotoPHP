# RapoarteLotoPHP

Start-up:
	1. creaza proiect laravel
		composer create-project --prefer-dist laravel/laravel numeProiect
	2. seteaza timezone in config/app.php
		'timezone' => 'Europe/Bucharest',
	3. initializare github cu director existent
		git init  //https://help.github.com/articles/adding-an-existing-project-to-github-using-the-command-line/
	4. porneste serverul 
		php artisan serve

	
Login:
	1. php artisan make:auth
	2. php artisan migrate
	
	https://laravel.com/docs/4.2/schema - cum faci o tabela in DB
	PS: In cazul in care nu se actualizeaza pagina sterge fisierele din storage/framework/views
	
	
View:
	RESTful: php artisan make:controller PhotoController --resource
	Model: php artisan make:model Bilete
	Script DB: php artisan make:migration create_setari_table
	Model+Script DB: php artisan make:model User --migration
