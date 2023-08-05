document.addEventListener('DOMContentLoaded', function () {

    // Attach event listener to the switch input
    const toggleTransportationInputs = document.querySelectorAll('.toggle-transportation');
    toggleTransportationInputs.forEach(function (input) {
        input.addEventListener('change', function () {
            const form = input.closest('form');

            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    showMessage('success', 'Employee transportation status updated successfully');
                })
                .catch(error => {
                    console.error(error);
                    showMessage('error', 'An error occurred while updating transportation status');
                });
        });
    });
    // Function to show messages
    function showMessage(type, message) {
        // Remove any existing messages
        const existingMessages = document.querySelectorAll('.alert-message');
        existingMessages.forEach(message => message.remove());

        // Create the message element
        const alertDiv = document.createElement('div');
        alertDiv.classList.add('alert-message');
        alertDiv.classList.add(type === 'success' ? 'alert-success' : 'alert-danger');
        alertDiv.textContent = message;

        // Append the message element to the container (you can choose a suitable container)
        const container = document.querySelector('.container');
        container.prepend(alertDiv);
    }
});
