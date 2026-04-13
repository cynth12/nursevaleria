<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Nurse – Valeria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">

</head>



<div class="container">
    <img src="{{ asset('img/formulario.png') }}" class="form-header-image"><br>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('patient.form.store') }}" method="POST">
        @csrf
        <h1></h1><br>
        <h2 class="form-title">BASIC EVALUATION FOR IV THERAPY</h2><br>
        <!-- Datos personales -->
        <h4>Datos personales</h4>
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Fecha de nacimiento</label>
            <input type="date" name="dob" class="form-control">
        </div>
        <div class="form-group">
            <label>Teléfono (WhatsApp)</label>
            <input type="text" name="phone" class="form-control">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <!-- Motivo y síntomas -->
        <h4>Motivo de la visita</h4>
        <div class="form-group">
            <label>Razón de la visita</label>
            <input type="text" name="reason" class="form-control">
        </div>
        <div class="form-group">
            <label>Síntomas</label><br>
            <label><input type="checkbox" name="symptoms[]" value="Dolor abdominal"> Dolor abdominal</label><br>
            <label><input type="checkbox" name="symptoms[]" value="Fiebre"> Fiebre</label><br>
            <label><input type="checkbox" name="symptoms[]" value="Vómito"> Vómito</label><br>
            <label><input type="checkbox" name="symptoms[]" value="Diarrea"> Diarrea</label><br>
            <label><input type="checkbox" name="symptoms[]" value="Ninguno"> Ninguno</label>
        </div>

        <!-- Contacto de emergencia -->
        <h4>Contacto de emergencia</h4>
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="emergency_contact_name" class="form-control">
        </div>
        <div class="form-group">
            <label>Relación</label>
            <input type="text" name="emergency_contact_relation" class="form-control">
        </div>
        <div class="form-group">
            <label>Teléfono</label>
            <input type="text" name="emergency_contact_phone" class="form-control">
        </div>

        <!-- Solicitud de IV -->
        <h4>Solicitud de IV</h4>
        <div class="form-group">
            <select name="iv_type" class="form-control custom-select">
                <option value="">Seleccione...</option>
                <option class="form-control optio">Custom</option>
                <option value="Wellness Duo">Wellness Duo</option>
                <option value="Energy Boost">Energy Boost</option>
                <option value="Beauty Glow">Beauty Glow</option>
                <option value="Hangover">Hangover</option>
                <option value="Immune Boost">Immune Boost</option>
            </select>
        </div>

        <!-- Historial médico -->
        <h4>Historial médico</h4>
        <div class="form-group">
            <label>Embarazo</label>
            <select name="pregnant" class="form-control">
                <option value="">Seleccione...</option>
                <option value="yes">Sí</option>
                <option value="no">No</option>
            </select>
        </div>
        <div class="form-group">
            <label>Alergias</label>
            <textarea name="allergies" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label>Medicamentos</label>
            <textarea name="medications" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label>Suplementos</label>
            <textarea name="supplements" class="form-control"></textarea>
        </div>

        <!-- Consentimiento -->
        <h4>Consentimiento informado</h4>
        <p>
            Autorizo la aplicación de terapia intravenosa y libero de responsabilidad al personal de NurseValeria.
        </p>
        <div class="form-group">
            <label><input type="checkbox" name="consent" value="1"> Acepto</label>
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>

