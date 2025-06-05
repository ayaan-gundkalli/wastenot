function showDetails(
  id,
  food_name,
  foodType,
  descriptions,
  address,
  pickupTime,
  contact,
  imagePath
) {
  const modal = document.getElementById("detailModal");
  const modalBody = document.getElementById("modalBody");

  modalBody.innerHTML = `
    <p><strong>Food Name:</strong> ${food_name}</p>
    <p><strong>Food Type:</strong> ${foodType}</p>
    <p><strong>Descriptions:</strong> ${descriptions}</p>
    <p><strong>Address:</strong> ${address}</p>
    <p><strong>Pickup Time:</strong> ${pickupTime}</p>
    <p><strong>Contact:</strong> ${contact}</p>
    <img src="${imagePath}" alt="Listing Image" style="width:100%; margin-top:10px; border-radius:6px; box-shadow:0 2px 4px #5b5221;">
    <div style="margin-top:15px;">
      <a href="edit_listing.php?id=${id}" class="btn">Edit</a>
      <button onclick="confirmDelete(${id})" class="btn delete-btn">Delete</button>
    </div>
  `;

  modal.style.display = "flex";
}

function closeModal() {
  const modal = document.getElementById("detailModal");
  modal.style.display = "none";
}

function confirmDelete(id) {
  if (confirm("Are you sure you want to delete this listing?")) {
    window.location.href = "../lister/delete.php?id=" + id;
  }
}

window.onclick = function (event) {
  const modal = document.getElementById("detailModal");
  if (event.target == modal) {
    closeModal();
  }
};

document.getElementById('foodImage').addEventListener('change', function(event) {
  const file = event.target.files[0];
  if (!file) return;

  const img = new Image();
  img.src = URL.createObjectURL(file);
  
  img.onload = function() {
    if (img.width <= img.height) {
      alert("INVALID. image must be landscape");
      event.target.value = "";
    }
  };
});
