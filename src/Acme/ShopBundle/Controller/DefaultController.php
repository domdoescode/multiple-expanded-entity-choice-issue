<?php
namespace Acme\ShopBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\ShopBundle\Entity\Category;
use Acme\ShopBundle\Entity\Product;

class DefaultController extends Controller
{
    /**
     * @Route("/category/")
     * @Template()
     */
    public function categoryCreateAction(Request $request)
    {
        $category = new Category();

        $form = $this
            ->createFormBuilder($category)
            ->add('name', 'text', array(
                'label' => 'Category Name',
                'label_attr' => array(
                    'class' => 'small-title'
                ),
                'attr' => array(
                    'class' => 'user-input',
                )
            ))
            ->add('products', 'entity', array(
                'label' => 'Products',
                'label_attr' => array(
                    'class' => 'small-title'
                ),
                'attr' => array(
                    'class' => 'user-input span4',
                ),
                'class' => 'AcmeShopBundle:Product',
                'property' => 'name',
                'required' => false,
                'expanded' => true,
                'multiple' => true,
            ))
            ->getForm();

        if ($request->getMethod() == 'POST') {
            $this->save($category, $form, $request);
        }

        return array(
            'form' => $form->createView(),
            'categories' => $this->getDoctrine()->getRepository('AcmeShopBundle:Category')->findAll(),
        );
    }

    /**
     * @Route("/product/")
     * @Template()
     */
    public function productCreateAction(Request $request)
    {
        $product = new Product();

        $form = $this
            ->createFormBuilder($product)
            ->add('name', 'text')
            ->add('category', 'entity', array(
                'class' => 'AcmeShopBundle:Category',
                'property' => 'name',
                'required' => false,
            ))
            ->getForm();

        if ($request->getMethod() == 'POST') {
            $this->save($product, $form, $request);
        }

        return array(
            'form' => $form->createView(),
            'products' => $this->getDoctrine()->getRepository('AcmeShopBundle:Product')->findAll(),
        );
    }

    protected function save($entity, $form, $request)
    {
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
        }
    }
}
