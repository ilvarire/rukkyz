<?php

namespace App\Livewire\Customer;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;


#[Layout('components.layouts.guest')]
class Profile extends Component
{
    public $current_password;
    public $password;

    // public function updatePassword()
    // {
    //     $this->validate([
    //         'current_password' => ['required', 'current_password'],
    //         'password' => ['required', Password::defaults(), 'confirmed']
    //     ]);
    //     $user = User::find(auth()->id());
    //     $user->update([
    //         'password' => Hash::make($this->password),
    //     ]);
    //     $this->reset(['current_password', 'password', 'password_confirmation']);

    //     // Send password changed email messaged

    //     LivewireAlert::title('password changed')
    //         ->text('successfully updated password.')
    //         ->success()
    //         ->toast()
    //         ->timer(3000)
    //         ->position('center')
    //         ->show();

    //     return back()->with('status', 'password-updated');
    // }
    public function render()
    {
        return view('livewire.customer.profile');
    }
}
