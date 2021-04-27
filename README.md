# About Gymania

Gymania is a web application for managing gyms subscriptions and staff 
built using Laravel 8 and Vuejs 2

this project is for my uni assignment and its a work in progress

# set up

## download and scaffold the app
<strong> you need to have composer and node installed  </strong>

    $ git clone https://github.com/HijenHEK/gymania.git
    $ cd gymania
    $ cp .env.example .env (add pusher details & db credentials)
    $ composer install
    $ php artisan key:generate
    $ php artisan storage:link
    $ npm install
    $ npm run dev

## prepare the database and seed it

<strong> setup you database and its credentials in your .env file then migrate </strong>

    $ php artisan migrate --seed

<strong> you ll have a default admin user </strong>
    <pre>
    <span class="pl-ent">username</span>: <span class="pl-s">admin</span>
    <span class="pl-ent">password</span>: <span class="pl-s">adminpassword</span>
    </pre>

## run the servers

<strong> we need to serve our app and run the websockets server + scheduled cron</strong>


    $ php artisan serve
    $ php artisan websockets:serve
    $ php artisan schedule:work

    



        


