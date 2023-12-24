# llegoo

# Getting Started

## Prerequisites
* Docker

## Instalation

1. Clone de repo 
```sh
   git clone git@github.com:isa-gdt/lleego.git
   ```
2. Install composer packages
```sh
   composer install
   ```
3. Create and start Docker containers
```sh
   docker compose up [-d]
```

## Commands
### Get endpoint
```sh
   php bin/console lleego:avail MAD BIO 2022-06-01
```

### test
```sh
   php bin/phpunit --testsuite Unit
```
