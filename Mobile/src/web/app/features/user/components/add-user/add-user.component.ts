import {Component, OnInit} from '@angular/core';
import {FormBuilder, FormGroup, Validators} from '@angular/forms';

@Component({
  selector: 'app-add-user',
  templateUrl: './add-user.component.html',
  styleUrls: ['./add-user.component.scss'],
})
export class AddUserComponent implements OnInit {
  isLoading = false;
  passwordVisible = false;
  validateForm!: FormGroup;
  date = null;

  constructor(private fb: FormBuilder) {
  }

  ngOnInit() {
    this.validateForm = this.fb.group({
      name: [null, [Validators.required]],
      lastname: [null, [Validators.required]],
      email: [null, [Validators.required]],
      password: [null, [Validators.required]],
      date: [null, [Validators.required]],
      gender: [null, [Validators.required]],
      street: [null, [Validators.required]],
      streetNumber: [null, [Validators.required]],
      zip: [null, [Validators.required]],
    });
  }

  saveUser(){

  }

  onChange(result: Date): void {
    console.log('onChange: ', result);
  }
}
