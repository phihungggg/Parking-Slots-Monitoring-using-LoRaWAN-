<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset='utf-8'>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, shrink-to-fit=no">

  <title>Parking lot </title>
  <meta name="description" content="Parking Lot - Register and Get your Parking Slot.">
  <meta name="author" content="Liyas Thomas">

  <!-- Bootstrap core CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.min.css">
 
  <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:700,900&display=swap" rel="stylesheet">


  <style>

    * {
      box-sizing: border-box;
      -webkit-tap-highlight-color: transparent;
      outline: 0;
      border: 0;
    }
    
    body {
      font-family: 'Nunito Sans', sans-serif;
      font-size: 16px;
      background-color: #eee;
      color: rgba(0, 0, 0, 0.6);
      font-weight: 700;
    }
    
    h1,
    h2,
    h3,
    h4,
    label {
      font-weight: 900;
    }
    
    .hide {
      display: none;
    }
    
    .starter-template {
      margin: 32px auto;
      padding: 32px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
      border-radius: 16px;
      background-color: #fff;
      display: flex;
      flex-direction: column;
    }
    
   
    
    .page-header-extended {
      padding-bottom: 9px;
      margin: 40px 0 20px;
    }
    
    
    
   
    .page-title {
      text-align: center;
      color: #b2b2b2;
      font-weight: 900;
    }
    
    .btn {
      margin: 2px;
      padding: 4px 16px;
      border-radius: 16px;
    }
    
  
    
  
    
    
    table {
      border: 1px solid #dee2e6;
      border-spacing: 0;
      border-collapse: separate;
      border-radius: 16px;
    }
    
    td,
    th {
      border-top: 1px solid #dee2e6;
      border-left: 1px solid #dee2e6;
    }
    
    th {
      border-top: 0 !important;
      border-bottom: 0 !important;
    }
    
    td:first-child,
    th:first-child {
      border-left: 0;
    }
    
    .table tr th,
    .table tr td {
      vertical-align: middle;
    }
    
    
 
    

    
  
    
    .center {
      text-align: center;
    }
    
    input[data-readonly] {
      pointer-events: none;
    }
    
    @media all and (max-width: 720px) {
      .table {
        display: flex;
        flex-direction: column;
      }
    
      .table tr {
        width: 100%;
      }
    
      .table tr th,
      .table tr td {
        display: inline-flex;
        width: 100%;
      }
    }
    
    
    </style>
@vite('resources/js/app.js')

</head>
<body>
  
  <div class="container">
    <div class="page-header-extended">
      <h4 class="page-title">Parking lot </h4>
     
    </div>
   
    <div class="starter-template">
      <div class="info-table-header-block">
        <label for="date_picker">Select Date:</label>
        <input type="text" id="date_picker" class="form-control" placeholder="Select a date">
       

        <label for="from_time">From Time:</label>
        <select id="from_time" class="form-control">
          <option value="none">none</option>
          <option value="00:00">00:00</option>
          <option value="01:00">01:00</option>
          <option value="02:00">02:00</option>
          <option value="03:00">03:00</option>
          <option value="04:00">04:00</option>
          <option value="05:00">05:00</option>
          <option value="06:00">06:00</option>
          <option value="07:00">07:00</option>
          <option value="08:00">08:00</option>
          <option value="09:00">09:00</option>
          <option value="10:00">10:00</option>
          <option value="11:00">11:00</option>
          <option value="12:00">12:00</option>
          <option value="13:00">13:00</option>
          <option value="14:00">14:00</option>
          <option value="15:00">15:00</option>
          <option value="16:00">16:00</option>
          <option value="17:00">17:00</option>
          <option value="18:00">18:00</option>
          <option value="19:00">19:00</option>
          <option value="20:00">20:00</option>
          <option value="21:00">21:00</option>
          <option value="22:00">22:00</option>
          <option value="23:00">23:00</option>
        </select>

        <label for="to_time">To Time:</label>
        <select id="to_time" class="form-control">
          <option value="none">none</option>
          <option value="00:00">00:00</option>
          <option value="01:00">01:00</option>
          <option value="02:00">02:00</option>
          <option value="03:00">03:00</option>
          <option value="04:00">04:00</option>
          <option value="05:00">05:00</option>
          <option value="06:00">06:00</option>
          <option value="07:00">07:00</option>
          <option value="08:00">08:00</option>
          <option value="09:00">09:00</option>
          <option value="10:00">10:00</option>
          <option value="11:00">11:00</option>
          <option value="12:00">12:00</option>
          <option value="13:00">13:00</option>
          <option value="14:00">14:00</option>
          <option value="15:00">15:00</option>
          <option value="16:00">16:00</option>
          <option value="17:00">17:00</option>
          <option value="18:00">18:00</option>
          <option value="19:00">19:00</option>
          <option value="20:00">20:00</option>
          <option value="21:00">21:00</option>
          <option value="22:00">22:00</option>
          <option value="23:00">23:00</option>
        </select>


        <button class="btn btn-primary mt-2" id="filter_button" onclick="filter_occupies_history()">Filter</button>
      </div>

      

      <div class="info-table-header-block">
    
      </div>
     
      <table id="member_table" class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>
              <a href="#" onclick="sortBy('reg_no')">Slot id</a>
            </th>
            <th>
              <a href="#" onclick="sortBy('owner_name')">Slot name</a>
            </th>
            <th>
              <a href="#" onclick="sortBy('email')">Come at</a>
            </th>
            <th>
              <a href="#" onclick="sortBy('d_o_a')">Leave at</a>
            </th>
            
           
          </tr>
        </thead>
      </table>
      
    
    </div>
  </div>



  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
  <script  type="module" > 

    window.slot_occupied= @json($slot_occupied)

    console.log('cmm');
    console.log(window.slot_occupied);
    
   

      </script>
  <script type="module" src="js/app2.js">
  
 
  </script>
  

