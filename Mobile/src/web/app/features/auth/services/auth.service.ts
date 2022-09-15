import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  token: string;
  user: string;

  constructor(private http: HttpClient) { }

  public login(credentials: any) {
    return this.http.post(environment.urlAPI + '/login', credentials , {observe: 'response'});
  }

  public checkLoggedIn() {
    return this.http.get(environment.urlAPI + '/check-logged-in');
  }

  logout() {
    localStorage.removeItem('token');
    localStorage.removeItem('user');
  }

  // return true is there is a loggen in user
  public loggedIn(): boolean {
    return  localStorage.getItem('token')!==null && localStorage.getItem('user') !== null ;
  }


  saveToken(data: any) {
    localStorage.setItem('token', data.token);
    localStorage.setItem('user', JSON.stringify(data.user));
    localStorage.setItem('permissions', JSON.stringify(data.user.permissions));
  }

  getPermissions() {
   return JSON.parse(localStorage.getItem('permissions'));
  }
}
