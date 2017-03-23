# DogePanelwith5.4
Now building with laravel 5.4

__reconstructing based on orvice/ss-panel__

# Plan

- frontend ElemeFE/element
- node fork from shadowsocks-go (custom)
- combination ansible

# Frontend

Based on [vue 2](https://github.com/vuejs/vue) and [element-ui](https://github.com/ElemeFE/element).

You can use these command to dev you own frontend ui.

- dev `npm run dev`
- build `npm run build`
- test `npm test`

# Backend

Based on Laravel 5.4

Construction  

Please run the following commands at the root dictionary one by one
** Note that we strongly recommand that `Redis` config for this application ! **

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
  - 'php artisan optimize`

and you are good to go ! 

