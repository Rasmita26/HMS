<?php
$base='../../';
include($base."_in/header.php");
include($base."_in/connect.php");
$con=_connect();
?>
<style>
  * {
    font-family: -apple-system, BlinkMacSystemFont, "San Francisco", Helvetica, Arial, sans-serif;
    font-weight: 300;
    margin: 0;
  }

  /* html, body {
  height: 100vh;
  width: 100vw;
  margin: 0 0;
  display: flex;
  align-items: flex-start;
  justify-content: flex-start;
  background: #f3f2f2;
} */
  h4 {
    font-size: 24px;
    font-weight: 600;
    color: #000;
    opacity: 0.85;
  }

  label {
    font-size: 12.5px;
    color: #000;
    opacity: 0.8;
    font-weight: 400;
  }

  form {
    padding: 40px 30px;
    background: #fefefe;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    padding-bottom: 20px;
    width: 300px;
  }

  form h4 {
    margin-bottom: 20px;
    color: rgba(0, 0, 0, 0.5);
  }

  form h4 span {
    color: black;
    font-weight: 700;
  }

  form p {
    line-height: 155%;
    margin-bottom: 5px;
    font-size: 14px;
    color: #000;
    opacity: 0.65;
    font-weight: 400;
    max-width: 200px;
    margin-bottom: 40px;
  }

  a.discrete {
    color: rgba(0, 0, 0, 0.4);
    font-size: 14px;
    border-bottom: solid 1px rgba(0, 0, 0, 0);
    padding-bottom: 4px;
    margin-left: auto;
    font-weight: 300;
    transition: all 0.3s ease;
    margin-top: 40px;
  }

  a.discrete:hover {
    border-bottom: solid 1px rgba(0, 0, 0, 0.2);
  }

  button {
    -webkit-appearance: none;
    width: auto;
    min-width: 100px;
    border-radius: 24px;
    text-align: center;
    padding: 15px 40px;
    /* margin-top: 5px; */
    background-color: #b08bf8;
    color: #fff;
    font-size: 14px;
    /* margin-left: auto; */
    font-weight: 500;
    box-shadow: 0px 2px 6px -1px rgba(0, 0, 0, 0.13);
    border: none;
    transition: all 0.3s ease;
    outline: 0;
  }

  /* button:hover {
    transform: translateY(-3px);
    box-shadow: 0 2px 6px -1px rgba(182, 157, 230, 0.65);
  }

  button:hover:active {
    transform: scale(0.99);
  } */

  input {
    font-size: 16px;
    padding: 20px 0px;
    height: 56px;
    border: none;
    border-bottom: solid 1px rgba(0, 0, 0, 0.1);
    background: #fff;
    width: 280px;
    box-sizing: border-box;
    transition: all 0.3s linear;
    color: #000;
    font-weight: 400;
    -webkit-appearance: none;
  }

  input:focus {
    border-bottom: solid 1px #b69de6;
    outline: 0;
    box-shadow: 0 2px 6px -8px rgba(182, 157, 230, 0.45);
  }

  .floating-label {
    position: relative;
    margin-bottom: 10px;
    width: 100%;

  }

  .floating-label label {
    position: absolute;
    top: calc(50% - 7px);
    left: 0;
    opacity: 0;
    transition: all 0.3s ease;
    padding-left: 44px;
  }

  .floating-label input {
    width: calc(100% - 44px);
    margin-left: auto;
    display: flex;
  }

  .floating-label .icon {
    position: absolute;
    top: 0;
    left: 0;
    height: 56px;
    width: 44px;
    display: flex;
  }

  .floating-label .icon svg {
    height: 30px;
    width: 30px;
    margin: auto;
    opacity: 0.15;
    transition: all 0.3s ease;
  }

  /* .floating-label .icon svg path {
    transition: all 0.3s ease;
  } */

  .floating-label input:not(:placeholder-shown) {
    padding: 28px 0px 12px 0px;
  }

  .floating-label input:not(:placeholder-shown)+label {
    transform: translateY(-10px);
    opacity: 0.7;
  }

  .floating-label input:valid:not(:placeholder-shown)+label+.icon svg {
    opacity: 1;
  }

  .floating-label input:valid:not(:placeholder-shown)+label+.icon svg path {
    fill: #b69de6;
  }

  .floating-label input:not(:valid):not(:focus)+label+.icon {
    animation-name: shake-shake;
    animation-duration: 0.3s;
  }

  @keyframes shake-shake {
    0% {
      transform: translateX(-3px);
    }

    20% {
      transform: translateX(3px);
    }

    40% {
      transform: translateX(-3px);
    }

    60% {
      transform: translateX(3px);
    }

    80% {
      transform: translateX(-3px);
    }

    100% {
      transform: translateX(0px);
    }
  }

  .session {
    display: flex;
    flex-direction: row;
    width: 70%;
    height: auto;
    margin: auto auto;
    background: #ffffff;
    border-radius: 4px;
    box-shadow: 0px 2px 6px -1px rgba(0, 0, 0, 0.12);
  }

  .left {
    width: 1500px;
    height: auto;
    min-height: 100%;
    position: relative;
    background-image: url("/images/signup-img1.jpg");
    background-size: cover;
    /* border-top-left-radius: 4px;
    border-bottom-left-radius: 4px; */
  }

  /* .left svg {
    height: 40px;
    width: auto;
    margin: 20px;
  } */
