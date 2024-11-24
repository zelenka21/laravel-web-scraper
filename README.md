# Laravel Web Scraper 

### Machine Requirements

Docker, docker-compose.

## Setup

* Clone the repository using `git clone git@github.com:zelenka21/laravel-web-scraper.git` command.
* Start Docker environment using `make start` command.
* Install dependencies using `make install` command.

## Available commands

* `make start` start the containers
* `make stop` stop the containers
* `make exec-php` enter the php container

## Available endpoints

## 1. Create a Job
- **Endpoint**: `POST /api/jobs`
- **Request Body**:
  ```json
  {
      "data": [
          {
              "url": "https://www.reiz.tech",
              "selectors": [
                  "#comp-lodvaza82__item-lk57oqib",
                  "h1"
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
- **Endpoint**: `GET /api/jobs/{id}`

## 3. Delete a job
- **Endpoint**: `DELETE /api/jobs/{id}`

