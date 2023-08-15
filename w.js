// Name: Nabin Kharel
// University ID: 2358188
// College ID: np03cs4s230151

if (localStorage.date_time != null && parseInt(localStorage.date_time) + 10000 > Date.now()) {
  document.querySelector(".cityName").innerText = localStorage.cityName;
  document.querySelector(".temperature").innerText = localStorage.temperature;
  document.querySelector(".pressure").innerText = "Pressure: " + localStorage.pressure + " hPa";
  document.querySelector(".humidity").innerText = "Humidity: " + localStorage.humidity + "%";
  document.querySelector(".wind").innerText = "Wind Speed: " + localStorage.windSpeed + " m/s";
  document.querySelector(".Direction").innerText = "Wind Direction: " + localStorage.winddirection + "°";
} else {
  let url = "http://localhost/p2.php";

  fetch(url)
    .then((response) => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then((obj) => {
      localStorage.clear();
      localStorage.setItem("cityName", obj.city);
      localStorage.setItem("humidity", obj.humidity);
      localStorage.setItem("windSpeed", obj.wind);
      localStorage.setItem("winddirection", obj.Direction);
      localStorage.setItem("pressure", obj.pressure);
      localStorage.setItem("temperature", obj.temperature);
      localStorage.setItem("date_time", Date.now());

      let cityName = localStorage.cityName;
      let temperature = localStorage.temperature;
      let humidity = localStorage.humidity;
      let pressure = localStorage.pressure;
      let windSpeed = localStorage.windSpeed;
      let Direction = localStorage.winddirection;

      document.querySelector(".cityName").innerText = 'The Weather of ' + cityName;
      document.querySelector(".temperature").innerText = temperature + "° C";
      document.querySelector(".pressure").innerText = "Pressure: " + pressure + " hPa";
      document.querySelector(".humidity").innerText = "Humidity: " + humidity + "%";
      document.querySelector(".wind").innerText = "Wind Speed: " + windSpeed + " m/s";
      document.querySelector(".Direction").innerText = "Wind Direction: " + Direction + "°";
    })
    .catch(err => {
      console.log(err);
    });
}
 