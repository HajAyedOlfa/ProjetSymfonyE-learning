<?php

namespace App\Security;

use App\Controller\SecurityController;
use App\Repository\ParticipantRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;

class LoginFormAuthenticator extends AbstractAuthenticator
{
    private $participantRepository;
    private $urlGenerator;

    public function __construct(ParticipantRepository $participantRepository, UrlGeneratorInterface $urlGenerator)
    {
        $this->participantRepository = $participantRepository;
        $this->urlGenerator = $urlGenerator;

    }

    public function supports(Request $request): ?bool
    {
        return $request->attributes->get('_route') === 'app_login'
            && $request->isMethod('POST');
    }
    public function authenticate(Request $request): PassportInterface
    {
        //dd($request->request->get('signin-email'));
        // find a user based on an "email" form field
        $user = $this->participantRepository->findOneByEmail($request->request->get('signin-email'));

        $request->getSession()->set(
            SecurityController::LAST_EMAIL,
            $request->request->get('signin-email')
        );
        //dd($user);
        if (!$user) {
            throw new CustomUserMessageAuthenticationException('Invalid credentials !');
        }

        return new Passport(
            $user,
            new PasswordCredentials($request->request->get('signin-password')), [
            // and CSRF protection using a "csrf_token" field
                new CsrfTokenBadge('login_form', $request->request->get('csrf_token')),
                new RememberMeBadge,
            ]
        );
    }


    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        $user = $this->participantRepository->findOneByEmail($request->request->get('signin-email'));
        $role = $user->getRoles();
        //dd($role);
        if($role[0] == "ROLE_USER"){
            return new RedirectResponse($this->urlGenerator->generate('user_interface'));
        }else{
            return new RedirectResponse($this->urlGenerator->generate('index'));
        }
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {

        $request->getSession()->getFlashBag()->add('error', 'Invalid credentials!');
        return new RedirectResponse($this->urlGenerator->generate('app_login'));
    }
}
?>