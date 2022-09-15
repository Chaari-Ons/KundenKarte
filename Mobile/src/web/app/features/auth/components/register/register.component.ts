import { Component, OnInit } from '@angular/core';
import {FormBuilder, FormGroup, Validators} from '@angular/forms';
import {NzMessageService} from 'ng-zorro-antd/message';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.scss'],
})
export class RegisterComponent implements OnInit {
  isLoading = false;
  passwordVisible = false;
  validateForm!: FormGroup;
  date = null;

  constructor(private fb: FormBuilder,
              private msg: NzMessageService) {
  }

  ngOnInit() {
    // this.validateForm = this.fb.group({
    //   name: [null, [Validators.required]],
    //   lastname: [null, [Validators.required]],
    //   email: [null, [Validators.required]],
    //   password: [null, [Validators.required]],
    //   date: [null, [Validators.required]],
    //   gender: [null, [Validators.required]],
    //   street: [null, [Validators.required]],
    //   streetNumber: [null, [Validators.required]],
    //   zip: [null, [Validators.required]],
    // });
  }

  register(){

  }

  onChange(result: Date): void {
    console.log('onChange: ', result);
  }
}
