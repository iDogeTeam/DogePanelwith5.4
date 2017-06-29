# DogePanelwith5.4 

Now building with laravel 5.4  
基于 Laravel，前端 vue+element  
按实例，使用量，并可分时间段和上下行计费的面板  
主要面向SS和OpenConnect  
 
Under developing...  
仍在开发中  

# Docs

[Here](https://github.com/iDogeTeam/PanelDocs)  

# Plan

- frontend ElemeFE/element
- node fork from shadowsocks-go (custom)
- combination ansible

# Frontend

Based on [vue 2](https://github.com/vuejs/vue) and [element-ui](https://github.com/ElemeFE/element).

## Install

- `npm install`

You can use these command to dev you own frontend ui.

- dev `npm run dev`
- build `npm run build`
- test `npm test`

# Backend

Based on [Laravel 5.4](https://github.com/laravel/laravel)

## Construction  

Recommended env: 
- apache
- php70+, prefork mode
- MariaDB
- Redis

Please run the following commands at the root dictionary. 

**Note that we strongly recommend that `Redis` config for this application !**  

- Composer
  - `Composer install`
- Config
  - `cp .env.example .env`
  - `vim .env` please change the config file accordingly
- Migration
  - `php artisan migrate`
- Key
  - `php artisan key:generate`
- Optimize
  - `php artisan optimize`

- Set up Cron For Laravel Schedule
Add the following Command to your cron. Change the path accordingly! 
  - `* * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1`

and you are good to go !

