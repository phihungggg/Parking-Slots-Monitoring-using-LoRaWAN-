<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Add a Map using HTML</title>
    <link rel="stylesheet" type="text/css" />
  
    <style>
        
        .body{
            font-family: 'Figtree', sans-serif;
            margin: 0;
            padding: 0;
            height: 100%;
            width: 120%
        }

        .flex {
            display: flex;
            flex-wrap: wrap;
        }

        /* Điều chỉnh cho màn hình desktop */
        #map {
            height: 100vh;
            width: 70%; /* 70% chiều rộng cho bản đồ */
           
        }

        #reservation-menu {
            width: 30%; /* 30% chiều rộng cho mục bên phải */
            background-color: #f0f0f0;
            box-shadow: 2px 0px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            box-sizing: border-box;
        }

     


        /* Điều chỉnh cho màn hình điện thoại */
        @media (max-width: 768px) {

            
            .reservation_and_login_out{

                display: flex; /* Kích hoạt Flexbox */
                gap: 1rem;
            }
            .what{
margin-left: 25px;

}


.logo {
        width: 100px; /* Thu nhỏ hơn trên màn hình nhỏ */
    }

            header {
                width: 100%; /* w-full: Chiều rộng đầy đủ */
    background-color: #0a0944; /* bg-[#0a0944]: Màu nền hex */
    color: white; /* text-white: Màu chữ trắng */
    padding: 1rem 1.5rem; /* py-4: 4 * 0.25rem = 1rem (trên/dưới), px-6: 6 * 0.25rem = 1.5rem (trái/phải) */
    display: flex; /* flex: Kích hoạt Flexbox */
    justify-content: space-between; /* justify-between: Khoảng cách đều giữa các phần tử con */
    align-items: center; /* items-center: Canh giữa theo trục ngang */
    border-bottom: 4px solid #22c55e;
    }

    header h1 {
        font-size: 20px; /* Giảm kích thước chữ */
        margin-bottom: 10px; /* Thêm khoảng cách dưới tiêu đề */
    }

    header nav ul {
        flex-direction: column; /* Chuyển danh sách sang cột */
        gap: 10px; /* Thêm khoảng cách giữa các mục menu */
    }

    header nav ul li {
        margin: 0;
        list-style: none;
    }

    header nav ul li a {
        font-size: 16px; /* Giảm kích thước font chữ */
        padding: 5px 10px; /* Thêm padding để dễ bấm */
    }
            #map {
                width: 100%; /* Bản đồ chiếm toàn bộ chiều rộng */
                height: 70rem; /* Giới hạn chiều cao bản đồ trên điện thoại */
            }

            #reservation-menu {
                width: 100%; /* Mục bên phải chiếm toàn bộ chiều rộng */
                box-shadow: none; /* Loại bỏ bóng cho thiết bị di động */
                padding: 10px;
                box-sizing: border-box;
            }

            #something button {
                margin-left: 0; /* Đặt lại khoảng cách nút trên điện thoại */
                margin-top: 10px; /* Thêm khoảng cách giữa các nút */
                display: block; /* Hiển thị nút theo dạng block để dễ dàng căn chỉnh */
                width: 100%; /* Chiếm toàn bộ chiều rộng của nút */
            }
        }

        /* Tùy chỉnh thêm cho các yếu tố khác, như nút bấm */
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Các mục trong reservation menu */
        h2 {
            margin-top: 0;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        select, input[type="datetime-local"], input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Nút đặt chỗ và tìm đường */
        #something button {
            margin-left: 0;
            margin-top: 10px;
            display: block;
            width: 100%;
        }


        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }
        .blinking {
            animation: blink 1s infinite;
        }


       
        @media (min-width: 768px) {

            .logo{

width: 200px; /* Bạn có thể thay đổi kích thước này */
height: auto; /* Giữ tỷ lệ hình ảnh */


}
        }
    </style>
  <!-- Leaflet CSS and JS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.css" />
  <script src="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.js"></script>

<!-- Leaflet Routing Machine CSS and JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

<!-- Geoapify Address Search Plugin CSS and JS -->
<link rel="stylesheet" href="https://unpkg.com/@geoapify/leaflet-address-search-plugin@^1/dist/L.Control.GeoapifyAddressSearch.min.css" />
<script src="https://unpkg.com/@geoapify/leaflet-address-search-plugin@^1/dist/L.Control.GeoapifyAddressSearch.min.js"></script>

<!-- Vite-generated JavaScript (if app.js imports anything related to Leaflet, it will be bundled correctly) -->
@vite('resources/js/app.js')

