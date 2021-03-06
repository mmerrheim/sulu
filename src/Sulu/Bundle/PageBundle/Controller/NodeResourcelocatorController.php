<?php

/*
 * This file is part of Sulu.
 *
 * (c) Sulu GmbH
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Sulu\Bundle\PageBundle\Controller;

use FOS\RestBundle\Routing\ClassResourceInterface;
use Sulu\Bundle\PageBundle\Repository\ResourceLocatorRepositoryInterface;
use Sulu\Component\DocumentManager\DocumentManagerInterface;
use Sulu\Component\Rest\Exception\MissingArgumentException;
use Sulu\Component\Rest\RequestParametersTrait;
use Sulu\Component\Rest\RestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * handles resource locator api.
 */
class NodeResourcelocatorController extends RestController implements ClassResourceInterface
{
    use RequestParametersTrait;

    /**
     * return resource-locator for sub-node.
     *
     * @throws MissingArgumentException
     *
     * @deprecated since 2.0, use ResourcelocatorController::postAction instead
     *
     * @return Response
     */
    public function postGenerateAction(Request $request)
    {
        $parentUuid = $this->getRequestParameter($request, 'parent');
        $parts = $this->getRequestParameter($request, 'parts', true);
        $templateKey = $this->getRequestParameter($request, 'template', true);
        $webspaceKey = $this->getRequestParameter($request, 'webspace', true);
        $languageCode = $this->getLocale($request);

        $result = $this->getResourceLocatorRepository()->generate(
            $parts,
            $parentUuid,
            $webspaceKey,
            $languageCode,
            $templateKey
        );

        return $this->handleView($this->view($result));
    }

    /**
     * return all resource locators for given node.
     *
     * @param string $uuid
     * @param Request $request
     *
     * @return Response
     */
    public function cgetAction($uuid, Request $request)
    {
        list($webspaceKey, $languageCode) = $this->getWebspaceAndLanguage($request);
        $result = $this->getResourceLocatorRepository()->getHistory($uuid, $webspaceKey, $languageCode);

        return $this->handleView($this->view($result));
    }

    /**
     * deletes resource locator with given path.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function deleteAction(Request $request)
    {
        list($webspaceKey, $languageCode) = $this->getWebspaceAndLanguage($request);
        $path = $this->getRequestParameter($request, 'path', true);

        $this->getResourceLocatorRepository()->delete($path, $webspaceKey, $languageCode);
        $this->getDocumentManager()->flush();

        return $this->handleView($this->view());
    }

    /**
     * returns webspacekey and languagecode.
     *
     * @param Request $request
     *
     * @return array list($webspaceKey, $languageCode)
     */
    private function getWebspaceAndLanguage(Request $request)
    {
        $webspaceKey = $this->getRequestParameter($request, 'webspace', true);
        $languageCode = $this->getRequestParameter($request, 'language', true);

        return [$webspaceKey, $languageCode];
    }

    /**
     * @return ResourceLocatorRepositoryInterface
     */
    private function getResourceLocatorRepository()
    {
        return $this->get('sulu_page.rl_repository');
    }

    /**
     * @return DocumentManagerInterface
     */
    private function getDocumentManager()
    {
        return $this->get('sulu_document_manager.document_manager');
    }

    /**
     * {@inheritdoc}
     */
    public function getLocale(Request $request)
    {
        return $this->getRequestParameter($request, 'language', true);
    }
}
