## Demo project AppSumer

Laradock was used as a development environment [https://laradock.io/]

Used src folder inside app as a default folder to separate logic from Laravel infrastructure and Custom classes

Install composer dependencies and rename .env.example to .env

### Code for Weather exercise in app/src/ForeCasts
- [Widget route](http://localhost)
- [Api Documentation](https://localhost/api/documentation)

In the forecasts.php config file you can adjust the forecast provider. 

Implementations:
- Weatherbit
- OpenWeahter

### Code for Logger exercise in app/src/Logger and tests/src/Logger

This code is just for demo purpose. Test cases have been implemented using fake implementations of Loggers which save data in filesystem to avoid delays in externals requests
 
There are some possible features which can be implemented to develop a more robust logger as:
- Delay execution of logs collecting them in an array in the Logger class 
- Autoconfigure one logger by default in a service provider and used this implementation as a default in the app
- Extra refactoring can be applied in some parts of the code

Feel free to contact me if you have any doubt [mailto:diegodominguez.h@gmail.com]
