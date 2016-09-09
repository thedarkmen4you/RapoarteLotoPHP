# RapoarteLotoPHP

<p>Start-up:<br />
&nbsp;&nbsp;&nbsp;1. creaza proiect laravel<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;composer create-project --prefer-dist laravel/laravel numeProiect<br />
&nbsp;&nbsp;&nbsp;2. seteaza timezone in config/app.php<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'timezone' => 'Europe/Bucharest',<br />
&nbsp;&nbsp;&nbsp;3. initializare github cu director existent<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;git init //https://help.github.com/articles/adding-an-existing-project-to-github-using-the-command-line/<br />
&nbsp;&nbsp;&nbsp;4. porneste serverul <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;php artisan serve</p>

<p> <br />
Login:<br />
&nbsp;&nbsp;&nbsp;1. php artisan make:auth<br />
&nbsp;&nbsp;&nbsp;2. php artisan migrate<br />
 <br />
&nbsp;&nbsp;&nbsp;https://laravel.com/docs/4.2/schema - cum faci o tabela in DB<br />
&nbsp;&nbsp;&nbsp;PS: In cazul in care nu se actualizeaza pagina sterge fisierele din storage/framework/views<br />
 <br />
 <br />
View:<br />
&nbsp;&nbsp;&nbsp;RESTful: php artisan make:controller PhotoController --resource<br />
&nbsp;&nbsp;&nbsp;Model: php artisan make:model Bilete<br />
&nbsp;&nbsp;&nbsp;Script DB: php artisan make:migration create_setari_table<br />
&nbsp;&nbsp;&nbsp;Model+Script DB: php artisan make:model User --migration</p>
