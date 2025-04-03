## Run application:

```bash
./vendor/bin/sail up
```

## Run seeders

```bash

sail artisan db:seed
```

## Run tests

```bash 
sail artisan test
```


## Http Endpoint for Products: 

```http request
http://localhost/api/products
```


## Applying filters:


```http request
http://localhost/api/products?filters[price_from]=1000&filters[price_to]=2000&filters[manufacturers][]=Adidas&filters[colours][]=Blue&filters[colours][]=Red&filters[sizes][]=XL
```


### PS:

Еще надо было добавить роут на получение всех доступных вариантов и вынести manufactures/colours в отдельную таблицу, сделать enum для сайзов, но у меня уже не было времени на это

