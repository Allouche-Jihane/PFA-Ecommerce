<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\Admin;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\ORM\NoResultException;


class SecurityController extends AbstractController
{
    /**
     * @Route("/connexion", name="security_login")
     */
    public function index(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        dump($error);
        return $this->render('security/login.html.twig', [
            'error' => $error,
        ]);
    }
    /**
     * @Route("/deconnexion",name="security_logout")
     */
    public function logout()
    {
    }

    
        
     /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, \Swift_Mailer $mailer)
    {
        if($request->request->count()>0)
        {

        $mail=$request->request->get('emailR');
        $rep = $this->getDoctrine()->getRepository(Admin::class);
            
        try {
            //code...
            $admin = $rep->createQueryBuilder('a')
            ->select('a.password')
             ->where("a.email = '$mail'")
            ->getQuery()
            ->getSingleScalarResult();
            //throw $th;
            $message = (new \Swift_Message())

            // Give the message a subject
            ->setSubject('Your subject')

                // Set the From address with an associative array
                ->setFrom('test1.projet@gmail.com')

                // Set the To addresses with an associative array (setTo/setCc/setBcc)
                 ->setTo($mail)
                 

                // Give it a body
                ->setBody("votre mot de passe est : ".$admin)
                ;
                $mailer->send($message);
                echo '    <script src="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.js"></script>';
                echo '    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.css" />';
                echo '<script type="text/javascript">';
                echo  'setTimeout(function () { swal({
                    title: \'Email  Enovyé !\',
                    text: \'\',
                    type: "success",
                      showConfirmButton: false
                  });';
                    echo '}, 1 );</script>';
             }
              catch (NoResultException $em) {
                echo '    <script src="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.js"></script>';
                echo '    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.css" />';
                echo '<script type="text/javascript">';
                echo 'setTimeout(function () { swal({
                  title: \'Attention!\',
                  text: "L\'email n\'existe pas",
                  type: "error",
                });';
                  echo '}, 1000);</script>';
                
              }
            
            
         
        }
       

        
        return $this->render('backend/index.html.twig');
    }
    /**
        * @Route("/{name}", name="test_member")
        */
        public function routeExists($name)
        {
        // I assume that you have a link to the container in your twig extension class
        $router = $this->container->get('router');
        return (null === $router->getRouteCollection()->get($name)) ? $this->redirectToRoute('index') : true;
    
       
        }
}

