document.addEventListener("DOMContentLoaded", () => {
    // Selecciona todos los botones de eliminar
    const deleteButtons = document.querySelectorAll("button[data-delete-task]");

    // Agrega un listener a cada botón
    deleteButtons.forEach(button => {
        button.addEventListener("click", (event) => {
            const taskId = button.getAttribute("data-delete-task");

            // Confirmación antes de eliminar
            if (confirm("Are you sure you want to delete this task?")) {
                deleteTask(taskId);
            }
        });
    });
});

// Define la función de eliminar tarea
function deleteTask(taskId) {
    // Ejemplo de lógica para eliminar (puedes personalizar esto)
    fetch(`/tasks/${taskId}`, {
        method: "DELETE",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => {
        if (response.ok) {
            // Elimina la tarea del DOM
            const taskElement = document.getElementById(`task-${taskId}`);
            taskElement.remove();
            alert("Task deleted successfully.");
        } else {
            alert("Failed to delete task.");
        }
    })
    .catch(error => {
        console.error("Error deleting task:", error);
        alert("An error occurred.");
    });
}
