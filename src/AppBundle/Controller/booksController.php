<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Book;
use AppBundle\Entity\Category;
use AppBundle\Entity\Book_has_category;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints as Assert;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;

class booksController extends Controller {

    /**
     * @Route("/formularz", name="b_formularz")
     */
    public function formAction(Request $request) {

        $book = new Book();
        $bhc = new Book_has_category();
        $category = $this->getDoctrine()->getRepository('AppBundle:Category')->find(1);

        $form = $this->createFormBuilder($book)
                ->add('title', TextType::class, array('attr' => array('class' => 'form-control mr-sm-2', 'style' => 'margin-bottom: 15px', 'placeholder' => "Book Title")))
                ->add('author', TextType::class, array('attr' => array('class' => 'form-control mr-sm-2', 'style' => 'margin-bottom: 15px', 'placeholder' => "Author Name")))
                ->add('price', NumberType::class, array('attr' => array('class' => 'form-control mr-sm-2', 'style' => 'margin-bottom: 15px', 'placeholder' => "Price")))
                ->add('save', SubmitType::class, array('label' => 'Add Book', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 15px')))
                ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $book = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $bhc->setBook($book);
            $bhc->setCategory($category);
            $em->persist($book);
            $em->persist($category);
            $em->persist($bhc);
            $em->flush();

			$this->addFlash(
						'notice',
						'Book Added'
						);
			
            return $this->redirectToRoute('b_formularz');
        }

        return $this->render('bookstwig/form.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/books", name="b_lista")
     */
    public function booksAction(Request $request) {
        
		static $title = "";
		$em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository('AppBundle:Book_has_category');
        $books = $repository->findAll();
		
        $forme = $this->createFormBuilder()
                ->add('select', ChoiceType::class, array('attr' => array('class' => 'form-control mr-sm-2', 'style' => 'margin-bottom: 15px'),
                    'choices' => array(
                        'Title and Author' => 'Title and Author',
                        'Author' => 'Author',
                        'Title' => 'Title',
                        'Category' => 'Category',
                        'Price' => 'Price',
            )))
                ->add('title', TextType::class, array('attr' => array('class' => 'form-control mr-sm-2', 'style' => 'margin-bottom: 15px', 'placeholder' => "Search")))
                ->add('save', SubmitType::class, array('label' => 'Search', 'validation_groups' => false, 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 15px', 'validation_groups' => false)))
                ->getForm();

        $forme->handleRequest($request);

        if ($forme->isSubmitted()) {

            $select = $forme->get('select')->getData();
            $title = $forme->get('title')->getData();

            $em = $this->getDoctrine()->getManager();

			 if ($select == 'Title and Author')
			  		$query = $em->getRepository('AppBundle:Book')->createQueryBuilder('b')
																					->select('b.id_book, b.title, b.author', 'b.price', 'c.name_cat')
																					->from('AppBundle:Category', 'c')
																					->where('b.title LIKE :title')
																					->orWhere('b.author LIKE :title')
																					->andWhere('b.id_book = c.id_category')
																					->setParameter('title', '%' .$title. '%')
																					->getQuery();

			 else if ($select == "Author")
			  		$query = $em->getRepository('AppBundle:Book')->createQueryBuilder('b')
																					->select('b.id_book, b.title, b.author', 'b.price', 'c.name_cat')
																					->from('AppBundle:Category', 'c')
																					->where('b.author LIKE :title AND b.id_book = c.id_category')
																					->setParameter('title', '%' .$title. '%')
																					->getQuery();

			else if ($select == "Title")
			  		$query = $em->getRepository('AppBundle:Book')->createQueryBuilder('b')
																					->select('b.id_book, b.title, b.author', 'b.price', 'c.name_cat')
																					->from('AppBundle:Category', 'c')
																					->where('b.title LIKE :title')
																					->andWhere('b.id_book = c.id_category')
																					->setParameter('title', '%' .$title. '%')
																					->getQuery();

			 else if ($select == "Category")
			  		$query = $em->getRepository('AppBundle:Book')->createQueryBuilder('b')
																					->select('b.id_book, b.title, b.author', 'b.price', 'c.name_cat')
																					->from('AppBundle:Category', 'c')
																					->where('b.title LIKE :title AND b.id_book = c.id_category')
																					->setParameter('title', '%' .$title. '%')
																					->getQuery();

			 else
			  		$query = $em->getRepository('AppBundle:Book')->createQueryBuilder('b')
																					->select('b.id_book, b.title, b.author', 'b.price', 'c.name_cat')
																					->from('AppBundle:Category', 'c')
																					->where('b.title LIKE :title AND b.id_book = c.id_category')
																					->setParameter('title', '%' .$title. '%')
																					->getQuery();
			$bookst = $query->getResult();
		
			$licz = count($bookst);

			$books = [];
		
			for($i = 0; $i<$licz; $i++)
			{
				$n[$i] = $bookst[$i]['id_book'];
				$tab = $this->getDoctrine()->getRepository('AppBundle:Book_has_category')->find($n[$i]);
				$books[] = $tab;
			}
        }
		
					/*$licz = count($books);
					$formtab = [];
					
					foreach($books as $boo)
					{
			       $formtab[]  = $forms = $this->createFormBuilder()
						->add('select', ChoiceType::class, array('attr' => array('class' => 'form-control mr-sm-2', 'style' => 'margin-bottom: 15px'),
						'choices' => array(
                        'fantasy' => 'fantasy',
                        'horror' => 'horror',
                        'przygodowa' => 'przygodowa',
                        'kryminał' => 'kryminał',
                        'bajki i baśnie' => 'bajki i baśnie',
						'klasyka' => 'klasyka',
						'IT' => 'IT',
						'romans' => 'romans',
						'popularnonaukowa' => 'popularnonaukowa',
					)))
						->add('add', SubmitType::class, array('label' => 'Search', 'validation_groups' => false, 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 15px')))
						//->add('del', SubmitType::class, array('label' => 'Search', 'validation_groups' => false, 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 15px')))
						->getForm();
					}*/

		$categories = $this->getDoctrine()->getRepository('AppBundle:Category')->findAll();
		
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
		
		if($title == "")
		{
			$result = $paginator->paginate(
					$books, 
					$request->query->getInt('page', 1),
					$request->query->getInt('limit', 5)
			);
		}
		else
		{
			$result = $paginator->paginate(
					$books
			);
		}
		
		$tablica = [];
		$tablica = array('books' => $result, 'categories' => $categories, 'forme' => $forme->createView(), 'title' => $title);
		
		/*for($i = 0; $i<$licz; $i++)
		{
			$tablica += ["forms" => $formtab[$i]->createView()];
		}*/
		
        return $this->render('bookstwig/books.html.twig', $tablica);

    }
}

?>