import React, { useState } from "react";

const CalculateLTE = () => {
  const [bandwidth, setBandWidth] = useState("");
  const [frequency, setFrequency] = useState("");
  const [frequencyOption, setFrequencyOption] = useState("");
  const [distanceFromAnteena, setDistanceFromAnteena] = useState("");
  const [cyclicMode, setCyclicMode] = useState("");
  const [transmissionPower, setTransmissionPower] = useState("");

  const calculateLTEDownloadLinkThrough = (e) => {
    e.preventDefault();
    var frequencyInGhz;
    var numberOfSubCarriers;
    var oFDMSymbol;
    var lossCalculator;
    var SINR;
    var modulation;
    var bitsPerSecond;

    console.log(bandwidth);
    console.log(frequency);
    console.log(frequencyOption);
    console.log(distanceFromAnteena);
    console.log(cyclicMode);
    console.log(transmissionPower);

    //checking the idal transmission power
    if (transmissionPower > 42) {
      alert(
        "The transmission Power can't be greater than 42 dBm for the practical calculations"
      );
      return;
    }
    //testing out data extracted from the form

    //checking the bandwidth to get the number of subCarriers
    if (bandwidth === "1.4MHz") {
      numberOfSubCarriers = 72;
    } else if (bandwidth === "3MHz") {
      numberOfSubCarriers = 180;
    } else if (bandwidth === "5MHz") {
      numberOfSubCarriers = 300;
    } else if (bandwidth === "10MHz") {
      numberOfSubCarriers = 600;
    } else if (bandwidth === "15MHz") {
      numberOfSubCarriers = 900;
    } else {
      numberOfSubCarriers = 1200;
    }
    console.log(
      `Bandwidtih and numbe rof sub carries ${bandwidth} ${numberOfSubCarriers}`
    );

    //Converting if the frequency is in HMz in GHZ;
    if (frequencyOption === "HMz") {
      frequencyInGhz = frequency / 1000;
    } else {
      frequencyInGhz = frequency;
    }

    //checking the cyclic mode to assign the OFDM symbols
    if (cyclicMode === "Normal") {
      oFDMSymbol = 7;
    } else {
      oFDMSymbol = 6;
    }
    console.log("Cyclic mode is");
    console.log(`${cyclicMode} ${oFDMSymbol}`);
    var noise = 100;

    lossCalculator = parseFloat(
      20 * Math.log10(distanceFromAnteena) +
        20 * Math.log10(frequencyInGhz * 1000) +
        32.5
    );
    console.log(`Checking the value for loss function ${lossCalculator}`);
    SINR = parseFloat(transmissionPower - lossCalculator) + parseFloat(noise);
    //checking the range of SINR for getting the Modulation;
    if (SINR < -6.936) {
      alert("Error can't compute the value.");
      return;
    } else if (SINR >= -6.936 && SINR <= 2.699) {
      modulation = "QPSK";
    } else if (SINR > 2.699 && SINR <= 8.573) {
      modulation = "16QAM";
    } else if (SINR > 8.573 && SINR <= 19.829) {
      modulation = "64QAM";
    } else {
      //as per the given data the value higher than 19.8290 are computed as 256QAM modulation
      modulation = "256QAM";
    }

    //setting the bits for the modulation
    if (modulation === "QPSK") {
      bitsPerSecond = 2;
    } else if (modulation === "16QAM") {
      bitsPerSecond = 5;
    } else if (modulation === "64QAM") {
      bitsPerSecond = 6;
    } else if (modulation === "128QAM") {
      bitsPerSecond = 7;
    } else if (modulation === "256AM") {
      bitsPerSecond = 8;
    }

    console.log(`The value of SINR is ${SINR}`);

    // For 20 MHZ we have  1200 sub carries

    // 1- sub carries during 0.5ms =  6 for extended per ts and 7 for normal   = 6*8 = 48bits --oFDMSymbol
    // 256QAM = 8 bits ---bitsPerSecond
    //  1 sub carrieers during 1 sec = 48 bit *1/(0.5 *10^-3) = 1188000/8000 bits
    // I thorougput = 1200 *96 kb/sec
    // I thouput = 115.2 Mb/s

    var downlinkThroughput = parseFloat(
      ((bitsPerSecond * oFDMSymbol * (1 / (0.5 * Math.pow(10, -3)))) /
        1000000) *
        numberOfSubCarriers
    );
    alert(
      `The value of downlink Throughput value in under given condition is ${downlinkThroughput} mbps`
    );
    console.log(
      `The value of  LTE downLinkThrough is ${downlinkThroughput} Mbps`
    );
  };

  return (
    <form onSubmit={calculateLTEDownloadLinkThrough}>
      <label>
        <h3>please select the desired Bandwidth</h3>

        <select
          value={bandwidth}
          onChange={(e) => setBandWidth(e.target.value)}
          required
        >
          <option value="1.4MHz">1.4MHz</option>
          <option value="3MHz">3MHz</option>
          <option value="5MHz">5MHz</option>
          <option value="10MHz">10MHz</option>
          <option value="15MHz">15MHz</option>
          <option value="20MHz">20MHz</option>
        </select>
      </label>

      <label>
        <h3> `Please enter the desired Frequency`</h3>
        <input
          type="number"
          value={frequency}
          onChange={(e) => setFrequency(e.target.value)}
          required
        />
      </label>
      <div className="frequencyRadioButton">
        <label>
          <h3>Select the type of frequency</h3>
          <h4>MHZ</h4>
          <input
            type="radio"
            value="MHz"
            checked={frequencyOption === "MHz"}
            onChange={() => setFrequencyOption("MHz")}
          />
        </label>

        <label>
          <h4>GHZ</h4>
          <input
            type="radio"
            value="GHz"
            checked={frequencyOption === "GHz"}
            onChange={() => setFrequencyOption("GHz")}
          />
        </label>
      </div>

      <label>
        <h3>please Enter the distance from the anteena in KM</h3>
        <input
          type="number"
          value={distanceFromAnteena}
          onChange={(e) => setDistanceFromAnteena(e.target.value)}
          required
        />
      </label>

      <label>
        <h3>please select the type of the cyclic mode</h3>
        <select
          value={cyclicMode}
          onChange={(e) => setCyclicMode(e.target.value)}
          required
        >
          <option value="Normal">Normal Cyclic Mode</option>
          <option value="Extended">Extended Cyclic Mode</option>
        </select>
      </label>
      <label>
        <h3>please enter the transmission power in dbm</h3>
        <input
          type="number"
          value={transmissionPower}
          onChange={(e) => setTransmissionPower(e.target.value)}
          required
        />
      </label>
      <button type="submit">calcuate</button>
    </form>
  );
};
export default CalculateLTE;
