document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.follow-btn').forEach(function(button) {
        button.addEventListener('click', function(event) {
            const userId = this.dataset.userId; // Define corretamente o userId
            const action = this.dataset.action.trim(); // Remova espaços extras
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            fetch(`/${action}/${userId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'followed') {
                    this.dataset.action = 'unfollow';
                    this.textContent = 'Deixar de Seguir';
                } else if (data.status === 'unfollowed') {
                    this.dataset.action = 'follow';
                    this.textContent = 'Seguir';
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});
