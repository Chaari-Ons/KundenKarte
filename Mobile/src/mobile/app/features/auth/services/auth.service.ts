import { Injectable } from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {Observable} from "rxjs";
import {User} from "../user";
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  link = environment.urlAPI+'users/register';

  constructor(private http: HttpClient) {}

  addUser(user: User): Observable<any> {
    const headers = { accept: 'application/json', contentType: 'application/json'};
    //let httpOptions.headers = httpOptions.headers.set('Authorization', 'my-new-auth-token');
    return this.http.post(this.link, user, {headers});
  }

  login(data): Observable<any> {
    return this.http.post(environment.urlAPI +'/login', data, {observe: 'response'});
  }

  register(data): Observable<any> {
    return this.http.post(this.link, data,
      {observe: 'response', headers:{ accept: 'application/json', contentType: 'application/json'}});
  }

  logout() {
    localStorage.removeItem('token');
  }

  // return true is there is a loggen in user
  public loggedIn(): boolean {
    return  localStorage.getItem('token')!==null;
  }

}
