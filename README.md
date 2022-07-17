
## Event App
Thank you for such a great opportunity. This is an event app created as an assessment.<br/>

- Laravel version 8 is used and that requires php 7.3 or higher
## Setup Steps
- Clone the project from GitHub using below command <br/>
` https://github.com/anishansari/eventApp.git`
- Then Go to the Project Folder<br/>
`cd eventapp`
- Run the following command<br/>
`composer install`
- Now look for the .env file and setup database<br/>
`DB_CONNECTION=mysql`<br/>
  `DB_HOST=127.0.0.1`<br/>
  `DB_PORT=3306`<br/>
  `DB_DATABASE= Your DB name`<br/>
  `DB_USERNAME=Your DB User Name`<br/>
  `DB_PASSWORD= Your DB password`<br/>
- For example </br>
>DB_CONNECTION=mysql<br/>
DB_HOST=127.0.0.1<br/>
DB_PORT=3306<br/>
DB_DATABASE=event<br/>
DB_USERNAME=root<br/>
DB_PASSWORD=password<br/>
- Also Setup a database for running unit tests, change the following in .env <br/>
`TESTING_DB_HOST=localhost`<br/>
`TESTING_DB_DATABASE=Your DB Name`<br/>
`TESTING_DB_USERNAME=Yur DB username`<br/>
`TESTING_DB_PASSWORD=Your DB password`<br/>
- For example </br>
>TESTING_DB_HOST=localhost<br/>
TESTING_DB_DATABASE=event_test<br/>
TESTING_DB_USERNAME=root<br/>
TESTING_DB_PASSWORD=password<br/>

- Once the setup is complete,run the migration and seeder<br/>
`php artisan migrate --seed`

- To run the test, please use the following command <br/>
`php artisan test` <br/>


Thank you
