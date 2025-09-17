<div id="reservation-menu">
    <h2>Đặt Chỗ Đỗ Xe</h2>
    
    <label for="location">Your current location:</label>
    <input type="text" id="location" placeholder="Fiil in your location">

    <label for="parking-slot">Select parking slot</label>
    <select id="parking-slot">
        <option value="slot1"> 3/2 </option>
        <option value="slot2">Ly Thuong Kiet</option>
        <option value="slot3">Nguyen Kim</option>
        <option value="slot4">Le Dai Hanh</option>
        <option value="slot5">Lu Gia</option>
        <option value="slot6">To Hien Thanh</option>
        <!-- Add more slots as needed -->
    </select>

    <label for="start-time">Thời Gian Bắt Đầu:</label>
    <input type="datetime-local" id="start-time">

    <label for="end-time">Thời Gian Kết Thúc:</label>
    <input type="datetime-local" id="end-time">

    <label for="duration">Thời Gian (giờ):</label>
    <input type="number" id="duration" min="1" placeholder="Số giờ">

    <button type="button" onclick="reserveSpot()">Đặt Chỗ</button>

    @if($message)
    <div>
       {{ $message }}
    </div>
    @endif
</div>