<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Panier;
use App\Entity\Produit;
use App\Form\ResetPasswordType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/connexion", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/deconnexion", name="app_logout")
     */
    public function logout(SessionInterface $session): Response
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/oublipass", name="app_forgotten_password")
     */
    public function forgottenPass(Request $request, UserRepository $userRepo, \Swift_Mailer $mailer, TokenGeneratorInterface $tokenGenerator){
        // création form 
        $form = $this->createForm(ResetPasswordType::class);

        // traite form
        $form->handleRequest($request);

        // formulaire valide condition
        if($form->isSubmitted() && $form->isValid()){
            // on recup les donnees  
            $donnees = $form->getData();
          
            // email appartient à un user
            $user = $userRepo->findOneByEmail($donnees['email']);

            // si user n'existe pas
            if(!$user){
                // envoie msg flash erreur
                $this->addFlash('danger', "Cette adresse mail n'existe pas.");
                $this->redirectToRoute('app_login');
            }

            // sinon
            $token = $tokenGenerator->generateToken();

            try{
                $user->setResetToken($token);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
            }catch(\Exception $e){
                $this->addFlash('warning', "Une erreur est survenue : ". $e->getMessage());
                return $this->redirectToRoute('app_login');
            }

            // On génère l'URL de réinitialisation de mot de passe
            $url = $this->generateUrl('app_reset_password', ['token' => $token], UrlGeneratorInterface::ABSOLUTE_URL);
            // On génère l'e-mail
            $message = (new \Swift_Message('Mot de passe oublié'))
                ->setFrom('votre@adresse.fr')
                ->setTo($user->getEmail())
                ->setBody(
                    "<p>>Bonjour,</p><p>Une demande de réinitialisation de mot de passe a été effectuée. Veuillez cliquer sur le lien suivant : " . $url.'</p>',
                    'text/html'
                )
            ;

            // On envoie l'e-mail
            $mailer->send($message);

            // On crée le message flash de confirmation
            $this->addFlash('message', 'E-mail de réinitialisation du mot de passe envoyé !');

            // On redirige vers la page de login
            return $this->redirectToRoute('app_login');
        }

        // On envoie le formulaire à la vue
        return $this->render('security/forgotten_password.html.twig',['emailForm' => $form->createView()]);
    }


    /**
     * @Route("/resetpass/{token}", name="app_reset_password")
     */
    public function resetPassword(Request $request, string $token, UserPasswordEncoderInterface $passwordEncoder)
    {
        // On cherche un utilisateur avec le token donné
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['reset_token' => $token]);

        // Si l'utilisateur n'existe pas
        if ($user === null) {
            // On affiche une erreur
            $this->addFlash('danger', 'Token Inconnu');
            return $this->redirectToRoute('app_login');
        }

        // Si le formulaire est envoyé en méthode post
        if ($request->isMethod('POST')) {
            // On supprime le token
            $user->setResetToken(null);

            // On chiffre le mot de passe
            $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));

            // On stocke
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // On crée le message flash
            $this->addFlash('message', 'Mot de passe mis à jour');

            // On redirige vers la page de connexion
            return $this->redirectToRoute('app_login');
        }else {
            // Si on n'a pas reçu les données, on affiche le formulaire
            return $this->render('security/reset_password.html.twig', ['token' => $token]);
        }

    }
}
