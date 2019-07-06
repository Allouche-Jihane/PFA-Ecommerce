<?php

namespace App\Controller;

use App\Entity\Admin;
use Doctrine\ORM\NoResultException;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\Client;

use App\Entity\Categorie;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function index(AuthenticationUtils $authenticationUtils )
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        dump($error);
       
        $rep = $this->getDoctrine()->getRepository(Categorie::class);
        $cat = $rep->findAll();
        return $this->render('frontend/login.html.twig', [
            'error' => $error,
            'cat'=>$cat
        ]);
    }
    /**
     * @Route("/ajouterClient", name="ajouterClient")
     */
    public function ajouter(Request $request , ObjectManager $manager)
    {
       
        if($request->request->count()>0)
        {
            $client = new Client();
        $client->setNomClient($request->request->get('nom'))
                ->setPrenomClient($request->request->get('prenom'))
                ->setEmailClient($request->request->get('email'))
                ->setPassword($request->request->get('password'))
                ->setAdresse($request->request->get('add'))
                ->setTel($request->request->get('phone'))
                ->setVille($request->request->get('ville'))
                ->setCodePostal($request->request->get('code'));
             
                if(($request->request->get('password'))==($request->request->get('repassword')))
                         {            
                $manager->persist($client);
              $manager->flush();
              if ($manager)
                 { 
                return $this->redirectToRoute('login');
                    }
                 }
                 else
                 {
                    $error="Mot de passe ne sont pas similaire";
                    
                 }
        }

       
    }
    
    /**
     * @Route("/deconnexion",name="security_logout")
     */
    public function logout()
    {
    }
     /**
     * @Route("/con", name="con")
     */
    public function contact(Request $request, \Swift_Mailer $mailer,AuthenticationUtils $authenticationUtils )
    {
        $error2 = $authenticationUtils->getLastAuthenticationError();
       
        if($request->request->count()>0)
        {

        $mail=$request->request->get('emailR');
        $rep = $this->getDoctrine()->getRepository(Client::class);
            
        try {
            //code...
            $admin = $rep->createQueryBuilder('a')
                        ->select('a.password')
                         ->where("a.emailClient = '$mail'")
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
                    title: \'Bravo!\',
                    text: \'Email  Enovyé .\',
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
        


        return $this->render('frontend/login.html.twig', [
            'error' => $error2,
        ]);    
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

