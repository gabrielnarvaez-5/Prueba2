import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, catchError, throwError } from 'rxjs';
import { Iprofesores } from '../Interfaces/iprofesores';

@Injectable({
  providedIn: 'root',
})
export class ProfesoresService {
  private apiurl = 'http://localhost/sexto/Proyectos/03MVC/controllers/gestion.controller.php?op=';

  constructor(private http: HttpClient) {}

  todos(): Observable<Iprofesores[]> {
    return this.http.get<Iprofesores[]>(this.apiurl + 'todosProfesores').pipe(
      catchError((error) => {
        console.error('Error al obtener profesores:', error);
        return throwError(error);
      })
    );
  }

  insertarProfesor(profesor: Iprofesores): Observable<any> {
    return this.http.post(this.apiurl + 'insertarProfesor', profesor).pipe(
      catchError((error) => {
        console.error('Error al insertar profesor:', error);
        return throwError(error);
      })
    );
  }
}
