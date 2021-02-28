# shortUrl

A lumen application that allows you to generate and use short URLs

## Setting up the environment
After pulling the repository, you need to change the **VOL_CODE** variable in **/docker/.env**. This will allow docker to build containers using application code as a reference
```bash
VOL_CODE=/path/to/your/local/folder
```

After doing this, make sure you have docker installed on your machine.
Then going to /docker and start terminal.
Execute:
```bash
docker-compose up --build
```
**This procedure will take care of creating the following containers**:
- php-fpm
- nginx
- mysql
- composer : this downloads all the libraries that the framework needs

At the end of the building, you application microservices are available on 
```bash
http://localhost:8000/
```

## Services available
###### **GET http://localhost:8000/kj8G6Ry**
This api allows you to automatically be redirected to an original url shortened by the service made available


###### **GET /api/shortened**
This api returns a list of all short url generated with some details, like number of redirection or the date of creation
```json
[
    {
        "id": 1,
        "long_url": "https://www.github.com/",
        "short_url": "http://localhost:8000/kj8G6Ry",
        "redirect": 0,
        "created_at": "Y-m-dTH:i:s",
        "updated_at": "Y-m-dTH:i:s"
    },
]
```
###### **POST /api/shortened**
This api allow you to create a new short url from a string passed in input. The request must be a POST and you should pass a json in the body of the request like :
```json
    {
        "long_url": "https://www.github.com/"
    }
```
This service checks if urls have not already been generated based on the parameter passed in input, and if the url really exists. This check is used to avoid conflicts between the generated short urls.
At the end, if all check pass successfully, api returns a response like this:
```json
"http://localhost:8000/BAkaFa2"
```
###### **DELETE /api/shortened**
This api allows you to delete a short url generated previously. The request must be DELETE and it expects a json of the following type as input:
**the ID of record stored in database: you can get it with the first API**
```json
    {
        "id": 1 
    }
```
If there aren't errors (the id you passed isn't exits) the response that it return is 
```json
"Url deleted successfully"
```


###### **GET /api/counter/all**
This api returns the sum of all short url redirects.
```json
"24"
```
###### **GET /api/counter/{id}**
This api returns the sum of a specific short url redirects.
**Param {id}** the ID of record stored in database
```json
"3"
```