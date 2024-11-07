

<!-- Modal -->
<div class="modal fade custom-modal" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">Adicionar Conversa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="adicionarContainer">
                    <p>Adicione novos contatos para começar a conversar.</p>
                    <form action="/conversations" method="POST">
                        @csrf
                        <input type="text" name="username" placeholder="ID do usuário para conversar" required>
                        <button type="submit" class="btn btn-primary">Iniciar Conversa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
