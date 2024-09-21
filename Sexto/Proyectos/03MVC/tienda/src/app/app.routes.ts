import { Routes } from '@angular/router';
import { ProfesoresComponent } from './profesores/profesores.component';
import { EstudiantesComponent } from './estudiantes/estudiantes.component';
import { ClasesComponent } from './clases/clases.component'; 

export const routes: Routes = [
  {
    path: '',
    component: ProfesoresComponent,
  },
  {
    path: 'profesores', // Ruta para profesores
    component: ProfesoresComponent,
  },
  {
    path: 'estudiantes', // Ruta para estudiantes
    component: EstudiantesComponent,
  },
  {
    path: 'clases', // Ruta para clases
    component: ClasesComponent,
  },
];
