# Countries and cities API

## Getting started

* Launch a MySQL server
* Edit .env file to match your server configuration
* Use `php artisan migrate` to create the database tables
* Use `php artisan DB:seed` to populate the tables.
* Use `php artisan key:generate` to generate the APP_KEY value for .env file
* Use `php artisan serve` to launch the API server.

## Usage

### GET method

#### Countries

URI: `GET` http://localhost:8000/api/countries

Gets all countries. The list is paginated: 10 rows per page.

Params:

|Parameter       |Type  |Description                                                                            |Required|
|----------------|------|---------------------------------------------------------------------------------------|--------|
|`sort`          |string|`asc` to sort the list in ascending order, `desc` to sort the list in descending order.|false   |
|`created_before`|date  |Returns data created before the specified date                                         |false   |
|`created_after` |date  |Returns data created after the specified date                                          |false   |
|`search`        |string|Search term                                                                            |false   |
|`page`          |int   |Page number                                                                            |false   |

* Success response:
  * Code: 200 OK
  * Content: a list of countries
* Error response:
  * Code: 404 Not found
  * Content: empty

URI: `GET` http://localhost:8000/api/countries/{id}

Gets the country with the specified id

* Success response:
    * Code: 200 OK
    * Content: the country with the specified id
* Error response:
    * Code: 404 Not found
    * Content: empty

#### Cities

URI: `GET` http://localhost:8000/api/cities

Gets all cities. The list is paginated: 10 rows per page.

Params:

|Parameter       |Type  |Description                                                                            |Required|
|----------------|------|---------------------------------------------------------------------------------------|--------|
|`sort`          |string|`asc` to sort the list in ascending order, `desc` to sort the list in descending order.|false   |
|`created_before`|date  |Returns data created before the specified date                                         |false   |
|`created_after` |date  |Returns data created after the specified date                                          |false   |
|`search`        |string|Search term                                                                            |false   |
|`page`          |int   |Page number                                                                            |false   |

* Success response:
    * Code: 200 OK
    * Content: a list of cities
* Error response:
    * Code: 404 Not found
    * Content: empty

URI: `GET` http://localhost:8000/api/countries/{id}

Gets the city with the specified id

* Success response:
    * Code: 200 OK
    * Content: the city with the specified id
* Error response:
    * Code: 404 Not found
    * Content: empty

### POST method

#### Countries

URI: `POST` http://localhost:8000/api/countries

Posts a country

Params:

|Parameter   |Type  |Description                  |Required|
|------------|------|-----------------------------|--------|
|`name`      |string|The name of the country      |true    |
|`population`|string|The population of the country|true    |
|`area`      |string|The area of the country      |true    |
|`phone_code`|string|The phone code of the country|true    |

* Success response:
    * Code: 201 Created
* Error response:
    * Code: 400 Bad request

URI: `POST` http://localhost:8000/api/countriesPostFile

Posts a country from a .json file

Params:

|Parameter|Type      |Description                                                           |Required|
|---------|----------|----------------------------------------------------------------------|--------|
|`file`   |.json file|.json file with the same parameters as the regular country POST method|true    |

File structure example:
```json
{
    "countries": [
        {
            "name": "Brazil",
            "population": "100mil",
            "area": "500000km2",
            "phone_code": "+12"
        },
        {
            "name": "Spain",
            "population": "30mil",
            "area": "100000km2",
            "phone_code": "+15"
        }
    ]
}
```
* Success response:
    * Code: 201 Created
* Error response:
    * Code: 400 Bad request

#### Cities

URI: `POST` http://localhost:8000/api/cities

Posts a city

Params:

|Parameter    |Type  |Description                                    |Required|
|-------------|------|-----------------------------------------------|--------|
|`name`       |string|The name of the city                           |true    |
|`population` |string|The population of the city                     |true    |
|`area`       |string|The area of the city                           |true    |
|`postal_code`|string|The postal code of the city                    |true    |
|`country_id` |int   |The ID of the country which the city belongs to|true    |

* Success response:
    * Code: 201 Created
* Error response:
    * Code: 400 Bad request

URI: `POST` http://localhost:8000/api/citiesPostFile

Posts a city from a .json file

Params:

|Parameter|Type      |Description                                                           |Required|
|---------|----------|----------------------------------------------------------------------|--------|
|`file`   |.json file|.json file with the same parameters as the regular country POST method|true    |

File structure example:
```json
{
    "cities": [
        {
            "name": "Vilnius",
            "population": "1mil",
            "area": "100km2",
            "postal_code": "LT-10000",
            "country_id": "1"
        },
        {
            "name": "Kaunas",
            "population": "0.5mil",
            "area": "50km2",
            "postal_code": "LT-20000",
            "country_id": "1"
        }
    ]
}
```

* Success response:
    * Code: 201 Created
* Error response:
    * Code: 400 Bad request

### PUT method

#### Countries

URI: `PUT` http://localhost:8000/api/countries/{id}

Updates the country with the specified ID

Params:

|Parameter   |Type  |Description                  |Required|
|------------|------|-----------------------------|--------|
|`name`      |string|The name of the country      |true    |
|`population`|string|The population of the country|true    |
|`area`      |string|The area of the country      |true    |
|`phone_code`|string|The phone code of the country|true    |

* Success response:
    * Code: 200 OK
* Error response:
    * Code: 400 Bad request

#### Cities

URI: `PUT` http://localhost:8000/api/cities/{id}

Posts a city

Params:

|Parameter    |Type  |Description                                    |Required|
|-------------|------|-----------------------------------------------|--------|
|`name`       |string|The name of the city                           |true    |
|`population` |string|The population of the city                     |true    |
|`area`       |string|The area of the city                           |true    |
|`postal_code`|string|The postal code of the city                    |true    |
|`country_id` |int   |The ID of the country which the city belongs to|true    |

* Success response:
    * Code: 200 OK
* Error response:
    * Code: 400 Bad request

### DELETE method

#### Countries

URI: `DELETE` http://localhost:8000/api/countries/{id}

Deletes the country (and all associated cities) with the specified ID

* Success response:
    * Code: 200 OK
* Error response:
    * Code: 404 Not found

#### Cities

URI: `DELETE` http://localhost:8000/api/cities/{id}

Deletes the city with the specified ID

* Success response:
    * Code: 200 OK
* Error response:
    * Code: 404 Not found
