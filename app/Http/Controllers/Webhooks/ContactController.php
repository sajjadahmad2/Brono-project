<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Contact;
use App\Models\Opportunity;
use Carbon\Carbon;
use App\Models\Appointment;
use App\Models\Call;

class ContactController extends Controller
{


    public function handle_contact($data=[]){
        
        $type = $data['type'] ?? null;
        $location_id =  $data['locationId'] ?? $data['location_id'];
        // Find the contact by ghl_contact_id and location_id
        $contact = Contact::where('ghl_contact_id', $data['id'])
                    ->where('location_id', $location_id)
                    ->first();
        
        if($type == 'ContactDelete'){
            if($contact){
                $contact->delete();
                Log::info("Contact with GHL Contact ID: {$data['id']} deleted successfully.");
            }else{
                Log::info("Contact with GHL Contact ID: {$data['id']} not found.");
            }
            return "done";
        }

        // Data to update or create the contact
        $contactData = [
            'ghl_contact_id' => $data['id'],
            'location_id' => $data['locationId'],
            'name' => isset($data['firstName']) && isset($data['lastName']) ? $data['firstName'] . ' ' . $data['lastName'] : null,
            'email' => isset($data['email']) ? $data['email'] : null,
            'country' => isset($data['country']) ? $data['country'] : null,
            'assigned_to' => isset($data['assignedTo']) ? $data['assignedTo'] : null,
            'tags' => isset($data['tags']) ? implode(',', $data['tags']) : null, // Convert tags array to a comma-separated string
            'dnd' => isset($data['dnd']) ? $data['dnd'] : null,
            'dnd_settings_email' => isset($data['dndSettings']['Email']['status']) ? $data['dndSettings']['Email']['status'] : null,
            'dnd_settings_sms' => isset($data['dndSettings']['SMS']['status']) ? $data['dndSettings']['SMS']['status'] : null,
            'dnd_settings_call' => isset($data['dndSettings']['Call']['status']) ? $data['dndSettings']['Call']['status'] : null,
            'date_added' => isset($data['dateAdded']) ? $data['dateAdded'] : null,
            'date_of_birth' => isset($data['dateOfBirth']) ? date('Y-m-d', strtotime($data['dateOfBirth'])) : null,
        ];

        // Update the existing user or create a new one
        if ($contact) {
            $contact->update($contactData);
            Log::info("Contact with GHL Contact ID: {$data['id']} updated successfully.");
        } else {
            $user = Contact::create($contactData);
            Log::info("Contact with GHL Contact ID: {$data['id']} created successfully.");
        }

        return $contact;

    }

    public function handle_opportunity($data=[]){
        $type = $data['type'];
        $location_id =  $data['locationId'] ?? $data['location_id'];
        // Find the opportunity by ghl_opportunity_id and location_id
        $opportunity = Opportunity::where('ghl_opportunity_id', $data['id'])
                    ->where('location_id', $location_id)
                    ->first();
        
        if($type == 'OpportunityDelete'){

            if($opportunity){
                $opportunity->delete();
                Log::info("Opportunity with GHL Opportunity ID: {$data['id']} deleted successfully.");
            }else{
                Log::info("Opportunity with GHL Opportunity ID: {$data['id']} not found.");
            }
            return "done";
        }

        $dateAdded = isset($data['dateAdded']) ? $data['dateAdded'] : null;
         $dateAdded =!is_null($dateAdded) ? Carbon::parse($dateAdded)->format('Y-m-d H:i:s') : null;
        // Data to update or create the opportunity
        $opportunityData = [
            'ghl_opportunity_id' => $data['id'],
            'location_id' => $data['locationId'],
            'assigned_to' => isset($data['assignedTo']) ? $data['assignedTo'] : null,
            'contact_id' => isset($data['contactId']) ? $data['contactId'] : null,
            'monetary_value' => isset($data['monetaryValue']) ? $data['monetaryValue'] : null,
            'name' => isset($data['name']) ? $data['name'] : null,
            'pipeline_id' => isset($data['pipelineId']) ? $data['pipelineId'] : null,
            'pipeline_stage_id' => isset($data['pipelineStageId']) ? $data['pipelineStageId'] : null,
            'source' => isset($data['source']) ? $data['source'] : null,
            'status' => isset($data['status']) ? $data['status'] : null,
            'date_added' =>$dateAdded
        ];

        // Update the existing opportunity or create a new one
        if ($opportunity) {
            $opportunity->update($opportunityData);
            Log::info("Opportunity with GHL Opportunity ID: {$data['id']} updated successfully.");
        } else {
            $opportunity = Opportunity::create($opportunityData);
            Log::info("Opportunity with GHL Opportunity ID: {$data['id']} created successfully.");
        }

        return $opportunity;

    }

