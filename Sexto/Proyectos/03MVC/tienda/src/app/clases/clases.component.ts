import { Component, OnInit } from '@angular/core';
import { Iclases } from '../Interfaces/iclases';
import { ClasesService } from '../Services/clases.service'; // Asegúrate de tener este servicio creado
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-clases',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './clases.component.html',
  styleUrls: ['./clases.component.css']
})
export class ClasesComponent implements OnInit {
  clases: Iclases[] = [];
  nuevaClase: Iclases = {
    nombre_clase: '',
    profesor_id: 0
  };

  constructor(private clasesService: ClasesService) {}

  ngOnInit(): void {
    this.cargarClases();
  }

  cargarClases() {
    this.clasesService.todos().subscribe((data) => {
      this.clases = data;
    });
  }

  agregarClase(formValues: Iclases) {
    this.clasesService.insertar(formValues).subscribe({
      next: () => {
        this.cargarClases(); // Recargar la lista después de agregar
        this.nuevaClase = { nombre_clase: '', profesor_id: 0 }; // Reiniciar el formulario
        alert('Clase agregada con éxito!'); // Mensaje de confirmación
      },
      error: (err) => {
        console.error('Error al insertar clase:', err); // Manejo de errores
        alert('Ocurrió un error al agregar la clase.'); // Mensaje de error
      }
    });
  }

  limpiarFormulario() {
    this.nuevaClase = {
      nombre_clase: '',
      profesor_id: 0
    };
  }
}