<script src="
https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.82.0/dist/L.Control.Locate.min.js
"></script>
<link href="
https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.82.0/dist/L.Control.Locate.min.css
" rel="stylesheet">


<!-- Fonts -->
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>
<body class="flex h-screen m-0 p-0 font-[Arial,_sans-serif]">
    <header class="w-full bg-[#0a0944] text-white py-4 px-6 flex justify-between items-center border-b-4 border-green-500" style="position: sticky; top: 0;  z-index: 99999;">
        <a href="/" > 
        <img src="{{ asset('images/Artboard22.png') }}" alt="Park Ease Logo" class= "logo w-200px">
    </a>
    <livewire:welcome.navigation />
    </header>


    <div id="map" class="h-full w-[70%]  " ></div>

    <div id="reservation-menu" class="w-[30%] p-[20px] bg-[#f0f0f0] box-shadow-[2px_0_5px_rgba(0,_0,_0,_0.1)]">
        <h2 class="mt-0">Reservation</h2>
        
        <div id="location-options">
            <div id="suggestions"></div>
            <button class="mt-[20px] p-[10px] bg-[#007BFF] text-[white] border-[none] rounded-[4px] cursor-pointer hover:bg-[#0056b3]" id="use-gps">Your current location</button>
        </div>

        <label class="block mt-[10px]" for="parking-slot">Select parking slot</label>
        <select id="parking-slot">
            <option value="slot0"> none </option>
            <option value="3_thang_2"> 3/2 </option>
            <option value="Ly_Thuong_Kiet">Ly Thuong Kiet</option>
            <option value="Nguyen_Kim">Nguyen Kim</option>
            <option value="Le_Dai_Hanh">Le Dai Hanh</option>
            <option value="Lu_Gia">Lu Gia</option>
            <option value="To_Hien_Thanh">To Hien Thanh</option>
        </select>

        
        <label class="block mt-[10px]" for="duration">Duration (hour):</label>
        <select
  class="w-full p-[8px] mt-[5px] border-[1px] border-[solid] border-[#ccc] rounded-[4px]"
  id="duration"
> <option value="0.016"> 1 minutes </option>
  <option value="1">1 hour</option>
  <option value="1.5">1 hour 30 minutes</option>
  <option value="2">2 hours</option>
  <option value="2.5">2 hours 30 minutes</option>
  <option value="3">3 hours</option>
  <option value="3.5">3 hours 30 minutes</option>
  <option value="4">4 hours</option>
</select>

        <div id="current_route_guiding">
            
        </div>
        <div id="nearest_parking_slot"></div>
        <div id="something" class="flex mt-[100px]">
            
            <button class="mt-[20px] p-[10px] bg-[#007BFF] text-[white] border-[none] rounded-[4px] cursor-pointer ml-[105px] hover:bg-[#0056b3]" type="button" onclick="reserveSpot()" >Reserve</button>
            <button class="mt-[20px] p-[10px] bg-[#007BFF] text-[white] border-[none] rounded-[4px] cursor-pointer ml-[105px] hover:bg-[#0056b3]" type="button" onclick="guiding_current_location()" >Show the way</button>
            <button class="mt-[20px] p-[10px] bg-[#007BFF] text-[white] border-[none] rounded-[4px] cursor-pointer ml-[105px] hover:bg-[#0056b3]" type="button" onclick="guiding_simulate()" >Show the way-(simulation)</button>
            <button class="mt-[20px] p-[10px] bg-[#007BFF] text-[white] border-[none] rounded-[4px] cursor-pointer ml-[105px] hover:bg-[#0056b3]" type="button" onclick="showing_nearest_parking_slot()">Show nearest parking slot</button>
        </div>
    </div>


    <script>
       
       var currentMarker = null;
var current_parkingslot;
var current_zoom;
var search_flag=0;
var search_lat;
var search_long;

var lot_status=1;


var currentRoute = null;

var waypoints = [];

var user_current_location_lat;
var user_current_location_long;
      var map = L.map('map').setView([ 10.771779135654299,106.65766122741186], 11);
		mapLink = "<a href='http://openstreetmap.org'>OpenStreetMap</a>";
		L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', { attribution: '© OpenStreetMap contributors', maxZoom: 18 }).addTo(map);

        L.control.locate().addTo(map);
//add icon
	
     


        var greenIcon = L.icon({
    iconUrl: '{{ asset('images/availableslot.png') }}',
    //shadowUrl: '{{ asset('images/availableslot.png') }}',

    iconSize:     [45, 45], // size of the icon
    shadowSize:   [50, 64], // size of the shadow
    iconAnchor:   [22, 45], // point of the icon which will correspond to marker's location
    shadowAnchor: [4, 62],  // the same for the shadow
    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
});


