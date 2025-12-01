<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class FeedbackPage extends Component
{
    public $feedbacks, $feedbackCount;
    public function mount() {
        $this->feedbacks = \App\Models\Feedback::all();
        $this->feedbackCount = \App\Models\Feedback::get()->count();
    }

    public function render()
    {
        return view('livewire.admin.feedback')->layout('components.layouts.dashboard');
    }
}
