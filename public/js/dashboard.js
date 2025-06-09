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
        document.getElementById(section + "Section").classList.add();
    });

    // Show selected section
    document.getElementById(sectionName + "Section").classList.remove();

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
            sidebar.classList.toggle();
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
            <td class="d-md-table-cell">${phone}</td>
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
            <td class="d-md-table-cell">${phone}</td>
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

// Add gallery image
function addGalleryImage() {
    // Show modal with jQuery
    $("#addImageModal").modal("show");
}

// Handle form submission
$("#addImageForm").on("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    const submitBtn = $(this).find('button[type="submit"]');

    submitBtn
        .prop("disabled", true)
        .html('<i class="fas fa-spinner fa-spin me-1"></i> Uploading...');

    fetch("/gallery", {
        method: "POST",
        body: formData,
        // Don't set Content-Type header when sending FormData
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                // Hide empty message if exists
                $("#empty-gallery").remove();

                // Add new image to gallery
                const newImageHtml = `
                <div class="col-md-4 mb-3" id="gallery-${data.data.id}">
                    <div class="card">
                        <img src="${data.data.image_url}" class="card-img-top" alt="${data.data.alt_text}">
                        <div class="card-body p-2">
                            <button class="btn btn-sm btn-outline-danger w-100" onclick="removeGalleryImage(${data.data.id})">
                                <i class="fas fa-trash me-1"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>
            `;
                $("#galleryImages").append(newImageHtml);

                // Reset form and close modal
                $("#addImageForm")[0].reset();
                $("#addImageModal").modal("hide");

                // Show success message
                showAlert("success", data.message);
            } else {
                showAlert("danger", data.message);
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            showAlert("danger", "Terjadi kesalahan saat mengupload foto");
        })
        .finally(() => {
            submitBtn
                .prop("disabled", false)
                .html('<i class="fas fa-upload me-1"></i> Upload');
        });
});

// Remove gallery image
function removeGalleryImage(id) {
    if (confirm("Apakah Anda yakin ingin menghapus foto ini?")) {
        fetch(`/gallery/${id}`, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
                "Content-Type": "application/json",
            },
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    // Remove image from DOM
                    $(`#gallery-${id}`).fadeOut(300, function () {
                        $(this).remove();

                        // Show empty message if no images left
                        if ($("#galleryImages .col-md-4").length === 0) {
                            $("#galleryImages").html(`
                            <div class="col-12 text-center py-4" id="empty-gallery">
                                <p class="text-muted">Belum ada foto dalam galeri</p>
                            </div>
                        `);
                        }
                    });

                    showAlert("success", data.message);
                } else {
                    showAlert("danger", data.message);
                }
            })
            .catch((error) => {
                console.error("Error:", error);
                showAlert("danger", "Terjadi kesalahan saat menghapus foto");
            });
    }
}

// Show alert message
function showAlert(type, message) {
    const alertHtml = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;

    // Remove existing alerts
    $(".alert").remove();

    // Add new alert at the top of card body
    $("#editGallerySection .card-body").prepend(alertHtml);

    // Auto hide after 5 seconds
    setTimeout(() => {
        $(".alert").fadeOut();
    }, 5000);
}
