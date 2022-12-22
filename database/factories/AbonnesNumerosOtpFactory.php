<?php

namespace Database\Factories;

use App\Models\Abonne;
use App\Models\AbonnesNumero;
use Illuminate\Database\Eloquent\Factories\Factory;

class AbonnesNumerosOtpFactory extends Factory {

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        $abonne_numero = AbonnesNumero::inRandomOrder()->first();
        $form_number = ($abonne_numero->abonnes_statut_id != '1') ? Abonne::find($abonne_numero->abonne_id)->numero_dossier : '';
        $otp_code = ($abonne_numero->abonnes_statut_id != '1') ? $abonne_numero->otp_code : '';
        $otp_sms_title = ($abonne_numero->abonnes_statut_id != '1') ? $abonne_numero->otp_code : '';
        $otp_sms_message = ($abonne_numero->abonnes_statut_id != '1') ? $abonne_numero->otp_sms : '';
        $otp_verification_status = $abonne_numero->abonnes_statut_id;
        return [
            'msisdn' => $abonne_numero->numero_de_telephone,
            'form_number' => $form_number,
            'otp_code' => $otp_code,
            'otp_sms_title' => $otp_sms_title,
            'otp_sms_message' => $otp_sms_message,
            'otp_verification_status' => $otp_verification_status,
        ];
    }

}
