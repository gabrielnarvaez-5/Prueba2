import { Component, OnInit } from '@angular/core';
import { Iestudiantes } from '../Interfaces/iestudiantes';
import { EstudiantesService } from '../Services/estudiantes.service';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-estudiantes',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './estudiantes.component.html',
  styleUrls: ['./estudiantes.component.css']
})
export class EstudiantesComponent implements OnInit {
  estudiantes: Iestudiantes[] = [];
  nuevoEstudiante: Iestudiantes = {
    nombre: '',
    apellido: '',
    fecha_nacimiento: '',
    grado: ''
  };

  constructor(private estudiantesService: EstudiantesService) {}

  ngOnInit(): void {
    this.cargarEstudiantes();
  }

  cargarEstudiantes() {
    this.estudiantesService.obtenerEstudiantes().subscribe((data) => {
      this.estudiantes = data;
    });
  }

  agregarEstudiante(formValues: Iestudiantes) {
    this.estudiantesService.insertarEstudiante(formValues).subscribe({
      next: () => {
        this.cargarEstudiantes(); // Recargar la lista después de agregar
        this.nuevoEstudiante = { nombre: '', apellido: '', fecha_nacimiento: '', grado: '' }; // Reiniciar el formulario
      },
      error: (err) => {
        console.error('Error al insertar estudiante:', err); // Manejo de errores
      }
    });
  }
  

  limpiarFormulario() {
    this.nuevoEstudiante = {
      nombre: '',
      apellido: '',
      fecha_nacimiento: '',
      grado: ''
    };
  }
}