<script type="module">
  import { merge_socket_data_and_database_data } from './js/app2.js';
   window.onload=function() {
      Echo.private('Admin.12')
    .listen('Send_parking_history', (event) => {
      console.log('listen var');
        window.listen_var=event;
        console.log(window.listen_var);
        merge_socket_data_and_database_data();
     // console.log('event private channel');
     // console.log(event);


    });}
  
</script>


<script type="module">
  import { filter_occupies_history } from './js/app2.js';

window.filter_occupies_history= filter_occupies_history;
</script>


<script>
  document.addEventListener("DOMContentLoaded", function () {
  const fromTimeSelect = document.getElementById("from_time");
  const toTimeSelect = document.getElementById("to_time");

  // Lắng nghe sự kiện thay đổi trên from_time
  fromTimeSelect.addEventListener("change", function () {
    const fromTimeValue = fromTimeSelect.value;

    // Nếu từ time là "none", thì to time cũng là "none"
   

    // Tính giá trị bắt đầu cho to_time (from_time + 1 giờ)
    const fromTimeParts = fromTimeValue.split(":"); // Tách giờ và phút
    const fromTimeHour = parseInt(fromTimeParts[0], 10);
    const nextHour = (fromTimeHour + 1) % 24; // Thêm 1 giờ, đảm bảo không vượt quá 23 giờ
    const nextTime = `${nextHour.toString().padStart(2, "0")}:00`;

    // Xóa tất cả các tùy chọn hiện tại của to_time
    while (toTimeSelect.options.length > 0) {
      toTimeSelect.remove(0);
    }
    
    // Lấy danh sách các tùy chọn mới
    const timeOptions = [
      "00:00", "01:00", "02:00", "03:00", "04:00", "05:00", "06:00",
      "07:00", "08:00", "09:00", "10:00", "11:00", "12:00", "13:00",
      "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00",
      "21:00", "22:00", "23:00",
    ];
    // Thêm các tùy chọn vào to_time, bắt đầu từ (from_time + 1 giờ) trở đi
    const filteredOptions = timeOptions.filter((time) => time >= nextTime);
    filteredOptions.forEach((time) => {
      const option = document.createElement("option");
      option.value = time;
      option.textContent = time;
      toTimeSelect.appendChild(option);
    });
  });
});
</script>
<script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>

<script>
   // Globally initializes an mqtt variable
   console.log(mqtt);

const clientId = 'mqttjs_' + Math.random().toString(16).substr(2, 8);

// Thay đổi host sang WSS URL
const host = 'wss://9c5f236efa1d446c94d326c9a8b53a85.s1.eu.hivemq.cloud:8884/mqtt';

const options = {
  keepalive: 60,
  clientId: clientId,
  protocolId: 'MQTT',
  protocolVersion: 4,
  clean: true,
  reconnectPeriod: 1000, // Thời gian thử kết nối lại
  connectTimeout: 30 * 1000, // 30 giây
  username: 'chabietmatkhau', // Điền username nếu có
  password: 'Chabiettaikhoan123@', // Điền password nếu có
  will: {
    topic: 'WillMsg',
    payload: 'Connection Closed abnormally..!',
    qos: 0,
    retain: false
  }
};

console.log('Connecting to MQTT WebSocket Secure...');
const client = mqtt.connect(host, options);

client.on('connect', () => {
  console.log('Connected to HiveMQ Cloud via WSS');

  // Subscribe vào một topic
  client.subscribe('test/something', (err) => {
    if (!err) {
      console.log('Subscribed to topic: test/topic');

      // Gửi một tin nhắn lên topic
      client.publish('test/something', 'Hello MQTT over WSS');
    }
  });
});

client.on('error', (err) => {
  console.log('Connection error: ', err);
  client.end();
});

client.on('reconnect', () => {
  console.log('Reconnecting...');
});

client.on('message', (topic, message) => {
  console.log(`Received message from ${topic}: ${message.toString()}`);
});
</script>

</body>
</html>