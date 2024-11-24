# Laravel Web Scraper 

Simple web scraper, with support for HTML/CSS selectors. Using Redis as the data store and queue driver.
### Machine Requirements

Docker, docker-compose.

## Setup

* Clone the repository using `git clone git@github.com:zelenka21/laravel-web-scraper.git` command.
* Start Docker environment using `make start` command.
* Install dependencies using `make install` command.

## Available commands

* `make start` start the containers.
* `make stop` stop the containers.
* `make exec-php` enter the php container to execute commands, run composer etc.

## Available endpoints

## 1. Create a Job
- **Endpoint**: `POST http://localhost:8000/api/jobs`
- **Request Body**:
  ```json
  {
      "data": [
          {
              "url": "https://www.reiz.tech",
              "selectors": [
                  "#comp-lodvaza82__item-lk57oqib",
                  "h1",
                  "main > section > div"
              ]
          },
          {
              "url": "https://example.com",
              "selectors": [
                  ".price"
              ]
          },
  
      ]
  }
## 2. Get job details
- **Endpoint**: `GET http://localhost:8000/api/jobs/{id}`

## 3. Delete a job
- **Endpoint**: `DELETE http://localhost:8000/api/jobs/{id}`

