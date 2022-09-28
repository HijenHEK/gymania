# About Gymania

Gymania is a web application for managing gyms subscriptions and staff 
built using Laravel 8 and Vuejs 2

this project is for my uni assignment and its a work in progress [demo video](https://drive.google.com/file/d/1R3dyh4t94tD9G4o6TbINGu1wm1rv1-3g/view)

the dashbboard is made from scratch with scss

![image](https://drive.google.com/uc?export=view&id=1MJm9o3EmWOjmbtNFm1QNDRz0n2CQtmQo)


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
    <span class="pl-ent">password</span>: <span class="pl-s">password</span>
    </pre>

## set up pusher env

```
BROADCAST_DRIVER=pusher

// Set these variables as you wish
PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
```

run :
    $ npm run dev




## run the servers

<strong> we need to serve our app and run the websockets server + scheduled cron</strong>


    $ php artisan serve
    $ php artisan websockets:serve
    $ php artisan schedule:work

    



        


