// Navigation functions
function showSection(sectionName) {
    // Hide all sections
    const sections = [
        "dashboard",
        "editHome",
        "editMempelai",
        "guests",
        "editWeb",
        "editStory",
        "editMap",
        "editInfo",
        "editGallery",
        "editGift",
    ];
    sections.forEach((section) => {
        document.getElementById(section + "Section").classList.add("d-none");
    });

    // Show selected section
    document.getElementById(sectionName + "Section").classList.remove("d-none");

    // Update active nav
    document
        .querySelectorAll(".nav-link")
        .forEach((link) => link.classList.remove("active"));
    event.target.classList.add("active");

    // Update page title
    const titles = {
        dashboard: "Dashboard",
        editHome: "Edit Home",
        editMempelai: "Edit Mempelai",
        guests: "Daftar Tamu",
        editWeb: "Edit Website",
        editStory: "Edit Story",
        editMap: "Edit Map",
        editInfo: "Edit Info",
        editGallery: "Edit Gallery",
        editGift: "Edit Gift",
    };
    document.querySelector("h1.h2").textContent =
        titles[sectionName] || "Dashboard";
}

// Sidebar toggle for mobile
document.addEventListener("DOMContentLoaded", function () {
    document
        .getElementById("sidebarToggle")
        .addEventListener("click", function () {
            const sidebar = document.getElementById("sidebar");
            sidebar.classList.toggle("d-none");
        });
});

// Guest management functions
let guestIdCounter = 5;
let editingGuestId = null;

function saveGuest() {
    const name = document.getElementById("guestName").value;
    const email = document.getElementById("guestEmail").value;
    const phone = document.getElementById("guestPhone").value;
    const status = document.getElementById("guestStatus").value;

    if (!name || !email) {
        alert("Nama dan email harus diisi!");
        return;
    }

    if (editingGuestId) {
        // Update existing guest
        updateGuestInTable(editingGuestId, name, email, phone, status);
        editingGuestId = null;
    } else {
        // Add new guest
        addGuestToTable(guestIdCounter++, name, email, phone, status);
    }

    // Reset form
    document.getElementById("guestForm").reset();

    // Close modal
    const modal = bootstrap.Modal.getInstance(
        document.getElementById("guestModal")
    );
    modal.hide();

    // Update statistics
    updateGuestStatistics();
}

function addGuestToTable(id, name, email, phone, status) {
    const statusBadge = getStatusBadge(status);
    const row = `
        <tr id="guest-${id}">
            <td>${name}</td>
            <td>${email}</td>
            <td class="d-none d-md-table-cell">${phone}</td>
            <td>${statusBadge}</td>
            <td>
                <button class="btn btn-sm btn-outline-primary me-1" onclick="editGuestModal(${id})">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn btn-sm btn-outline-danger" onclick="deleteGuest(${id})">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        </tr>
    `;
    document.getElementById("guestsList").insertAdjacentHTML("beforeend", row);
}

function updateGuestInTable(id, name, email, phone, status) {
    const row = document.getElementById(`guest-${id}`);
    if (row) {
        const statusBadge = getStatusBadge(status);
        row.innerHTML = `
            <td>${name}</td>
            <td>${email}</td>
            <td class="d-none d-md-table-cell">${phone}</td>
            <td>${statusBadge}</td>
            <td>
                <button class="btn btn-sm btn-outline-primary me-1" onclick="editGuestModal(${id})">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn btn-sm btn-outline-danger" onclick="deleteGuest(${id})">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        `;
    }
}

function getStatusBadge(status) {
    const badges = {
        pending: '<span class="badge bg-warning text-dark">Menunggu</span>',
        confirmed: '<span class="badge bg-success">Hadir</span>',
        declined: '<span class="badge bg-danger">Tidak Hadir</span>',
    };
    return badges[status] || badges["pending"];
}

function editGuestModal(id) {
    editingGuestId = id;
    document.getElementById("guestModalLabel").textContent = "Edit Tamu";

    // In a real application, you would fetch the guest data
    // For demo purposes, we'll use placeholder data
    document.getElementById("guestName").value = "Sample Name";
    document.getElementById("guestEmail").value = "sample@example.com";
    document.getElementById("guestPhone").value = "0812-3456-7890";
    document.getElementById("guestStatus").value = "confirmed";

    const modal = new bootstrap.Modal(document.getElementById("guestModal"));
    modal.show();
}

function deleteGuest(id) {
    if (confirm("Apakah Anda yakin ingin menghapus tamu ini?")) {
        const row = document.getElementById(`guest-${id}`);
        if (row) {
            row.remove();
            updateGuestStatistics();
        }
    }
}

