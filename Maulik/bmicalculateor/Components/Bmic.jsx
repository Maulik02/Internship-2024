import React, { useState } from 'react';

function BMIC() {
  // State
  const [weight, setWeight] = useState(0);
  const [height, setHeight] = useState(0);
  const [weightUnit, setWeightUnit] = useState('lbs');
  const [heightUnit, setHeightUnit] = useState('in');
  const [gender, setGender] = useState('male');
  const [bmi, setBmi] = useState('');
  const [message, setMessage] = useState('');

  const calcBmi = (event) => {
    // Prevent submitting
    event.preventDefault();

    if (weight === 0 || height === 0) {
      alert('Please enter a valid weight and height');
    } else {
      let convertedWeight = weight;
      let convertedHeight = height;

      // Convert weight to lbs if in kg
      if (weightUnit === 'kg') {
        convertedWeight = weight * 2.20462;
      }

      // Convert height to inches if in cm
      if (heightUnit === 'cm') {
        convertedHeight = height * 0.393701;
      }

      let bmi = (convertedWeight / (convertedHeight * convertedHeight)) * 703;
      setBmi(bmi.toFixed(1));

      // Logic for message
      if (bmi < 18.5) {
        setMessage('You are underweight');
      } else if (bmi >= 18.5 && bmi < 24.9) {
        setMessage('You are a healthy weight');
      } else {
        setMessage('You are overweight');
      }
    }
  };

  // Show image based on BMI calculation
  let imgSrc;

  if (bmi < 1) {
    imgSrc = null;
  } else {
    if (bmi < 18.5) {
      imgSrc = gender === 'male' ? '../image/underweight_boy.png' : '../image/underweight_girl.png';
    } else if (bmi >= 18.5 && bmi < 24.9) {
      imgSrc = gender === 'male' ? '../image/healthy_boy.png' : '../image/healthy_girl.png';
    } else {
      imgSrc = gender === 'male' ? '../image/overweight_boy.png' : '../image/overweight_girl.png';
    }
  }

  const reload = () => {
    window.location.reload();
  };

  return (
    <div className="app">
      <div className="container">
        <h2 className="center">BMI Calculator</h2>
        <form onSubmit={calcBmi}>
          <div>
            <label>Gender</label>
            <select
              value={gender}
              onChange={(e) => setGender(e.target.value)}
            >
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
          </div>
          <div>
            <label>Weight</label>
            <input
              type="number"
              value={weight}
              onChange={(e) => setWeight(e.target.value)}
            />
            <select
              value={weightUnit}
              onChange={(e) => setWeightUnit(e.target.value)}
            >
              <option value="lbs">lbs</option>
              <option value="kg">kg</option>
            </select>
          </div>
          <div>
            <label>Height</label>
            <input
              type="number"
              value={height}
              onChange={(e) => setHeight(e.target.value)}
            />
            <select
              value={heightUnit}
              onChange={(e) => setHeightUnit(e.target.value)}
            >
              <option value="in">in</option>
              <option value="cm">cm</option>
            </select>
          </div>
          <div>
            <button className="btn" type="submit">Submit</button>
            <button className="btn btn-outline" onClick={reload} type="button">Reload</button>
          </div>
        </form>

        <div className="center">
          <h3>Your BMI is: {bmi}</h3>
          <p>{message}</p>
        </div>

        <div className="img-container">
          <img src={imgSrc} alt="" />
        </div>
      </div>
    </div>
  );
}

export default BMIC;
