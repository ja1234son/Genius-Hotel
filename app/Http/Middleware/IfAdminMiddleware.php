<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IfAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
    
        if ($user) {
            $email = $user->email;
    
            // Check if the email contains "@admin.com" (bypass Spatie for admin)
            if (strpos($email, '@admin.com') !== false) {
                return $next($request); // Admin user, bypass Spatie check, proceed
            }
    
            // Check if the user is an employee (by user_type)
            if ($user->user_type === 'employee') {
                return $next($request); // Employee user, proceed with Spatie check
            }
    
            // If the user is neither admin nor employee, check permissions using Spatie roles
            if (!$user->can('view-dashboard')) {
                return redirect()->route('login')->with('warning', 'You do not have admin or employee access.');
            }
        }
    
        // If no user found or conditions are not met, redirect to login
        return redirect()->route('login')->with('warning', 'You do not have admin or employee access.');
    }
    
   
    }

