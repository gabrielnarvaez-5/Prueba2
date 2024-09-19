import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Iprofesores } from '../Interfaces/iprofesores';

@Injectable({
  providedIn: 'root',
})
export class ProfesoresService {
  private apiurl = 'http://localhost/sexto/Proyectos/03MVC/controllers/profesores.controller.php?op=';

  constructor(private http: HttpClient) {}

  todos(): Observable<Iprofesores[]> {
    return this.http.get<Iprofesores[]>(this.apiurl + 'todos');
  }

  eliminar(idProfesor: number): Observable<number> {
    const formData = new FormData();
    formData.append('profesor_id', idProfesor.toString());
    return this.http.post<number>(this.apiurl + 'eliminar', formData);
  }

  insertar(profesor: Iprofesores): Observable<any> {
    return this.http.post<any>(this.apiurl + 'insertar', profesor);
  }
}
