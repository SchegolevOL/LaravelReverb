<?php

namespace App\Livewire\Pages;

use App\Events\MessageSendEvent;
use App\Events\UnreadMessageEvent;
use App\Events\UserTypingEvent;
use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Chat extends Component
{
    use WithFileUploads;
    public $user;
    public $message;
    public $senderId;
    public $receiverId;
    public $messages;
    public $file;

    public function mount($userId)
    {
        $this->user=$this->getUser($userId);
        $this->senderId=auth()->user()->id;
        $this->receiverId=$userId;
        $this->messages=$this->getMessages();
        $this->dispatch('message-updated');
        $this->readAllMessages();

    }

    public function render()
    {
        $this->readAllMessages();
        return view('livewire.pages.chat');
    }

    /**
     * @param $userId
     * @return User|Collection|Model|null
     */
    public function getUser($userId)
    {
        return User::query()->find($userId);
    }
    public function sendMessage()
    {


        $sendMessage = $this->saveMessage();

        $this->messages[]=$sendMessage;
        broadcast(new MessageSendEvent($sendMessage));
        $unreadMessagesCount = $this->getUnreadMessagesCount();
        broadcast(new UnreadMessageEvent($this->senderId, $this->receiverId, $unreadMessagesCount))->toOthers();
        $this->message='';
        $this->file=null;
        $this->dispatch('message-updated');
    }
    public function getMessages()
    {
        //dd($this->senderId, $this->receiverId, auth()->id());
        /*return Message::query()
            ->where('sender_id',$this->senderId)
            ->where('receiver_id',$this->receiverId)
            ->orWhere('sender_id',$this->receiverId)
            ->orWhere('receiver_id',$this->senderId)
            ->get();*/
        return Message::query()->with('sender:id,name','receiver:id,name')->
            where(function ($query) {
              $query->where('sender_id',$this->senderId)->orWhere('receiver_id',$this->receiverId);
        })->orWhere(function ($query) {
            $query->where('sender_id',$this->receiverId)->orWhere('receiver_id',$this->senderId);
        })->get();
    }
    public function saveMessage()
    {
        #File Handling
        $fileName=null;
        $file_original_name=null;
        $folder_path=null;
        $fileType = null;
        if ($this->file){
            $fileName = $this->file->hashName();
            $file_original_name = $this->file->getClientOriginalName();
            $folder_path = $this->file->store('chat_files', 'public');
            $fileType         = $this->file->getMimeType();
        }

        return Message::query()->create([
            'sender_id'=>$this->senderId,
            'receiver_id'=>$this->receiverId,
            'message'=>$this->message,
            'file_name'=>$fileName,
            'file_original_name'=>$file_original_name,
            'folder_path'=>$folder_path,
            'is_read'=>false,
            'file_type'=>$fileType,
        ]);
    }
    #[On('echo-private:chat-channel.{senderId},MessageSendEvent')]
    public function listenMessage($event)
    {
        $newMessage=Message::query()->find($event['message']['id'])->load('sender:id,name','receiver:id,name');
        $this->messages[]=$newMessage;
    }
public function userTyping()
{
    broadcast(new UserTypingEvent($this->senderId, $this->receiverId))->toOthers();
}

public function readAllMessages()
{
    Message::query()->where('sender_id',$this->receiverId)->where('receiver_id',$this->senderId)->where('is_read', false)->update(['is_read'=>true]);
}

public function getUnreadMessagesCount()
{
    return Message::query()->where('receiver_id',$this->receiverId)->where('is_read', false)->count();
}


}
