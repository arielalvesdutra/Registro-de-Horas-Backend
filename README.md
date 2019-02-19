# Descrição
Descrição aqui...

# Instalação
### Composer
Instalar dependências com o composer.
```bash
$ composer install
```
É necessário ter instalado o PHP 7.3 no computador. Mesmo se ele estiver instalado e gerar erro na instalação das dependências com o composer, é possível utilizar o `--ignore-platform-reqs`.
```bash
$ composer install --ignore-platform-reqs
```

### Executar o ambiente docker
É necessário ter o `docker` e o `docker-compose` instalado no computador.
Acesse a pasta `env/` do projeto e execute:
 
 ```bash
 $ docker-compose up
 ```
Ou:
```bash
 $ sudo docker-compose up
 ```
Informações do ambiente docker:
- host web: `http://localhost:8000`
- mysql:
    - host: TODO
    - porta: `3600`
    - usuario padrão: `root`
    - senha: `password` 
    
### Frontend


Instalar e executar ambiente do frontend [aqui](https://github.com/arielalvesdutra/Registro-de-Horas-Frontend).