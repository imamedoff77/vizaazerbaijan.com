<?php

namespace App\Services;

use App\Models\ContactMessage;

class ContactService
{
    /**
     * @param array $data
     * @return ContactMessage
     */
    public function save(array $data): ContactMessage
    {
        $message = new ContactMessage();
        $message->name = $data['name'];
        $message->email = $data['email'];
        if (isset($data['application_number'])) {
            $message->application_number = $data['application_number'];
        }
        $message->message = $data['message'];
        $message->save();
        return $message;
    }

    /**
     * @param int $id
     * @return ContactMessage
     */
    public function read(int $id): ContactMessage
    {
        $message = ContactMessage::find($id);
        $message->read_at = now();
        $message->save();
        return $message;
    }

    /**
     * @param array $ids
     * @return void
     */
    public function bulkDelete(array $ids): void
    {
        ContactMessage::destroy($ids);
    }
}
