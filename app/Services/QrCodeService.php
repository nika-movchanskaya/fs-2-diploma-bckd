<?php

namespace App\Services;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeService
{
    /**
     * Generate and save a QR code image.
     *
     * @param $data
     * @return string QR code filename
     */
    public static function generateQrCode($data, $fileId): string
    {
        $qrCodeImage = QrCode::format('png')->size(300)->generate($data);
        $fileName = 'ticket_12' . $fileId . '.png';
        $path = public_path('qr_codes/' . $fileName);

        file_put_contents($path, $qrCodeImage);

        return $fileName;
    }
}
