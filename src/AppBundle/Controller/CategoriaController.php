<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Categoria;
use AppBundle\Entity\CategoriaScientist;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Repository\CategoriaRepository;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\CategoriaFormType;
use Symfony\Component\HttpFoundation\Request;


class CategoriaController extends Controller
{

    /**
     * @Route("/categorias", name="categorias_index")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $categorias = $em->getRepository('AppBundle:Categoria')
            ->findAllCategorias();

        return $this->render('categorias/index.html.twig', [
            'categorias' => $categorias
        ]);
    }


    /**
     * @Route("/categorias/editar/{slug}", name="categorias_editar")
     */
    public function editarAction(Categoria $categoria, Request $request)
    {
        $form = $this->createForm(CategoriaFormType::class, $categoria);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categoria);
            $em->flush();

            $this->addFlash('success', 'Categoria Atualizada!');

            return $this->redirectToRoute('categorias_editar', [
                'slug' => $categoria->getSlug()
            ]);
        }

        return $this->render('categorias/editar.html.twig', array(
            'categoria' => $categoria,
            'categoriaForm' => $form->createView()
        ));
    }

    /**
     * @Route("/categorias/nova")
     */
    public function novaAction() {

        $em = $this->getDoctrine()->getManager();

        $categoria = new Categoria();
        $categoria->setName("Categoria# " . rand(1, 10000));

        $user = $em->getRepository("AppBundle:User")
            ->findOneBy(["email" => "aquanaut1@example.org"]);


        $categoriaScientist = new CategoriaScientist();
        $categoriaScientist->setCategoria($categoria);
        $categoriaScientist->setUser($user);
        $categoriaScientist->setPeriodoCategoria(10);
        $em->persist($categoriaScientist);

        $em->persist($categoria);
        $em->flush();

        return $this->render('categorias/nova.html.twig');
    }

    /**
     * @Route("/categorias/{categoriaId}/scientist/{userId}", name="categoria_scientist_remove")
     * @Method("DELETE")
     */
    public function removeCategoriaScientistAction($categoriaId, $userId)
    {
        $em = $this->getDoctrine()->getManager();

        $categoriaScientist = $em->getRepository('AppBundle:CategoriaScientist')
            ->findOneBy([
                'user'  => $userId,
                'categoria' => $categoriaId
            ]);

        $em->remove($categoriaScientist);
        $em->flush();

        return new Response(null, 204);
    }


    /**
     * @Route("/categorias/{slug}", name="categorias_show")
     */
    public function showAction(Categoria $categoria)
    {

        return $this->render('categorias/mostrar.html.twig', array(
            'categoria' => $categoria
        ));
    }


}
