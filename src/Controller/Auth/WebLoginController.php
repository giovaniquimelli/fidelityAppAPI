<?php


namespace App\Controller\Auth;


use App\Entity\Users;
use RangeException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\SodiumPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\DateTime;

class WebLoginController extends AbstractController
{

    /**
     * @Route(path="/api/home", methods={"GET", "POST"})
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function home(Request $request)
    {
        $_common = '$argon2id$v=19$m=10,t=3,p=1$';
        $_secret = 'default';
        $_sodium = new SodiumPasswordEncoder(3, 1024 * 10);
        $_salt = '5f6c92bc-739d-427b-8a02-388a8d2b74c8';
        $_key = '9c3fdc8c5248200c6cfa4d8facec7f88';

        $d = [
            str_replace($_common, "", $_sodium->encodePassword($_secret, $_salt)),
            (new \DateTime())->format('Y-m-d H:i:s.u'),
            bin2hex(random_bytes(10))
        ];

        // dd($this->safeEncrypt(implode("$", $d), $_key));
        // dd(bin2hex(crypt((new \DateTime())->format('Y-m-d H:i'), random_bytes(10))));

        $_sodium = new SodiumPasswordEncoder(3, 1024 * 10);

        if($request->getMethod() == 'POST') {

            $ssd = $request->get('token');

            dd(explode("%", $this->safeDecrypt($ssd, $_key)));

        }

        $sd = str_replace($_common, "", $_sodium->encodePassword($_secret, $_salt));
        // dd($sd, $_sodium->isPasswordValid($_common. $sd, 'do-sign-in',$_salt));


        return $this->render('auth/sign-in.html.twig',[
            'colegio_lobo' => 'Colégio Lobo',
            'mais_uma' => 'ok',
            '_token' => $this->safeEncrypt(implode("%", $d), $_key)
        ]);
    }

    /**
     * Encrypt a message
     *
     * @param string $message - message to encrypt
     * @param string $key - encryption key
     * @return string
     * @throws RangeException
     */
    private function safeEncrypt(string $message, string $key): string
    {
        if (mb_strlen($key, '8bit') !== SODIUM_CRYPTO_SECRETBOX_KEYBYTES) {
            throw new RangeException('Key is not the correct size (must be 32 bytes).');
        }
        $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);

        $cipher = base64_encode(
            $nonce.
            sodium_crypto_secretbox(
                $message,
                $nonce,
                $key
            )
        );
        sodium_memzero($message);
        sodium_memzero($key);
        return $cipher;
    }

    /**
     * Decrypt a message
     *
     * @param string $encrypted - message encrypted with safeEncrypt()
     * @param string $key - encryption key
     * @return string
     * @throws Exception
     */
    private function safeDecrypt(string $encrypted, string $key): string
    {
        $decoded = base64_decode($encrypted);
        $nonce = mb_substr($decoded, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, '8bit');
        $ciphertext = mb_substr($decoded, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, null, '8bit');

        $plain = sodium_crypto_secretbox_open(
            $ciphertext,
            $nonce,
            $key
        );
        if (!is_string($plain)) {
            throw new Exception('Invalid MAC');
        }
        sodium_memzero($ciphertext);
        sodium_memzero($key);
        return $plain;
    }
}
