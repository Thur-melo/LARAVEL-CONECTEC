<?php
namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ChatController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        $conversations = Conversation::where('user_one_id', Auth::id())
            ->orWhere('user_two_id', Auth::id())
            ->get();

        return view('chat.index', compact('conversations', 'user'));
    }

    

    public function createConversation(Request $request)
    {
        // Validação dos dados de entrada
        $request->validate([
            'username' => 'required|string',
        ]);
    
        // Busca o usuário pelo nome
        $user = User::where('arroba', $request->username)->first();
    
        if (!$user) {
            return redirect()->back()->withErrors(['arroba' => 'Usuário não encontrado.']);
        }
    
        // Verifique se a conversa já existe
        $existingConversation = Conversation::where(function ($query) use ($user) {
            $query->where('user_one_id', Auth::id())
                  ->where('user_two_id', $user->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('user_one_id', $user->id)
                  ->where('user_two_id', Auth::id());
        })->first();
    
        if ($existingConversation) {
            // Se a conversa já existir, redireciona para a conversa existente
            return redirect()->route('chat.show', $existingConversation->id);
        }
    
        // Criar a nova conversa
        $conversation = Conversation::create([
            'user_one_id' => Auth::id(),
            'user_two_id' => $user->id,
        ]);
    
        // Recuperar as conversas do usuário logado
        $conversations = Conversation::where('user_one_id', Auth::id())
            ->orWhere('user_two_id', Auth::id())
            ->get();
    
        // Redirecionar para a conversa recém-criada e passar os dados necessários
        return redirect()->route('chat.show', $conversation->id)
                         ->with('conversations', $conversations)
                         ->with('user', $user);
    }
    
    



    public function showConversation($id)
{
    $user = Auth::user();
    $conversation = Conversation::with('messages.user')->findOrFail($id);
    $conversations = Conversation::where('user_one_id', Auth::id())
    ->orWhere('user_two_id', Auth::id())
    ->get();


    // Verifique se o usuário atual está na conversa
    if (!($conversation->user_one_id === Auth::id() || $conversation->user_two_id === Auth::id())) {
        abort(403); // Acesso negado
    }

    $ultimaMensagem = $conversation->messages()->orderBy('created_at', 'desc')->first();

    $messages = $conversation->messages; // Isso deve retornar as mensagens

    return view('chat.show', compact('conversation','conversations', 'messages', 'user','ultimaMensagem'));
}


public function storeMessage(Request $request, $conversationId)
{
    // Validação
    $request->validate(['message' => 'required']);

    // Encontra a conversa com base no ID
    $conversation = Conversation::findOrFail($conversationId);

    // Cria a nova mensagem associada à conversa
    Message::create([
        'conversation_id' => $conversationId,  // Aqui, associamos a mensagem à conversa correta
        'user_id' => Auth::id(),
        'username' => Auth::user()->name,  // Usa o nome do usuário autenticado
        'message' => $request->message,  // O conteúdo da mensagem
    ]);

    // Após salvar a mensagem, redireciona de volta para a conversa
    return redirect()->route('chat.show', ['id' => $conversationId]);
}



}
