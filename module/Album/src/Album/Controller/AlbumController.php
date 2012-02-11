<?php

namespace Album\Controller;

use Zend\Mvc\Controller\ActionController,
    Album\Form\AlbumForm,
    Album\Entity\Album,
    Doctrine\ORM\EntityManager;

class AlbumController extends ActionController
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $_em;

    public function setEntityManager(EntityManager $em)
    {
        $this->_em = $em;
    }

    public function indexAction()
    {
        return array(
            'albums' => $this->_em->getRepository('Album\Entity\Album')->findAll(),
        );
    }

    public function addAction()
    {
        $form = new AlbumForm();
        $form->submit->setLabel('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $formData = $request->post()->toArray();
            if ($form->isValid($formData)) {
                $album = new Album();
                $album->artist = $form->getValue('artist');
                $album->title = $form->getValue('title');

                $this->_em->persist($album);
                $this->_em->flush();

                // Redirect to list of albums
                return $this->redirect()->toRoute('default', array(
                    'controller' => 'album',
                    'action'     => 'index',
                ));
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        $form = new AlbumForm();
        $form->submit->setLabel('Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $formData = $request->post()->toArray();
            if ($form->isValid($formData)) {

                $album = $this->_em->find('Album\Entity\Album', $form->getValue('id'));
                if ($album) {
                    $album->artist = $form->getValue('artist');
                    $album->title = $form->getValue('title');
                    $this->_em->flush();
                }

                // Redirect to list of albums
                return $this->redirect()->toRoute('default', array(
                    'controller' => 'album',
                    'action'     => 'index',
                ));
            }
        } else {
            $album = $this->_em->find('Album\Entity\Album', $request->query()->get('id', 0));
            if ($album) {
              $form->populate($album->toArray());
            }
        }

        return array('form' => $form);
    }

    public function deleteAction()
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->post()->get('del', 'No');
            if ($del == 'Yes') {
                $album = $this->_em->find('Album\Entity\Album', $request->post()->get('id'));
                if ($album) {
                    $this->_em->remove($album);
                    $this->_em->flush();
                }
            }

            // Redirect to list of albums
            return $this->redirect()->toRoute('default', array(
                'controller' => 'album',
                'action'     => 'index',
            ));
        }

        $id = $request->query()->get('id', 0);
        return array('album' => $this->_em->find('Album\Entity\Album', $id)->toArray());
    }
}