function updateGuestStatistics() {
    // In a real application, this would calculate from actual data
    const totalGuests = document.querySelectorAll("#guestsList tr").length;
    document.getElementById("totalGuests").textContent = totalGuests;
}

function exportGuestList() {
    alert("Fungsi export akan diimplementasikan dengan backend");
}

// Save functions for different sections
function saveHomeSection() {
    alert("Data halaman awal berhasil disimpan!");
}

function saveMempelaiSection() {
    alert("Informasi mempelai berhasil disimpan!");
}

function saveWebSettings() {
    alert("Pengaturan website berhasil disimpan!");
}

function saveStorySection() {
    alert("Cerita cinta berhasil disimpan!");
}

function updateMapPreview() {
    alert("Peta berhasil diperbarui!");
}

function saveInfoSection() {
    alert("Informasi sambutan berhasil disimpan!");
}

function addGalleryImage() {
    const input = document.createElement("input");
    input.type = "file";
    input.accept = "image/*";
    input.onchange = function (e) {
        if (e.target.files[0]) {
            alert("Gambar berhasil ditambahkan ke galeri!");
        }
    };
    input.click();
}

function removeGalleryImage(id) {
    if (confirm("Apakah Anda yakin ingin menghapus gambar ini?")) {
        alert("Gambar berhasil dihapus dari galeri!");
    }
}

function saveGiftSection() {
    alert("Informasi hadiah berhasil disimpan!");
}

function logout() {
    if (confirm("Apakah Anda yakin ingin logout?")) {
        alert("Logout berhasil!");
        // In real application, redirect to login page
    }
}

// Initialize event listeners when DOM is loaded
document.addEventListener("DOMContentLoaded", function () {
    // Modal reset when hidden
    document
        .getElementById("guestModal")
        .addEventListener("hidden.bs.modal", function () {
            document.getElementById("guestForm").reset();
            document.getElementById("guestModalLabel").textContent =
                "Tambah Tamu";
            editingGuestId = null;
        });

    // Handle edit button clicks
    document.addEventListener("click", function (e) {
        if (e.target.closest(".btn-edit")) {
            const btn = e.target.closest(".btn-edit");
            const id = btn.getAttribute("data-id");
            const name = btn.getAttribute("data-name");
            const address = btn.getAttribute("data-address");
            const status = btn.getAttribute("data-status");

            // Populate edit modal
            document.getElementById("editGuestId").value = id;
            document.getElementById("editGuestName").value = name;
            document.getElementById("editGuestAddress").value = address || "";
            document.getElementById("editGuestStatus").value = status;

            // Update form action
            const form = document.getElementById("editGuestForm");
            form.action = `/guest/${id}`;
        }
    });

    // Handle edit form submission with AJAX
    document
        .getElementById("editGuestForm")
        .addEventListener("submit", function (e) {
            e.preventDefault();

            const formData = new FormData(this);
            const guestId = document.getElementById("editGuestId").value;

            // Get CSRF token from meta tag
            const token = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content");

            fetch(`/guest/${guestId}`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": token,
                },
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        // Update the table row
                        const row = document.getElementById(
                            `guest-row-${guestId}`
                        );
                        const statusClass =
                            formData.get("guestStatus") === "hadir"
                                ? "bg-success"
                                : formData.get("guestStatus") === "tidak_hadir"
                                ? "bg-danger"
                                : "bg-warning";
                        const statusText = formData
                            .get("guestStatus")
                            .replace("_", " ");

                        if (row) {
                            row.innerHTML = `
                    <td>${formData.get("guestName")}</td>
                    <td>${formData.get("guestAddress") || ""}</td>
                    <td>
                        <span class="badge ${statusClass}">
                            ${
                                statusText.charAt(0).toUpperCase() +
                                statusText.slice(1)
                            }
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-warning btn-sm btn-edit me-1"
                            data-id="${guestId}"
                            data-name="${formData.get("guestName")}"
                            data-address="${formData.get("guestAddress") || ""}"
                            data-status="${formData.get("guestStatus")}"
                            data-bs-toggle="modal"
                            data-bs-target="#editGuestModal">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="deleteGuest(${guestId}, '${formData.get(
                                "guestName"
                            )}')">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </td>
                `;
                        }

                        // Close modal
                        const modal = bootstrap.Modal.getInstance(
                            document.getElementById("editGuestModal")
                        );
                        modal.hide();

                        // Show success message
                        showAlert("Data tamu berhasil diperbarui!", "success");
                    } else {
                        showAlert(
                            data.message ||
                                "Terjadi kesalahan saat memperbarui data!",
                            "danger"
                        );
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    showAlert(
                        "Terjadi kesalahan saat memperbarui data!",
                        "danger"
                    );
                });
        });
});