</style>
<div class="main-content">
  <div class="title"> Patient Registration Form</div>
  <div style="margin-top:8px">
    <div class="session">
      <div class="left">
        <!-- <?xml version="1.0" encoding="UTF-8"?>
        <svg enable-background="new 0 0 300 302.5" version="1.1" viewBox="0 0 300 302.5" xml:space="preserve"
          xmlns="http://www.w3.org/2000/svg">
          <style type="text/css">
            .st01 {
              fill: #fff;
            }
          </style>
          <path class="st01"
            d="m126 302.2c-2.3 0.7-5.7 0.2-7.7-1.2l-105-71.6c-2-1.3-3.7-4.4-3.9-6.7l-9.4-126.7c-0.2-2.4 1.1-5.6 2.8-7.2l93.2-86.4c1.7-1.6 5.1-2.6 7.4-2.3l125.6 18.9c2.3 0.4 5.2 2.3 6.4 4.4l63.5 110.1c1.2 2 1.4 5.5 0.6 7.7l-46.4 118.3c-0.9 2.2-3.4 4.6-5.7 5.3l-121.4 37.4zm63.4-102.7c2.3-0.7 4.8-3.1 5.7-5.3l19.9-50.8c0.9-2.2 0.6-5.7-0.6-7.7l-27.3-47.3c-1.2-2-4.1-4-6.4-4.4l-53.9-8c-2.3-0.4-5.7 0.7-7.4 2.3l-40 37.1c-1.7 1.6-3 4.9-2.8 7.2l4.1 54.4c0.2 2.4 1.9 5.4 3.9 6.7l45.1 30.8c2 1.3 5.4 1.9 7.7 1.2l52-16.2z" />
        </svg> -->
      </div>
      <div>
        <!-- <form action="" class="log-in" autocomplete="off"> -->
        <div class="col-sm-6">
          <div class="floating-label">
            <input placeholder="Registration Date" type="text" id="registration_date" autocomplete="off">
            <label>Registration Date</label>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="floating-label">
            <input placeholder="UHID No." type="text" id="uhid_no" autocomplete="off">
            <label>UHID No.</label>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="floating-label">
            <input placeholder="Patient Name" type="text" id="patient_name" autocomplete="off">
            <label>Patient Name</label>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="floating-label">
            <input placeholder="Relative Name" type="text" id="relative_name" autocomplete="off">
            <label>Relative Name</label>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="floating-label">
            <input placeholder="Gender" type="text" id="gender" autocomplete="off">
            <label>Gender</label>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="floating-label">
            <input placeholder="Address" type="text" id="address" autocomplete="off">
            <label>Address</label>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="floating-label">
            <input placeholder="Mobile No" type="text" id="mobileno1" autocomplete="off">
            <label>Mobile No.1</label>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="floating-label">
            <input placeholder="Mobile No" type="text" id="mobileno2" autocomplete="off">
            <label>Mobile No.2</label>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="floating-label">
            <input placeholder="DOB" type="text" id="dob" autocomplete="off" onchange="calculate_age()">
            <label>DOB</label>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="floating-label">
            <input placeholder="Age" type="text" id="age" autocomplete="off">
            <label>Age</label>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="floating-label">
            <input placeholder="Consulting Doctor" type="text" id="consulting_doctor" autocomplete="off">
            <label>Consulting Doctor</label>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="floating-label">
            <input placeholder="Reffered By" type="text" id="reffered_by" autocomplete="off">
            <label>Reffered By</label>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="floating-label">
            <input placeholder="Disease" type="text" id="disease" autocomplete="off">
            <label>Disease</label>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="floating-label">
            <input placeholder="Type" type="text" id="type" autocomplete="off">
            <label>Type</label>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="floating-label">
            <input placeholder="Deposit" type="text" id="deposit" autocomplete="off">
            <label>Deposit</label>
          </div>
        <br></div>
        <div class="col-sm-6">
        <div class="margin-left:50%">
        <button type="submit">Log in</button>
        </div>
        </div>
        <!-- </form> -->
      </div>
    </div>
  </div>

</div>
<?php 
include($base."_in/footer.php");
?>