var redIcon = L.icon({
    iconUrl: '{{ asset('images/notavaiableslot.png') }}',

    iconSize:     [45, 45], // size of the icon
    shadowSize:   [50, 64], // size of the shadow
    iconAnchor:   [22, 45], // point of the icon which will correspond to marker's location
    shadowAnchor: [4, 62],  // the same for the shadow
    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
});

var yellowIcon = L.icon({
    iconUrl: '{{ asset('images/reservedslot.png') }}',

    iconSize:     [45, 45], // size of the icon
    shadowSize:   [50, 64], // size of the shadow
    iconAnchor:   [22, 45], // point of the icon which will correspond to marker's location
    shadowAnchor: [4, 62],  // the same for the shadow
    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
});

var HungIcon = L.icon({
    iconUrl: '{{ asset('images/hehe.jpg') }}',
    //shadowUrl: '{{ asset('images/availableslot.png') }}',

    iconSize:     [45, 45], // size of the icon
    shadowSize:   [50, 64], // size of the shadow
    iconAnchor:   [22, 45], // point of the icon which will correspond to marker's location
    shadowAnchor: [4, 62],  // the same for the shadow
    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
});

const slotsData = @json($slots);
console.log(slotsData);



function change_slot_status(location, status) {

    switch(status)
    {

        case 0:
        icon=redIcon;
        break;

        case 1 :
        icon=greenIcon;
        break;
        case 2 :
        icon=yellowIcon;
        break;
    }

   // const icon = status === 1 ? greenIcon : redIcon;
 
    location.setIcon(icon);
}


var markers = {
        "3_thang_2": L.marker([10.763723871833784, 106.65976955431256],{icon: greenIcon}).addTo(map),
        "Ly_Thuong_Kiet": L.marker([10.761078620733292, 106.66060917741723],{icon: greenIcon}).addTo(map),
        "Nguyen_Kim": L.marker([10.762378881477494, 106.66195345162645],{icon: greenIcon}).addTo(map),
        "Le_Dai_Hanh": L.marker([10.766211203146504, 106.6543467857687],{icon: greenIcon}).addTo(map),
        "Lu_Gia": L.marker([10.770669889748305, 106.65629512277314],{icon: greenIcon}).addTo(map),
        "To_Hien_Thanh": L.marker([10.774398028512875, 106.66200563634163],{icon: greenIcon}).addTo(map)
    };

    const parkingSlots = [
    { lat: 10.763723871833784, long: 106.65976955431256 }, // 3 thang 2
    { lat: 10.761078620733292, long: 106.66060917741723 }, // Ly_Thuong_Kiet
    { lat: 10.762378881477494, long: 106.66195345162645 }, // Nguyen_Kim
    { lat: 10.766211203146504, long: 106.6543467857687 }, // Le_Dai_Hanh
    { lat: 10.770669889748305, long: 106.65629512277314 }, // Lu_Gia
    { lat: 10.774398028512875, long: 106.66200563634163 }  // To_Hien_Thanh
];

function reserveSpot()
{ let duration;
if (TheSelectedSlot){
    duration=document.getElementById("duration").value;
        console.log(duration); 
    const data = {
            reservation: "reserve",

            slot : TheSelectedSlot-1,

            duration : duration
        };
        fetch('/map', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',  // Định dạng dữ liệu là JSON
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')  // CSRF token
            },
            body: JSON.stringify(data),  // Chuyển dữ liệu thành JSON
        })
        .then(response => response.json())  // Chuyển đổi dữ liệu JSON trả về
        .then(data => {
            console.log('slot_index', data.slot); 
            console.log('status', data.status);   // Hiển thị kết quả trả về
            console.log('Does change', data.doeschange );
            console.log('isReserved',data.isReserved)
            console.log('isReservedbyOther',data.isReservedbyOther)
            
            if(data.isReserved===true)
{            alert(" Bạn đã đặt chỗ rồi , không thể đặt thêm");   }

            else  
{
            if(data.isReservedbyOther===true)   
            {   alert(" Chỗ đã có người đặt ")}
            else{
                if(data.status===2)
                alert(" Đã đặt chỗ thành công ")
                else if( data.status===0)
                alert(" Chỗ đậu xe đã hết")

            }     

            }
})
        .catch(error => {
            console.error('Error:', error);  // Xử lý lỗi nếu có
        });
    }
    else{
    alert(" Hãy chọn bãi đậu xe trước !" );
    }

}




