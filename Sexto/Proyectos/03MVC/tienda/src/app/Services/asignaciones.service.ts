import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Iasignaciones } from '../Interfaces/iasignaciones';

@Injectable({
  providedIn: 'root',
})
export class AsignaturasService {
  private apiurl = 'http://localhost/sexto/Proyectos/03MVC/controllers/gestion.controller.php?op=';

  constructor(private http: HttpClient) {}

  todos(): Observable<Iasignaciones[]> {
    return this.http.get<Iasignaciones[]>(this.apiurl + 'todos');
  }

  eliminar(idAsignatura: number): Observable<number> {
    const formData = new FormData();
    formData.append('asignatura_id', idAsignatura.toString());
    return this.http.post<number>(this.apiurl + 'eliminar', formData);
  }    

  insertar(asignatura: Iasignaciones): Observable<any> {
    return this.http.post<any>(this.apiurl + 'insertar', asignatura);
  }
}
