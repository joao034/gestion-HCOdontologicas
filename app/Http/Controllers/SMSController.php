<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Odontograma;
use Twilio\Rest\Client;

class SMSController extends Controller
{
    public function send_sms($id_presupuesto)
    {
        try {
            $account_sid = env('TWILIO_SID');
            $auth_token = env('TWILIO_AUTH_TOKEN');

            $twilio_number = env('TWILIO_PHONE_NUMBER');

            $urlPresupuesto = env('APP_URL') . "/presupuestos/pdf/$id_presupuesto";
            $odontograma = Odontograma::find($id_presupuesto);
            $numero = $odontograma->paciente->celular;

            if (!$numero) {
                return back()->with('danger', 'El paciente no tiene un número celular registrado');
            }

            $numero = $this->formatearNumero($numero);

            $client = new Client($account_sid, $auth_token);
            $client->messages->create(
                $numero,
                array(
                    'from' => $twilio_number,
                    'body' => 'Revise su presupuesto en el siguiente enlace: ' . $urlPresupuesto
                )
            );
            return back()->with('message', 'Presupuesto enviado al celular del paciente correctamente');

        } catch (\Exception $e) {
            return back()->with('danger', 'No se pudo enviar el mensaje ' . $e->getMessage());
        }
    }

    private function formatearNumero($numero)
    {
        $numero = substr($numero, 1);
        $numero = "+593" . $numero;
        return $numero;
    }
}