async function showing_nearest_parking_slot()
{
    const urls =
[ `https://api.mapbox.com/directions/v5/mapbox/driving/${user_current_location_long},${user_current_location_lat};${parkingSlots[0].long},${parkingSlots[0].lat}?steps=true&language=vi&access_token=pk.eyJ1IjoiZGVvY290ZW4iLCJhIjoiY20zcHR4NzZjMGUxdjJqc2R2Znp2aGtiayJ9.6sZmvb5zWF1RjzunxCD7wA`,

`https://api.mapbox.com/directions/v5/mapbox/driving/${user_current_location_long},${user_current_location_lat};${parkingSlots[1].long},${parkingSlots[1].lat}?steps=true&language=vi&access_token=pk.eyJ1IjoiZGVvY290ZW4iLCJhIjoiY20zcHR4NzZjMGUxdjJqc2R2Znp2aGtiayJ9.6sZmvb5zWF1RjzunxCD7wA`,
`https://api.mapbox.com/directions/v5/mapbox/driving/${user_current_location_long},${user_current_location_lat};${parkingSlots[2].long},${parkingSlots[2].lat}?steps=true&language=vi&access_token=pk.eyJ1IjoiZGVvY290ZW4iLCJhIjoiY20zcHR4NzZjMGUxdjJqc2R2Znp2aGtiayJ9.6sZmvb5zWF1RjzunxCD7wA`,
`https://api.mapbox.com/directions/v5/mapbox/driving/${user_current_location_long},${user_current_location_lat};${parkingSlots[3].long},${parkingSlots[3].lat}?steps=true&language=vi&access_token=pk.eyJ1IjoiZGVvY290ZW4iLCJhIjoiY20zcHR4NzZjMGUxdjJqc2R2Znp2aGtiayJ9.6sZmvb5zWF1RjzunxCD7wA`,
`https://api.mapbox.com/directions/v5/mapbox/driving/${user_current_location_long},${user_current_location_lat};${parkingSlots[4].long},${parkingSlots[4].lat}?steps=true&language=vi&access_token=pk.eyJ1IjoiZGVvY290ZW4iLCJhIjoiY20zcHR4NzZjMGUxdjJqc2R2Znp2aGtiayJ9.6sZmvb5zWF1RjzunxCD7wA`,
`https://api.mapbox.com/directions/v5/mapbox/driving/${user_current_location_long},${user_current_location_lat};${parkingSlots[5].long},${parkingSlots[5].lat}?steps=true&language=vi&access_token=pk.eyJ1IjoiZGVvY290ZW4iLCJhIjoiY20zcHR4NzZjMGUxdjJqc2R2Znp2aGtiayJ9.6sZmvb5zWF1RjzunxCD7wA`,

];



try 
{
    let road_length = Infinity; // Start with a very high value to ensure the first distance is always considered
        let index = -1;
    for (let i=0;i<urls.length;++i)
{
    const response = await fetch(urls[i]);

    if ( !response.ok)
{
    console.log(' failed to fetch URL at index ${i} ');

}
    var something = await response.json();
    console.log('Response from URL ${i}',something);
    console.log (' Distance ');
    console.log(something.routes[0].distance );

if (road_length )
{
    if( road_length>something.routes[0].distance)
{road_length=something.routes[0].distance;
index=i;}
}
else
{
road_length=something.routes[0].distance;

}
}

console.log(' Nearest Distance ',road_length);
console.log(' Index ',index);
var name;

switch(index)
{
case 0:
if (currentMarker) {
            currentMarker.getElement().classList.remove("blinking");
        }
currentMarker = markers["3_thang_2"];
            
            currentMarker.getElement().classList.add("blinking");

            map.setView(currentMarker.getLatLng(), current_zoom); 
        name='3 tháng 2';
        break;
case 1:
if (currentMarker) {
            currentMarker.getElement().classList.remove("blinking");
        }
currentMarker = markers["Ly_Thuong_Kiet"];
            
            currentMarker.getElement().classList.add("blinking");

            map.setView(currentMarker.getLatLng(), current_zoom); 
            name='Lý Thường Kiệt';
        break;
       
        case 2:
if (currentMarker) {
            currentMarker.getElement().classList.remove("blinking");
        }
currentMarker = markers["Nguyen_Kim"];
            
            currentMarker.getElement().classList.add("blinking");

            map.setView(currentMarker.getLatLng(), current_zoom); 
            name='Nguyễn Kim';
        break;


        case 3:
if (currentMarker) {
            currentMarker.getElement().classList.remove("blinking");
        }
currentMarker = markers["Le_Dai_Hanh"];
            
            currentMarker.getElement().classList.add("blinking");

            map.setView(currentMarker.getLatLng(), current_zoom); 
            name='Lê Đại Hành';
        break;


        case 4:
if (currentMarker) {
            currentMarker.getElement().classList.remove("blinking");
        }
currentMarker = markers["Lu_Gia"];
            
            currentMarker.getElement().classList.add("blinking");

            map.setView(currentMarker.getLatLng(), current_zoom); 
            name='Lữ Gia';
        break;


        case 5:
if (currentMarker) {
            currentMarker.getElement().classList.remove("blinking");
        }
currentMarker = markers["To_Hien_Thanh"];
            
            currentMarker.getElement().classList.add("blinking");

            map.setView(currentMarker.getLatLng(), current_zoom); 
            name='Tô Hiến Thành';
        break;




}

//document.getElementById("nearest_parking_slot").innerHTML=" Bãi đậu xe gần nhất là "+ name +" với khoảng cách  " + road_length+ " m";
alert("Bãi đậu xe gần nhất là " + name + " với khoảng cách " + road_length + " m");
}
catch(error)
{
    console.log('Error fetching data : ',error);

}




}







    slotsData.forEach((slot, index) => {
        const icon = slot.slot_status === 1 ? greenIcon : redIcon;

        // Match the slot id with the marker key and set the icon
     switch (index)
     {
        case 0:
        change_slot_status(markers["3_thang_2"],slot.slot_status);
        break;
        case 1:
        change_slot_status(markers["Ly_Thuong_Kiet"], slot.slot_status);
        break;
        case 2:
        change_slot_status(markers["Nguyen_Kim"], slot.slot_status);
            break;
        case 3:
        change_slot_status(markers["Le_Dai_Hanh"], slot.slot_status);
        break;
        case 4:
        change_slot_status(markers["Lu_Gia"], slot.slot_status);
        break;
        case 5:
        change_slot_status(markers["To_Hien_Thanh"],  slot.slot_status);
        break;
        default:
            break;
     }

    });


    var userMarker;
    var myAPIKey = "dc83c16450114c92a1be0c2a096b025b";
    const addressSearchControl = L.control.addressSearch(myAPIKey, {
  position: 'topleft',
  resultCallback: (selectedAddress) => {


                    if (userMarker) {
                  map.removeLayer(userMarker);
                    }
                    if (currentRoute) {
            map.removeControl(currentRoute);
        }
                    // Center the map on the selected location
                    console.log(selectedAddress);
                    map.setView([selectedAddress.lat, selectedAddress.lon], current_zoom);
                    user_current_location_lat=selectedAddress.lat;
                    user_current_location_long=selectedAddress.lon;
                    userMarker = L.marker([selectedAddress.lat,selectedAddress.lon]).addTo(map);
                    search_flag=1;
                },
  suggestionsCallback: (suggestions) => {
    console.log(suggestions);
  }
});




