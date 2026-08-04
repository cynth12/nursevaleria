<?php

namespace App\Http\Middleware;

use App\Models\Consultation;
use App\Models\Consentimiento;
use App\Models\Patient;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureShiftDateAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        /*
         * Los usuarios normales conservan acceso total.
         */
        if (!$user || !$user->is_shift_nurse) {
            return $next($request);
        }

        $shiftDate = $request->session()->get(
            'shift_date',
            now('America/Cancun')->toDateString()
        );

        $patient = null;
        $consultation = null;

        /*
         * Lista de consultas: /patients/{patient}/consultas
         */
        if ($request->routeIs('consultas.index')) {
            $parameter = $request->route('patient');

            $patient = $parameter instanceof Patient
                ? $parameter
                : Patient::findOrFail($parameter);
        }

        /*
         * Vista general de un paciente: /patient/{id}
         */
        if ($request->routeIs('patient.show')) {
            $patient = Patient::findOrFail(
                $request->route('id')
            );
        }

        /*
         * Rutas de consulta:
         * show, edit y update.
         */
        if ($request->routeIs([
            'consultas.show',
            'consultas.edit',
            'consultas.update',
        ])) {
            $parameter = $request->route('consultation');

            $consultation = $parameter instanceof Consultation
                ? $parameter
                : Consultation::findOrFail($parameter);

            $patient = $consultation->patient;
        }

        /*
         * Crear o guardar firma usando consultationId.
         */
        if ($request->routeIs([
            'consentimiento.create',
            'consentimiento.store',
        ])) {
            $consultation = Consultation::findOrFail(
                $request->route('consultationId')
            );

            $patient = $consultation->patient;
        }

        /*
         * Ver, editar o actualizar un consentimiento existente.
         */
        if ($request->routeIs([
            'consentimiento.show',
            'consentimiento.edit',
            'consentimiento.update',
        ])) {
            $consentimiento = Consentimiento::findOrFail(
                $request->route('id')
            );

            $consultation = $consentimiento->consultation;
            $patient = $consultation?->patient;
        }

        /*
         * El paciente debe haberse registrado en la fecha del turno.
         */
        if ($patient) {
            $patientDate = Carbon::parse(
                $patient->registration_date
            )->toDateString();

            if ($patientDate !== $shiftDate) {
                abort(
                    403,
                    'You do not have permission to access patients from another date.'
                );
            }
        }

        /*
         * La consulta también debe pertenecer a la fecha del turno.
         */
        if ($consultation) {
            $consultationDate = Carbon::parse(
                $consultation->registration_date
            )->toDateString();

            if ($consultationDate !== $shiftDate) {
                abort(
                    403,
                    'You do not have permission to access an older consultation.'
                );
            }
        }

        return $next($request);
    }
}