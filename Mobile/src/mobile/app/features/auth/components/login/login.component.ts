import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import {AuthService} from '../../services/auth.service';
import {NgForm} from '@angular/forms';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss'],
})
export class LoginComponent implements OnInit {
    private error: boolean = false;

  constructor(private router: Router, private authService: AuthService) {}


  ngOnInit() {}

  onLogin(formdata: NgForm){
    if (formdata.invalid) {
      return;
    }
    this.authService.login(formdata.value)
      .subscribe(
        rep=>{
          localStorage.setItem('token',rep.body.token);
          this.router.navigate(['/home']);
        },err=>{console.log(err);
        this.error = true; }
      );
  }

    generateToken() {
        localStorage.setItem('token','fake Token');
        this.router.navigate(['/home']);
    }

}
