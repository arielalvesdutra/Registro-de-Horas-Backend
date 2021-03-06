## Sumário 

1. [Descrição](#1-descrição)
2. [Instalação](#2-instalação)
3. [Testes Unitários](#3-testes-unitários)
4. [Métodos](#4-métodos)


# 1. Descrição

### Sobre o projeto

Esse é o repositorio do projeto "Registro de Horas - Backend".

A ideia do projeto é praticar programação no PHP 7.3 e procurar aplicar os conceitos de SOLID, Design Patterns, Clean Code, Refactoring e  DDD. 

Não é intenção desse projeto aplicar estritamente os conceitos, até porque o objetivo do mesmo é o aprendizado.

### A aplicação

O objetivo dessa aplicação é ser uma API REST para receber as requisões do frontend para registrar horas de determinados "esforços de tempo".

Exemplo de esforço:

```
- Título: "Estudar PHP"
- Inicio do registro: `2019/01/10 10:00:00`
- Final do registro: `2019/01/10 12:00:00`
```

O backend irá receber uma requisição do frontend para adicionar esse registro de esforço de tempo e irá calcular a duração. Em seguida o frontend realizará uma solicitação dos registros e receberá o registro de tempo com a duração calculada. Depois de o backend calcular a duração e adicionar o registro no banco de dados, o registro ficará próximo de:

```
- Id: 1
- Título: "Estudar PHP"
- Inicio do registro: `2019/01/10 10:00:00`
- Final do registro: `2019/01/10 12:00:00`
- Duração: `2:00:00`
```

# 2. Instalação
### Composer
Instalar dependências com o composer.
```bash
$ composer install
```
É necessário ter instalado o PHP 7.3 no computador. Mesmo se ele estiver instalado e gerar erro na instalação das dependências com o composer, é possível utilizar o `--ignore-platform-reqs`.
```bash
$ composer install --ignore-platform-reqs
```

### Ambiente docker
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
    - host: é o ip da máquina que executa o docker
    - porta: `3600`
    - usuario padrão: `root`
    - senha: `password`
     
** obs1: no momento, ainda é preciso configura o IP do banco no arquivo src\Database\Factories\Connections\DefaultDatabaseConnection. Tem uma issue aberta para criar a funcionalidade de pegar as configurações de um arquivo .env.

### Frontend


Instalar e executar ambiente do frontend [aqui](https://github.com/arielalvesdutra/Registro-de-Horas-Frontend).

# 3. Testes unitários

Os testes são realizados com PHPUnit. Basta executar na raiz do projeto: 

```bash
$ ./vendor/bin/phpunit
```

** Até o momento foram adicionados poucos testes à aplicação.

# 4. Métodos

#### addRecord()

O backend recebe um JSON e salva no banco um registro de tempo.

Rota | Tipo | Método  
--- | --- | --- 
http://localhost:8000/addRecord | POST |App\Controllers\TimeRecorder->addRecord()

Exemplo de requisição JSON:

```json
{
  "title" : "Estudo de PHP",
  "initDateTime" : "2019/01/10 10:06:01",
  "endDateTime" : "2019/01/10 13:41:22"
}
```

Se a requisição estivar mal formatada, será retornodo o status http `400`.

#### deleteRecord()

Recebe um parametro `{id}` (int) e deleta o registro no banco de dados.

Rota | Tipo | Método  
--- | --- | --- 
http://localhost:8000/deleteRecord/{id} | DELETE |App\Controllers\TimeRecorder->deleteRecord()

Exemplo: `http://localhost:8000/deleteRecord/1`


#### getRecords()

Retorna os registros de esforço de tempo existentes no banco.

Rota | Tipo | Método  
--- | --- | --- 
http://localhost:8000/getRecords | GET|App\Controllers\TimeRecorder->getRecords()  
http://localhost:8000/getRecords/filters?title=estudo | GET|App\Controllers\TimeRecorder->getRecords()  

Filtros.

|Filtros| Exemplo |
|-------|---------|
| `title` | title=estudo |
| `initDate` | initDate=2019-01-10 |

Ordenação.

|Ordernação| Exemplo |
|-------|---------|
| `title` | order=title |
| `initDate` | order=initDate|
| `desc` | desc |



Exemplo: `http://localhost:8000/getRecords/filters?title=estudo&order=initDate&desc`

#### updateRecord()

Recebe um JSON e atualiza o registro no banco de dados.

Rota | Tipo | Método  
--- | --- | --- 
http://localhost:8000/updateRecord | PUT |App\Controllers\TimeRecorder->updateRecord()

Exemplo de requisição JSON para atualizar um registro:

```json
{
  "id": 1,
  "title" : "Estudo de PHP - Iniciante",
  "initDateTime" : "2019/01/10 09:02:33",
  "endDateTime" : "2019/01/10 14:10:13"
}
```