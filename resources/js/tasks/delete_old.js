async function deleteTask(id) {
    try {
        const response = await fetch(`/tasks/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content'),
            },
        });

        if (!response.ok) {
            const error = await response.json();
            console.error('Error al eliminar la tarea:', error);
            alert('Failed to delete task: ' + error.message || response.statusText);
        } else {
            //borrar
            const data = await response.json();
            alert(data.message); // Mostrar el mensaje recibido del servidor
            //borrar
            document.getElementById(`task-${id}`).remove();
        }
    } catch (error) {
        console.error('Error de red:', error);
        alert('Failed to delete task due to a network error.');
    }
}

window.deleteTask = deleteTask;
