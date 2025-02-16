<?php

/**
 * Pimcore
 *
 * This source file is available under two different licenses:
 * - GNU General Public License version 3 (GPLv3)
 * - Pimcore Enterprise License (PEL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 *  @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.org)
 *  @license    http://www.pimcore.org/license     GPLv3 and PEL
 */

namespace App\Controller;

use App\Website\LinkGenerator\NewsLinkGenerator;
use Pimcore\Model\DataObject\News;
use Pimcore\Model\DataObject;
use Pimcore\Twig\Extension\Templating\HeadTitle;
use Pimcore\Twig\Extension\Templating\Placeholder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Pimcore\Controller\FrontendController;

class NewsController extends FrontendController
{
   

    /**
     * @Route("news/{id}", name="news-detail")
     */
    public function detailAction(Request $request, HeadTitle $headTitleHelper,$id): Response
    {
        $news = News::getById($id);

        if (!($news instanceof News && ($news->isPublished() || $this->verifyPreviewRequest($request, $news)))) {
            throw new NotFoundHttpException('News not found.');
        }
        $headTitleHelper($news->getTitle());
   
        return $this->render('news/detail.html.twig', [
            'news' => $news
        ]);
    }

    /**
     * @param Request $request
     * @param DataObject $object
     *
     * @return bool
     */
    protected function verifyPreviewRequest(Request $request, DataObject $object): bool
    {
        if (Tool::isElementRequestByAdmin($request, $object)) {
            return true;
        }

        return false;
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    protected function getAllParameters(Request $request): array
    {
        return array_merge($request->request->all(), $request->query->all());
    }

  
}
