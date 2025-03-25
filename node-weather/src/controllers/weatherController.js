const weatherService = require('../services/weatherService');

exports.getHomePage = (req, res) => {
  res.render('index');
};

exports.getWeatherByCity = async (req, res) => {
  const city = req.params.city;
  try {
    const weatherData = await weatherService.getWeatherByCity(city);
    res.render('weather', { weather: weatherData });
  } catch (error) {
    res.status(500).send('Error fetching weather data');
  }
};

exports.getWeatherByLocation = async (req, res) => {
  const lat = req.query.lat;
  const lon = req.query.lon;
  try {
    if (lat && lon) {
      const weatherData = await weatherService.getWeatherByCoordinates(lat, lon);
      res.render('weather', { weather: weatherData });
    } else {
      res.render('weather', { weather: null });
    }
  } catch (error) {
    res.status(500).send('Error fetching weather data');
  }
};