<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Entity\Admin;
use App\Entity\Client;
use App\Entity\Coupons;
use App\Entity\Produit;
use App\Entity\Commande;
use App\Entity\Categorie;
use Doctrine\ORM\Query\AST\Join;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use DoctrineExtensions\Query\Mysql\Month;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\ComboChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Options\VAxis;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\LineChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\ColumnChart;
class BackendController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
      $rep1 = $this->getDoctrine()->getRepository(Produit::class);
      $rep2 = $this->getDoctrine()->getRepository(Client::class);
      $rep3 = $this->getDoctrine()->getRepository(Commande::class);
      $rep4 = $this->getDoctrine()->getRepository(Commande::class);
      $rep5 = $this->getDoctrine()->getRepository(Avis::class);

            $Produits = $rep1->createQueryBuilder('a')
                      ->select('count(a.idproduit) ')
                      ->getQuery()
                      ->getSingleScalarResult();
            $Clients = $rep2->createQueryBuilder('a')
                      ->select('count(a.idclient) ')
                      ->getQuery()
                      ->getSingleScalarResult();
            $CommandeT = $rep3->createQueryBuilder('a')
                      ->select('count(a.idcommande) ')
                      ->getQuery()
                      ->getSingleScalarResult();
            $CommandeV = $rep4->createQueryBuilder('a')
                      ->where("a.etatCommande ='Terminée' ")
                      ->select('count(a.idcommande) ')
                      ->getQuery()
                      ->getSingleScalarResult();


             $DerniersCom = $rep4->createQueryBuilder('a')
                    
                      ->select('a')
                      ->orderBy('a.idcommande', 'DESC')
                      ->setMaxResults(5)
                      ->getQuery()
                      ->getResult();

            $DerniersAvis = $rep5->createQueryBuilder('a')
                      ->select('a')
                      ->orderBy('a.idavis', 'DESC')
                      ->setMaxResults(5)
                      ->getQuery()
                      ->getResult();

                      
                   $item = $this->getDoctrine()->getRepository(Commande::class);

                   $items  =$item->createQueryBuilder('a')
                        ->select('count(a) AS nombre , Month(a.dateCommande) AS date')
                        ->groupBy('date')
                        ->getQuery()
                        ->getResult();

                   
                         dump($items);
                 

                      $data = [['Date','Nombre de Commandes']];
                      foreach($items as $categorie)
                      {
                          $data[] = array(
                            $categorie["date"], $categorie["nombre"]
                          );
                      }
                      $pieChart = new ColumnChart();
                      $pieChart->getData()->setArrayToDataTable(
                          $data
                      );
                   


                      $pieChart->getOptions()->getChart()
                      
                      ->setTitle('');
                  $pieChart->getOptions()
                      ->setHeight(313)
                      ->setWidth(550)
                      ->setSeries([['axis' => 'Commandes'], ['axis' => 'Mois']])
                      ->setAxes(['y' => ['Commandes' => ['label' => 'Commandes (nbr)'], 'Daylight' => ['label' => 'Daylight']]]);

                 
             
        return $this->render('backend/index.html.twig', [
            'controller_name' => 'BackendController',
            'produits'=> $Produits,
            'clients' => $Clients,
            'commandet' => $CommandeT,
            'commande' => $CommandeV,
            'derniercom'=>$DerniersCom,
            'avis'=>$DerniersAvis,
            'piechart' => $pieChart,

        ]);
    }
    /**
     * @Route("/listeProduits", name="listeProduits")
     */
    public function produits()
    {
      $rep = $this->getDoctrine()->getRepository(Produit::class);
      $produits = $rep->findAll();

        return $this->render('backend/listeProduits.html.twig',[
           'produits' => $produits,
        ]);
    }
    /**
     * @Route("/newProduit", name="newProduit")
     */
    public function newProduct(Request $request , ObjectManager $manager)
    {
      dump($request);
      $rep = $this->getDoctrine()->getRepository(Categorie::class);


        if($request->request->count()>0)
        {
          if(empty($request->request->get('nomp')) || empty($request->request->get('quantite')) || empty($request->request->get('prix'))
            || empty($request->request->get('desc')) || empty($request->request->get('cat')) || empty($request->request->get('type')))
          {
            echo '    <script src="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.js"></script>';
            echo '    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.css" />';
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal({
              title: \'Veuillez Remplir Tous Les Champs!\',
              text: \'\',
              type: "error",
            });';
              echo '}, 1000);</script>';

          }
          else {
        $produit = new Produit();
        $image = $_FILES['imageF']['name'];
        $images= $_FILES['imageA']['name'];
        $ia=$_FILES['imageA'];
            
        $produit->setNomProduit($request->request->get('nomp'))
              ->setQuantiteStock($request->request->get('quantite'))
              ->setPrix($request->request->get('prix'))
              ->setDescription($request->request->get('desc'))
              ->setActif($request->request->get('customRadioInline1'))
              ->setValeurPromo($request->request->get('promo'))
              ->setDateFin(new \DateTime($request->request->get('datef')))
              ->setDateDebut(new \DateTime($request->request->get('dated')))
              ->setTypeProduit($request->request->get('type'))

              ->setCategoriecategorie($rep->find($request->request->get('cat')))
              ->setImagePrincipale($image)
              ->setImagesAdditio($images);

              if((new \DateTime($request->request->get('datef'))) > (new \DateTime($request->request->get('dated'))) || (empty($request->request->get('type')))   )
                     {
            $manager->persist($produit);
            $manager->flush();

            if ($manager)
            {
              echo '    <script src="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.js"></script>';
              echo '    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.css" />';
              echo '<script type="text/javascript">';
              echo 'setTimeout(function () { swal({
                title: \'Ajout Avec Succès!\',
                text: \'.\',
                type: "success",
                  showConfirmButton: false
              });';
                echo '}, 1000);</script>';


               header ("Refresh: 2;URL='listeProduits'");
            }
            else
            {
              echo '    <script src="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.js"></script>';
              echo '    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.css" />';
              echo '<script type="text/javascript">';
              echo 'setTimeout(function () { swal({
                title: \'Erreur dans l\'ajout d`\'un produit!\',
                text: \'\',
                type: "error",
              });';
                echo '}, 1000);</script>';


            }
          }

          else {
            // msg erreur date
            echo '    <script src="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.js"></script>';
            echo '    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.css" />';
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal({
              title: \'Erreur la date de fin doit etre supérieur à la date de début !\',
              text: \'\',
              type: "error",
            });';
              echo '}, 1000);</script>';
          }
          }

        }
        if(isset($_FILES['imageF'])){
          // liste des extensions autorisée
          $file_extension = strrchr($_FILES['imageF']['name'], '.');
          $extensions= array(".jpeg",".jpg",".png",".PNG");
          if(!in_array($file_extension, $extensions)){
              echo "
                <div class=\"alert alert-success\">
                  <ul class=\"fa-ul\">
                    <li>
                      <i class=\"fa fa-info-circle fa-lg fa-li\"></i>  L'extension n'est pas valide
                    </li>
                  </ul>
                </div>
";
          }
          else
          {

            //Enregistrement et renommage du fichier
            $dossier = 'images/Produits/';
            $nom_fichier=$request->request->get('nomp').".jpg";

            $result=move_uploaded_file($_FILES["imageF"]["tmp_name"],$dossier.$nom_fichier);
            if($result==TRUE){
              echo "";
            }
            else{
echo "
                  <div class=\"alert alert-success\">
                    <ul class=\"fa-ul\">
                      <li>
                        <i class=\"fa fa-info-circle fa-lg fa-li\"></i>  Erreur de transfert
                      </li>
                    </ul>
                  </div>
";                                              }
          }
        }
        // Images additio
        if(isset($_FILES['imageA'])) {
	$taille =count($_FILES['imageA']['name']);
	for($i = 0; $i<$taille; $i++){
		$maxsize = 1000000000;
		$extensions_valides = array( 'jpg' , 'jpeg','png');
		$extension_upload = strtolower(  substr(  strrchr($_FILES['imageA']['name'][$i], '.')  ,1)  );
		if ($_FILES['imageA']['error'][$i] > 0 || !(in_array($extension_upload, $extensions_valides)) || ($_FILES['imageA']['size'][$i] > $maxsize)) {
      echo '    <script src="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.js"></script>';
      echo '    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.css" />';
      echo '<script type="text/javascript">';
      echo 'setTimeout(function () { swal({
        title: \'Erreur lors du transfert!\',
        text: \'\',
        type: "error",
      });';
        echo '}, 1000);</script>';
		}else {
      $dossier = 'images/Produit2/';
      $nom_fichier=$request->request->get('nomp')."$i.jpg";

			$nom = $_FILES['imageA']['name'][$i];
			$deplacement = move_uploaded_file($_FILES['imageA']['tmp_name'][$i],$dossier.$nom_fichier);

			if (!$deplacement) {
        echo '    <script src="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.js"></script>';
        echo '    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.css" />';
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal({
          title: \'Erreur lors de l\'upload !\',
          text: \'\',
          type: "error",
        });';
          echo '}, 1000);</script>';
			}
		}
	}

}
        $categories = $rep->findAll();


        return $this->render('backend/newProduct.html.twig',[
           'categories' => $categories,
           'nomp' => $request->request->get('nomp'),
           'quantite' => $request->request->get('quantite'),
           'prix' => $request->request->get('prix'),
           'desc' => $request->request->get('desc'),
           'promo' => $request->request->get('promo'),
           'dated' => $request->request->get('dated'),
           'datef' => $request->request->get('datef'),
           'btn' => $request->request->get('customRadioInline1'),
           'cate'=>$request->request->get('cat'),
           'type'=>$request->request->get('type'),


        ]);
    }
    /**
     * @Route("/listeProduits/{idP}", name="deleteProduit" )
     */
    public function deleteProduit($idP,Request $request )
    {
      $produits = $this->getDoctrine()->getRepository(Produit::class)->find($idP);

      $entiryManager=$this->getDoctrine()->getManager();
      $entiryManager->remove($produits);
      $entiryManager->flush();
      $this->addFlash('success', 'Produit Supprimé avec succès!');
        return $this->redirectToRoute('listeProduits');


    }
    /**
     * @Route("/updateProduit/{idP}", name="updateProduit",methods="GET|POST")
     */
    public function updateProduit($idP,Request $request , ObjectManager $manager)
    {
      $repo=$this->getDoctrine()->getRepository(Produit::class);
      $produit=$repo->find($idP);

      $rep = $this->getDoctrine()->getRepository(Categorie::class);

      dump($request);
      if($request->request->count()>0)
      {
        if(  empty($request->request->get('quantite')) || empty($request->request->get('prix')) || empty($request->request->get('cat'))
          || empty($request->request->get('desc'))  || empty($request->request->get('type'))
         )
        {
          echo '    <script src="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.js"></script>';
          echo '    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.css" />';
          echo '<script type="text/javascript">';
          echo 'setTimeout(function () { swal({
            title: \'Veuillez Remplir Tous Les Champs!\',
            text: \'\',
            type: "error",
          });';
            echo '}, 1000);</script>';

        }
        else {
          $produit->setQuantiteStock($request->request->get('quantite'))
                ->setPrix($request->request->get('prix'))
                ->setDescription($request->request->get('desc'))
                ->setActif($request->request->get('customRadioInline1'))
                ->setValeurPromo($request->request->get('promo'))
                ->setCategoriecategorie($rep->find($request->request->get('cat')))
                ->setTypeProduit($request->request->get('type'))
                ->setDateFin(new \DateTime($request->request->get('datef')))
                ->setDateDebut(new \DateTime($request->request->get('dated')));


                if((new \DateTime($request->request->get('datef'))) >= (new \DateTime($request->request->get('dated'))) )
                       {
              $manager->persist($produit);
              $manager->flush();

              if($manager)
              {
                echo '    <script src="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.js"></script>';
                echo '    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.css" />';
                echo '<script type="text/javascript">';
                echo 'setTimeout(function () { swal({
                  title: \'Modification Avec Succès!\',
                  text: \'\',
                  type: "success",
                    showConfirmButton: false
                });';
                  echo '}, 1000);</script>';


                 header ("Refresh: 2;URL='../listeProduits'");
              }
            }
            else {
              // msg erreur date
              echo '    <script src="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.js"></script>';
              echo '    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.css" />';
              echo '<script type="text/javascript">';
              echo 'setTimeout(function () { swal({
                title: \'Erreur la date de fin doit etre supérieur à la date de début!\',
                text: \'\',
                type: "error",
              });';
                echo '}, 1000);</script>';
            }

        }
      }
      $categories = $rep->findAll();

      return $this->render('backend/updateProduit.html.twig',[
        'categories'=>$categories,
        'produit'=>$produit,
      ]);

    }
    /**
     * @Route("/categories", name="categories")
     */
    public function categorie()
    {
      $rep = $this->getDoctrine()->getRepository(Categorie::class);
      $cat = $rep->findAll();
      $rep1 = $this->getDoctrine()->getRepository(Produit::class);

      $liste1=array();
      $liste2=array();
      $liste=array();
      foreach ($cat as $key )
       {
        

        $nomC=$key->getDesignation();
        $idC=$key->getIdCategorie();

        $Articles = $rep1->createQueryBuilder('a')
                ->where("a.categoriecategorie = $idC")
                ->select('count(a.idproduit) ')
                ->getQuery()
                ->getSingleScalarResult();

                array_push($liste1,$Articles);
                array_push($liste2,$idC);

      }             
   //  $liste= array_merge($liste2,$liste1);
    /* $collection3 = new ArrayCollection(
      array_merge($liste2->toArray(), $liste1->toArray())
  );*/
  $data = array_combine($liste2, $liste1);


  
      dump($data);

      return $this->render('backend/categorie.html.twig',[
        'cat' => $cat,
        'produit'=>$data
     ]);
      
       

    }
    /**
     * @Route("/ajouterCategorie", name="ajouterCategorie" )
     */
    public function ajouterCategorie(Request $request , ObjectManager $manager)
    {
      dump($request); 
      if($request->request->count()>0)
      {
        if(empty($request->request->get('desi')) || empty($request->request->get('customRadioInline1')))
        {
          echo '    <script src="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.js"></script>';
          echo '    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.css" />';
          echo '<script type="text/javascript">';
          echo 'setTimeout(function () { swal({
            title: \'Veuillez Remplir Tous Les Champs!\',
            text: \'\',
            type: "error",
          });';
            echo '}, 1000);</script>';
          dump("remplir rous");
        }
        else {
          $categorie = new Categorie();
        $categorie->setDesignation($request->request->get('desi'))
              ->setActif($request->request->get('customRadioInline1'));
              $manager->persist($categorie);
              $manager->flush();
              if ($manager)
            {
              echo '    <script src="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.js"></script>';
              echo '    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.css" />';
              echo '<script type="text/javascript">';
              echo 'setTimeout(function () { swal({
                title: \'Ajout Avec Succès!\',
                text: \'\',
                type: "success",
                  showConfirmButton: false
              });';
                echo '}, 1000);</script>';


               header ("Refresh: 2;URL='categories'");
               dump("remplir rous");


            }
            else
            {
              echo '    <script src="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.js"></script>';
              echo '    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.css" />';
              echo '<script type="text/javascript">';
              echo 'setTimeout(function () { swal({
                title: \'Erreur dans l\'ajout d`\'une categorie!\',
                text: \'\',
                type: "error",
              });';
                echo '}, 1000);</script>';
              dump("errerur");

            }

    }
  }
      return $this->render('backend/ajouterCategorie.html.twig',[
        'designation'=>$request->request->get('desi'),
          'actif'=> $request->request->get('customRadioInline1'),
      ]);     

}
/**
     * @Route("/categories/{idCa}", name="deleteCat" )
     */
    public function deleteCategorie($idCa,Request $request )
    {
      $cat = $this->getDoctrine()->getRepository(Categorie::class)->find($idCa);

      $entiryManager=$this->getDoctrine()->getManager();
      $entiryManager->remove($cat);
      $entiryManager->flush();
      $this->addFlash('success', 'Catégorie Supprimée avec succès!');
        return $this->redirectToRoute('categories');


    }
    /**
     * @Route("/updateCat/{idCa}", name="updateCat",methods="GET|POST")
     */
    public function updateCat($idCa,Request $request , ObjectManager $manager)
    {
      $repo=$this->getDoctrine()->getRepository(Categorie::class);
      $cat=$repo->find($idCa);

      dump($request);
      if($request->request->count()>0)
      {
        if(empty($request->request->get('desi')))
        {
          echo '    <script src="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.js"></script>';
          echo '    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.css" />';
          echo '<script type="text/javascript">';
          echo 'setTimeout(function () { swal({
            title: \'Veuillez Remplir Tous Les Champs!\',
            text: \'\',
            type: "error",
          });';
            echo '}, 1000);</script>';

        }
        else {
          $cat->setDesignation($request->request->get('desi'))
              ->setActif($request->request->get('customRadioInline1'));
                
               
              $manager->persist($cat);
              $manager->flush();

              if($manager)
              {
                echo '    <script src="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.js"></script>';
                echo '    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.css" />';
                echo '<script type="text/javascript">';
                echo 'setTimeout(function () { swal({
                  title: \'Modification Avec Succès!\',
                  text: \'\',
                  type: "success",
                    showConfirmButton: false
                });';
                  echo '}, 1000);</script>';


                 header ("Refresh: 2;URL='../categories'");
              }
            
            

        }
      }
      return $this->render('backend/updateCategorie.html.twig',[
        'cat'=>$cat,
      ]);

    }
    /**
     * @Route("/sousCategorie/{idCa}", name="sousCategorie" ,methods="GET|POST")")
     */
    public function sousCategorie($idCa,Request $request , ObjectManager $manager)
    {
      $rep = $this->getDoctrine()->getRepository(Categorie::class);
      $cat = $rep->find($idCa);

      $rep1 = $this->getDoctrine()->getRepository(Produit::class);

      $produits = $rep1->createQueryBuilder('a')
                ->where("a.categoriecategorie = $idCa")
                ->select('a')
                ->getQuery()
                ->getResult();

            dump($produits);
            dump($cat);
        return $this->render('backend/SousCategories.html.twig',[
          'produit'=>$produits,
          'cat'=>$cat
        ]);
    }

    /**
     * @Route("/avis", name="avis")
     */
    public function avis()
    {
      $rep = $this->getDoctrine()->getRepository(Avis::class);
      $avis = $rep->findAll();

        return $this->render('backend/avis.html.twig',[
           'avis' => $avis,
        ]);

    }
    /**
     * @Route("/avis/{idA}", name="deleteAvis" )
     */
    public function deleteAvis($idA,Request $request )
    {
      $avis = $this->getDoctrine()->getRepository(Avis::class)->find($idA);

      $entiryManager=$this->getDoctrine()->getManager();
      $entiryManager->remove($avis);
      $entiryManager->flush();
      $this->addFlash('success', 'Avis Supprimé avec succès!');
        return $this->redirectToRoute('avis');


    }
    /**
     * @Route("/ventes", name="ventes")
     */
    public function ventes()
    {
      $rep = $this->getDoctrine()->getRepository(Commande::class);
      $cmd = $rep->findAll();
       $em = $this->getDoctrine()->getManager();
       $totalArticles = $rep->createQueryBuilder('a')
           ->select('count(a.idcommande)')
           ->getQuery()
           ->getSingleScalarResult();
       $totalArticlesT = $rep->createQueryBuilder('a')
                ->where("a.etatCommande = 'Terminée'")
               ->select('count(a.idcommande)')
               ->getQuery()
               ->getSingleScalarResult();
      $totalArticlesA = $rep->createQueryBuilder('a')
                        ->where("a.etatCommande = 'Annulée'")
                       ->select('count(a.idcommande)')
                       ->getQuery()
                       ->getSingleScalarResult();
      $totalArticlesAt = $rep->createQueryBuilder('a')
                      ->where("a.etatCommande = 'Attente'")
                      ->select('count(a.idcommande)')
                       ->getQuery()
                     ->getSingleScalarResult();

        return $this->render('backend/ventes.html.twig',[
          'vente' => $cmd,
          'count'=>$totalArticles,
          'countT'=>$totalArticlesT,
          'countA'=>$totalArticlesA,
          'countAt'=>$totalArticlesAt
      ]);
    }
    /**
     * @Route("/listeCoupon", name="listeCoupon")
     */
    public function listeCoupon()
    {
      $rep = $this->getDoctrine()->getRepository(Coupons::class);
      $coupons = $rep->findAll();

        return $this->render('backend/listeCoupon.html.twig',[
           'coupons' => $coupons
        ]);

    }
    /**
     * @Route("/listeCoupon/{idC}", name="deleteCoupon")
     */
    public function deleteCoupon($idC,Request $request )
    {
      $coupons = $this->getDoctrine()->getRepository(Coupons::class)->find($idC);

      $entiryManager=$this->getDoctrine()->getManager();
      $entiryManager->remove($coupons);
      $entiryManager->flush();
      $this->addFlash('success', 'Coupons Supprimé avec succès!');
        return $this->redirectToRoute('listeCoupon');


    }
    /**
     * @Route("/updateCoupon/{idC}", name="updateCoupon",methods="GET|POST")
     */
    public function updateCoupon($idC,Request $request , ObjectManager $manager)
    {
      $repo=$this->getDoctrine()->getRepository(Coupons::class);
      $coupon=$repo->find($idC);

      dump($request);
      if($request->request->count()>0)
      {
        if(empty($request->request->get('nomC')) || empty($request->request->get('codeC')) || empty($request->request->get('valeurC'))
          || empty($request->request->get('dateD')) || empty($request->request->get('dateF'))
          || empty($request->request->get('limitUPC')) || empty($request->request->get('limitUPCO')))
        {
          echo '    <script src="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.js"></script>';
          echo '    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.css" />';
          echo '<script type="text/javascript">';
          echo 'setTimeout(function () { swal({
            title: \'Veuillez Remplir Tous Les Champs!\',
            text: \'\',
            type: "error",
          });';
            echo '}, 1000);</script>';

        }
        else {
          $coupon->setNomCoupon($request->request->get('nomC'))
                ->setCodeCoupon($request->request->get('codeC'))
                ->setValue($request->request->get('valeurC'))
                ->setDateDebut(new \DateTime($request->request->get('dateD')))
                ->setDateFin(new \DateTime($request->request->get('dateF')))
                ->setValide($request->request->get('customRadioInline1'))
                ->setNombrePersonne($request->request->get('limitUPC'))
                ->setDateCreation(new \DateTime('now'))
                ->setLimiteUtilisation($request->request->get('limitUPCO'));
                if((new \DateTime($request->request->get('dateF'))) > (new \DateTime($request->request->get('dateD'))) )
                       {
              $manager->persist($coupon);
              $manager->flush();

              if($manager)
              {
                echo '    <script src="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.js"></script>';
                echo '    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.css" />';
                echo '<script type="text/javascript">';
                echo 'setTimeout(function () { swal({
                  title: \'Modification Avec Succès!\',
                  text: \'\',
                  type: "success",
                    showConfirmButton: false
                });';
                  echo '}, 1000);</script>';


                 header ("Refresh: 2;URL='../listeCoupon'");
              }
            }
            else {
              // msg erreur date
              echo '    <script src="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.js"></script>';
              echo '    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.css" />';
              echo '<script type="text/javascript">';
              echo 'setTimeout(function () { swal({
                title: \'Erreur la date de fin doit etre supérieur à la date de début !\',
                text: \'\',
                type: "error",
              });';
                echo '}, 1000);</script>';
            }

        }
      }
      return $this->render('backend/updateCoupon.html.twig',[
        'coupon'=>$coupon,
      ]);

    }
    /**
     * @Route("/ajouterCoupon", name="ajouterCoupon")
     */
    public function ajouterCoupon(Request $request , ObjectManager $manager)
    {
      dump($request);
      if($request->request->count()>0)
      {
        if(empty($request->request->get('nomC')) || empty($request->request->get('codeC')) || empty($request->request->get('valeurC'))
          || empty($request->request->get('dateD')) || empty($request->request->get('dateD'))
          || empty($request->request->get('limitUPC')) || empty($request->request->get('limitUPCO')))
        {
          echo '    <script src="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.js"></script>';
          echo '    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.css" />';
          echo '<script type="text/javascript">';
          echo 'setTimeout(function () { swal({
            title: \'Veuillez Remplir Tous Les Champs!\',
            text: \'\',
            type: "error",
          });';
            echo '}, 1000);</script>';

        }
        else {
        $coupon = new Coupons();
        $coupon->setNomCoupon($request->request->get('nomC'))
              ->setCodeCoupon($request->request->get('codeC'))
              ->setValue($request->request->get('valeurC'))
              ->setDateDebut(new \DateTime($request->request->get('dateD')))
              ->setDateFin(new \DateTime($request->request->get('dateF')))
              ->setValide($request->request->get('customRadioInline1'))
              ->setNombrePersonne($request->request->get('limitUPC'))
              ->setDateCreation(new \DateTime('now'))
              ->setLimiteUtilisation($request->request->get('limitUPCO'));

              if((new \DateTime($request->request->get('dateF'))) > (new \DateTime($request->request->get('dateD'))) )
                     {
            $manager->persist($coupon);
            $manager->flush();
            if ($manager)
            {
              echo '    <script src="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.js"></script>';
              echo '    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.css" />';
              echo '<script type="text/javascript">';
              echo 'setTimeout(function () { swal({
                title: \'Ajout Avec Succès!\',
                text: \'\',
                type: "success",
                  showConfirmButton: false
              });';
                echo '}, 1000);</script>';


               header ("Refresh: 2;URL='listeCoupon'");
            }
            else
            {
              echo '    <script src="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.js"></script>';
              echo '    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.css" />';
              echo '<script type="text/javascript">';
              echo 'setTimeout(function () { swal({
                title: \'Erreur dans l\'ajout d`\'un coupon!\',
                text: \'\',
                type: "error",
              });';
                echo '}, 1000);</script>';


            }
          }
          else {
            // msg erreur date
            echo '    <script src="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.js"></script>';
            echo '    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.css" />';
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal({
              title: \'Erreur la date de fin doit etre supérieur à la date de début !\',
              text: \'\',
              type: "error",
            });';
              echo '}, 1000);</script>';
          }
          }
        }

        return $this->render('backend/ajouterCoupon.html.twig',[
          'nom'=>$request->request->get('nomC'),
          'code'=> $request->request->get('codeC'),
          'valeur'=>$request->request->get('valeurC'),
          'limiteUPC'=>$request->request->get('limitUPC'),
          'limiteUPCO'=>$request->request->get('limitUPCO'),
          'dateD'=>$request->request->get('dateD'),
          'dateF'=>$request->request->get('dateF'),
          'btn'=>$request->request->get('customRadioInline1'),



        ]);
    }
    /**
     * @Route("/clients", name="clients")
     */
    public function clients()
    {
        $rep = $this->getDoctrine()->getRepository(Client::class);
        $clients = $rep->findAll();

        return $this->render('backend/clients.html.twig',[
           'clients' => $clients
        ]);

    }
    /**
     * @Route("/clients/{idCl}", name="deleteClient" )
     */
    public function deleteClient($idCl,Request $request )
    {
      $client = $this->getDoctrine()->getRepository(Client::class)->find($idCl);

      $entiryManager=$this->getDoctrine()->getManager();
      $entiryManager->remove($client);
      $entiryManager->flush();
      $this->addFlash('success', 'Client Supprimé avec succès!');
        return $this->redirectToRoute('clients');


    }
    /**
     * @Route("/roles", name="roles")
     */
    public function roles()
    {
      $rep = $this->getDoctrine()->getRepository(Admin::class);
      $admins = $rep->findAll();

        return $this->render('backend/roles.html.twig',[
           'admins' => $admins
        ]);

    }
    /**
     * @Route("/roles/ajouter", name="ajouterAdmin")
     */
    public function ajouterRoles(Request $request , ObjectManager $manager)
    {
        dump($request);
        if($request->request->count()>0)
        {
          if(empty($request->request->get('Nom')) || empty($request->request->get('Prenom')) || empty($request->request->get('Email'))
          || empty($request->request->get('pswd')) || empty($request->request->get('pswd2')) )
          {
          echo '    <script src="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.js"></script>';
          echo '    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.css" />';
          echo '<script type="text/javascript">';
          echo 'setTimeout(function () { swal({
            title: \'Veuillez Remplir Tous Les Champs!\',
            text: \'\',
            type: "error",
          });';
            echo '}, 1000);</script>';

        }
         else {
          $admin = new Admin();
          $admin->setNom($request->request->get('Nom'))
                ->setPrenom($request->request->get('Prenom'))
                ->setEmail($request->request->get('Email'))
                ->setPassword($request->request->get('pswd'))
                  ->setRole($request->request->get('role'));

                if(($request->request->get('pswd'))==($request->request->get('pswd2')))
                         {
              $manager->persist($admin);
              $manager->flush();
              if ($manager)
                         {
                           echo '    <script src="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.js"></script>';
                           echo '    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.css" />';
                           echo '<script type="text/javascript">';
                           echo 'setTimeout(function () { swal({
                             title: \'Ajout Avec Succès!\',
                             text: \'\',
                             type: "success",
                               showConfirmButton: false
                           });';
                             echo '}, 1000);</script>';


                            header ("Refresh: 2;URL='../roles'");
                         }
                         else
                         {
                           echo '    <script src="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.js"></script>';
                           echo '    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.css" />';
                           echo '<script type="text/javascript">';
                           echo 'setTimeout(function () { swal({
                             title: \'Erreur dans l\'ajout d`\'un admin!\',
                             text: \'\',
                             type: "error",
                           });';
                             echo '}, 1000);</script>';


                         }
                       }
                       else {
                         // msg erreur date
                         echo '    <script src="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.js"></script>';
                         echo '    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.css" />';
                         echo '<script type="text/javascript">';
                         echo 'setTimeout(function () { swal({
                           title: \'Erreur les mots de passe ne sont pas similaires !\',
                           text: \'\',
                           type: "error",
                         });';
                           echo '}, 1000);</script>';
                       }
                       }
                     }
        return $this->render('backend/ajouterAdmin.html.twig',[
          'nom'=>$request->request->get('Nom'),
          'prenom'=>$request->request->get('Prenom'),
          'email'=>$request->request->get('Email'),
          'pswd'=>$request->request->get('pswd'),
          'pswd2'=>$request->request->get('pswd2'),
          'role'=>$request->request->get('role')

        ]);
    }
    /**
     * @Route("/roles/{idR}", name="deleteAdmin" )
     */
    public function deleteAdmin($idR,Request $request )
    {
      $admin = $this->getDoctrine()->getRepository(Admin::class)->find($idR);

      $entiryManager=$this->getDoctrine()->getManager();
      $entiryManager->remove($admin);
      $entiryManager->flush();
      $this->addFlash('success', 'Admin Supprimé avec succès!');
        return $this->redirectToRoute('roles');


    }

     /**
     * @Route("/updateRoles/{idR}", name="updateRole",methods="GET|POST")
     */
    public function updateRole($idR,Request $request , ObjectManager $manager)
    {
      $repo=$this->getDoctrine()->getRepository(Admin::class);
      $admin=$repo->find($idR);
      dump($admin);
      if($request->request->count()>0)
      {
        if(empty($request->request->get('Nom')) || empty($request->request->get('Prenom')) || empty($request->request->get('Email'))
        || empty($request->request->get('pswd')) || empty($request->request->get('pswd2')) )
        {
          echo '    <script src="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.js"></script>';
          echo '    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.css" />';
          echo '<script type="text/javascript">';
          echo 'setTimeout(function () { swal({
            title: \'Veuillez Remplir Tous Les Champs!\',
            text: \'\',
            type: "error",
          });';
            echo '}, 1000);</script>';

        }
        else {
         $admin->setNom($request->request->get('Nom'))
               ->setPrenom($request->request->get('Prenom'))
               ->setEmail($request->request->get('Email'))
               ->setPassword($request->request->get('pswd'))
                ->setRole($request->request->get('role'));

                 if(($request->request->get('pswd'))==($request->request->get('pswd2')))
                          {
             $manager->persist($admin);
             $manager->flush();
             dump($manager);
             if($manager)
              {
                echo '    <script src="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.js"></script>';
                echo '    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.css" />';
                echo '<script type="text/javascript">';
                echo 'setTimeout(function () { swal({
                  title: \'Modification Avec Succès!\',
                  text: \'\',
                  type: "success",
                    showConfirmButton: false
                });';
                  echo '}, 1000);</script>';


                 header ("Refresh: 2;URL='../roles'");
              }
            }
          else {
            // msg erreur date
            echo '    <script src="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.js"></script>';
            echo '    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.css" />';
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal({
              title: \'Erreur les mots de passe ne sont pas similaires !\',
              text: \'\',
              type: "error",
            });';
              echo '}, 1000);</script>';
          }

      }
    }
    return $this->render('backend/editRole.html.twig',[
      'admin'=>$admin,
    ]);

  }


    /**
     * @Route("/rapport", name="rapport")
     */
    public function rapport()
    {
        return $this->render('backend/rapport.html.twig');
    }
   
  
}
