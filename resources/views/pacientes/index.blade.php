@extends('adminlte::page')

@section('title', 'Patient list')

@section('content_header')
   <h1>{{ $titulo ?? 'Patients' }}</h1>
@endsection

@section('content')

<form method="GET" action="{{ route('pacientes.index') }}" class="mb-3">

    <div class="row">

        <div class="col-md-4">
            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Search patient..."
                   value="{{ request('search') }}">
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">
                Search
            </button>
        </div>

    </div>

</form>

    <div class="card">
        <div class="card-body">

            <table class="table table-bordered table-striped table-hover">

                <thead>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Last Name</th>
                            <th>Date of Birth</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </thead>

                <tbody>

                    @foreach ($patients as $patient)
                        <tr>

                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $patient->name }}</td>
                            <td>{{ $patient->last_name }}</td>
                            <td>{{ $patient->date_of_birth }}</td>
                            <td>{{ $patient->phone }}</td>
                            <td>{{ $patient->email }}</td>
                            <td>{{ $patient->registration_date }}</td>

                            <td>

                                <a href="{{ route('consultas.index', $patient->id) }}" class="btn btn-primary btn-sm">
                                    View
                                </a>

                                <!-- <a href="{{ route('consentimiento.create', $patient->id) }}"
                                   class="btn btn-warning btn-sm">
                                   Signature
                                </a>-->

                                <!--@if ($patient->consentimientos && $patient->consentimientos->count() > 0)
                                    <a href="{{ route('consentimiento.show', $patient->consentimientos->first()->id) }}"
                                        class="btn btn-info btn-sm">
                                        Consent
                                    </a>
                                @endif-->

                                <!-- <a href="{{ route('patient.edit', $patient->id) }}"
                                   class="btn btn-success btn-sm">
                                   Edit
                                </a>-->

                                <form action="{{ route('patient.destroy', $patient->id) }}" method="POST"
                                    style="display:inline;">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Delete
                                    </button>

                                </form>

                            </td>
                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

        {{-- PAGINACIÓN --}}
        <div class="card-footer clearfix">
            {{ $patients->links() }}
        </div>

    </div>

@endsection
