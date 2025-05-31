
document.addEventListener("DOMContentLoaded", () => {
    // Selecciona todos los botones de eliminar
    const editButtons = document.querySelectorAll("button[data-edit-task]");

    // Agrega un listener a cada botón
    editButtons.forEach(button => {
        button.addEventListener("click", (event) => {
            const taskId = button.getAttribute("data-edit-task");

            openEditModal(taskId);

        });
    });
});


function openEditModal(id) {
    // Aquí podrías usar fetch para recuperar más información de la tarea

    fetch(`/tasks/${id}`)
        .then(response => response.json())
        .then(data => {
            const selectCtrl = document.getElementById('edit-status');
            document.getElementById('edit-task-id').value = id;
            document.getElementById('edit-title').value = data['edit-title'] || ''; // Asegúrate de que `data.title` exista

            document.getElementById('edit-description').value = data['edit-description'] || ''; // Asegúrate de que `data.title` exista

            document.getElementById('edit-due-date').value = data['edit-due-date'] || ''; // Asegúrate de que `data.title` exista
            fillStatusOptions(selectCtrl, data.statuses, data['edit-status']);
            document.getElementById('edit-modal').classList.remove('hidden');
        })

        .catch(error => console.error('Error fetching task data:', error));
}

function closeEditModal() {
    document.getElementById('edit-modal').classList.add('hidden');
}

function fillStatusOptions(selectCtrl, statuses, valor){
    selectCtrl.innerHTML = '';
    statuses.forEach(opt => {
        const newOption = document.createElement('option');
        newOption.value = opt;
        newOption.text = opt;
        selectCtrl.appendChild(newOption);
    });
    statuses.value = valor;
};



async function submitEdit(event) {
    event.preventDefault();
    const id = document.getElementById('edit-task-id').value;
    const title = document.getElementById('edit-title').value;
    const description = document.getElementById('edit-description').value;
    const due_date = document.getElementById('edit-due-date').value;
    const status = document.getElementById('edit-status').value;
    const tkn1 = document.querySelector('meta[name="csrf-token"]').content;


    const response = await fetch(`/tasks/${id}`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': tkn1,
        },
        body: JSON.stringify({
            id, title, description, due_date, status
        }),
    });

    if (response.ok) {
        const taskElement = document.getElementById(`task-${id}`);
        taskElement.querySelector('[esTitulo]').textContent = title;
        taskElement.querySelector('[esFecha]').textContent = due_date;
        taskElement.querySelector('[esStatus]').textContent = status;
        closeEditModal();
    } else {
        const errorData = await response.json();
        console.error('Error al actualizar la tarea:', errorData);
        alert('Failed to update task');
    }
}

window.openEditModal = openEditModal;
window.closeEditModal = closeEditModal;
window.submitEdit = submitEdit;
