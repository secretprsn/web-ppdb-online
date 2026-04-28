<?php

namespace App\Notifications;

use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegistrationSuccessful extends Notification
{
    use Queueable;

    public $registration;

    public function __construct(Registration $registration)
    {
        $this->registration = $registration;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Pendaftaran PPDB Berhasil')
            ->greeting('Halo, ' . $notifiable->name . '!')
            ->line('Terima kasih telah melakukan pendaftaran di PPDB Online kami.')
            ->line('Pendaftaran kamu untuk jurusan ' . $this->registration->major->nama_jurusan . ' telah kami terima.')
            ->line('Status saat ini: ' . $this->registration->status_label)
            ->action('Lihat Dashboard', url('/dashboard'))
            ->line('Mohon simpan bukti pendaftaran kamu dan tunggu informasi selanjutnya.');
    }
}
