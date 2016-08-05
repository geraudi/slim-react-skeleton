# Slim Framework 3 Skeleton Application + ReactJs

## Install

### Slim 3
```
composer install
```


### Webpack + ReactJs + Karma

Installation :

```
npm install
```

Run webpack dev server :

```
npm run start
```

Run test :

```
npm run test
```

##Config

###app/config/settings.php

#### Database

```
...
'pdo' => [
        'dns'      => 'mysql:dbname=my-db;host=127.0.0.1;charset=utf8',
        'user'     => 'root',
        'password' => 'root'
    ],
 ...
```

#### JWT

```
...
'auth' => [
        'jwtKey' => '6v9d5AN2Ka88E4dr', // <= Change here
        'requestAttribute' => 'jwt',
    ]
 ...
```

### React Call API

####src/js/lib/api.js

```
...
axios.defaults.baseURL = 'http://example.com/api/v1/';
...
```


    

