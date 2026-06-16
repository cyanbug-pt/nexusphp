<?php

namespace App\Http\Middleware;

use App\Exceptions\NexusException;
use App\Models\Setting;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSiteStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if ($user && $user->class < User::CLASS_ADMINISTRATOR && !Setting::getIsSiteOnline()) {
            throw new NexusException(nexus_trans('misc.site_down_for_maintenance'));
        }
        return $next($request);
    }
}
