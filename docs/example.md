# Example code
Some Example code for making request to MyCovid Data API

## PHP

```php
<?php
$url = "https://mycovidapi.herokuapp.com/cases.php?date=now";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
var_dump($resp);

?>
```

## JavaScript/AJAX

``` javascript
const url = "https://mycovidapi.herokuapp.com/cases.php?date=now";

const xhr = new XMLHttpRequest();
xhr.open("GET", url);

xhr.onreadystatechange = function () {
   if (xhr.readyState === 4) {
      console.log(xhr.status);
      console.log(xhr.responseText);
   }
};

xhr.send();
```

## Python

``` python
import requests as req

url = "https://mycovidapi.herokuapp.com/cases.php?date=now"

response = req.get(url)
print(response.json)
```

## Java

``` java
URL url = new URL("https://mycovidapi.herokuapp.com/cases.php?date=now");
HttpURLConnection http = (HttpURLConnection)url.openConnection();
System.out.println(http.getResponseCode() + " " + http.getResponseMessage());
http.disconnect();
```

## C#/.NET

``` c#
var url = "https://mycovidapi.herokuapp.com/cases.php?date=now";

var httpRequest = (HttpWebRequest)WebRequest.Create(url);


var httpResponse = (HttpWebResponse)httpRequest.GetResponse();
using (var streamReader = new StreamReader(httpResponse.GetResponseStream()))
{
   var result = streamReader.ReadToEnd();
}

Console.WriteLine(httpResponse.StatusCode);
```

## CURL/BASH

``` shell
#!/bin/bash
curl -X GET https://mycovidapi.herokuapp.com/cases.php?date=now 
```
