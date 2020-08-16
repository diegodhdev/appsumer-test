<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Weather Widget</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .temperature {
            font-size: 40px;
        }

        .forecast-details > ul {
            margin: 0;
            display: inline;
            padding-inline-start: 0;
        }

        .forecast-details > ul > li {
            font-size: 13px;
            list-style: none;
        }

    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">

        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <select id="cities" name="cities" id="cars" form="carform" class="float-right">
                    <option value="">Select a city</option>
                    @foreach($cities as $city)
                        <option value="{{ $city['name'] }}"
                                data-country-code="{{ $city['country_code'] }}">{{ $city['name'] }}</option>
                    @endforeach
                </select>

                <div id="forecast-template">
                    <h5 class="card-title">--</h5>
                    <p>--</p>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <span class="temperature">--</span>
                            </div>
                            <div class="col forecast-details">
                                <ul>
                                    <li>Humidity: --
                                    <li>
                                    <li>Precipitation: --
                                    <li>
                                    <li>Wind: --
                                    <li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <script>

        $("#cities").change(function () {

            const isACity = () => option.val() !== "";
            const forecast_template_selector = '#forecast-template';
            const option = $(this).find("option:selected");
            const body = {
                'city': option.val(),
                'country_code': option.data('country-code')
            };

            if (isACity()) {
                fetch('{{ route('foreCastGet') }}',
                    {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        body: JSON.stringify(body)
                    })
                    .then(response => {
                        const statusKo = response.status >= 300;
                        if (statusKo) {
                            throw Error(response.statusText);
                        }
                        return response.json();
                    })
                    .then(data => {
                        $(forecast_template_selector).html('');
                        $(forecast_template_selector).append(getForeCastTemplate(data));
                    })
                    .catch(error => {
                        alert(error);
                    });

            } else {
                $(forecast_template_selector).html(``);
                $(forecast_template_selector).append(getEmptyForeCastTemplate());
            }
        });

        function getForeCastTemplate(data) {
            return `
                    <h5 class="card-title">${data.cityName}</h5>
                    <p>${data.lastUpdate}</p>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <span class="temperature">${data.temperature}ºC</span>
                            </div>
                            <div class="col forecast-details">
                                <ul>
                                    <li>Humidity: ${data.humidity}%
                                    <li>
                                    <li>Precipitation: ${data.precipitation}%
                                    <li>
                                    <li>Wind: ${data.wind}
                                    <li>
                                </ul>
                            </div>
                        </div>
                    </div>`;
        }

        function getEmptyForeCastTemplate() {
            return `
                    <h5 class="card-title">--</h5>
                    <p>--</p>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <span class="temperature">--</span>
                            </div>
                            <div class="col forecast-details">
                                <ul>
                                    <li>Humidity: --
                                    <li>
                                    <li>Precipitation: --
                                    <li>
                                    <li>Wind: --
                                    <li>
                                </ul>
                            </div>
                        </div>
                    </div>`;
        }

    </script>
</div>
</body>
</html>
