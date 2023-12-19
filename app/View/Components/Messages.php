<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Messages extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        $message = null;
        if (session()->get('success_message')) {
            $message['type'] = "success";
            $message['text'] = session()->get('success_message');
        }

        if (session()->get('info_message')) {
            $message['type'] = "info";
            $message['text'] = session()->get('info_message');
        }

        if (session()->get('error_message')) {
            $message['type'] = "error";
            $message['text'] = session()->get('error_message');
        }

        if (session()->get('status')) {
            $message['type'] = "info";

            switch (session()->get('status')) {
                case "verification-link-sent":
                    $message['text'] = __('account.verification_link_sent');
                    break;
                case "profile-information-updated":
                    $message['text'] =  __('account.profile_information_updated');
                    break;
                case "password-updated":
                    $message['text'] =  __('account.password_updated');
                    break;
                default:
                    $message['text'] = session()->get('status');
                    break;
            }
        }


        return view('components.messages', [
            "message" => $message
        ]);
    }
}
