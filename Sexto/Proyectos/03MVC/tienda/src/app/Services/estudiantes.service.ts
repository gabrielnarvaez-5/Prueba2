import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Iestudiantes } from '../Interfaces/iestudiantes';

@Injectable({
  providedIn: 'root',
})
export class EstudiantesService {
  private apiurl = 'http://localhost/sexto/Proyectos/03MVC/controllers/gestion.controller.php?op=';

  constructor(private http: HttpClient) {}

  // Método para obtener todos los estudiantes
  obtenerEstudiantes(): Observable<Iestudiantes[]> {
    return this.http.get<Iestudiantes[]>(this.apiurl + 'todosEstudiantes');
  }

  // Método para eliminar un estudiante
  eliminar(idEstudiante: number): Observable<number> {
    const formData = new FormData();
    formData.append('estudiante_id', idEstudiante.toString());
    return this.http.post<number>(this.apiurl + 'eliminar', formData);
  }

  // Método para insertar un nuevo estudiante
  insertarEstudiante(estudiante: Iestudiantes): Observable<Iestudiantes> {
    const formData = new FormData();
    formData.append('nombre', estudiante.nombre);
    formData.append('apellido', estudiante.apellido);
    formData.append('fecha_nacimiento', estudiante.fecha_nacimiento);
    formData.append('grado', estudiante.grado);
    return this.http.post<Iestudiantes>(this.apiurl + 'insertarEstudiante', formData);
  }
  
}
