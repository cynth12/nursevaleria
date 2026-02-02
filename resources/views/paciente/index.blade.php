@extends('adminlte::page')

@section('title', 'Pacientes')

@section('content')



 <h1>Create new patient</h1>






<form method="POST" action="">
    
    <div class="form-group">
        <label for="numero">Patient name</label>
        <select name="name" id="name" class="form-control" required>
         
                <option value="">Name</option>
        </select>
    </div>

    <div class="form-group">
        <label for="fecha">📅 Date of birth</label>
        <input type="text" name="fecha" id="fecha" class="form-control" placeholder="dd/mm/yyyy" required>
    </div>

    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="number" step="0.01" name="phone" id="premio" class="form-control" placeholder="" required>
    </div>
    <div class="form-group">
        <label for="phone">Email</label>
        <input type="number" step="0.01" name="phone" id="premio" class="form-control" placeholder="" required>
    </div>

    <h4 class="mt-4">Alergies</h4>
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                
                <th>Medicine</th>
                <th>Food</th>
            </tr>
        </thead>
        <tbody>
            
<tr>
    
    <td>
        <select name="" class="form-control">
            <option value="" class="form-control">select medicine</option>
            <option value=""></option>
        </select>
    </td>
    <td>
        <select name="" class="form-control" required>
            <option value="" disabled selected>Select food</option>
            
                <option value=""></option>
           
        </select>
    </td>
</tr>

        </tbody>
    </table>

    <button type="submit" class="btn btn-success mt-3">✅ Save patient</button>
</form>

@endsection
