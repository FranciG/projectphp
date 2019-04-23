<?php
// Looks like the file name, and the class name, should match
namespace App\Controller;
//Bring in the Article entity previusly created in /Entity/Article.php
use App\Entity\Article;
use Symfony\Component\HttpFoundation\Response;
//To use annotations and no the routes.yaml
use Symfony\Component\Routing\Annotation\Route;
//To specify methods like get, post the routes can take
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
//Bring the twig template
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//For the form
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;


class Itemcontroller extends Controller
//Setting up anotations with the routes and the type of requests the route can make
//so routes.yaml is not used
{
    /**
     * @Route("/", name="article_list")
     * @Method({"GET"})
     */
    public function main()
    {
      //Doctrine is used to interact with the databse
        $articles=$this->getDoctrine()->getRepository
         (Article::class)->findAll();
     //Rendering the template
        return $this->render('items/index.html.twig', array ('articles'=>$articles));
    }
       
        /**
         * @Route("/article/new", name="new_item")
         * Method({"GET", "POST"})
         */
        public function new(Request $request) {
            $article = new Article();
            $form=$this->createFormBuilder($article)
            ->add('title', TextType::class, array('attr'=>array('class'=>'form-control')))
            ->add('body', TextareaType::class, array(
            //The body is required
           'required'=> true,
           'attr'=>array('class'=>'form-control')
             ))
             ->add('save', SubmitType::class, array(
                'label' => 'Create',
                'attr' => array('class' => 'btn btn-primary mt-3')
              ))
              ->getForm();
               

              $form->handleRequest($request);

              //Checking if the form is been submited
              if($form->isSubmitted() && $form->isValid()) {
                $article = $form->getData();
                
                //If is valid, we add the item to the database
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($article);
                $entityManager->flush();
                //After,we return to the articles list
                return $this->redirectToRoute('article_list');
              }
        

              return $this->render('items/create.html.twig', array(
                'form' => $form->createView()
              ));
        }


        
         /**
         * @Route("/article/{id}", name="article_show")
         */

         //Instead of findall, find it is used, passing the id as a parameter to find.
        
       
         public function show($id) {
            $article=$this->getDoctrine()->getRepository(Article::class)->find($id);
            return $this->render('items/find.html.twig', array ('article'=>$article));
          }
 //Delete route
     /**
      * @Route("/article/delete/{id}")
      *@Method ({"DELETE"})
      */  
        public function delete(Request $request, $id) {
          $article=$this->getDoctrine()->getRepository(Article::class)->find($id);
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->remove($article);
          $entityManager->flush();
          $response= new Response();
          $response->send();
        }

   /**
         * @Route("/article/edit/{id}", name="edit_item")
         * Method({"GET", "POST"})
         */
        public function edit(Request $request, $id) {
          $article = new Article();
          //First the article is found
          $article=$this->getDoctrine()->getRepository(Article::class)->find($id);
          //Then it is pased to the form builder
          $form=$this->createFormBuilder($article)
          ->add('title', TextType::class, array('attr'=>array('class'=>'form-control')))
          ->add('body', TextareaType::class, array(
          //The body is required
         'required'=> true,
         'attr'=>array('class'=>'form-control')
           ))
           ->add('save', SubmitType::class, array(
              'label' => 'Modify',
              'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();
             

            $form->handleRequest($request);

            //Checking if the form is been submited
            if($form->isSubmitted() && $form->isValid()) {
             // $article = $form->getData();
              
              //If is valid, we add the item to the database
              $entityManager = $this->getDoctrine()->getManager();
             // $entityManager->persist($article);
              $entityManager->flush();
              //After,we return to the articles list
              return $this->redirectToRoute('article_list');
            }
      

            return $this->render('items/create.html.twig', array(
              'form' => $form->createView()
            ));
      }
}
