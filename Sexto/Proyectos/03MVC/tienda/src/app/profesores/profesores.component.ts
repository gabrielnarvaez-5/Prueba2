import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { Iestudiantes } from '../Interfaces/iestudiantes';
import { Iprofesores } from '../Interfaces/iprofesores';
import { Iclases } from '../Interfaces/iclases';
import { FormsModule } from '@angular/forms';
import { EstudiantesService } from '../Services/estudiantes.service';
import { ProfesoresService } from '../Services/profesores.service';
import { ClasesService } from '../Services/clases.service';

@Component({
  selector: 'app-profesores',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './profesores.component.html',
  styleUrls: ['./profesores.component.css']
})
export class ProfesoresComponent implements OnInit {
  estudiantes: Iestudiantes[] = [];
  profesores: Iprofesores[] = [];
  materias: Iclases[] = [];

  constructor(
    private estudiantesService: EstudiantesService,
    private profesoresService: ProfesoresService,
    private materiasService: ClasesService
  ) {}

  ngOnInit(): void {
    this.cargarEstudiantes();
    this.cargarProfesores();
    this.cargarMaterias();
  }

  cargarEstudiantes() {
    this.estudiantesService.obtenerEstudiantes().subscribe((data) => {
      this.estudiantes = data;
    });
  }

  cargarProfesores() {
    this.profesoresService.todos().subscribe((data) => {
      this.profesores = data;
    });
  }

  cargarMaterias() {
    this.materiasService.todos().subscribe((data) => {
      this.materias = data; 
    });
  }

  getProfesorNombre(profesor_id: number): string {
    const profesor = this.profesores.find((prof) => prof.profesor_id === profesor_id);
    return profesor ? profesor.nombre : 'Desconocido';
  }
}
