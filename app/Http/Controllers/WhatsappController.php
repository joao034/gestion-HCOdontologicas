<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Odontograma;
use Illuminate\Support\Facades\Http;

class WhatsappController extends Controller
{
    public function sendMessage($id_presupuesto)
    {
        try {
            $token = env('WHATSAPP_ACCESS_TOKEN');
            $phoneId = env('PHONE_ID');
            $version = env('VERSION');

            $urlPresupuesto = env('APP_URL') . "/presupuestos/$$id_presupuesto";
            $odontograma = Odontograma::find($id_presupuesto);
            $numero = $odontograma->paciente->celular;

            if (!$numero) {
                return back()->with('danger', 'El paciente no tiene un número celular registrado');
            }

            $numero = $this->formatearNumero($numero);

            $payload = [
                'messaging_product' => 'whatsapp',
                'to' => "$numero",
                'text' =>   [
                    "preview_url" => true,
                    "body" => "Descargue su presupuesto en el siguiente enlace: $urlPresupuesto",
                ]
            ];

            //documento
            /*    "messaging_product": "whatsapp",
                "to": "593999826595",
                "type": "document",
                    "document": {
                        "link": "https://repositorio.uta.edu.ec/bitstream/123456789/39584/1/t2401so.pdf",
                        "caption": "Presupuesto Jacome Joao" 
            } */

            $message = Http::withToken($token)->post("https://graph.facebook.com/$version/$phoneId/messages", $payload)->throw()->json();

            return back()->with('message', 'Presupuesto enviado al WhatsAPP del paciente correctamente');

            /* return response()->json([
                'success' => true,
                'data' => $message
            ], 200); */
        } catch (\Exception $e) {
            /* return response()->json([
                'success' => true,
                'error' => $e->getMessage()
            ], 500); */
            return back()->with('danger', 'No se pudo enviar el mensaje ' . $e->getMessage());
        }
    }

    private function formatearNumero($numero)
    {
        $numero = substr($numero, 1);
        $numero = "593" . $numero;
        return $numero;
    }
}
