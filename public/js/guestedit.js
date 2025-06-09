document.addEventListener('DOMContentLoaded', function () {
    var editGuestModal = document.getElementById('editGuestModal');

    if (!editGuestModal) return;

    editGuestModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;

        var guestId = button.getAttribute('data-id');
        var guestName = button.getAttribute('data-name');
        var guestAddress = button.getAttribute('data-address');
        var guestStatus = button.getAttribute('data-status');

        document.getElementById('editGuestId').value = guestId;
        document.getElementById('editGuestName').value = guestName;
        document.getElementById('editGuestAddress').value = guestAddress;
        document.getElementById('editGuestStatus').value = guestStatus;

        document.getElementById('editGuestForm').action = '/guest/' + guestId;
    });
});

// Fungsi hapus tamu pakai AJAX
function deleteGuest(id, name) {
    if (!confirm(`Yakin ingin menghapus tamu: ${name} ?`)) return;

    fetch(`/guest/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            const row = document.querySelector(`button[onclick="deleteGuest(${id}, '${name}')"]`).closest('tr');
            if (row) row.remove();
        } else {
            alert('Gagal menghapus tamu: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        alert('Terjadi kesalahan saat menghapus tamu.');
        console.error(error);
    });
}
