function escapeHtml(unsafe) {
  if (!unsafe) return '';
  return unsafe.toString()
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;")
    .replace(/'/g, "&#039;");
}

function htmlEscapeJson(obj) {
  return JSON.stringify(obj).replace(/"/g, '&quot;');
}

// ===== MAIN FUNCTIONS =====
function showDetails(id, food_name, foodType, descriptions, address, pickupTime, contact, imagePath) {
  const modal = document.getElementById("detailModal");
  const modalBody = document.getElementById("modalBody");

  modalBody.innerHTML = `
    <p><strong>Food Name:</strong> ${escapeHtml(food_name)}</p>
    <p><strong>Food Type:</strong> ${escapeHtml(foodType)}</p>
    <p><strong>Descriptions:</strong> ${escapeHtml(descriptions)}</p>
    <p><strong>Address:</strong> ${escapeHtml(address)}</p>
    <p><strong>Pickup Time:</strong> ${escapeHtml(pickupTime)}</p>
    <p><strong>Contact:</strong> ${escapeHtml(contact)}</p>
    <img src="${escapeHtml(imagePath)}" alt="Listing Image" style="width:100%; margin-top:10px; border-radius:6px; box-shadow:0 2px 4px #5b5221;">
    <div style="margin-top:15px;">
      <button class="btn" onclick="openEditModal(${htmlEscapeJson({
        id, food_name, foodType, descriptions, address, pickupTime, contact
      })})">Edit</button>
      <button class="btn delete-btn" onclick="confirmDelete('${escapeHtml(id)}')">Delete</button>
    </div>
  `;

  modal.style.display = "flex";
}

function openEditModal(data) {
  const editModal = document.getElementById("editModal");
  const editModalBody = document.getElementById("editModalBody");

  editModalBody.innerHTML = `
    <form id="editForm" enctype="multipart/form-data">
      <input type="hidden" name="id" value="${escapeHtml(data.id)}">
      <div class="edit-modal-form-group">
        <label>Food Name:</label>
        <input type="text" name="foodname" value="${escapeHtml(data.food_name)}" required>
      </div>
      <div class="edit-modal-form-group">
        <label>Food Type:</label>
        <select name="foodType" required>
          <option value="veg" ${data.foodType === 'veg' ? 'selected' : ''}>Veg</option>
          <option value="non-veg" ${data.foodType === 'non-veg' ? 'selected' : ''}>Non-Veg</option>
          <option value="animal" ${data.foodType === 'animal' ? 'selected' : ''}>Animal</option>
        </select>
      </div>
      <div class="edit-modal-form-group">
        <label>Description:</label>
        <textarea name="description" required>${escapeHtml(data.descriptions)}</textarea>
      </div>
      <div class="edit-modal-form-group">
        <label>Address:</label>
        <input type="text" name="address" value="${escapeHtml(data.address)}" required>
      </div>
    
      <div class="edit-modal-form-group">
        <label>Contact:</label>
        <input type="text" name="contact" value="${escapeHtml(data.contact)}" required>
      </div>
      <div class="edit-modal-footer">
        <button type="button" class="edit-modal-cancel-btn" onclick="closeEditModal()">Cancel</button>
        <button type="submit" class="edit-modal-save-btn">Save Changes</button>
      </div>
    </form>
  `;

  editModal.style.display = "flex";

  document.getElementById("editForm").onsubmit = function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    fetch("update_listing.php", {
      method: "POST",
      body: formData
    })
    .then(res => res.text())
    .then(msg => {
      alert(msg);
      closeEditModal();
      location.reload();
    })
    .catch(err => {
      console.error(err);
      alert("Failed to update listing.");
    });
  };
}

function closeModal() {
  document.getElementById("detailModal").style.display = "none";
}

function closeEditModal() {
  document.getElementById("editModal").style.display = "none";
}

function confirmDelete(id) {
  if (confirm("Are you sure you want to delete this listing?")) {
    fetch(`delete.php?id=${encodeURIComponent(id)}`, {
      method: 'DELETE'
    })
    .then(response => {
      if (response.ok) location.reload();
      else alert("Delete failed");
    })
    .catch(err => console.error('Error:', err));
  }
}

window.onclick = function(event) {
  if (event.target === document.getElementById("detailModal")) {
    closeModal();
  }
  if (event.target === document.getElementById("editModal")) {
    closeEditModal();
  }
};

document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll('.openModalBtn').forEach(card => {
    card.addEventListener('click', () => {
      const expiresAt = new Date(card.dataset.expiresAt);
      const now = new Date();

      if (expiresAt <= now) {
        alert("This listing has expired and cannot be viewed or edited.");
        return;
      }

      showDetails(
        card.dataset.id,
        card.dataset.foodname,
        card.dataset.foodtype,
        card.dataset.description,
        card.dataset.address,
        card.dataset.pickup,
        card.dataset.contact,
        card.dataset.image
      );
    });
  });
});
