<?php

/*
 * This file is part of Sulu.
 *
 * (c) Sulu GmbH
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Sulu\Bundle\AdminBundle\Admin\Routing;

trait FormRouteBuilderTrait
{
    private function setResourceKeyToRoute(Route $route, string $resourceKey): void
    {
        $route->setOption('resourceKey', $resourceKey);
    }

    private function setFormKeyToRoute(Route $route, string $formKey): void
    {
        $route->setOption('formKey', $formKey);
    }

    private function setBackRouteToRoute(Route $route, string $backRoute): void
    {
        $route->setOption('backRoute', $backRoute);
    }

    private function setEditRouteToRoute(Route $route, string $editRoute): void
    {
        $route->setOption('editRoute', $editRoute);
    }

    private function setIdQueryParameterToRoute(Route $route, string $idQueryParameter): void
    {
        $route->setOption('idQueryParameter', $idQueryParameter);
    }

    private function addLocalesToRoute(Route $route, array $locales): void
    {
        $oldLocales = $route->getOption('locales');
        $newLocales = $oldLocales ? array_merge($oldLocales, $locales) : $locales;
        $route->setOption('locales', $newLocales);
    }

    private function addToolbarActionsToRoute(Route $route, array $toolbarActions): void
    {
        $oldToolbarActions = $route->getOption('toolbarActions');
        $newToolbarActions = $oldToolbarActions ? array_merge($oldToolbarActions, $toolbarActions) : $toolbarActions;
        $route->setOption('toolbarActions', $newToolbarActions);
    }

    private function addRouterAttributesToFormStoreToRoute(Route $route, array $routerAttributesToFormStore): void
    {
        $oldRouterAttributesToFormStore = $route->getOption('routerAttributesToFormStore');
        $newRouterAttributesToFormStore = $oldRouterAttributesToFormStore
            ? array_merge($oldRouterAttributesToFormStore, $routerAttributesToFormStore)
            : $routerAttributesToFormStore;

        $route->setOption('routerAttributesToFormStore', $newRouterAttributesToFormStore);
    }

    private function addRouterAttributesToEditRouteToRoute(Route $route, array $routerAttributesToEditRoute): void
    {
        $oldRouterAttributesToEditRoute = $route->getOption('routerAttributesToEditRoute');
        $newRouterAttributesToEditRoute = $oldRouterAttributesToEditRoute
            ? array_merge($oldRouterAttributesToEditRoute, $routerAttributesToEditRoute)
            : $routerAttributesToEditRoute;

        $route->setOption('routerAttributesToEditRoute', $newRouterAttributesToEditRoute);
    }
}
