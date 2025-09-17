import { replaceRow  } from './delete_and_insert_row.js';


/**
 * Initiate the app at the beginning
 */

//var slot_occupies=window.slot_occupied;

var listen_var;
// loc data
var simplifiedSlots = window.slot_occupied.map(item => {
  return {
      slot_id: item.slot_id,
      Come_at: item.Come_at,
      Leave_at: item.Leave_at
  };
});
//var temp_data =slot_occupies;
//var listen_var;
console.log(simplifiedSlots);


 
simplifiedSlots.forEach((item,index)=>{

  insertIntoTableView(item, getTotalRowOfTable());
});





export function merge_socket_data_and_database_data()
{ listen_var= window.listen_var;
  console.log('listen_var la ', listen_var);
  var flag=0;
  var index_to_insert;
  
console.log  ( 'merge function being called ');
  simplifiedSlots.forEach((item,index)=>{
    if(item.slot_id===listen_var.slot_id && item.Come_at===listen_var.Come_at)
    {
      if(item.Leave_at==="")
        item.Leave_at=listen_var.Leave_at;
        index_to_insert=index+1; 
     }
     else if(index_to_insert===null)
     {
     flag=1;
     }
  
  });
  if(index_to_insert)
  { console.log(" replace row ");
  replaceRow(listen_var,index_to_insert);
    return ;
}
console.log(" insertintotableview ");
  insertIntoTableView(listen_var, getTotalRowOfTable());
  simplifiedSlots.push(listen_var);
}




/**
 * Generating unique ID for new Input
 */
function guid() {
  return parseInt(Date.now() + Math.random())
}
/**
 * Create and Store New Member
 */



/**
 * Inserting data into the table of the view
 *
 * @param {object} item
 * @param {int} tableIndex
 */


function insertIntoTableView(item, tableIndex) {
  
 // console.log(item);
  const table = document.getElementById('member_table')
  const row = table.insertRow()
  const idCell = row.insertCell(0)
  const Slot_id_Cell = row.insertCell(1)
  const Slot_Name_Cell = row.insertCell(2)
  const Come_at_Cell = row.insertCell(3)
  const Leave_at_Cell = row.insertCell(4)
  //const actionCell = row.insertCell(5)
var slot_name;
switch( item.slot_id)
{ case 0:
  slot_name=' 3 tháng 2 ';
  break;
   case 1:
  slot_name=' Lý Thường Kiệt ';
  break;
   case 2:
  slot_name=' Nguyễn Kim ';
  break;
   case 3:
  slot_name=' Lê Đại Hành ';
  break;
   case 4:
  slot_name=' Lữ Gia ';
  break;
   case 5:
  slot_name=' Tô Hiến Thành ';
  break;
}
  idCell.innerHTML = tableIndex
  Slot_id_Cell.innerHTML = item.slot_id
  Slot_Name_Cell.innerHTML = slot_name
  Come_at_Cell.innerHTML = item.Come_at
  Leave_at_Cell.innerHTML = item.Leave_at
 
  const guid = item.id

}

function getTotalRowOfTable() {
  const table = document.getElementById('member_table')

  return table.rows.length
}




$(document).ready(function() {
  // Khởi tạo Datepicker cho ngày
  $("#date_picker").datepicker({
    dateFormat: 'yy-mm-dd'
  });

  
});


export function filter_occupies_history(){

console.log('quan dien');

const selectedDate = document.getElementById('date_picker').value;
const fromTime = document.getElementById('from_time').value;
const toTime = document.getElementById('to_time').value;
console.log(selectedDate);
console.log(fromTime);
console.log(toTime);

if (!selectedDate || fromTime === "none" || toTime === "none") {
  alert("Vui lòng chọn đầy đủ ngày, giờ bắt đầu và giờ kết thúc.");
  return;
}
const fromDateTime = new Date(`${selectedDate} ${fromTime}:00`);
const toDateTime = new Date(`${selectedDate} ${toTime}:00`);

console.log("Khoảng thời gian lọc:");
console.log("Từ:", fromDateTime);
console.log("Đến:", toDateTime);

// Lọc dữ liệu từ simplifiedSlots
const filteredSlots = simplifiedSlots.filter((slot) => {
  const comeAt = new Date(slot.come_at);
  console.log(comeAt);
  const leaveAt = new Date(slot.leave_at);
  console.log(leaveAt);
  // Kiểm tra xem đợt đậu xe có giao với khoảng thời gian đã chọn không
  return (
    (comeAt >= fromDateTime && comeAt < toDateTime) || // Bắt đầu trong khoảng
    (leaveAt > fromDateTime && leaveAt <= toDateTime) || // Kết thúc trong khoảng
    (comeAt <= fromDateTime && leaveAt >= toDateTime) // Bao phủ toàn bộ khoảng
  );
});

// In kết quả lọc ra console
console.log("Kết quả lọc:", filteredSlots);

}

/**
 *
 *
 * @param {string} id
 */

/**
 * Show Edit Modal of a single member
 *
 
 */

/**
 * Store Updated Member Data into the storage
 */

/**
 * Show Delete Confirmation Dialog Modal
 *
 * @param {int} id
 */

/**
 * Delete single member
 */

/**
 * Sorting table data through type, e.g: reg_no, email, owner_name etc.
 *
 * @param {string} type
 */

