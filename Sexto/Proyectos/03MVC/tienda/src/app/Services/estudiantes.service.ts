import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Iestudiantes } from '../Interfaces/iestudiantes';

@Injectable({
  providedIn: 'root',
})
export class EstudiantesService {
  private apiurl = 'http://localhost/sexto/Proyectos/03MVC/controllers/estudiantes.controller.php?op=';

  constructor(private http: HttpClient) {}

  todos(): Observable<Iestudiantes[]> {
    return this.http.get<Iestudiantes[]>(this.apiurl + 'todos');
  }

  eliminar(idEstudiante: number): Observable<number> {
    const formData = new FormData();
    formData.append('estudiante_id', idEstudiante.toString());
    return this.http.post<number>(this.apiurl + 'eliminar', formData);
  }

  insertar(estudiante: Iestudiantes): Observable<any> {
    return this.http.post<any>(this.apiurl + 'insertar', estudiante);
  }
}
