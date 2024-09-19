import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, FormsModule, ReactiveFormsModule, Validators } from '@angular/forms';
import { Iprofesores } from 'src/app/Interfaces/iprofesores';
import { ProfesoresService } from 'src/app/Services/profesores.service';

@Component({
  selector: 'app-nuevoprofe',
  standalone: true,
  imports: [ReactiveFormsModule, FormsModule, CommonModule],
  templateUrl: './nuevoprofe.component.html',
  styleUrls: ['./nuevoprofe.component.scss']
})
export class NuevoprofeComponent implements OnInit {
  titulo = 'Nuevo Profesor';
  frm_Profesor: FormGroup;

  constructor(
    private fb: FormBuilder,
    private profesoresServicio: ProfesoresService
  ) {}

  ngOnInit(): void {
    this.crearFormulario();
  }

  crearFormulario() {
    this.frm_Profesor = new FormGroup({
      nombre: new FormControl('', Validators.required),
      apellido: new FormControl('', Validators.required),
      especialidad: new FormControl('', Validators.required),
      email: new FormControl('', [Validators.required, Validators.email])
    });
  }

  grabar() {
    if (this.frm_Profesor.valid) {
      const profesor: IProfesores = this.frm_Profesor.value;
      this.profesoresServicio.insertar(profesor).subscribe(
        (response) => {
          console.log('Profesor insertado exitosamente:', response);
          // Manejar la inserción exitosa (por ejemplo, mostrar un mensaje de éxito, restablecer el formulario, etc.)
          this.frm_Profesor.reset();
        },
        (error) => {
          console.error('Error al insertar profesor:', error);
          // Manejar el error (por ejemplo, mostrar un mensaje de error)
        }
      );
    } else {
      console.log('Formulario no válido');
      // Manejar los errores de validación del formulario si es necesario
    }
  }
}
