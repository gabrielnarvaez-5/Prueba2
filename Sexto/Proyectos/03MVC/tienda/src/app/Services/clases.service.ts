import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Iclases } from '../Interfaces/iclases';

@Injectable({
  providedIn: 'root',
})
export class ClasesService {
  private apiurl = 'http://localhost/sexto/Proyectos/03MVC/controllers/gestion.controller.php?op=';

  constructor(private http: HttpClient) {}

  todos(): Observable<Iclases[]> {
    return this.http.get<Iclases[]>(this.apiurl + 'todosClases');
  }

  eliminar(idClase: number): Observable<number> {
    const formData = new FormData();
    formData.append('clase_id', idClase.toString());
    return this.http.post<number>(this.apiurl + 'eliminar', formData);
  }

  insertar(clase: Iclases): Observable<any> {
    const formData = new FormData();
    formData.append('nombre_clase', clase.nombre_clase);
    formData.append('profesor_id', clase.profesor_id.toString());
    
    return this.http.post<any>(this.apiurl + 'insertarClase', formData);
  }
}
