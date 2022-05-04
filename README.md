# Elgiganten Repair Admin Panel
## Installation
### Prerequisites
- A webserver such as Apache
- PHP 8.0 or newer
- Composer 2.3.0 or newer

### CLI Commands to Run
#### Install Dependencies
<code>composer install</code>
#### Update Dependencies
<code>composer update</code>
### Create .env File
- For Windows: <code>copy .env.example .env</code>

- For Linux/Mac: <code>cp .env.example .env</code>
#### Generate App Key
<code>php artisan key:generate</code>
### Update the .env File
In the .env file update the following field to match your web server:
- <code>APP_URL</code> to your webserver URL
- <code>Base URL</code> to the API Token from [the wiki](https://github.com/dann4624/ElRepair/wiki/Credentials)
- <code>API_BASE</code> to <code>"https://elrepair.semeicardia.online/api/" </code> OR the link to your local instance of [Elgiganten Repair API](https://github.com/dann4624/ElRepair)

#### Clear Cache
<code>php artisan cache:clear</code>
#### Update Cache
- <code>php artisan route:cache</code>
- <code>php artisan view:cache</code>
- <code>php artisan config:cache</code>


