const axios = require('axios');
require('dotenv').config();

const API_KEY = process.env.API_KEY;
const BASE_URL = 'https://api.openweathermap.org/data/2.5/weather';

exports.getWeatherByCity = async (city) => {
  const url = `${BASE_URL}?q=${city},ua&appid=${API_KEY}&units=metric`;
  const response = await axios.get(url);
  return response.data;
};

exports.getWeatherByCoordinates = async (lat, lon) => {
  const url = `${BASE_URL}?lat=${lat}&lon=${lon}&appid=${API_KEY}&units=metric`;
  const response = await axios.get(url);
  return response.data;
};