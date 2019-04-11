<?php

namespace Drupal\article_item\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;

class ArticleController extends ControllerBase
{

    public function page()
    {


        $query = \Drupal::entityQuery('node')
            ->condition('type', 'article')
            ->condition('uid', 0);
        $filter_nids = $query->execute();
        //dsm($filter_nids);

        $nodes = Node::loadMultiple($filter_nids);

        foreach ($nodes as $nod) {
            $items[] = array (
                'title' => $nod->title->value,
                'body' => $nod->body->value,
            );
        }
        return array(
            '#theme' => 'article_list',
            '#items' => $items,
            '#title' => 'Our article list'
        );



    }
}
