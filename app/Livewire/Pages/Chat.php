<?php

namespace App\Livewire\Pages;

use App\Events\MessageSendEvent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\On;
use Livewire\Component;

class Chat extends Component
{
    public $user;
    public $message;
    public $senderId;
    public $receiverId;
    public $messages;

    public function mount($userId)
    {
        $this->user=$this->getUser($userId);
        $this->senderId=auth()->user()->id;
        $this->receiverId=$userId;
        $this->messages=$this->getMessages();
        $this->dispatch('message-updated');
    }

    public function render()
    {
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
        $this->message='';

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
        return Message::query()->create([
            'sender_id'=>$this->senderId,
            'receiver_id'=>$this->receiverId,
            'message'=>$this->message,
            /*'file_name',
            'file_original_name',
            'folder_path',*/
            'is_read'=>false,
        ]);
    }
    #[On('echo-private:chat-channel.{senderId},MessageSendEvent')]
    public function listenMessage($event)
    {
        $newMessage=Message::query()->find($event['message']['id'])->load('sender:id,name','receiver:id,name');
        $this->messages[]=$newMessage;
    }







}
