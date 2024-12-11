function openEditModal(id, title) {
    document.getElementById('edit-task-id').value = id;
    document.getElementById('edit-title').value = title;
    document.getElementById('edit-modal').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('edit-modal').classList.add('hidden');
}

async function submitEdit(event) {
    event.preventDefault();
    const id = document.getElementById('edit-task-id').value;
    const title = document.getElementById('edit-title').value;

    const response = await fetch(`/tasks/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: JSON.stringify({
            title
        }),
    });

    if (response.ok) {
        const taskElement = document.getElementById(`task-${id}`);
        taskElement.querySelector('h4').textContent = title;
        closeEditModal();
    } else {
        alert('Failed to update task');
    }
}

window.openEditModal = openEditModal;
window.closeEditModal = closeEditModal;
window.submitEdit = submitEdit;
