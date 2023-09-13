<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Base64Image implements Rule
{
    public function passes($attribute, $value)
    {
        // Vérifiez si la chaîne commence par "data:image/png;base64,"
        if (preg_match('/^data:image\/(png);base64,/', $value)) {
            // Supprimez le préfixe "data:image/png;base64,"
            $base64Data = substr($value, strpos($value, ',') + 1);

            // Créez un fichier temporaire
            $tempFilePath = tempnam(sys_get_temp_dir(), 'base64img_');

            // Écrivez les données base64 dans le fichier temporaire
            file_put_contents($tempFilePath, base64_decode($base64Data));

            // Vérifiez si le fichier est une image PNG valide
            $imageInfo = getimagesize($tempFilePath);
            $isValidImage = $imageInfo !== false && $imageInfo['mime'] === 'image/png';

            // Supprimez le fichier temporaire
            unlink($tempFilePath);

            return $isValidImage;
        }

        return false;
    }

    public function message()
    {
        return 'Le champ :attribute doit contenir une image PNG valide en base64.';
    }
}
