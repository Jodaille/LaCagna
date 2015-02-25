<?php

namespace LaCagnaProduct\Model;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Imagine\Image\ImageInterface;

class Medias
{
    protected $em;
    protected $servicelocator;

    public function addMedia($img_slug, $type = 'main')
    {
      $repository = $this->getEntityManager()
                              ->getRepository('LaCagnaProduct\Entity\Media');
      $media = $repository->findOneBySlug($img_slug);
      if(!$media)
      {
        $media = new \LaCagnaProduct\Entity\Media;
      }
      $media->setSlug($img_slug);
      $media->setType($type);
      $this->getEntityManager()->persist($media);
      $this->getEntityManager()->flush();
      return $media;
    }

    public function mkThumb($img_src, $img_dest, $format)
    {
      $imagine = $this->getServiceLocator()->get('ImagineImagick');
      $image     = $imagine->open($img_src);
      $size      = $image->getSize();
      $options = array(
          'resolution-units' => ImageInterface::RESOLUTION_PIXELSPERCENTIMETER,
          'resolution-x' => 300,
          'resolution-y' => 300,
          'jpeg_quality' => 100,
          'flatten' => false,
      );


      return $image->resize($image->getSize()->widen( $format ))
                                  ->save($img_dest, $options);
    }

    public function fetchFromUrl($url)
    {
      $filename = basename($url);
      $file = file_get_contents($url);
      $localname = "./data/uploads/$filename";
      file_put_contents($localname, $file);
      return $localname;
    }

    public function getList()
    {
        $repository = $this->getEntityManager()
                                ->getRepository('LaCagnaProduct\Entity\Media');
        return $repository->findAll();
    }

    public function getEntityManager()
    {
        if (null === $this->em)
        {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    public function setServiceLocator($serviceLocator)
    {
        $this->servicelocator = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->servicelocator;
    }
}
