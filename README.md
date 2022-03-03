## MyCovid Data API

The MyCovid API is an HTTP-based interface 
created for developers keen on building about
Malaysia Covid-19 programs.

Once deverloper sent a request, 
the Web API will send back a json
formated data

Powered by PHP

## Usage

### Base Url 
Providing 2 interfaces, non-interfering with each other. 
Operate independently

- `manho30.herokuapp.com/`


- `mycovidapi.herokuapp.com/`

All the [Supported Queries](#method) can be normal using 
while making request to both of MyCovid Data API

### Making requests
All queries to the MyCovid API must be served over 
HTTPS and need to be presented in specific form. 

You can either choose to fetch like 

```
mycovidapi.herokuapp.com/api/<method>
```

OR 

```
mycovidapi.herokuapp.com/<method>.php
```

Supported `GET` HTTP methods by passing parameters in MyCovid API requests:
 - URL query string 

## Method
### Cases

Get the confirmed Covid-19 case(s) 

*Example Code*

``` javascript
fetch("http://mycovidapi.herokuapp.com/cases.php?date=now)
    .then(response => response.json())
    .then(res => console.log(res))
```
**Parameter**

- date (Require) 

##### Parameter and query for cases data 

- date:

| Query       |  Query String     | Description              |
| ----------- | ----------------- | ------------------------ |
| all         | date=all          | Get all possible data    |
| now         | date=now          | Get today's data         |
| yyyy/mm/dd  | date=2022-01-31   | Get a specific date data |





### State

Get Covid-19 confirmed case(s) 
information in every state 

**Example Code**

``` javascript
fetch("http://mycovidapi.herokuapp.com/state.php?date=now&state=Johor)
    .then(response => response.json())
    .then(res => console.log(res))
```
**Parameter**
- date(require)
- state(optional)

##### Parameter and query for state data

- date:

| Query       |  Query String     | Description              |
| ----------- | ----------------- | ------------------------ |
| all         | date=all          | Get all possible data    |
| now         | date=now          | Get today's data         |
| yyyy/mm/dd  | date=2022-01-31   | Get a specific date data |

- state:

| Query       |  Query String     | Description              |
| ----------- | ----------------- | ------------------------ |
| state       | state=<state_name>| Get all possible data    |

**Notice:** The first letter needs to be capitalized for the `state` query


### Vax
Get the Covid-19 vaccination data 
``` javascript
fetch("http://mycovidapi.herokuapp.com/state.php?date=now)
    .then(response => response.json())
    .then(res => console.log(res))
```
**Parameter**
- date(require) 

##### Parameter and query for vax

- date:

| Query       |  Query String     | Description              |
| ----------- | ----------------- | ------------------------ |
| all         | date=all          | Get all possible data    |
| now         | date=now          | Get today's data         |
| yyyy/mm/dd  | date=2022-01-31   | Get a specific date data |


### Death
RIP... Get death data due to Covid-19

``` javascript
fetch("http://mycovidapi.herokuapp.com/death.php?date=now)
    .then(response => response.json())
    .then(res => console.log(res))
```
**Parameter**
- date(require)

##### Parameter and query for death data

- date:

| Query       |  Query String     | Description              |
| ----------- | ----------------- | ------------------------ |
| all         | date=all          | Get all possible data    |
| now         | date=now          | Get today's data         |
| yyyy/mm/dd  | date=2022-01-31   | Get a specific date data |





## Data source
All the data are from [MoH-Malaysia/covid19-public](https://github.com/MoH-Malaysia/covid19-public)

## Build your own
*Tutorial coming soon, bcuz iam lazy now*
