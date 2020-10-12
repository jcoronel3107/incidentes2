

System for the Control and Registration of Incidents to which a Firefighters Institution attends

Fully responsive system, that is, it works on mobiles, tablets and computers

## Features
-Icons FontAwesome
-Activity Log 	spatie/laravel-activitylog": "^3.16
-Geocoder		javascript
-Translate		laravel-lang/lang": "~7.0
-Send Mail		smtp
-PDF export		barryvdh/laravel-dompdf": "^0.8.6
-PDF import		barryvdh/laravel-dompdf": "^0.8.6
-Excel export	maatwebsite/excel": "^3.1
-Excel import	maatwebsite/excel": "^3.1
-Bootstrap		Fully responsive system, that is, it works on mobiles, tablets and computers

### Installation

1. Clone the repo
`git clone https://github.com/jcoronel3107/incidentes2.git`

2. Configure .env file
`mv .env.example .env`

3. Install composer
`composer install`

4.  Migrate database
`php artisan migrate`

5.  App key
`php artisan key:generate`

6. Seed database
`php artisan db:seed`


## License
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
