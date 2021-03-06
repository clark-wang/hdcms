<?php

namespace App\Http\Middleware;

use App\Services\ModuleService;
use App\Services\SiteService;
use Closure;

/**
 * 前台中间件
 * Class FrontMiddleware
 */
class FrontMiddleware
{
  public function handle($request, Closure $next)
  {
    $site = app(SiteService::class)->getSiteByDomain();
    if (!$site || !$site->module) {
      dd('域名不属于任何站点或站点没有设置默认模块');
    }
    app(SiteService::class)->site($site);
    app(ModuleService::class)->module(site()['module']);
    return $next($request);
  }
}
