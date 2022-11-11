<?php

namespace App\Http\Livewire;

use App\Models\Book;
use App\Models\BookUser;
use Illuminate\Support\Facades\Auth;

class Payment extends Cart
{
    public $Book_id;

    public $Book;

    public function enrollNow($Book_id)
    {
    }

    // public function storeEnrollment()
    // {
    //     if (!Auth::check()) {
    //         return   $this->dispatchBrowserEvent('loginModal');
    //     }

    //     if (count(BookUser::where(['Book_id' => $this->Book_id, 'user_id' => auth()->user()->id])->get()) > 0) {
    //         return  session()->flash('error', "You have been enrolled to this Book" . $this->Book->name);
    //     }
    //     BookUser::create(['Book_id' => $this->Book_id, 'user_id' => auth()->user()->id]);
    //     session()->flash('success', "You have successfully enrolled to this Book" . $this->Book->name);
    //     $this->dispatchBrowserEvent('closeModal');
    // }

    public function render()
    {
        return view('livewire.payment');
    }
}
