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

class Itemcontroller extends Controller
{
    /**
     * @Route("/")
     * @Method({"GET"})
     */
    public function number()
    {
        $articles=$this->getDoctrine()->getRepository
        (Article::class)->findAll();
        return $this->render('items/index.html.twig', array ('articles'=>$articles));
      //  $number = random_int(0, 100);

       // return new Response(
       //     '<html><body>Lucky number: '.$number.'</body></html>' );
       }
    // /**
    //  * @Route("/article/save")
    //  */
    // //To use doctrine to save an article an entity manager is needed
    // public function save(){
    //     $entityManager=$this->getDoctrine()->getManager();
    //     $article=new Article();
    //     //Remember to write the method names from Article.php
    //     $article->setTitle('Article two');
    //     $article->setbody('The body of two');
    //     //Persist says that we want to eventually save $article to the database
    //     $entityManager->persist($article);
    //     //To save it flush is needed
    //     $entityManager->flush();

    //     return new Response ('Saved with id'.$article->returnId());
    // }
}
