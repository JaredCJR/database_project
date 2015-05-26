<?php
//密碼至多32個
//帳號至多32個
//$Pass = "Passwort";    
//$Clear = "fdsf45s46a7f489s4af984a84df98556";    

/*
$crypted = fnEncrypt($Clear, $Pass);
echo "Encrypred: ".$crypted."</br>";*/
/*
$crypted = fnEncrypt("123", "MuLin");
echo "Encrypred: ".$crypted."</br>";
*/
/*
$newClear = fnDecrypt($crypted, $Pass);
echo "Decrypred: ".$newClear."</br>";   
*/
function fnEncrypt($sValue, $sSecretKey)
{
    return rtrim(
        base64_encode(
            mcrypt_encrypt(
                MCRYPT_RIJNDAEL_256,
                $sSecretKey, $sValue, 
                MCRYPT_MODE_ECB, 
                mcrypt_create_iv(
                    mcrypt_get_iv_size(
                        MCRYPT_RIJNDAEL_256, 
                        MCRYPT_MODE_ECB
                    ), 
                    MCRYPT_RAND)
                )
            ), "\0"
        );
}

function fnDecrypt($sValue, $sSecretKey)
{
    return rtrim(
        mcrypt_decrypt(
            MCRYPT_RIJNDAEL_256, 
            $sSecretKey, 
            base64_decode($sValue), 
            MCRYPT_MODE_ECB,
            mcrypt_create_iv(
                mcrypt_get_iv_size(
                    MCRYPT_RIJNDAEL_256,
                    MCRYPT_MODE_ECB
                ), 
                MCRYPT_RAND
            )
        ), "\0"
    );
}
?>