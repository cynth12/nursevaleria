@extends('adminlte::page')

@section('title', 'Pacientes')

@section('content')



<div class="container">
        <h1>Listado de Pacientes</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Last name</th>
                    <th>Date of birth</th>
                    <th>Phone</th>
                    <th>Mail</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <a href="" class="btn btn-primary btn-sm">Ver</a>

                            
                                <form action="" method="POST" style="display:inline;">
                                  
                                   
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        >Borrar</button>
                                </form>
                          
                        </td>
                    </tr>
            </tbody>
        </table>
    </div>
@endsection



