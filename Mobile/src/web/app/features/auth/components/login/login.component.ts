import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { NzMessageService } from 'ng-zorro-antd/message';
import { AuthService } from '../../services/auth.service';


@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss'],
})
export class LoginComponent implements OnInit {
  isLoading = false;
  credentials = {
    email: '',
    password: '',
  };
  passwordVisible = false;
  password?: string;
  constructor(
    private authService: AuthService,
    private message: NzMessageService,
    private router: Router
  ) { }

  ngOnInit(): void {
    localStorage.removeItem('token');
  }

  login() {
    this.isLoading = true;
    this.authService.login(this.credentials).subscribe(
      (response: any) => {
        this.createMessage('success', 'login succeed !');
        const data = response.body;
        this.authService.saveToken(data);
        this.router.navigate(['/application']);
      },
      (error) => {
        this.createMessage('error', error.error.message);
        this.isLoading = false;
      },
      () => {
        this.isLoading = false;
      }
    );
  }

  createMessage(type: string, message: any): void {
    this.message.create(type, ` ${message}`);
  }
}
