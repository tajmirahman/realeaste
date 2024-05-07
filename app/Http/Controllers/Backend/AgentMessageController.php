<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PropertyMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentMessageController extends Controller
{
    //Agent Message Details
    public function AgentMessageDetails()
    {
        $id = Auth::user()->id;

        $agentMessage = PropertyMessage::where('agent_id',$id)->get();
        return view('backend.agent.message.agent_message_details',compact('agentMessage'));
    }

    //Agent Message Full
    public function AgentMessageFull($id)
    {
        $message = PropertyMessage::find($id);
        return view('backend.agent.message.agent_message_full',compact('message'));
    }

    //Agent Message Delete
    public function MessageDelete($id)
    {
        PropertyMessage::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Message Delete Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('agent.message.details')->with($notification);
    }


}
