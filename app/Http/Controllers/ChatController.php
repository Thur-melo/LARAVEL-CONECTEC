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
        $request->validate(['username' => 'required|string']);
    
        // Busca o usuário pelo nome
        $user = User::where('id', $request->username)->first();
    
        if (!$user) {
            return redirect()->back()->withErrors(['id' => 'Usuário não encontrado.']);
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
            return redirect()->route('chat.show', $existingConversation->id);
        }

        $usermain = Auth::user();

        $conversations = Conversation::where('user_one_id', Auth::id())
            ->orWhere('user_two_id', Auth::id())
            ->get();

    
        // Criar a nova conversa
        $conversation = Conversation::create([
            'user_one_id' => Auth::id(),
            'user_two_id' => $user->id,
        ]);
    
        return redirect()->route('chat.show',  $conversation->id, compact('conversations', 'user'));
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

    $messages = $conversation->messages; // Isso deve retornar as mensagens

    return view('chat.show', compact('conversation','conversations', 'messages', 'user'));
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
