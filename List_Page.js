function Edit_Users(button) {
    var uID = button.getAttribute('data-id');
    var name = button.getAttribute('data-name');
    var email = button.getAttribute('data-email');
    var phone = button.getAttribute('data-phone');
    var role = button.getAttribute('data-role');

    document.getElementById('modalUserID').value = uID;
    document.getElementById('modalUsername').value = name;
    document.getElementById('modalEmail').value = email;
    document.getElementById('modalPhone').value = phone;
    document.getElementById('modalRole').value = role;

    document.getElementById('editModal').classList.add('active');
}

function Edit_Tapes(button) {
    var uID = button.getAttribute('data-id');
    var name = button.getAttribute('data-name');
    var description = button.getAttribute('data-desc');
    var genre = button.getAttribute('data-genre');
    var duration = button.getAttribute('data-duration');
    var releaseDate = button.getAttribute('data-releaseDate');
    var price = button.getAttribute('data-price');
    var image = button.getAttribute('data-image');

    document.getElementById('modalVideoID').value = uID;
    document.getElementById('modalName').value = name;
    document.getElementById('modalDescription').value = description;
    document.getElementById('modalGenre').value = genre;
    document.getElementById('modalDuration').value = duration;
    document.getElementById('modalReleaseDate').value = releaseDate;
    document.getElementById('modalPrice').value = price;
    // ✨ 核心修改 1：让小窗口里的图片标签显示当前的图片
    document.getElementById('modalImagePreview').src = image;
    // ✨ 核心修改 2：把旧路径存进隐藏输入框，防止用户不换照片时图片丢失
    document.getElementById('modalOldImagePath').value = image;
    // 清空上一次选择的文件流，确保每次打开都是干净的
    document.getElementById('modalImageInput').value = "";

    document.getElementById('editModal').classList.add('active');
}

// ✨ 新增：当用户在电脑里选了新照片后，立刻在小窗口里看到换上去的效果（本地预览）
function previewNewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            // 把小窗口的图片预览源，替换为用户刚刚选的本地照片
            document.getElementById('modalImagePreview').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function Edit_Rental(button) {
    var rentalID = button.getAttribute('data-rentalID');
    var beginDate = button.getAttribute('data-beginDate');
    var userID = button.getAttribute('data-userID');
    var inventoryID = button.getAttribute('data-inventoryID');
    var payment = button.getAttribute('data-payment');
    var status = button.getAttribute('data-status');

    document.getElementById('modalRentalID').value = rentalID;
    document.getElementById('modalBeginDate').value = beginDate;
    document.getElementById('modalUserID').value = userID;
    document.getElementById('modalInventoryID').value = inventoryID;
    document.getElementById('modalPayment').value = payment;
    document.getElementById('modalStatus').value = status;

    document.getElementById('editModal').classList.add('active');
}

function Edit_Inventory(button) {
    var inventoryID = button.getAttribute('data-inventoryID');
    var videoID = button.getAttribute('data-vidoeID');
    var status = button.getAttribute('data-status');

    document.getElementById('modalInventoryID').value = inventoryID;
    document.getElementById('modalVideoID').value = videoID;
    document.getElementById('modalStatus').value = status;

    document.getElementById('editModal').classList.add('active');
}

function closeModal() {
    document.getElementById('editModal').classList.remove('active');
}

function Delete_Users(button) {
    var uID = button.getAttribute('data-id');
    
    if (confirm("🚨 Warning: Are you sure you want to delete User [" + uID + "]? This process cannot be undone!")) {
        window.location.href = "Delete_User.php?id=" + uID;
    }
}

function Delete_Tapes(button) {
    var uID = button.getAttribute('data-id');
    
    if (confirm("🚨 Warning: Are you sure you want to delete Tape [" + uID + "]? This process cannot be undone!")) {
        window.location.href = "Delete_Tape.php?id=" + uID;
    }
}

function Delete_Rental(button) {
    var uID = button.getAttribute('data-rentalID');
    
    if (confirm("🚨 Warning: Are you sure you want to delete Rental [" + uID + "]? This process cannot be undone!")) {
        window.location.href = "Delete_Rental.php?id=" + uID;
    }
}

function Delete_Inventory(button) {
    var uID = button.getAttribute('data-inventoryID');
    
    if (confirm("🚨 Warning: Are you sure you want to delete Inventory [" + uID + "]? This process cannot be undone!")) {
        window.location.href = "Delete_Inventory.php?id=" + uID;
    }
}

// 当点击 + 号时触发这个函数
function openModal() {
    document.getElementById('addModal').classList.add('active');
}

function closeModal_Add() {
    document.getElementById('addModal').classList.remove('active');
}

let clickCounts = {};

function sortTable(columnIndex, type) {
    if (!clickCounts[columnIndex]) {
        clickCounts[columnIndex] = 1; 
    } else {
        clickCounts[columnIndex]++;
    }

    const isAscending = clickCounts[columnIndex] % 2 !== 0;
    const table = document.querySelector('.data-table');
    const rows = Array.from(table.querySelectorAll('.table-row'));

    rows.sort((rowA, rowB) => {
        let cellA = rowA.querySelectorAll('span')[columnIndex].innerText.trim();
        let cellB = rowB.querySelectorAll('span')[columnIndex].innerText.trim();

        // 剥离电话号码的特殊符号
        if (columnIndex === 3) {
            cellA = cellA.replace('+60-', '').replace('-', '');
            cellB = cellB.replace('+60-', '').replace('-', '');
        }

        // ✨ 核心判定逻辑
        if (type === 'mixed') {
            // 使用 localeCompare 配合 numeric: true
            // 它会聪明地把 "2" 排在 "10" 前面，把 "A" 排在 "B" 前面，把 "U2" 排在 "U10" 前面
            return isAscending 
                ? cellA.localeCompare(cellB, undefined, { numeric: true, sensitivity: 'base' })
                : cellB.localeCompare(cellA, undefined, { numeric: true, sensitivity: 'base' });
        } else if (type === 'num') {
            return isAscending ? parseFloat(cellA) - parseFloat(cellB) : parseFloat(cellB) - parseFloat(cellA);
        } else {
            return isAscending ? cellA.localeCompare(cellB) : cellB.localeCompare(cellA);
        }
    });

    rows.forEach(row => table.appendChild(row));
    
    // 箭头旋转特效
    const allImgs = document.querySelectorAll('.table-header span img');
    allImgs.forEach((img, idx) => {
        if (idx === columnIndex) {
            img.style.transform = isAscending ? 'rotate(0deg)' : 'rotate(180deg)';
            img.style.transition = 'transform 0.2s ease';
        } else {
            img.style.transform = 'none';
        }
    });
}