export function replaceRow(item, tableIndex) {
    const table = document.getElementById('member_table');
    
    // Xóa hàng tại vị trí `tableIndex`
    if (table.rows[tableIndex]) {
      table.deleteRow(tableIndex);
    } else {
      console.error(`Hàng tại vị trí ${tableIndex} không tồn tại.`);
      return;
    }
    
    // Thêm lại hàng mới tại cùng vị trí
    const row = table.insertRow(tableIndex);
    const idCell = row.insertCell(0);
    const Slot_id_Cell = row.insertCell(1);
    const Slot_Name_Cell = row.insertCell(2);
    const Come_at_Cell = row.insertCell(3);
    const Leave_at_Cell = row.insertCell(4);
    
    let slot_name;
    switch (item.slot_id) {
      case 0:
        slot_name = '3 tháng 2';
        break;
      case 1:
        slot_name = 'Lý Thường Kiệt';
        break;
      case 2:
        slot_name = 'Nguyễn Kim';
        break;
      case 3:
        slot_name = 'Lê Đại Hành';
        break;
      case 4:
        slot_name = 'Lữ Gia';
        break;
      case 5:
        slot_name = 'Tô Hiến Thành';
        break;
      default:
        slot_name = 'Không xác định';
    }
    
    idCell.innerHTML = tableIndex;
    Slot_id_Cell.innerHTML = item.slot_id;
    Slot_Name_Cell.innerHTML = slot_name;
    Come_at_Cell.innerHTML = item.Come_at;
    Leave_at_Cell.innerHTML = item.Leave_at;
  }