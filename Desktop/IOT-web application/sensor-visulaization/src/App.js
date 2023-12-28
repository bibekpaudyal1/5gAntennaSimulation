import React, { useEffect, useState } from "react";
import {
  LineChart,
  Line,
  CartesianGrid,
  XAxis,
  YAxis,
  Tooltip,
} from "recharts";

function App() {
  const [temperatureData, setTemperatureData] = useState([]);
  const [currentData, setCurrentData] = useState(null);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await fetch(
          "http://localhost:8000/api/sensorData/logic"
        );
        const data = await response.json();

        const updatedTemperatureData = data.data.map((item) => ({
          name: new Date(item.dataandTime).toLocaleString(),
          temperature: item.temperature,
          humidity: item.humidity,
          amt: 0,
        }));

        setTemperatureData(updatedTemperatureData);

        if (updatedTemperatureData.length > 0) {
          setCurrentData(
            updatedTemperatureData[updatedTemperatureData.length - 1]
          );
        }
      } catch (error) {
        console.error("Error fetching temperature data:", error);
        setTimeout(fetchData, 2000);
      }
    };

    fetchData();
    const intervalId = setInterval(fetchData, 5000);
    return () => clearInterval(intervalId);
  }, []);

  return (
    <div>
      <div>
        {currentData && (
          <div>
            <h2>Current Data:</h2>
            <p>Time: {currentData.name}</p>
            <p>Temperature: {currentData.temperature}</p>
            <p>Humidity: {currentData.humidity}</p>
          </div>
        )}
      </div>
      <h1>The temperature and humidity data stats</h1>
      <LineChart
        width={1800}
        height={800}
        data={temperatureData}
        margin={{ top: 5, right: 20, bottom: 5, left: 0 }}
      >
        <Line type="monotone" dataKey="temperature" stroke="#8884d8" />
        <Line type="monotone" dataKey="humidity" stroke="#82ca9d" />
        <CartesianGrid stroke="#ccc" strokeDasharray="5 5" />
        <XAxis dataKey="name" />
        <YAxis />
        <Tooltip />
      </LineChart>
    </div>
  );
}

export default App;