map.addControl(addressSearchControl);
L.control.zoom({ position: 'bottomright' }).addTo(map);

var TheSelectedSlot;

function listen_to_reservation_notification()
{

    Echo.channel('transport_information')
    .listen('Send_reservation_notification', (event) => {
        console.log(event.slot);
        console.log(event.status);




    });

}

window.onload=function(){
    Echo.channel('transport_information')
    .listen('Transport_data', (event) => {
        console.log(event.data);
        console.log(event.slot);
        var mk;
        
        switch (event.slot) {
            case 'SLOT1':
                change_slot_status(markers["3_thang_2"], event.data);
                break;
            case 'SLOT2':
                change_slot_status(markers["Ly_Thuong_Kiet"], event.data);
                break;
            case 'SLOT3':
                change_slot_status(markers["Nguyen_Kim"], event.data);
                break;
            case 'SLOT4':
                change_slot_status(markers["Le_Dai_Hanh"], event.data);
                break;
            case 'SLOT5':
                change_slot_status(markers["Lu_Gia"], event.data);
                break;
            case 'SLOT6':
                change_slot_status(markers["To_Hien_Thanh"], event.data);
                break;
                default :
                console.log(' something is not wrong');
                break;
        }

       // console.log('status:', event.data);  // Assuming the event has a `message` property
    });


   // listen_to_reservation_notification();

	}

        map.on('zoomend', function (e) {
            current_zoom=e.target._zoom;
    console.log(e.target._zoom);

});


