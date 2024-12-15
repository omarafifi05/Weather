<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="mainofmain">
        <div class="main">
            <h1>Weather in Morocco</h1>
            <form method="POST">
                <label for="city">Choose a city :</label>
                <select name="city" id="city">
                <option value="Agadir" <?php echo isset($_POST['city']) && $_POST['city'] == 'Agadir' ? 'selected' : ''; ?>>Agadir</option>
<option value="Al Hoceima" <?php echo isset($_POST['city']) && $_POST['city'] == 'Al Hoceima' ? 'selected' : ''; ?>>Al Hoceima</option>
<option value="Azilal" <?php echo isset($_POST['city']) && $_POST['city'] == 'Azilal' ? 'selected' : ''; ?>>Azilal</option>
<option value="Beni Mellal" <?php echo isset($_POST['city']) && $_POST['city'] == 'Beni Mellal' ? 'selected' : ''; ?>>Beni Mellal</option>
<option value="Casablanca" <?php echo isset($_POST['city']) && $_POST['city'] == 'Casablanca' ? 'selected' : ''; ?>>Casablanca</option>
<option value="Chefchaouen" <?php echo isset($_POST['city']) && $_POST['city'] == 'Chefchaouen' ? 'selected' : ''; ?>>Chefchaouen</option>
<option value="Dakhla" <?php echo isset($_POST['city']) && $_POST['city'] == 'Dakhla' ? 'selected' : ''; ?>>Dakhla</option>
<option value="El Jadida" <?php echo isset($_POST['city']) && $_POST['city'] == 'El Jadida' ? 'selected' : ''; ?>>El Jadida</option>
<option value="Fes" <?php echo isset($_POST['city']) && $_POST['city'] == 'Fes' ? 'selected' : ''; ?>>Fes</option>
<option value="Ifrane" <?php echo isset($_POST['city']) && $_POST['city'] == 'Ifrane' ? 'selected' : ''; ?>>Ifrane</option>
<option value="Kenitra" <?php echo isset($_POST['city']) && $_POST['city'] == 'Kenitra' ? 'selected' : ''; ?>>Kenitra</option>
<option value="Ksar el-Kébir" <?php echo isset($_POST['city']) && $_POST['city'] == 'Ksar el-Kébir' ? 'selected' : ''; ?>>Ksar el-Kébir</option>
<option value="Laâyoune" <?php echo isset($_POST['city']) && $_POST['city'] == 'Laâyoune' ? 'selected' : ''; ?>>Laâyoune</option>
<option value="Marrakech" <?php echo isset($_POST['city']) && $_POST['city'] == 'Marrakech' ? 'selected' : ''; ?>>Marrakech</option>
<option value="Meknes" <?php echo isset($_POST['city']) && $_POST['city'] == 'Meknes' ? 'selected' : ''; ?>>Meknes</option>
<option value="Nador" <?php echo isset($_POST['city']) && $_POST['city'] == 'Nador' ? 'selected' : ''; ?>>Nador</option>
<option value="Ouarzazate" <?php echo isset($_POST['city']) && $_POST['city'] == 'Ouarzazate' ? 'selected' : ''; ?>>Ouarzazate</option>
<option value="Oujda" <?php echo isset($_POST['city']) && $_POST['city'] == 'Oujda' ? 'selected' : ''; ?>>Oujda</option>
<option value="Rabat" <?php echo isset($_POST['city']) && $_POST['city'] == 'Rabat' ? 'selected' : ''; ?>>Rabat</option>
<option value="Safi" <?php echo isset($_POST['city']) && $_POST['city'] == 'Safi' ? 'selected' : ''; ?>>Safi</option>
<option value="Settat" <?php echo isset($_POST['city']) && $_POST['city'] == 'Settat' ? 'selected' : ''; ?>>Settat</option>
<option value="Tanger" <?php echo isset($_POST['city']) && $_POST['city'] == 'Tanger' ? 'selected' : ''; ?>>Tangier</option>
<option value="Taza" <?php echo isset($_POST['city']) && $_POST['city'] == 'Taza' ? 'selected' : ''; ?>>Taza</option>
<option value="Tétouan" <?php echo isset($_POST['city']) && $_POST['city'] == 'Tétouan' ? 'selected' : ''; ?>>Tétouan</option>
<option value="Taroudant" <?php echo isset($_POST['city']) && $_POST['city'] == 'Taroudant' ? 'selected' : ''; ?>>Taroudant</option>
<option value="Tiznit" <?php echo isset($_POST['city']) && $_POST['city'] == 'Tiznit' ? 'selected' : ''; ?>>Tiznit</option>

</select>


                <button class="btn" type="submit" name="getWeather">Get Weather</button>
            </form>
            <div id="result">
                <?php
                if (isset($_POST['getWeather'])) {
                    $city = $_POST['city'];
                    $apikey = '1a77cb1d5282381d74572491dd3fa68e';
                    $url = "http://api.openweathermap.org/data/2.5/weather?q=$city,MA&APPID=$apikey&units=metric";

                    // Initialize cURL
                    $request = curl_init();
                    curl_setopt($request, CURLOPT_URL, $url);
                    curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($request);
                    curl_close($request);

                    if ($response) {
                        $data = json_decode($response, true);

                        if (isset($data['main'])) {
                            $main = $data['main'];
                            $temp = $main['temp'];
                            $humidity = $main['humidity'];
                            $wind = $data['wind']['speed'];
                            $description = $data['weather'][0]['description'];

                            echo '<table class="weather-table">';
                            echo '<tr><th>City</th><td>' . $city . '</td></tr>';
                            echo '<tr><th>Temperature</th><td>' . $temp . ' °C</td></tr>';
                            echo '<tr><th>Humidity</th><td>' . $humidity . ' %</td></tr>';
                            echo '<tr><th>Wind Speed</th><td>' . $wind . ' m/s</td></tr>';
                            echo '<tr><th>Weather</th><td>' . $description . '</td></tr>';
                            echo '</table>';
                
                            if ($temp > 20) {
                                echo '<div class="weather-icon">☀️</div>';
                            } elseif ($temp >= 10 && $temp <= 20) {
                                echo '<div class="weather-icon">⛅</div>';
                            } elseif ($temp >= 0 && $temp < 10) {
                                echo '<div class="weather-icon">☁️</div>';
                            } elseif ($temp < 0) {
                                echo '<div class="weather-icon">❄️</div>';
                            }

                        } else {
                            echo "Cannot find the weather for this city.";
                        }
                    } else {
                        echo "Unable to fetch weather data. Please try again.";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
