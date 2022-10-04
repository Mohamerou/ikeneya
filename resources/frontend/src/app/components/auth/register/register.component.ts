import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { DataService } from 'src/app/service/data.service';
import { Register } from 'src/app/models/register.model';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {
  form!: FormGroup;
  submitted = false;
  users:any;
  user = new Register;

  constructor(private formBuilder: FormBuilder) { }

  ngOnInit(): void {
    this.createForm();
  }


  createForm() {
    this.form = this.formBuilder.group({
      first_name: [null, Validators.required],
      last_name: [null, Validators.required],
      phone: [null, Validators.required, Validators.minLength(8)],
    });
  }

  Submit() {
    this.submitted = true;
    if(this.form.invalid) {
      return;
    }
  }


  get f() {
    return this.form.controls;
  }
}