console.log(typeof L !== 'undefined' ? 'Leaflet is loaded' : 'Leaflet is not loaded');

        document.getElementById("parking-slot").addEventListener("change", function() {
             var selectedSlot= this.value;
           
            switch ( selectedSlot)
            {
               
            
                case "3_thang_2":

                    current_parkingslot=[10.763723871833784,106.65976955431256];
                    TheSelectedSlot=1;
                    break;  
                case "Ly_Thuong_Kiet":
                     current_parkingslot=[10.761078620733292,106.66060917741723];
                     TheSelectedSlot=2;
                    break;
                case "Nguyen_Kim":
                    current_parkingslot=[10.762378881477494,106.66195345162645];
                    TheSelectedSlot=3;
                     break;
                case "Le_Dai_Hanh":
                    current_parkingslot=[10.766211203146504,106.6543467857687];
                    TheSelectedSlot=4;
                    break;
                case "Lu_Gia":
                    current_parkingslot=[10.770669889748305,106.65629512277314];
                    TheSelectedSlot=5;
                    break;
                case "To_Hien_Thanh":
                    current_parkingslot=[10.774398028512875,106.66200563634163];
                    TheSelectedSlot=6;
                    break;
                    
                default:
                    current_parkingslot = null;
                    break;
            }

            console.log(current_parkingslot);
            if (currentMarker) {
            currentMarker.getElement().classList.remove("blinking");
        }


            if (current_parkingslot) {
        map.setView(current_parkingslot, current_zoom); // Adjust the zoom level as desired
    }
            console.log("Selected parking slot:", selectedSlot, current_parkingslot);

            if (selectedSlot && markers[selectedSlot]) {
            currentMarker = markers[selectedSlot];

            currentMarker.getElement().classList.add("blinking");

            map.setView(currentMarker.getLatLng(), current_zoom); // Center the map on the selected slot
        }
            
        });

var id_interval;
var jten;

var current_instruction_array_length;
var current_guiding;
var testRoute=null;

var distance_to_sth=null;
var distance_check=null;
var instructions;

        function guiding_simulate() {
    if (current_parkingslot && search_flag) {
        if (currentRoute) {
            map.removeControl(currentRoute);
        }
        lamchuyendaisu(1);
    } else {
        alert("Vui lòng chọn vị trí và bãi đỗ xe trước!");
    }
}
    function guiding_current_location(){
        if (current_parkingslot && search_flag) {
        if (currentRoute) {
            map.removeControl(currentRoute);
        }
        lamchuyendaisu(2);
    } else {
        alert("Vui lòng chọn vị trí và bãi đỗ xe trước!");
    }

    }




var jjj=0;
var count=0;

var i=1;
var flag=0;
var flag2=0;


function dosomething()
{

    if (jjj===jjjten.length-1)
{
    
    clearInterval(id_interval);
    console.log(" dosomething is over");
    
 return ;
}


if (jjjten.length>0)
{
    if (i===maneuver_lat.length)
{
    
console.log(getmaneuver[i-1].maneuver.instruction);
document.getElementById("current_route_guiding").innerHTML=getmaneuver[i-1].maneuver.instruction;
clearInterval(id_interval);
jjj=0;
i=1;
flag=0;
flag2=0;
waypoints=[];
 maneuver_long=[];
 maneuver_lat=[];
getmaneuver=null;
return;
}

var latlng1 = L.latLng(jjjten[jjj].lat, jjjten[jjj].lng); 

    var latlng2 = waypoints[i];  // Example: Point 1 (Latitude, Longitude)

    var distance = latlng1.distanceTo(latlng2);
    if ( i>0)
{
var distance_back=latlng1.distanceTo(waypoints[i-1]);
}
    console.log('distance: ');
    console.log(distance);
    console.log(' current guiding :');
    console.log(getmaneuver[i-1].maneuver.instruction) ;
    if(flag2===1)
{
    document.getElementById("current_route_guiding").innerHTML=getmaneuver[i-1].maneuver.instruction;

flag2=0;
}   else
   
document.getElementById("current_route_guiding").innerHTML=" Tiếp tục đi trên đường "+ getmaneuver[i-1].name + " " + Math.round(distance) + "m";

    if (userMarker) {
                  map.removeLayer(userMarker);
                    }
    userMarker = L.marker([jjjten[jjj].lat, jjjten[jjj].lng],{icon: HungIcon}).addTo(map);
    //L.marker([10.770669889748305, 106.65629512277314],{icon: greenIcon}).addTo(map),
                    console.log(jjjten[jjj].lat);
                    console.log(jjjten[jjj].lng);
                    count++;
                    console.log(count);
if (distance<10)
{
    i++;
   flag=1;
  
}


if (distance_back>24 && i>1&&flag===1)
{
flag=0;
flag2=1;
}

    jjj++;
}
}

