<?php
    include('phpqrcode.php');

    function qr_code_create($content,                           //  text string to encode
                            $width_height = 200,                     //  (optional) qrcode image width and height
                            $outfile=null, // 	(optional) output file name, if false outputs to browser with required headers
                            $margin = 2,                             //  (optional) code margin (silent zone) in 'virtual' pixels
                            $level = QR_ECLEVEL_L,                   // 	(optional) error correction level QR_ECLEVEL_L, QR_ECLEVEL_M, QR_ECLEVEL_Q or QR_ECLEVEL_H
                            $saveandprint = false,                   //  (optional) if true code is outputed to browser and saved to file, otherwise only saved to file. It is effective only if $outfile is specified.
                            $size = 7                                //	(optional) pixel size, multiplier for each 'virtual' pixel
    )
    {
        if(!defined('IMAGE_WIDTH')) {
            define('IMAGE_WIDTH', $width_height);
            define('IMAGE_HEIGHT', $width_height);
        }
        if($outfile==null)
            $outfile = 'D:/qr_code/'.time().'.png';
        QRcode::png($content,$outfile,$level,$size,$margin,$saveandprint);
        return $outfile;
    }
    qr_code_create("https://github.com/hanlli/Tool");