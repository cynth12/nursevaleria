@extends('adminlte::page')

@section('title', 'Group details')

@section('content')

    <div class="container">

        <h2>Group: {{ $group->place }}</h2>

        <p>
            <strong>Creation date:</strong> {{ $group->date }}
        </p>

        <hr>

        <h4>Group patients</h4>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Date of birth</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th width="320">Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($patients as $patient)
                    @php
                        $consultation = $patient->consultations()->latest('registration_date')->first();
                    @endphp

                    <tr>
                        <td>{{ $patient->id }}</td>
                        <td>{{ $patient->name }} {{ $patient->last_name }}</td>
                        <td>{{ $patient->date_of_birth }}</td>
                        <td>{{ $patient->phone }}</td>
                        <td>{{ $patient->email }}</td>

                        <td>

                            @if ($consultation)
                                {{-- View --}}
                                <a href="{{ route('consultas.show', $consultation->id) }}" class="btn btn-primary btn-sm">
                                    View
                                </a>

                                {{-- Edit --}}
                                <a href="{{ route('consultas.edit', $consultation->id) }}" class="btn btn-success btn-sm">
                                    Edit
                                </a>

                               @if ($consultation->consentimiento)
                                    <a href="{{ route('consentimiento.show', $consultation->consentimiento->id) }}"
                                        class="btn btn-info btn-sm">
                                        Consent
                                    </a>
                                @endif

                                {{-- Delete --}}
                                <form action="{{ route('consultas.destroy', $consultation->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this consultation?')">
                                        Delete
                                    </button>
                                </form>
                            @else
                                <span class="text-muted">
                                    No consultations
                                </span>
                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="text-center">
                            No patients assigned to this group.
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>

    </div>

@endsection