var flag3=0;
var flag4=0;

function dosomething2()
{
    
    var latlng1 = L.latLng( user_current_location_lat, user_current_location_long); 

    var latlng2 = waypoints[i];  // Example: Point 1 (Latitude, Longitude)

var distance = latlng1.distanceTo(latlng2);
if ( i>0)
{
var distance_back=latlng1.distanceTo(waypoints[i-1]);
}
console.log('distance: ');
console.log(distance);
console.log(' current guiding :');
console.log(getmaneuver[i-1].maneuver.instruction) ;
if(flag4===1)
{
document.getElementById("current_route_guiding").innerHTML=getmaneuver[i-1].maneuver.instruction;

flag4=0;
}   else{

    console.log(" get maneuver ");
    console.log(getmaneuver);
document.getElementById("current_route_guiding").innerHTML=" Tiếp tục đi trên đường "+ getmaneuver[i-1].name + distance+ " m";


}
if (userMarker) {
              map.removeLayer(userMarker);
                }


userMarker = L.marker([user_current_location_lat, user_current_location_long],{icon: HungIcon}).addTo(map);
//L.marker([10.770669889748305, 106.65629512277314],{icon: greenIcon}).addTo(map),
                console.log(jjjten[jjj].lat);
                console.log(jjjten[jjj].lng);
                count++;
                console.log(count);
if (distance<10)
{
i++;
flag3=1;

}


if (distance_back>24 && i>1&&flag3===1)
{
flag3=0;
flag4=1;


}

}



//var current_user_location_radius_circle;
map.on('locationfound', function (e) {

    if (userMarker) {
    map.removeLayer(userMarker);
  }

  if (currentRoute) {
            map.removeControl(currentRoute);
        }
        var userRadius=e.accuracy;

    //    if (radius) {
  //  map.removeLayer(radius);
  //}

    const lat = e.latitude;
    const lng = e.longitude;

    console.log(`Latitude: ${lat}, Longitude: ${lng}`);
    user_current_location_lat=lat;
    user_current_location_long=lng;
    userMarker = L.marker([lat, lng]).addTo(map)
    .bindPopup(`You are here!<br>Lat: ${lat}<br>Lng: ${lng}`).openPopup();


  /*
    radius=L.circle([lat,lng], {
          radius: userRadius, // Radius in meters
          color: 'blue',
          fillColor: '#add8e6',
          fillOpacity: 0.5,
        }).addTo(map);
        radius.setStyle({
            opacity: 0,       // Ẩn đường viền
            fillOpacity: 0,   // Ẩn phần nền
        });
    // You can display these values elsewhere or process them as needed
*/
    search_flag=1;
});



let boolean_setview = true; // Biến toàn cục để kiểm soát setView

function constantly_update_user_location() {
    // Chỉ cập nhật vị trí mà không di chuyển bản đồ
    map.stopLocate();
    // Bạn có thể thêm logic xử lý khi cập nhật vị trí, nhưng không cần dùng stopLocate ở đây
}

const locateButton = document.getElementById('use-gps');
locateButton.addEventListener('click', function () {
    if (boolean_setview) {
        // Lần đầu tiên, gọi locate với setView: true để di chuyển bản đồ đến vị trí người dùng
        map.locate({  setView: true,  maxZoom: 20, watch: true });
        boolean_setview = false; // Đặt lại để lần sau không còn setView
       // map.stopLocate();
    }
    // Liên tục cập nhật vị trí sau mỗi 3 giây mà không di chuyển bản đồ
    //setInterval(constantly_update_user_location, 3000);
});
var radius;
   // var marker;
    map.on('click', function (e) {

  const { lat, lng } = e.latlng; // Get latitude and longitude from click event
  search_flag=1;
  user_current_location_lat=lat;
  user_current_location_long=lng;
  
  if (currentRoute) {
            map.removeControl(currentRoute);
        }
  if (userMarker) {
    map.removeLayer(userMarker);
  }
  /*
  if (radius) {
    map.removeLayer(radius);
  }
  */
  // If a marker already exists, move it; otherwise, create a new one
 
    userMarker = L.marker([lat, lng]).addTo(map);

   // radius=L.circle([lat, lng], {radius: 200}).addTo(map);
   
   /*
    radius.setStyle({
            opacity: 0,       // Ẩn đường viền
            fillOpacity: 0,   // Ẩn phần nền
        });
        */
    // You ca
  // Optionally, log or display the coordinates
  console.log(`Marker placed at: ${user_current_location_lat}, ${user_current_location_long}`);
});