    public function handle_appointment($data=[]){
        $type = $data['type'];
        $location_id =  $data['locationId'] ?? $data['location_id'];
        // Find the appointment by ghl_appointment_id and location_id
        $appointment = Appointment::where('ghl_appointment_id', $data['appointment']['id'])
                    ->where('location_id', $location_id)
                    ->first();
        
        
        if($type == 'AppointmentDelete'){

            if($appointment){
                $appointment->delete();
                Log::info("Appointment with GHL Appointment ID: {$data['id']} deleted successfully.");
            }else{
                Log::info("Appointment with GHL Appointment ID: {$data['id']} not found.");
            }
            return "done";
        }

        //overwriting the $data 
        $data = isset($data['appointment']) ? $data['appointment'] : $data;

        $dateAdded = isset($data['dateAdded']) ? $data['dateAdded'] : null;
        $dateAdded =!is_null($dateAdded) ? Carbon::parse($dateAdded)->format('Y-m-d H:i:s') : null;
        $startTime = isset($data['startTime']) ? $data['startTime'] : null;
        $startTime =!is_null($startTime) ? Carbon::parse($startTime)->format('Y-m-d H:i:s') : null;
        $endTime = isset($data['endTime']) ? $data['endTime'] : null;
        $endTime =!is_null($endTime) ? Carbon::parse($endTime)->format('Y-m-d H:i:s') : null;
        // Data to update or create the appointment
        $appointmentData = [
            'ghl_appointment_id' => $data['id'],
            'location_id' => $location_id,
            'address' => isset($data['address']) ? $data['address'] : null,
            'title' => isset($data['title']) ? $data['title'] : null,
            'calendar_id' => isset($data['calendarId']) ? $data['calendarId'] : null,
            'contact_id' => isset($data['contactId']) ? $data['contactId'] : null,
            'group_id' => isset($data['groupId']) ? $data['groupId'] : null,
            'appointment_status' => isset($data['appointmentStatus']) ? $data['appointmentStatus'] : null,
            'assigned_user_id' => isset($data['assignedUserId']) ? $data['assignedUserId'] : null,
            'users' => isset($data['users']) ?json_encode($data['users']) : null,
            'notes' => isset($data['notes']) ? $data['notes'] : null,
            'source' => isset($data['source']) ? $data['source'] : null,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'date_added' => $dateAdded,
        ];

        // Update the existing appointment or create a new one
        if ($appointment) {
            $appointment->update($appointmentData);
            Log::info("Appointment with GHL Appointment ID: {$data['id']} updated successfully.");
        } else {
            $appointment = Appointment::create($appointmentData);
            Log::info("Appointment with GHL Appointment ID: {$data['id']} created successfully.");
        }

        return $appointment;

    }

    public function handle_outbound_message_old($data=[])
    {

        $dateAdded = isset($data['dateAdded']) ? $data['dateAdded'] : null;
        $dateAdded =!is_null($dateAdded) ? Carbon::parse($dateAdded)->format('Y-m-d H:i:s') : null;
        // Data to update or create the call
        $callData = [
            'type' => $data['type'],
            'location_id' => $data['locationId'],
            'attachments' => isset($data['attachments']) ? $data['attachments'] : null,
            'contact_id' => isset($data['contactId']) ? $data['contactId'] : null,
            'conversation_id' => isset($data['conversationId']) ? $data['conversationId'] : null,
            'date_added' => $dateAdded,
            'direction' => isset($data['direction']) ? $data['direction'] : null,
            'message_type' => isset($data['messageType']) ? $data['messageType'] : null,
            'message_id' => isset($data['messageId']) ? $data['messageId'] : null,
            'status' => isset($data['status']) ? $data['status'] : null,
        ];

        // Create the call
        $call = Call::create($callData);
        Log::info("Call created successfully.");

        return $call;
    }
    
    
    
    public function handle_outbound_message($data=[])
    {


        try{
            $dateAdded = isset($data['dateAdded']) ? $data['dateAdded'] : null;
            $dateAdded =!is_null($dateAdded) ? Carbon::parse($dateAdded)->format('Y-m-d H:i:s') : null;
            // Data to update or create the call
            $callData = [
                'type' => $data['type'],
                'location_id' => $data['locationId'],
                'attachments' => isset($data['attachments']) ? json_encode($data['attachments']) : null,
                'contact_id' => isset($data['contactId']) ? $data['contactId'] : null,
                'conversation_id' => isset($data['conversationId']) ? $data['conversationId'] : null,
                'date_added' => $dateAdded,
                'direction' => isset($data['direction']) ? $data['direction'] : null,
                'message_type' => isset($data['messageType']) ? $data['messageType'] : null,
                'message_id' => isset($data['messageId']) ? $data['messageId'] : null,
                'status' => isset($data['status']) ? $data['status'] : null,
            ];
    
            // Create the call
            $call = Call::create($callData);
            Log::info("Call created successfully.");
    
            return $call;
        }catch(\Exception $e){
            Log::info('-----------------  Array to string conversion error -----------------');
            Log::info(json_encode($data));
            Log::alert("Error: ".$e->getMessage());
            Log::info('-----------------  Array to string conversion error -----------------');
        }

       
    }



    public function handle_webhook(Request $request)
    {
        // Extract data from the request
        $data = $request->all();
        $type = $data['type'] ?? null;
        if(in_array($type, ['ContactCreate', 'ContactUpdate', 'ContactDelete', 'ContactTagUpdate','ContactDndUpdate'])){
            $this->handle_contact($data);
        }else if (in_array($type, ['OpportunityCreate', 'OpportunityUpdate', 'OpportunityDelete','OpportunityAssignedToUpdate','OpportunityMonetaryValueUpdate','OpportunityStageUpdate','OpportunityStatusUpdate'])){
            $this->handle_opportunity($data);
        }else if (in_array($type,['AppointmentCreate','AppointmentUpdate','AppointmentDelete'])){
            $this->handle_appointment($data);
        }else if(in_array($type,['OutboundMessage'])){
            if(isset($data['messageType']) && $data['messageType'] == 'CALL'){
               $this->handle_outbound_message($data);
            }
        }else{
            Log::info("Webhook type not found: {$type}");
        }

        return response()->json(['status' => 'success']);
    }

    
}
