<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictShiftNurseAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        /*
         * Si no hay usuario o no es enfermero de turno,
         * no aplicamos ninguna restricción.
         */
        if (!$user || !$user->is_shift_nurse) {
            return $next($request);
        }

        /*
         * Si el enfermero está desactivado,
         * cerramos su sesión inmediatamente.
         */
        if (!$user->is_active) {
            auth()->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->withErrors([
                    'email' => 'Your account has been disabled.',
                ]);
        }

        /*
         * Si por alguna razón no existe la fecha en sesión,
         * usamos la fecha actual.
         */
        if (!$request->session()->has('shift_date')) {
            $request->session()->put(
                'shift_date',
                now('America/Cancun')->toDateString()
            );
        }

        /*
         * Únicas rutas permitidas para el enfermero.
         */
        $allowedRoutes = [
            'patients.index',

            'patient.show',

            'consultas.index',
            'consultas.show',
            'consultas.edit',
            'consultas.update',

            'consentimiento.create',
            'consentimiento.store',
            'consentimiento.show',
            'consentimiento.edit',
            'consentimiento.update',

            'logout',
        ];

        if ($request->routeIs($allowedRoutes)) {
            return $next($request);
        }

        return redirect()
            ->route('patients.index')
            ->with(
                'error',
                'Your account only has access to patients registered on your current shift date.'
            );
    }
}