var maneuver_long=[];
var maneuver_lat=[];
var getmaneuver ;


function lamchuyendaisu( i1){
 
var profile = '';
var accessToken = 'pk.eyJ1IjoiZGVvY290ZW4iLCJhIjoiY20zcHR4NzZjMGUxdjJqc2R2Znp2aGtiayJ9.6sZmvb5zWF1RjzunxCD7wA';

console.log('user location long ');
console.log(user_current_location_long);
const url = `https://api.mapbox.com/directions/v5/mapbox/driving/${user_current_location_long},${user_current_location_lat};${current_parkingslot[1]},${current_parkingslot[0]}?steps=true&language=vi&access_token=pk.eyJ1IjoiZGVvY290ZW4iLCJhIjoiY20zcHR4NzZjMGUxdjJqc2R2Znp2aGtiayJ9.6sZmvb5zWF1RjzunxCD7wA`;



fetch(url)
  .then(response => response.json())
  .then(data => {
    console.log('Full Response:', data);
     getmaneuver=data.routes[0].legs[0].steps;
var matnai=0;
    for (var h =0;h<getmaneuver.length;h++,matnai++)
  {
    console.log(matnai);
    console.log(getmaneuver[h].maneuver.location);

    maneuver_long.push(getmaneuver[h].maneuver.location[0]);
    maneuver_lat.push(getmaneuver[h].maneuver.location[1]);

waypoints.push(L.latLng(getmaneuver[h].maneuver.location[1],getmaneuver[h].maneuver.location[0]));
  }
  console.log(' waypoints de chen vo route');


waypoints.shift();
waypoints.pop();

waypoints.unshift(L.latLng(user_current_location_lat, user_current_location_long));
waypoints.push( L.latLng(current_parkingslot[0], current_parkingslot[1]));

console.log(waypoints);
currentRoute = L.Routing.control({
            waypoints:  waypoints
        //  [ L.latLng(user_current_location_lat, user_current_location_long),
        //    L.latLng(current_parkingslot[0], current_parkingslot[1]),
 //] 
 ,
 createMarker: function(i, waypoint, n) {
      
        if (i === 0 || i === n - 1) {
            
            return L.marker(waypoint.latLng, {
                draggable: true 
            });
        }
        return null;
    },
            router: L.Routing.mapbox('pk.eyJ1IjoiZGVvY290ZW4iLCJhIjoiY20zcHR4NzZjMGUxdjJqc2R2Znp2aGtiayJ9.6sZmvb5zWF1RjzunxCD7wA',
            {
                steps: true, // Show steps in the route instructions
        language: 'vi', // Set the language for instructions
    }),
           // routeWhileDragging: true,
        }).addTo(map);

        const routingControlContainer = this.currentRoute.getContainer();
        const controlContainerParent = routingControlContainer.parentNode;
        controlContainerParent.removeChild(routingControlContainer);

        
        currentRoute.on('waypointschanged', function(e) {
    console.log('Waypoint changed:', e.waypoints);
});

        currentRoute.on('routesfound', function (e) {
           // map.stopLocate();
            console.log(e);
            const routes = e.routes; // Mảng các tuyến đường
           console.log(routes);
            if (routes.length > 0) {
                 instructions = routes[0].instructions; // Danh sách các chỉ dẫn
                jjjten= routes[0].coordinates;
                if (instructions.length > 0) {
                    current_guiding= instructions[0].text;
                    distance_to_sth= instructions[0].distance; 
                    distance_check=instructions[0].distance; 
                    current_instruction_array_length=instructions.length;
                   // console.log(current_guiding);
                    //console.log(current_instruction_array_length);
                    
                    for (var i = 0; i < instructions.length; ++i) {
                        const instructionText = instructions[i].text;
                        console.log(`${i} guiding:`, instructionText);
                    }
               
                    if(i1===1)
                   id_interval=setInterval(dosomething, 500); //bat dau gia lap duong di cua user
                    else if(i1===2)
                    id_interval=setInterval(dosomething2,500);
                }
            }
        });

})
  .catch(error => console.error('Error fetching directions:', error));
}









    
      </script>
   
   <script>
    // Check if this is a redirected request by using session data
    if (window.performance && window.performance.navigation.type === 1) {
        // The page was reloaded explicitly
        console.log("Page reloaded explicitly.");
    } else {
        // Force a reload to ensure everything is loaded
        window.location.reload();
    }
</script>


  
</body>
</html>