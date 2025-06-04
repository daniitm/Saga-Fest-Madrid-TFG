<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use Illuminate\Support\Facades\Crypt;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $token = [
            'value' => bin2hex(random_bytes(16)),
        ];
        $encryptedToken = Crypt::encrypt($token);

        return view('layouts.app', [
            'encryptedToken' => $encryptedToken,
        ]);
    }
}
