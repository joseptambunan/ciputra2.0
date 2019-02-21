<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\User\Entities\User;

class EmailApproved extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $total_project = 0;
        $total_doc = 0;
        $total_approve = 0;
        $project = array();

        foreach ($this->user->approval_histories as $key => $value) {
            if (  $value->document_type != "Modules\Tender\Entities\TenderRekanan" && $value->document_type != "Modules\Tender\Entities\TenderMenang"  && $value->document_type != "Modules\Budget\Entities\BudgetDetail" ){
                if ( $value->document != "" ){                  
                    if ( $value->document->project != "" ){
                        if ( $value->approval_action_id == 1 ){
                            $project[$value->document->project->id] = 1;
                            $total_doc = $total_doc + 1;
                        } 
                    }  
                }
            }                
        }
        $total_project = count($project);

        return $this->view('mail.body1')
        ->with([
            'total_project' => $total_project,
            'total_doc' => $total_doc,
            'total_approve' => $total_doc,
            'url' => "http://117.53.46.38"
        ]);
    }
}
