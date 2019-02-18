## Instalar PHP 7.3 no Ubuntu 16.04

- Executar no terminal:
    - `sudo add-apt-repository ppa:ondrej/php`
    - `sudo apt update`
    - `sudo apt install php7.3 php7.3-mysql`

## Instalar composer no Ubuntu 16.04

- É preciso instalar o PHP
- Executar no terminal:
    - `php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"`
    - `php -r "if (hash_file('sha384', 'composer-setup.php') === '93b54496392c062774670ac18b134c3b3a95e5a5e5c8f1a9f115f203b75bf9a129d5daa8ba6a13e2cc8a1da0806388a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"`
    - `php composer-setup.php`
    - `php -r "unlink('composer-setup.php');"`
    - `chmod +x composer.phar`
    - `sudo mv composer.phar /usr/local/bin/composer`

## PHPUnit

- É possível instalar o PHPUnit atraves do composer:
    - `composer require --dev phpunit/phpunit ^8`
    - `composer update` ou `composer update --ignore-platform-reqs`
- Para executar o PHPUnit (na pasta raiz do projeto):
    - `vendor/bin/phpunit`
- Dependência do php7.3-xml:
    - `sudo apt install php7.3-xml`

## Executar o ambiente docker
- É necessário ter o `docker` e o `docker-compose` instalado
- Acessar a pasta `env/` e executar:
    - `docker-compose up`, `sudo docker-compose up` ou `sudo docker-compose up -d`
- O endereço pré-configurado do apache é o `http://localhost:8000`
- MySQL...
    - Porta: 3600 
    - ...