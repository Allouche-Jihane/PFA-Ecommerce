<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\Categorie;
use App\Entity\Avis;
use App\Entity\Client;
use App\Entity\Wishlist;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontendController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {       
        $rep = $this->getDoctrine()->getRepository(Categorie::class);
        $cat = $rep->findAll();
        return $this->render('frontend/index.html.twig', [
            'controller_name' => 'FrontendController',
            'cat'=> $cat
        ]);
    }
    
    /**
     * @Route("/produits/{idC}", name="produits",methods="GET|POST")
     */
    public function produits($idC,Request $request , ObjectManager $manager)
    {
        $rep = $this->getDoctrine()->getRepository(Categorie::class);
        $cat2 = $rep->find($idC);

            
        $rep1 = $this->getDoctrine()->getRepository(Categorie::class);
        $cat = $rep1->findAll();

        $rep1 = $this->getDoctrine()->getRepository(Produit::class);
        $produits = $rep1->createQueryBuilder('a')
                    ->where("a.categoriecategorie = $idC")
                    ->select('a')
                    ->getQuery()
                    ->getResult();
         return $this->render('frontend/hommes.html.twig',[
            'produit'=>$produits,
            'cat2'=>$cat2,
            'cat'=> $cat

            ]);
    }
      /**
     * @Route("/wish/{idP}", name="wish",methods="GET|POST")
     */
    public function wish($idP,Request $request , ObjectManager $manager)
    {   
        $rep = $this->getDoctrine()->getRepository(Produit::class);
        $produit = $rep->find($idP);
        $rep2 = $this->getDoctrine()->getRepository(Client::class);
       // $wish = $this->getDoctrine()->getRepository(Wishlist::class);

      
        $wish=new Wishlist();
        $wish->setUser($this->getUser())
             ->setProduit($produit);
        
           

            
                if($this->getUser()!=null)
                {   
                    $manager->persist($wish);
                    $manager->flush();
                    if($manager)
                     {       
                        $this->addFlash('success', 'Produit ajouté à votre liste d\'envie!');
                return $this->redirectToRoute('detail',array('idP'=>$idP));
                     }
                }
                else
                {
                    return $this->redirectToRoute('login');

                }
            
        }
      
    /**
     * @Route("/detail/{idP}", name="detail",methods="GET|POST")
     */
    public function detail($idP,Request $request , ObjectManager $manager)
    {   
        $rep = $this->getDoctrine()->getRepository(Produit::class);
        $produit = $rep->find($idP);
        $rep2 = $this->getDoctrine()->getRepository(Client::class);
       // $wish = $this->getDoctrine()->getRepository(Wishlist::class);

            
       $repppp = $this->getDoctrine()->getRepository(Categorie::class);
       $cat = $repppp->findAll();

        $rep1 = $this->getDoctrine()->getRepository(Avis::class);
        $avis = $rep1->createQueryBuilder('a')
                    ->where("a.produitproduit = $idP")
                    ->select('a')
                    ->getQuery()
                    ->getResult();
        
                    if($request->request->count()>0)
                    {
                        $av = new Avis();
                        $av->setNom($request->request->get('nom'))
                              ->setCommentaire($request->request->get('comment'))
                              ->setEvaluation($request->request->get('eval'))
                              ->setCreatedAt(new \DateTime('now'))
                              ->setProduitproduit($produit)
                              ->setClientclient(($this->getUser()));

                         $manager->persist($av);
                         $manager->flush();
                         if($manager)
                         {
                            return $this->redirectToRoute('detail',array('idP'=>$idP));

                         }
                    }  
           $type=$produit->getTypeProduit();   

        $listeP = $rep->createQueryBuilder('a')
                ->where("a.typeProduit = '$type'")
                ->select('a')
                ->getQuery()
                ->getResult();


        return $this->render('frontend/detail.html.twig',[
            'produit'=>$produit,
            'avis'=>$avis,
            'listeP'=>$listeP,
            'cat'=> $cat
        ]);
    }
    /**
     * @Route("/panier", name="panier")
     */
    public function panier()
    {
        $rep = $this->getDoctrine()->getRepository(Categorie::class);
        $cat = $rep->findAll();
        return $this->render('frontend/panier.html.twig',[
            'cat'=>$cat
        ]);
    }
    /**
     * @Route("/check", name="check")
     */
    public function check()
    {
        return $this->render('frontend/check.html.twig');
    }
    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('frontend/contact.html.twig');
    }
    /**
     * @Route("/faq", name="faq")
     */
    public function faq()
    {
        return $this->render('frontend/faq.html.twig');
    }
    
    /**
     * @Route("/profile/{idC}", name="profile",methods="GET|POST")
     */
    public function profile($idC,Request $request , ObjectManager $manager)
    {
        $client = $this->getDoctrine()->getRepository(Client::class)->find($idC);
        if($request->request->count()>0)
        {
                $client->setAdresse($request->request->get('add'))
                    ->setTel($request->request->get('tel'))
                    ->setVille($request->request->get('ville'))
                    ->setCodePostal($request->request->get('code'))
                    ->setPassword($request->request->get('password'));
                
                $manager->persist($client);
                $manager->flush();
                if($manager)
                {
                    $this->addFlash('success', 'Modification des informations faites avec succès!');
                    return $this->redirectToRoute('profile',array('idC'=>$idC));

                }

        }
        $rep = $this->getDoctrine()->getRepository(Categorie::class);
        $cat = $rep->findAll();

        return $this->render('frontend/profile.html.twig',[
            'cat'=>$cat
        ]);

    }
    /**
     * @Route("/about", name="about")
     */
    public function about()
    {
        return $this->render('frontend/about.html.twig');
    }
    /**
     * @Route("/search", name="search" ,methods="GET|POST")
     */
    public function search(Request $request , ObjectManager $manager)
    {
        $searchNom= $request->request->get('q');

        $rep1 = $this->getDoctrine()->getRepository(Produit::class);
        $produits = $rep1->createQueryBuilder('a')
                    ->where("a.nomProduit = '$searchNom' OR a.typeProduit='$searchNom'")

                    ->select('a')
                    ->getQuery()
                    ->getResult();


                    $rep = $this->getDoctrine()->getRepository(Categorie::class);
                    $cat = $rep->findAll();

         return $this->render('frontend/search.html.twig',[
            'produit'=>$produits,
            'cat'=>$cat
         ]);
    }
}
